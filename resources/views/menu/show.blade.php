<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Check Out Our Menus!') }}
            </h2>
            <div class="flex justify-end items-center">
                <a href="/menu/{{$menus->id}}/edit" class="mx-2">
                    <x-primary-button>
                        {{ __('Edit Menu') }}
                    </x-primary-button>
                </a>
                <form method="POST" action="/menu/{{ $menus->id }}" onsubmit="return confirm('Are you sure you want to delete this menu item?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        {{ __('Delete Menu') }}
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="w-1/2 p-4">
        <div class="bg-white shadow-lg rounded-lg p-4" style="display: flex; flex-direction: column; height: 200px; overflow: hidden;">
            <div class="flex" style="height: 100%;">
                <div class="w-1/2" style="height: 100%; overflow: hidden;">
                    <img src="{{asset('storage/photo-menu/'.$menus->photo)}}" class="w-full h-auto object-cover rounded-lg" style="max-height: 100%;">
                </div>
                <div class="w-1/2 p-4" style="height: 100%; overflow: hidden;">
                    <h3 class="text-xl font-semibold mb-2">{{$menus->name}}</h3>
                    <p class="text-gray-600">{{$menus->description}}</p>
                    <p class="text-gray-950 mt-4">Rp {{$menus->price}}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>