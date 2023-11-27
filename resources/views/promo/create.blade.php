<x-guest-layout>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight flex justify-center">
        {{ __('Add New Promo') }}
    </h2>

    <form method="POST" action="{{ route('promo') }}" enctype="multipart/form-data">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Discount -->
        <div class="mt-4">
            <x-input-label for="discount" :value="__('Discount Percentage (%)')" />
            <x-text-input id="discount" class="block mt-1 w-full" type="number" name="discount" min="5" max="100" step="5" required autofocus autocomplete="discount" />
            <x-input-error :messages="$errors->get('discount')" class="mt-2" />
        </div>

        <!-- Start Time -->
        <div class="mt-4">
            <x-input-label for="start_time" :value="__('Start Time')" />
            <x-text-input id="start_time" class="block mt-1 w-full" type="datetime-local" name="start_time" min="5" max="100" required autofocus autocomplete="start_time" />
            <x-input-error :messages="$errors->get('start_time')" class="mt-2" />
        </div>

        <!-- End Time -->
        <div class="mt-4">
            <x-input-label for="end_time" :value="__('End Time')" />
            <x-text-input id="end_time" class="block mt-1 w-full" type="datetime-local" name="end_time" min="5" max="100" required autofocus autocomplete="end_time" />
            <x-input-error :messages="$errors->get('end_time')" class="mt-2" />
        </div>

        <!-- Menu -->
        <div class="mt-4">
            <x-input-label for="menus" :value="__('Choose Menu')"/>
            <div class="border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full py-2 px-4">
                @foreach($menus as $menu)
                <label>
                    <input type="checkbox" name="menus[]" value="{{ $menu->id }}">
                    {{ $menu->name }}
                </label><br>
                @endforeach
            </div>

            <x-input-error :messages="$errors->first('menus')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a href="/menu">
                <x-primary-button type="button">
                    {{ __('Back') }}
                </x-primary-button>
            </a>
            <x-primary-button type="submit" class="ml-4">
                {{ __('Add Promo') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>