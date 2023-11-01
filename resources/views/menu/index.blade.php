<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Check Out Our Menus!') }}
            </h2>
            <a href="/menu/create">
                <x-primary-button>
                    {{ __('Add Menu') }}
                </x-primary-button>
            </a>
        </div>
    </x-slot>

    <div class="flex flex-wrap justify-center p-4">
        @foreach($types as $type)
        @php
        $typeMenus = $menus->where('type_id', $type->id);
        @endphp
        @if($typeMenus->count() > 0)
        <div class="w-full mx-5" style="margin-bottom: 60px">
            <p class="font-semibold text-xl text-gray-800 px-4">{{$type->name}}</p>
            <div class="flex flex-wrap">
                @foreach($typeMenus as $menu)
                <div class="w-1/2 p-4">
                    <div class="bg-white shadow-lg rounded-lg p-4" style="display: flex; flex-direction: column; height: 220px; overflow: hidden;">
                        <div class="flex" style="height: 100%;">
                            <div class="w-1/2" style="height: 100%; overflow: hidden;">
                                <img src="{{asset('storage/photo-menu/'.$menu->photo)}}" class="w-full h-auto object-cover rounded-lg" style="max-height: 100%;">
                            </div>
                            <div class="w-1/2 px-4" style="height: 100%; overflow: hidden;">
                                <h3 class="text-xl font-semibold mb-2">{{strlen($menu->name) > 20 ? substr($menu->name, 0, 20) . "..." : $menu->name}}</h3>
                                <p class="text-gray-600">{{strlen($menu->description) > 50 ? substr($menu->description, 0, 50) . "..." : $menu->description}}</p>
                                <p class="text-gray-950 my-4">Rp {{$menu->price}}</p>
                                <a href="/menu/{{$menu->id}}">
                                    <x-primary-button>
                                        {{ __('Detail Menu') }}
                                    </x-primary-button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
        @endforeach
    </div>
</x-app-layout>