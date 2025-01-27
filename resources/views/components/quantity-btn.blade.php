@props(['id', 'isCheckout', 'deliverTo'])
<div class="w-16 text-center border border-green-500 rounded text-green-500 px-2">
    <button hx-patch="{{ url('/cart/item/' . $id . '/qty/-?checkout=' . $isCheckout . '&deliverTo=' . $deliverTo) }}" hx-target="#cart" hx-include="[name=_token]" hx-swap="outerHTML" class="text-lg">-</button>
    <span class="font-bold text-xs">{{ $slot }}</span>
    <button hx-patch="{{ url('/cart/item/' . $id . '/qty/+?checkout=' . $isCheckout . '&deliverTo=' . $deliverTo) }}" hx-target="#cart" hx-include="[name=_token]" hx-swap="outerHTML" class="text-lg">+</button>
</div>
