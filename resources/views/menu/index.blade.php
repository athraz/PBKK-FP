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
                <div class="lg:w-1/4 md:w-1/3 sm:w-full p-4">
                    <div class="bg-white shadow-lg rounded-lg p-4" style="display: flex; flex-direction: column; height: 360px; overflow: hidden;">
                        <div class="flex" style="height: 100%; overflow: hidden;">
                            <img src="{{asset('storage/photo-menu/'.$menu->photo)}}" class="w-full h-auto object-cover rounded-lg" style="max-height: 100%;">
                        </div>
                        <div class="pt-4" style="height: 100%; overflow: hidden;">
                            <h3 class="text-xl font-semibold mb-2">{{strlen($menu->name) > 20 ? substr($menu->name, 0, 20) . "..." : $menu->name}}</h3>
                            <p class="text-gray-950 my-4">Rp {{$menu->price}}</p>
                            <div class="flex justify-between">
                                <a href="/menu/{{$menu->id}}">
                                    <x-primary-button>
                                        {{ __('Detail') }}
                                    </x-primary-button>
                                </a>

                                <form method="POST" action="{{ route('cart.create')}}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="menu_id" value="<?= $menu['id'] ?>"/>
                                    <input id="quantity" name="quantity" type="number" min="1" max="99" value="1" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"" />
                                    <button type=" submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    {{ __('Add') }}
                                    </button>
                                </form>
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