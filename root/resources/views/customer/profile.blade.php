@php
    $user = Auth::guard('customer')->user();
@endphp
<x-layout>
    <x-container>
        <div class="mt-10 bg-white p-10 rounded-lg">
            <div class="px-4 sm:px-0">
                <h3 class="text-base font-semibold leading-7 text-gray-900">Profile</h3>
                <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500">Personal details</p>
            </div>
            <div class="mt-6 border-t border-gray-100">
                <dl class="divide-y divide-gray-100 bg-whitee">
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-gray-900">Full Name</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $user->first_name . ' ' . $user->last_name }}</dd>
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-gray-900">Email address</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $user->email }}</dd>
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-gray-900">Phone</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $user->phone }}</dd>
                    </div>
                </dl>
            </div>
            <div class="mt-10">
                <form action="/logout" method="POST" class="max-w-32">
                    @csrf
                    <x-form.button class="text-white">Logout</x-form.button>
                </form>
            </div>
        </div>
        <div class="mt-10 bg-white p-10 rounded-lg">
            <div class="px-4 sm:px-0">
                <h3 class="text-base font-semibold leading-7 text-gray-900">Orders</h3>
            </div>
            <div class="mt-6 border-t border-gray-100 space-y-4">
                @foreach($user->orders as $order)
                <div class="bg-white shadow-lg rounded-lg p-6 border border-gray-200">
                <div class="flex items-center justify-between border-b border-gray-200 pb-4 mb-4">
                    <h3 class="text-xl font-semibold text-gray-800">Order ID: #{{ $order->id }}</h3>
                    <a href="/order/{{ $order->id }}" class="text-orange-600 hover:text-orange-800 font-semibold">View Details</a>
                </div>

                <div class="flex flex-col space-y-4">
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-700">Total Items:</span>
                        <span class="text-gray-900">{{ $order->items->count() }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="font-medium text-gray-700">Tax:</span>
                        <span class="text-gray-900">Rs. {{ number_format($order->gst / 100, 2) }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="font-medium text-gray-700">Fee:</span>
                        <span class="text-gray-900">Rs. {{ number_format($order->delivery_fee / 100, 2) }}</span>
                    </div>

                    <div class="flex justify-between border-t border-gray-200 pt-4">
                        <span class="font-medium text-gray-700">Net Total:</span>
                        <span class="text-gray-900 font-bold">Rs. {{ number_format($order->net_total / 100, 2) }}</span>
                    </div>
                </div>
            </div>
                @endforeach
            </div>
        </div>
    </x-container>
</x-layout>