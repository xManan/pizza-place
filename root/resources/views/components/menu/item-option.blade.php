@props([ 'label' ])
<div class="flex justify-between">
    <div>
        <input {{ $attributes }}
        />
        <label for="{{ $attributes['id'] }}">{{ $label }}</label>
    </div>
    <p>{{ 'Rs. ' . ($attributes['price'] / 100) }}</p>
</div>