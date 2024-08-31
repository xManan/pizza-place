<x-layout>
    <x-container class="flex justify-center">
        <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8 bg-white mt-20 min-w-[32rem] rounded-lg border-2 border-orange-500">
          <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <h2 class="mt-4 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Login to your account</h2>
          </div>
        
          <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="/login" method="POST">
                @csrf
                <div>
                    <x-form.label for="phone">Phone</x-form.label>
                    <x-form.input id="phone" name="phone" type="tel" value="{{ old('phone') }}" autocomplete="phone" pattern="[0-9]{10}" maxlength="10" required />
                </div>
        
                <div>
                    <div class="flex items-center justify-between">
                        <x-form.label for="password">Password</x-form.label>
                        <div class="text-sm">
                            <x-form.link href="#">Forgot password?</x-form.link>
                        </div>
                    </div>
                    <x-form.input id="password" name="password" type="password" autocomplete="current-password" required />
                </div>
        
                <div>
                    <x-form.button class="text-white">Login</x-form.button>
                </div>
            </form>
        
            <p class="mt-10 text-center text-sm text-gray-500">
                Not a member?
                <x-form.link href="/register">Create an account</x-form.link>
            </p>
          </div>
        </div>
    </x-container>
</x-layout>
