<x-guest-layout>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight flex justify-center">
        {{ __('Edit Type') }}
    </h2>

    <form action="/type/{{$type->id}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{$type->name}}" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a href="./">
                <x-primary-button type="button">
                    {{ __('Back') }}
                </x-primary-button>
            </a>
            <x-primary-button type="submit" class="ml-4">
                {{ __('Edit Type') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>