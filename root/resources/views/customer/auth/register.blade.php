<x-layout>
    <x-container class="flex justify-center">
        <div class="flex min-h-full flex-col justify-center px-6 py-6 lg:px-8 bg-white mt-16 rounded-lg min-w-[32rem] border border-orange-500 border-2">
          <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <h2 class="mt-4 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Create an account</h2>
          </div>
        
          <div class="mt-0 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="/register" method="POST">
                @csrf
                <div class="flex gap-4">
                    <div>
                        <x-form.label for="first_name">First Name</x-form.label>
                        <x-form.input id="first_name" name="first_name" type="text" value="{{ old('first_name') }}" autocomplete="first_name" pattern="[a-zA-Z]+" required />
                    </div>

                    <div>
                        <x-form.label for="last_name">Last Name</x-form.label>
                        <x-form.input id="last_name" name="last_name" type="text" value="{{ old('last_name') }}" autocomplete="last_name" pattern="[a-zA-Z]+" required />
                    </div>
                </div>

                <div>
                    <x-form.label for="phone">Phone</x-form.label>
                    <x-form.input id="phone" name="phone" type="tel" value="{{ old('phone') }}" autocomplete="phone" pattern="[0-9]{10}" maxlength="10" required />
                </div>

                <div>
                    <x-form.label for="email">Email Address</x-form.label>
                    <x-form.input id="email" name="email" type="text" value="{{ old('email') }}" autocomplete="email" required />
                </div>
        
                <div>
                    <x-form.label for="password">Password</x-form.label>
                    <x-form.input id="password" name="password" type="password" autocomplete="current-password" required />
                </div>

                <div>
                    <x-form.label for="password">Confirm Password</x-form.label>
                    <x-form.input id="password" name="password_confirmation" type="password" autocomplete="current-password" required />
                </div>
        
                <div>
                    <x-form.button class="text-white">Register</x-form.button>
                </div>
            </form>
        
            <p class="mt-10 text-center text-sm text-gray-500">
                Already registered?
                <x-form.link href="/login">Login</x-form.link>
            </p>
          </div>
        </div>
    </x-container>
</x-layout>
