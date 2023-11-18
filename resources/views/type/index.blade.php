<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('This is Our Menu Types!') }}
            </h2>
            @if(Auth::user()->role == 'admin')
            <a href="/type/create">
                <x-primary-button>
                    {{ __('Add Type') }}
                </x-primary-button>
            </a>
            @endif
        </div>
    </x-slot>

    <div class="flex flex-wrap justify-center p-4 mx-5">
        @foreach($types as $type)
        <div class="w-1/3 p-4">
            <div class="bg-white shadow-lg rounded-lg p-4" style="display: flex; flex-direction: column; height: 150px; overflow: hidden;">
                <div class="flex" style="height: 100%;">
                    @php
                        $typeMenus = $menus->where('type_id', $type->id);
                        $firstTypeMenu = $typeMenus->first();
                    @endphp
                    @if($firstTypeMenu)
                        <div class="w-1/2 flex justify-content-center" style="height: 100%; overflow: hidden;">
                            <img src="{{asset('storage/photo-menu/'.$firstTypeMenu->photo)}}" class="w-full h-auto object-cover rounded-lg" style="max-height: 100%;">
                        </div>
                    @else
                    <div class="w-1/2 flex justify-content-center" style="height: 100%; overflow: hidden;">
                            <img src="{{asset('storage/photo-menu/null.jpg')}}" class="w-full h-auto object-cover rounded-lg" style="max-height: 100%;">
                        </div>
                    @endif
                    <div class="w-1/2 px-4" style="height: 100%; overflow: hidden;">
                        <h3 class="text-xl font-semibold mb-2">{{strlen($type->name) > 30 ? substr($type->name, 0, 30) . "..." : $type->name}}</h3>
                        <div class="flex items-center">
                            @if(Auth::user()->role == 'admin')
                            <a href="/type/{{$type->id}}/edit">
                                <x-primary-button>
                                    {{ __('Edit') }}
                                </x-primary-button>
                            </a>
                            <form method="POST" action="/type/{{ $type->id }}" onsubmit="return confirm('Are you sure you want to delete this menu type?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 my-2 ml-2">
                                    {{ __('Delete') }}
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</x-app-layout>