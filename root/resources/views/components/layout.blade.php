<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pizza Place</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body x-data="{ scrollOff: false, item: null }" x-bind:class="{ 'bg-black/5 overflow-hidden h-screen': scrollOff, 'bg-black/5': !scrollOff }">
    <nav class="bg-orange-500 text-2xl text-white">
        <div class="container flex justify-between mx-auto">
            <div class="flex items-center">
                <a href="/" class="flex items-center">
                    <img src="{{ Vite::asset('resources/images/logo.png') }}" alt="LOGO" class="w-32">
                    <h2 class="text-4xl">Pizza Place</h2>
                </a>
                <!-- <x-nav.select name="location" id="location">
                    <x-nav.option value="delhi">Delhi</x-nav.option>
                    <x-nav.option value="mumbai">Mumbai</x-nav.option>
                    <x-nav.option value="sonipat">Sonipat</x-nav.option>
                </x-nav.select> -->
            </div>
            <div class="flex items-center space-x-16">
                <x-nav.link href="/" :active="request()->is('/') or request()->is('menu/*')">Menu</x-nav.link>
                <!-- <x-nav.link href="/offers" :active="request()->is('offers')">Offers</x-nav.link> -->
                @auth('customer')
                    <x-nav.link href="/profile" :active="request()->is('profile')">{{ Auth::guard('customer')->user()->first_name }}</x-nav.link>
                @endauth
                @guest('customer')
                    <x-nav.link href="/login" :active="request()->is('login')">Login</x-nav.link>
                @endguest
            </div>
        </div>
    </nav>
    {{$slot}}
</body>
</html>