<div class="mt-2">
    <input {{ $attributes->merge(['class' => 'block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6']) }} />
    @error($attributes['name'])
        <div class="text-red-500 text-sm">
            {{ $message }}
        </div>
    @enderror
</div>