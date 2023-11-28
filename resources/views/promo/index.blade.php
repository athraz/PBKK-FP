<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('These are our promos!') }}
            </h2>
            <a href="/promo/create">
                <x-primary-button>
                    {{ __('Add Promo') }}
                </x-primary-button>
            </a>
        </div>
    </x-slot>

    @php
    $activepromo = $promos->where('is_active', 1)->first();
    $notactivepromos = $promos->where('is_active', 0);
    @endphp

    <div class="flex flex-wrap justify-center">
        <div class="w-4/5 p-4">
            @if($activepromo->count() > 0)
            <div class="w-full p-4" style="margin-bottom: 10px">
                <div class="bg-white shadow-lg rounded-lg p-4 mb-8" style="display: flex; flex-direction: column; overflow: hidden;">
                    <h2 class="font-semibold text-lg text-gray-800 leading-tight mb-2 p-4">Active Promo: {{$activepromo->name}} </h2>
                    @php
                    $activepromomenus = $promomenus->where('promo_id', $activepromo->id);
                    @endphp
                    <div class="flex flex-wrap">
                        @foreach($activepromomenus as $activepromomenu)
                        <div class="lg:w-1/4 md:w-1/3 sm:w-full p-4">
                            <div class=" bg-white shadow-lg rounded-lg p-4" style="display: flex; flex-direction: column; height: 240px; overflow: hidden;">
                                <div class="flex" style="height: 100%; overflow: hidden;">
                                    <img src="{{asset('storage/photo-menu/'.$activepromomenu->menu->photo)}}" class="w-full h-auto object-cover rounded-lg" style="max-height: 100%;">
                                </div>
                                <div class="pt-4" style="height: 100%; overflow: hidden;">
                                    <h3 class="text-lg font-semibold mb-1">{{strlen($activepromomenu->menu->name) > 20 ? substr($activepromomenu->menu->name, 0, 20) . "..." : $activepromomenu->menu->name}}</h3>
                                    @if($activepromomenu->menu->price == $activepromomenu->menu->original_price)
                                    <p class="text-gray-950 my-4">Rp {{$activepromomenu->menu->price}}</p>
                                    @else
                                    <div class="flex">
                                        <p class="text-gray-950 my-4 mr-2 line-through">Rp {{$activepromomenu->menu->original_price}}</p>
                                        <p class="text-gray-950 my-4">Rp {{$activepromomenu->menu->price}}</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="flex justify-between p-4">
                        <h2 class="font-semibold text-lg text-gray-800 leading-tight"> Promo will end at: {{$activepromo->end_time}}</h2>
                        <a href="/menu">
                            <x-primary-button>
                                {{ __('Order Menu') }}
                            </x-primary-button>
                        </a>
                    </div>
                </div>
            </div>
            @endif
            @if ($notactivepromos->count() > 0)
            <div class="w-full p-4" style="margin-bottom: 30px">
                <div class="bg-white shadow-lg rounded-lg p-4 mb-8" style="display: flex; flex-direction: column; overflow: hidden;">
                    <h2 class="font-semibold text-lg text-gray-800 leading-tight mb-2 p-4">Upcoming Promos</h2>
                    <div>
                        <div class="flex mb-3" style="height: 100%;">
                            <div class="w-1/4 px-4 flex items-center" style="height: 100%; overflow: hidden;">
                                <h3 class="text-lg font-semibold">Name</h3>
                            </div>
                            <div class="w-1/4 px-4 flex items-center" style="height: 100%; overflow: hidden;">
                                <h3 class="text-lg font-semibold">Discount (%)</h3>
                            </div>
                            <div class="w-1/4 px-4 flex items-center" style="height: 100%; overflow: hidden;">
                                <h3 class="text-lg font-semibold">Start Time</h3>
                            </div>
                            <div class="w-1/4 px-4 flex items-center" style="height: 100%; overflow: hidden;">
                                <h3 class="text-lg font-semibold">End Time</h3>
                            </div>
                        </div>
                        <hr class="my-3">
                        @foreach($notactivepromos as $promo)
                        <div class="flex mb-3" style="height: 100%;">
                            <div class="w-1/4 px-4 flex items-center" style="height: 100%; overflow: hidden;">
                                <h3 class="text-lg font-semibold">{{ $promo->name }}</h3>
                            </div>
                            <div class="w-1/4 px-4 flex items-center" style="height: 100%; overflow: hidden;">
                                <h3 class="text-lg font-semibold">{{ $promo->discount }}</h3>
                            </div>
                            <div class="w-1/4 px-4 flex items-center" style="height: 100%; overflow: hidden;">
                                <h3 class="text-lg font-semibold">{{ $promo->start_time }}</h3>
                            </div>
                            <div class="w-1/4 px-4 flex items-center" style="height: 100%; overflow: hidden;">
                                <h3 class="text-lg font-semibold">{{ $promo->end_time }}</h3>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>