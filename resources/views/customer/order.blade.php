@props(['order'])
<x-layout>
    <x-container>
    @if(request()->get('success'))
        <div class="min-h-screen flex items-center justify-center absolute top-0 left-1/2 -translate-x-1/2">
            <div class="bg-white shadow-md rounded-lg p-8 max-w-md text-center">
                <h1 class="text-2xl font-bold text-gray-800 mb-4">Order Placed Successfully!</h1>
                <p class="text-gray-600 mb-6">Thank you for your order! Your delicious food is being prepared and will be on its way to you shortly.</p>

                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded mb-4">
                    <p><strong>Order Number:</strong> #{{ $order->id }}</p>
                    <p><strong>Estimated Delivery Time:</strong> 30-45 minutes</p>
                </div>

                <a href="{{ url('/') }}" class="text-white bg-green-600 hover:bg-green-700 font-bold py-2 px-4 rounded">
                    Continue to Home
                </a>

                <div class="mt-6">
                    <p class="text-gray-500 text-sm">If you have any questions about your order, feel free to <a href="{{ url('/contact') }}" class="text-green-600 hover:underline">contact us</a>.</p>
                </div>
            </div>
        </div>
    @endif
    </x-container>
</x-layout>