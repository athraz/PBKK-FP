<x-guest-layout>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight flex justify-center">
        {{ __('Add New Type') }}
    </h2>

    <form method="POST" action="{{ route('type') }}" enctype="multipart/form-data">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a href="/type">
                <x-primary-button type="button">
                    {{ __('Back') }}
                </x-primary-button>
            </a>
            <x-primary-button type="submit" class="ml-4">
                {{ __('Add Type') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>