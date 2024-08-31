<?php

use App\Enums\MenuCategory;
use App\Models\Customer;
use App\Models\CustomerAddress;
use App\Models\MenuItem;
use App\Models\Order;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rules\Password;

Route::get('/', function() {
    $cart = collect();
    $user = Auth::guard('customer')->user();
    if($user) {
        $cart = $user->cart->items;        
    }

    return view('customer.menu', [ 'items' => MenuItem::with('options.values')->where('category', MenuCategory::PIZZAS)->get(), 'cart' => $cart ]);
});

Route::get('/menu/{category}', function($category) {
    $category = strtoupper($category);
    if(MenuCategory::isNotValid($category)) {
        abort(404);
    }
    $items = MenuItem::with('options.values')->where('category', $category)->get();
    $cart = collect();
    $user = Auth::guard('customer')->user();
    if($user) {
        $cart = $user->cart->items;        
    }
    return view('customer.menu', [ 'items' => $items, 'cart' => $cart ]);
});

Route::get('/menu/item/{id}/options', function($id) {
    if (app()->environment('local')) {
        Debugbar::disable();
    }

    $optionsQueryCallback = function($query) {
        $query->select('id', 'name', 'label', 'is_multiselect');
    };

    $optionValuesQueryCallback = function($query) {
        $query->select('id', 'menu_item_option_id', 'label', 'value', 'price', 'is_default');
    };

    $item = MenuItem::with([ 'options' => $optionsQueryCallback, 'options.values' => $optionValuesQueryCallback ])->findOrFail($id);
    
    return view('components.menu.item-options', [ 'item' => $item, 'options' => $item->options ]);
});

Route::view('/offers', 'customer.offers');
Route::view('/login', 'customer.auth.login')->name('login');

Route::get('/checkout', function(Request $request) { 
    $user = Auth::guard('customer')->user();
    $cart = $user->cart->items;        
    $props = ['cart' => $cart];
    if(isset($request['deliverTo'])) {
        $address = CustomerAddress::find($request['deliverTo']);
        if($address) {
            $props['deliverTo'] = $address;
        }
    }
    return view('customer.checkout', $props);
})->middleware('auth:customer');

Route::post('/cart', function(Request $request) {
    $request->validate([
        'item_id' => [ 'required', 'int' ]
    ]);

    $options = $request->options ?? [];

    $item = MenuItem::with('options.values')->findOrFail($request->item_id);

    if(!$item->options->isEmpty()) {
        $optionIds = collect($options)->flatten();
        $allOptionIds = $item->options->flatMap(function($option){
            return $option->values->pluck('id');
        });

        $allOptionsBelongToMenuItem = collect($optionIds)->every(function($optionId) use($allOptionIds) {
            return $allOptionIds->contains($optionId);
        });

        if(!$allOptionsBelongToMenuItem) {
            abort(400);
        }

        $optionValuesTotalPrice = $item->options->flatMap(function($option) use ($optionIds) {
            return $option->values->whereIn('id', $optionIds);
        })->sum('price');
    } else {
        $optionIds = [];
        $optionValuesTotalPrice = 0;
    }

    $user = Auth::guard('customer')->user();

    $cartItem = $user->cart->items()->firstOrCreate([
        'menu_item_id' => $item->id,
        'options' => json_encode($optionIds),
        'total_price' => $item->base_price + $optionValuesTotalPrice,
    ]);
    
    if(!$cartItem->wasRecentlyCreated) {
        $cartItem->increment('qty');
    }

    return redirect('/menu/' . strtolower($item->category));
})->middleware('auth:customer');

Route::patch('/cart/item/{itemId}/qty/{action}', function(Request $request, $itemId, $action) {
    $user = Auth::guard('customer')->user();
    $cartItem = $user->cart->items()->findOrFail($itemId);
    $cart = $cartItem->cart;
    if($action == "+") {
        $cartItem->increment('qty');
    } else {
        $cartItem->decrement('qty');        
        if($cartItem->qty <= 0) {
            $cartItem->delete();
        }
    }
    return view('components.cart', [ 'cart' => $cart->items, 'isCheckout' => boolval($request->get('checkout')) ]);
})->middleware('auth:customer');

Route::post('/login', function(Request $request) {
    $credentials = $request->validate([
        'phone' => ['required', 'regex:/[0-9]{10}/'],
        'password' => ['required'],
    ]);
    
    if (Auth::guard('customer')->attempt($credentials)) {
        $request->session()->regenerate();

        return redirect()->intended('/');
    }

    return back()->withErrors([
        'phone' => 'The provided credentials do not match our records.',
    ])->onlyInput('phone');
});

Route::post('/logout', function(Request $request) {
    Auth::guard('customer')->logout();

    return redirect('/');
})->middleware('auth:customer');

Route::get('/forgot-password', function() {
    return view('customer.auth.forgot-password');
});

Route::get('/register', function() {
    return view('customer.auth.register');
});

Route::post('/register', function(Request $request) {
    $inputs = $request->validate([
        'first_name' => [ 'required' ],
        'last_name' => [ 'required' ],
        'phone' => [ 'required', 'regex:/[0-9]+/', 'unique:customers,phone' ],
        'email' => [ 'required', 'email', 'unique:customers,email' ],
        'password' => [ 'required', Password::default(), 'confirmed' ],
    ]);
    
    $user = Customer::create($inputs);
    $user->cart()->create();

    Auth::guard('customer')->login($user);

    return redirect('/');
});

Route::get('/profile', function() {
    return view('customer.profile');
})->middleware('auth:customer');

Route::post('/customer/address', function (Request $request) {
    $inputs = $request->validate([
        'name' => 'required',
        'address1' => 'required',
        'address2' => 'required',
        'city' => 'required',
        'pincode' => 'required',
    ]);
    
    /** @var \App\Models\User $user */
    $user = Auth::guard('customer')->user();

    $user->addresses()->create($inputs);

    return back();
});

Route::post('/order', function (Request $request) {
    /** @var \App\Models\User $user */
    $user = Auth::guard('customer')->user();
    $items = $user->cart->items;
    if($items->isEmpty()) {
        return redirect('/');
    }
    $order = $user->orders()->create();
    $totalAmount = 0;
    foreach($items as $item) {
        $order->items()->create([
            'menu_item_id' => $item->menu_item_id,
            'options' => json_encode($item->options),
            'qty' => $item->qty,
            'total_price' => $item->total_price,
        ]);
        $totalAmount += $item->total_price * $item->qty;
    }
    $gst = $totalAmount * env('GST_PERC', 0) / 100;
    $deliveryFee = env('DELIVERY_FEE', 0);
    $netTotal = $totalAmount + $gst + $deliveryFee;

    $order->gst = $gst;
    $order->delivery_fee = $deliveryFee;
    $order->net_total = $netTotal;
    $order->save();

    $user->cart->items()->delete();
    return redirect('/order/' . $order->id . '?success=true');
});

Route::get('/order/{id}', function(Request $request, $id) {
    /** @var \App\Models\User $user */
    $user = Auth::guard('customer')->user();
    $order = $user->orders()->findOrFail($id);
    return view('customer.order', [ 'order' => $order ]);
});