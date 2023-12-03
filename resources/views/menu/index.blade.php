<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Check Out Our Menus!') }}
            </h2>
            @if(Auth::check() && Auth::user()->role == 'admin')
            <a href="/menu/create">
                <x-primary-button>
                    {{ __('Add Menu') }}
                </x-primary-button>
            </a>
            @endif
        </div>
    </x-slot>

    @if (session('status') == 'success')
    <div class="flex justify-center items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 relative" role="alert">
        <svg class="absolute top-0 right-0 m-2 cursor-pointer" width="18" height="18" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16" onclick="this.parentElement.style.display='none'">
            <path d="M3.646 3.646a.5.5 0 0 1 .708 0L8 7.293l3.646-3.647a.5.5 0 0 1 .708 0 .5.5 0 0 1 0 .708L8.707 8l3.647 3.646a.5.5 0 0 1 0 .708a.5.5 0 0 1-.708 0L8 8.707l-3.646 3.647a.5.5 0 0 1-.708 0a.5.5 0 0 1 0-.708L7.293 8 3.646 4.354a.5.5 0 0 1 0-.708z" />
        </svg>
        <span class="sr-only">Info</span>
        <div>
            <span class="font-large">Success!</span> {{ session('message') }}
        </div>
    </div>
    @endif

    <div class="w-full flex justify-center">
        <div class="lg:w-1/5 md:w-1/3 p-4">
            <div class="bg-white shadow-lg rounded-lg p-4 sticky top-5" style="display: flex; flex-direction: column;">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-2">Types</h2>
                @foreach($types as $type)
                <div class="flex items-center">
                    <input checked id="{{ $type->id }}-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="{{ $type->id }}-checkbox" class="px-2 py-2 ms-2 text-lg font-medium text-gray-900 dark:text-gray-300">{{ $type->name }}</label>
                </div>
                @if(!$loop->last)
                <hr>
                @endif
                @endforeach
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-10 mb-2">Sort by</h2>
                <div class="flex items-center">
                    <input id="rating-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="rating-checkbox" class="px-2 py-2 ms-2 text-lg font-medium text-gray-900 dark:text-gray-300">Rating</label>
                </div>
                <hr>
                <div class="flex items-center">
                    <input id="order-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="order-checkbox" class="px-2 py-2 ms-2 text-lg font-medium text-gray-900 dark:text-gray-300">Times Ordered</label>
                </div>
                <hr>
                <div class="flex items-center">
                    <input id="price-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="price-checkbox" class="px-2 py-2 ms-2 text-lg font-medium text-gray-900 dark:text-gray-300">Lowest Price</label>
                </div>
            </div>
        </div>
        <div class="w-3/4 mx-1">
            <div id="menucontainer" class="flex flex-wrap">
                @foreach($menus as $menu)
                @php
                $ordered = $ordermenus->where('menu_id', $menu->id)->sum('quantity');
                $total = $reviews->where('menu_id', $menu->id)->sum('rating');
                $count = $reviews->where('menu_id', $menu->id)->count();
                $rating = ($count > 0) ? ($total / $count) : 0;
                @endphp
                <div class="lg:w-1/3 md:w-1/2 sm:w-full p-4 menu-{{ $menu->type->id }} menuclass" data-rating="{{ $rating }}" data-order="{{ $ordered }}" data-price="{{$menu->price}}">
                    <div class=" bg-white shadow-lg rounded-lg p-4" style="display: flex; flex-direction: column; height: 360px; overflow: hidden;">
                        <div class="flex" style="height: 100%; overflow: hidden;">
                            <img src="{{asset('storage/photo-menu/'.$menu->photo)}}" class="w-full h-auto object-cover rounded-lg" style="max-height: 100%;">
                        </div>
                        <div class="pt-4" style="height: 100%; overflow: hidden;">
                            <h3 class="text-xl font-semibold mb-1">{{strlen($menu->name) > 20 ? substr($menu->name, 0, 20) . "..." : $menu->name}}</h3>
                            <div class="flex justify-between">
                                <p class="text-gray-950 mt-1">{{ $ordered }} Ordered</p>
                                <div class="flex">
                                    <p class="text-gray-950 mt-1">{{ number_format($rating, 1) }}</p>
                                    <svg class="w-5 h-5 text-yellow-300 ml-1 mt-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                    </svg>
                                </div>
                            </div>
                            @if($menu->price == $menu->original_price)
                            <p class="text-gray-950 my-4">Rp {{$menu->price}}</p>
                            @else
                            <div class="flex">
                                <p class="text-gray-950 my-4 mr-2 line-through">Rp {{$menu->original_price}}</p>
                                <p class="text-gray-950 my-4">Rp {{$menu->price}}</p>
                            </div>
                            @endif
                            <div class="flex justify-between">
                                <a href="/menu/{{$menu->id}}">
                                    <x-primary-button>
                                        {{ __('Detail') }}
                                    </x-primary-button>
                                </a>

                                <form method="POST" action="{{ route('cart.create')}}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="menu_id" value="<?= $menu['id'] ?>" />
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
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var checkboxes = document.querySelectorAll("[id$='-checkbox']");
            checkboxes.forEach(function(checkbox) {
                var type = checkbox.id.replace('-checkbox', '');
                var menuClass = 'menu-' + type;
                var menus = document.querySelectorAll('.' + menuClass);

                function toggleMenus() {
                    var displayValue = checkbox.checked ? "block" : "none";
                    menus.forEach(function(menu) {
                        menu.style.display = displayValue;
                    });
                }
                toggleMenus();
                checkbox.addEventListener("change", toggleMenus);
            });

            var realOrder = Array.from(document.querySelectorAll('.menuclass'));

            var ratingCheckbox = document.getElementById('rating-checkbox');
            var orderCheckbox = document.getElementById('order-checkbox');
            var priceCheckbox = document.getElementById('price-checkbox');

            ratingCheckbox.addEventListener("change", function() {
                if (ratingCheckbox.checked) {
                    orderCheckbox.checked = false;
                    priceCheckbox.checked = false;
                    var menus = document.querySelectorAll('.menuclass');
                    var menusArray = Array.from(menus);

                    menusArray.sort(function(a, b) {
                        var ratingA = parseFloat(a.getAttribute('data-rating'));
                        var ratingB = parseFloat(b.getAttribute('data-rating'));
                        return ratingB - ratingA;
                    });

                    menus.forEach(function(menu) {
                        menu.remove();
                    });

                    var menuContainer = document.getElementById('menucontainer');
                    menusArray.forEach(function(menu) {
                        menuContainer.appendChild(menu);
                    });
                } else {
                    var menus = document.querySelectorAll('.menuclass');
                    var menuContainer = document.getElementById('menucontainer');

                    realOrder.forEach(function(menu) {
                        menuContainer.appendChild(menu);
                    });
                }
            });

            orderCheckbox.addEventListener("change", function() {
                if (orderCheckbox.checked) {
                    ratingCheckbox.checked = false;
                    priceCheckbox.checked = false;
                    var menus = document.querySelectorAll('.menuclass');
                    var menusArray = Array.from(menus);

                    menusArray.sort(function(a, b) {
                        var orderA = parseFloat(a.getAttribute('data-order'));
                        var orderB = parseFloat(b.getAttribute('data-order'));
                        return orderB - orderA;
                    });

                    menus.forEach(function(menu) {
                        menu.remove();
                    });

                    var menuContainer = document.getElementById('menucontainer');
                    menusArray.forEach(function(menu) {
                        menuContainer.appendChild(menu);
                    });
                } else {
                    var menus = document.querySelectorAll('.menuclass');
                    var menuContainer = document.getElementById('menucontainer');

                    realOrder.forEach(function(menu) {
                        menuContainer.appendChild(menu);
                    });
                }
            });

            priceCheckbox.addEventListener("change", function() {
                if (priceCheckbox.checked) {
                    ratingCheckbox.checked = false;
                    orderCheckbox.checked = false;
                    var menus = document.querySelectorAll('.menuclass');
                    var menusArray = Array.from(menus);

                    menusArray.sort(function(a, b) {
                        var priceA = parseFloat(a.getAttribute('data-price'));
                        var priceB = parseFloat(b.getAttribute('data-price'));
                        return priceA - priceB;
                    });

                    menus.forEach(function(menu) {
                        menu.remove();
                    });

                    var menuContainer = document.getElementById('menucontainer');
                    menusArray.forEach(function(menu) {
                        menuContainer.appendChild(menu);
                    });
                } else {
                    var menus = document.querySelectorAll('.menuclass');
                    var menuContainer = document.getElementById('menucontainer');

                    realOrder.forEach(function(menu) {
                        menuContainer.appendChild(menu);
                    });
                }
            });
        });
    </script>

</x-app-layout>