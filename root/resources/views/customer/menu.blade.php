<x-layout>
    <div class="container mx-auto px-16 mb-32">
        <div class="flex gap-16 text-orange-500 text-xl py-4">
            <x-nav.link href="/menu/pizzas" :active="request()->is('/') or request()->is('menu/pizzas')">Pizzas</x-nav.link>
            <x-nav.link href="/menu/pastas" :active="request()->is('menu/pastas')">Pastas</x-nav.link>
            <x-nav.link href="/menu/sides" :active="request()->is('menu/sides')">Sides</x-nav.link>
            <x-nav.link href="/menu/drinks" :active="request()->is('menu/drinks')">Drinks</x-nav.link>
        </div>
        <div class="flex mt-4 gap-4">
            <div class="basis-3/4 grid grid-cols-3 gap-4" x-data="{open:false}">
                @foreach ($items as $item)
                    <x-menu.card :item="$item" />
                @endforeach
            </div>
            <x-cart :cart="$cart"/>
        </div>
        <div id="menu-item-options-container">
        </div>
    </div>
</x-layout>