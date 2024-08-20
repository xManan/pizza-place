<?php

use App\Enums\MenuCategory;
use App\Models\CartItem;
use App\Models\Customer;
use App\Models\MenuItem;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Route::view('/checkout', 'customer.checkout');

// Auth::guard('customer')->login(Customer::find(1));
Route::post('/cart', function(Request $request) {
    $request->validate([
        'itemId' => [ 'required', 'int' ]
    ]);

    $options = $request->options ?? [];

    $item = MenuItem::with('options.values')->findOrFail($request->itemId);

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

Route::patch('/cart/item/{itemId}/qty/{action}', function($itemId, $action) {
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
    return view('components.cart', [ 'cart' => $cart->items ]);
})->middleware('auth:customer');