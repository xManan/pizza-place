@props(['id', 'isCheckout', 'deliverTo'])
<div class="border border-green-500 rounded text-green-500 px-2">
    <button hx-patch="/cart/item/{{ $id }}/qty/-?checkout={{ $isCheckout }}&deliverTo={{ $deliverTo }}" hx-target="#cart" hx-include="[name=_token]" hx-swap="outerHTML" class="text-lg">―</button>
    <span class="font-bold text-xs">{{ $slot }}</span>
    <button hx-patch="/cart/item/{{ $id }}/qty/+?checkout={{ $isCheckout }}&deliverTo={{ $deliverTo }}" hx-target="#cart" hx-include="[name=_token]" hx-swap="outerHTML" class="text-lg">+</button>
</div>