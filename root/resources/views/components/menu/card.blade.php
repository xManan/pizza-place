@props(['item'])

<div class="border border-gray-200 p-4 bg-white flex flex-col max-h-[32rem]">
    <img src="{{ Vite::asset($item->img_path) }}" onerror="this.onerror=null;this.src=`{{ Vite::asset('resources/images/pizzas/margherita-pizza.jpg') }}`" alt="pizza" class="w-full aspect-[4/3] object-cover">
    <div class="flex items-center mt-4">
        <h2 class="text-xl font-bold mr-4">{{ $item->name }}</h2>
        <div class="w-4 h-4 border {{ $item->is_veg ? 'border-green-500' : 'border-red-500' }} flex justify-center items-center">
            <div class="w-2 h-2 rounded-full {{ $item->is_veg ? 'bg-green-500' : 'bg-red-500' }}"></div>
        </div>
    </div>
    <p class="text-gray-500 text-wrap">{{ $item->desc }}</p>
    <div class="flex justify-between items-center mt-4 mt-auto">
        <span class="font-bold text-xl">Rs. {{ $item->base_price / 100 }}</span>
        @if($item->options->isEmpty())
            <form action="/cart" method="POST">
                @csrf
                <input type="text" class="hidden" name="itemId" value="{{ $item->id }}">
                <x-add-to-cart-btn>Add to Cart</x-add-to-cart-btn>
            </form>
        @else
            <x-add-to-cart-btn 
                x-on:click="showItemOptions=true"
                hx-get="/menu/item/{{ $item->id }}/options"
                hx-target="#menu-item-options-container"
                hx-swap="innerHTML"
            >
                Add to Cart
            </x-add-to-cart-btn>
        @endif
    </div>
</div>