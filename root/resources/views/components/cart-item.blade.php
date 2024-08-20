@props(['cartItem'])
<div id="cart-item-{{$cartItem->id}}" class="flex justify-between items-center mt-4 text-left">
    <div style="max-width: 10rem" class="flex flex-col">
        <span class="font-bold  text-xs">{{ $cartItem->menuItem->name }}</span>
        <span class="text-xs text-gray-500">{{ $cartItem->optionValues()->pluck('label')->implode(' | ') }}</span>
    </div>
    <div class="flex space-x-4">
        <x-quantity-btn :id="$cartItem->id">{{ $cartItem->qty }}</x-quantity-btn>
        <span class="font-bold text-xs min-w-16 text-right">Rs. {{ ($cartItem->qty * $cartItem->total_price) / 100 }}</span>
    </div>
</div>