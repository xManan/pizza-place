@props(['cart'])
<div id="cart" class="basis-1/4 block w-full">
    <div class="border border-gray-200 p-4 bg-white text-center">
        @if($cart->isEmpty())
            <img src="{{ Vite::asset('resources/images/empty-cart.png') }}" class="mx-auto" />
        @else
            <h2 class="text-xl font-bold">Cart</h2>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @foreach($cart as $cartItem)
                <x-cart-item :cartItem="$cartItem" />
            @endforeach
                <hr class="mt-2">
                <div class="flex justify-between my-2">
                    <h2 class="text-lg font-bold">Total</h2>
                    <h2 class="text-lg font-bold">Rs. {{ $cart->sum(function($item) { return $item['total_price'] * $item['qty']; }) / 100 }}</h2>
                </div>
                <hr>
                <button class="mt-4 bg-orange-500 text-white px-8 py-2 rounded-lg">Checkout</button>
        @endif
    </div>
</div>
