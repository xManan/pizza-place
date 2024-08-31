@php
    $user = Auth::guard('customer')->user();
@endphp
<x-layout>
    <x-container x-data="{showAddAddressModal: false}">
        <div>
            <x-modal id="add-address-modal" x-show="showAddAddressModal">
                <form class="space-y-4" action="/customer/address" method="POST"> 
                    @csrf
                    <div>
                        <x-form.label for="name">Name</x-form.label>
                        <x-form.input id="name" name="name" type="text" value="{{ old('name') }}" autocomplete="name" required />
                    </div>
                    <div>
                        <x-form.label for="address1">Address 1</x-form.label>
                        <x-form.input id="address1" name="address1" type="text" value="{{ old('address1') }}" autocomplete="address1" required />
                    </div>
                    <div>
                        <x-form.label for="address2">Address 2</x-form.label>
                        <x-form.input id="address2" name="address2" type="text" value="{{ old('address2') }}" autocomplete="address2" required />
                    </div>
                    <div>
                        <x-form.label for="city">City</x-form.label>
                        <x-form.input id="city" name="city" type="text" value="{{ old('city') }}" autocomplete="city" required />
                    </div>
                    <div>
                        <x-form.label for="pincode">Pin Code</x-form.label>
                        <x-form.input id="pincode" name="pincode" type="text" value="{{ old('pincode') }}" autocomplete="pincode" required />
                    </div>
                    <div>
                        <x-form.button class="text-white">Add Address</x-form.button>
                    </div>
                </form>
            </x-modal>
        </div>
        <div class="grid grid-cols-[3fr,1fr] gap-4 mt-8">
            @if(isset($deliverTo))
                <div>
                    <div class="bg-white py-4 px-8 border">
                        <h2 class="text-2xl">
                            Delivery address
                        </h2>
                        <div class="mt-4">
                            <strong>{{ $deliverTo->name }}</strong>                        
                            <p>{{ $deliverTo->address1 }}</p>
                            <p>{{ $deliverTo->address2 }}</p>
                            <p>{{ $deliverTo->city }}</p>
                            <p>{{ $deliverTo->pincode }}</p>
                            <a href="/checkout" class="text-orange-500 hover:underline">change</a>
                        </div>
                    </div>
                    <div class="bg-white p-4" x-data="paymentOptionInit">
                        <script>
                            function paymentOptionInit() {
                                return {
                                    paymentOption: 'upi',
                                    handlePaymentOptionChange(event) {
                                        console.log(paymentOption);
                                        paymentOption = event.target.value
                                        console.log(paymentOption);
                                    }
                                }
                            }
                        </script>
                        <h2 class="text-2xl mb-4">
                            Payment Method
                        </h2>
                        <div class="flex flex-col ">
                            <!-- <div>
                                <div>
                                    <input id="upi" name="payment" type="radio" x-on:change="handlePaymentOptionChange" value="upi" checked />
                                    <label for="upi">UPI</label>
                                </div>
                                <div x-show="paymentOption=='upi'">
                                    <input type="text" placeholder="example@bank" class="border" /> 
                                    <button class="border">Verify</button>
                                </div>
                            </div>
                            <div>
                                <input id="card" name="payment" type="radio" x-on:change="handlePaymentOptionChange" value="card" />
                                <label for="card">Debit/Credit Card</label>
                            </div>
                            <div>
                                <input id="net" name="payment" type="radio" x-on:change="handlePaymentOptionChange" value="net" />
                                <label for="net">Net Banking</label>
                            </div> -->
                            <div>
                                <input id="cod" name="payment" type="radio" value="cod" checked />
                                <label for="cod">Cash On Delivery</label>
                            </div>
                        </div>
                    </div>
                </div>
                <x-cart :cart="$cart" />
            @else
                <div class="bg-white py-4 px-8 border">
                    <h2 class="text-2xl">
                        Choose a delivery address
                    </h2>
                    <div class="grid grid-cols-3 gap-8 text-lg mt-4">
                        @foreach($user->addresses as $address)
                            <div class="relative bg-white min-h-72 p-4 border-2">
                                <h3 class="font-bold">{{ $address->name }}</h3>
                                <p>{{ $address->address1 }}</p>
                                <p>{{ $address->address2 }}</p>
                                <p>{{ $address->address3 }}</p>
                                <p>{{ $address->city }}</p>
                                <p>{{ $address->pincode }}</p>
                                <a href="/checkout?deliverTo={{$address->id}}"><x-form.button class="absolute bottom-8 left-1/2 -translate-x-1/2 max-w-36 text-white">Deliver Here</x-form.button></a>
                            </div>
                        @endforeach
                        <div class="relative bg-white min-h-64 p-4 border-2 text-orange-500">
                            <x-form.button 
                                class="absolute bottom-1/2 left-1/2 translate-y-1/2 -translate-x-1/2 max-w-36 bg-white border-2 border-orange-500 text-orange-500 hover:text-white"
                                x-on:click="showAddAddressModal=true;scrollOff=true"
                            >
                                Add New
                            </x-form.button>
                        </div>
                    </div>
                </div>
                <x-cart :cart="$cart" />
            @endif
        </div>
    </x-container>
</x-layout>
