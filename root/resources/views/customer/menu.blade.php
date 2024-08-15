<x-layout>
    <div class="container mx-auto px-16" x-data="{ showItemOptions: false }">
        <div class="flex gap-16 text-orange-500 text-xl py-4">
            <x-nav.link href="/menu/pizzas" :active="request()->is('/') or request()->is('menu/pizzas')">Pizzas</x-nav.link>
            <x-nav.link href="/menu/pastas" :active="request()->is('menu/pastas')">Pastas</x-nav.link>
            <x-nav.link href="/menu/sides" :active="request()->is('menu/sides')">Sides</x-nav.link>
            <x-nav.link href="/menu/drinks" :active="request()->is('menu/drinks')">Drinks</x-nav.link>
        </div>
        <div class="flex mt-4 gap-4">
            <div class="basis-3/4 grid grid-cols-3 gap-4" x-data="{open:false}">
                <x-menu-card />
                <x-menu-card />
                <x-menu-card />
            </div>
            <div id="cart" class="basis-1/4 block w-full">
                <div class="border border-gray-200 p-4 bg-white text-center">
                    <h2 class="text-xl font-bold">Cart</h2>
                    <div class="flex justify-between items-center mt-4">
                        <span class="font-bold text-xl">Pizza</span>
                        <div class="space-x-4">
                            <span class="font-bold text-xl">- 1 +</span>
                            <span class="font-bold text-xl">$100</span>
                        </div>
                    </div>
                    <div class="flex justify-between items-center mt-4">
                        <span class="font-bold text-xl">Pizza</span>
                        <div class="space-x-4">
                            <span class="font-bold text-xl">- 1 +</span>
                            <span class="font-bold text-xl">$100</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-menu-item-options />
    </div>
</x-layout>