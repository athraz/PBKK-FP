<x-guest-layout>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight flex justify-center">
        {{ __('Edit Menu') }}
    </h2>

    <form action="/menu/{{$menu->id}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{$menu->name}}" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Type -->
        <div class="mt-4">
            <x-input-label for="type" :value="__('Type')" />
            <select id="type" name="type" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
                <option value="0" selected>-</option>
                @foreach ($types as $item)
                <option value="{{$item->id}}" @if($item->id == $menu->type_id)
                    selected
                    @endif
                    >{{$item->name}}</option>
                @endforeach
            </select>

            <x-input-error :messages="$errors->get('type')" class="mt-2" />
        </div>

        <!-- Price -->
        <div class="mt-4">
            <x-input-label for="price" :value="__('Price')" />
            <x-text-input id="price" class="block mt-1 w-full" type="text" name="price" value="{{$menu->price}}" required autofocus autocomplete="price" />
            <x-input-error :messages="$errors->get('price')" class="mt-2" />
        </div>

        <!-- Description -->
        <div class="mt-4">
            <x-input-label for="description" :value="__('Description')" />
            <textarea id="description" name="description" rows="5" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">{{$menu->description}}</textarea>
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>

        <!-- Photo -->
        <div class="mt-4">
            <x-input-label for="photo" :value="__('Photo')" />
            <input id="photo" name="photo" type="file" class="block w-full text-sm text-slate-500 file:text-sm file:font-semibold file:py-2 file:px-4 file:bg-violet-50 file:text-violet-700 file:rounded-full file:border-0 file:mr-4 hover:file:bg-violet-100" />
            <x-input-error :messages="$errors->get('photo')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a href="./">
                <x-primary-button type="button">
                    {{ __('Back') }}
                </x-primary-button>
            </a>
            <x-primary-button type="submit" class="ml-4">
                {{ __('Edit Menu') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>