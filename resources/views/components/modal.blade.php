<div {{ $attributes->merge(['style' => "display:none"]) }}>
    <div class="fixed top-0 left-0 z-10 w-full h-full bg-black/25" x-on:click="{{ $attributes['x-show'] }}=false;scrollOff=false">
        <div x-on:click="$event.stopPropagation();" class="fixed min-w-96 border-2 border-orange-500 bg-white top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 rounded-lg p-4">
            {{ $slot }}
        </div>
    </div>
</div>