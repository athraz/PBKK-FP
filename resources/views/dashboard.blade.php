<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Welcome to Our Restaurant!') }}
        </h2>
    </x-slot>

    @php
    $carouselmenus = $menus->shuffle()->take(5);
    $activepromo = $promos->where('is_active', 1)->first();
    @endphp

    <div class="flex flex-wrap justify-center">
        <div class="w-4/5 p-4">
            <div id="controls-carousel" class="relative w-full" data-carousel="static">
                <!-- Carousel wrapper -->
                <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                    @foreach($carouselmenus as $menu)
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="{{asset('storage/photo-menu/'.$menu->photo)}}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                    </div>
                    @endforeach
                </div>
                <!-- Slider indicators -->
                <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
                    <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                    <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
                    <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
                    <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 4" data-carousel-slide-to="3"></button>
                    <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 5" data-carousel-slide-to="4"></button>
                </div>
                <!-- Slider controls -->
                <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4" />
                        </svg>
                        <span class="sr-only">Previous</span>
                    </span>
                </button>
                <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="sr-only">Next</span>
                    </span>
                </button>
            </div>
        </div>
    </div>

    <div class="flex flex-wrap justify-center">
        <div class="w-4/5">
            @if($activepromo !== null && $activepromo->count() > 0)
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
        </div>
    </div>

</x-app-layout>