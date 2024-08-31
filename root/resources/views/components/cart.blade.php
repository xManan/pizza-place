@props(['cart'])
@php
    $totalAmount = $cart->sum(function($item) { return $item['total_price'] * $item['qty'];});
    $gst = $totalAmount * env('GST_PERC', 0) / 100;
    $deliveryFee = env('DELIVERY_FEE', 0);
    $netTotal = $totalAmount + $gst + $deliveryFee;
@endphp
<div id="cart" class="basis-1/4 block w-full">
    <div class="border border-gray-200 p-4 bg-white text-center">
        @if($cart->isEmpty())
            <img src="{{ Vite::asset('resources/images/empty-cart.png') }}" class="mx-auto" />
        @else
            <h2 class="text-xl font-bold">Cart</h2>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @foreach($cart as $cartItem)
                <x-cart-item :cartItem="$cartItem" :isCheckout="request()->is('checkout') || (isset($isCheckout) && $isCheckout)" :deliverTo="request()->get('deliverTo')" />
            @endforeach
                @if(request()->is('checkout') || (isset($isCheckout) && $isCheckout))
                    <br>
                    <hr>
                    <br>
                    <div class="text-left">
                        <strong>
                            Bill Details
                        </strong>
                        <div class="flex justify-between text-xs">
                            <p>Total</p>
                            <p>Rs. {{ $totalAmount / 100 }}</p>
                        </div>
                        <div class="flex justify-between text-xs">
                            <p>Delivery Fee</p>
                            <p>Rs. {{ $deliveryFee / 100 }}</p>
                        </div>
                        <div class="flex justify-between text-xs">
                            <p>GST</p>
                            <p>Rs. {{ $gst / 100 }}</p>
                        </div>
                        <br>
                        <hr>
                        <br>
                        <div class="flex justify-between">
                            <strong>To Pay</strong>
                            <strong>Rs. {{ $netTotal / 100 }}</strong>
                        </div>
                        <br>
                    </div>
                    @if(!empty(request()->get('deliverTo')))
                        <form action="/order" method="POST">
                            @csrf
                            <input type="text" class="hidden" name="address_id" value="{{ request()->get('deliverTo') }}"/>
                            <x-form.button class="text-white">Place Order</x-form.button>
                        </form>
                    @endif
                @else
                    <hr class="mt-2">
                    <div class="flex justify-between my-2">
                        <h2 class="text-lg font-bold">Total</h2>
                        <h2 class="text-lg font-bold">Rs. {{ $cart->sum(function($item) { return $item['total_price'] * $item['qty']; }) / 100 }}</h2>
                    </div>
                    <hr>
                    <br>
                    <a href="/checkout" class="bg-orange-500 text-white px-8 py-2 rounded-lg">Checkout</a>
                @endif
        @endif
    </div>
</div>
