<div id="menu-item-options" x-data="menuItemOptionsInit">
    <script>
        function menuItemOptionsInit() {
            return { 
                totalPrice: "{{ $item->base_price }}",
                handleItemOptionClick(ele) {
                    let basePrice = parseInt("{{ $item->base_price }}")
                    
                    let opts = document.querySelectorAll('.menu-item-option')
                    console.log(opts[0].getAttribute('price'))
                    opts.forEach(el => {
                        if(el.checked) {
                            basePrice += parseInt(el.getAttribute('price'))
                        }
                    })
    
                    this.totalPrice = basePrice
                }
            }
        }
    </script>
    <div class="fixed top-0 left-0 z-10 w-full h-full bg-black/25" x-on:click="document.getElementById('menu-item-options').remove();scrollOff=false;">
    <div x-on:click="$event.stopPropagation();" class="fixed min-w-96 border-2 border-orange-500 bg-white top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 rounded-lg p-4">
        <form action="/cart" method="POST">
            @csrf
            <h2 class="text-2xl font-bold">{{ $item->name }} ({{ 'Rs. ' . $item->base_price / 100 }})</h2>
            <hr>
            <div>
                <input class="hidden" id="item-id" name="item_id" type="text" value="{{ $item->id }}" />
                @foreach ($options as $option)
                    <x-menu.item-options-group group="{{ $option['label'] }}">
                        @foreach ($option['values'] as $value)
                            @if($value['is_default'])
                                <x-menu.item-option 
                                    id="{{ $value['value'] }}" 
                                    name="{{ 'options[' . $option['name'] . ']' . ($option['is_multiselect'] ? '[]' : '') }}" 
                                    class="menu-item-option"
                                    value="{{ $value['id'] }}" 
                                    type="{{ $option['is_multiselect'] ? 'checkbox' : 'radio' }}"
                                    x-on:click="handleItemOptionClick"
                                    checked=true
                                    label="{{ $value['label'] }}" 
                                    price="{{ $value['price'] }}"
                                />
                            @else
                                <x-menu.item-option 
                                    id="{{ $value['value'] }}" 
                                    name="{{ 'options[' . $option['name'] . ']' . ($option['is_multiselect'] ? '[]' : '') }}" 
                                    class="menu-item-option"
                                    value="{{ $value['id'] }}" 
                                    type="{{ $option['is_multiselect'] ? 'checkbox' : 'radio' }}"
                                    x-on:click="handleItemOptionClick"
                                    label="{{ $value['label'] }}" 
                                    price="{{ $value['price'] }}"
                                />
                            @endif
                        @endforeach
                    </x-menu.item-options-group>
                    <hr>
                @endforeach
            </div>
            <hr>
            <div class="flex justify-between items-center font-bold">
                <span class="font-bold text-2xl">Total</span>
                <div><span>Rs. </span><span x-text="totalPrice/100"></span></div>
            </div>
            <hr>
            <div class="text-right mt-4">
                <span 
                    class="py-2 px-4 rounded-lg border cursor-pointer" 
                    x-on:click="document.getElementById('menu-item-options').remove();scrollOff=false;"
                >
                    Cancel
                </span>
                <x-add-to-cart-btn>Add to cart</x-add-to-cart-btn>
            </div>
        </form>
    </div>
    </div>
</div>