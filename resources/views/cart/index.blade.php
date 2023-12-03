<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('This is your cart!') }}
            </h2>
            <a href="/menu">
                <x-primary-button>
                    {{ __('Add More Menu') }}
                </x-primary-button>
            </a>
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

    @php
    $usercarts = $carts->where('user_id', Auth::user()->id);
    @endphp

    <div class="flex flex-wrap justify-center">
        <div class="w-4/5 p-4">
            @if($usercarts->count() > 0)
            <form method="POST" action="{{ route('cart.update')}}" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="w-full" style="margin-bottom: 30px">
                    <div class="flex flex-wrap">
                        <div class="w-full p-4">
                            <div class="bg-white shadow-lg rounded-lg p-4" style="display: flex; flex-direction: column; height: 100%; overflow: hidden;">
                                <div class="flex items-center">
                                    <div class="w-1/6 px-4 flex justify-center items-center" style="height: 100%; overflow: hidden;">
                                    <h3 class="text-lg font-semibold">Amount</h3>
                                    </div>
                                    <div class="w-1/6 px-4 flex justify-center items-center" style="height: 100%; overflow: hidden;">
                                    <h3 class="text-lg font-semibold">Photo</h3>
                                    </div>
                                    <div class="w-1/6 px-4 flex justify-start items-center" style="height: 100%; overflow: hidden;">
                                    <h3 class="text-lg font-semibold">Name</h3>
                                    </div>
                                    <div class="w-1/6 px-4 flex justify-start items-center" style="height: 100%; overflow: hidden;">
                                    <h3 class="text-lg font-semibold">Price</h3>
                                    </div>
                                    <div class="w-1/6 px-4 flex justify-start items-center" style="height: 100%; overflow: hidden;">
                                    <h3 class="text-lg font-semibold">Subtotal</h3>
                                    </div>
                                    <div class="w-1/6 px-4 flex justify-start items-center" style="height: 100%; overflow: hidden;">
                                    <h3 class="text-lg font-semibold">Delete</h3>
                                    </div>
                                </div>
                                <hr class="mt-5 mb-3">
                                @foreach($usercarts as $cart)
                                <div class="flex items-center" style="height: 100px;">
                                    <div class="w-1/6 px-4 flex justify-center items-center" style="height: 100%; overflow: hidden;">
                                        <input type="hidden" name="menu_id" value="<?= $cart['menu_id'] ?>" />
                                        <input type="number" name="quantity-<?= $cart['menu_id']; ?>" min="1" max="99" value="<?= $cart['quantity'] ?>" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-s text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" onchange="subtotal(this)" data-menu-id="<?= $cart['menu_id'] ?>" data-menu-price="{{ $cart->menu->price }}" />
                                    </div>
                                    <div class="w-1/6 px-4 flex items-center" style="height: 60%; overflow: hidden;">
                                        <img src="{{ asset('storage/photo-menu/'.$cart->menu->photo) }}" class="w-full h-auto object-cover rounded-lg" style="max-height: 100%;">
                                    </div>
                                    <div class="w-1/6 px-4 flex items-center" style="height: 100%; overflow: hidden;">
                                        <h3 class="text-xl font-semibold">{{$cart->menu->name}}</h3>
                                    </div>
                                    <div class="w-1/6 px-4 flex items-center" style="height: 100%; overflow: hidden;">
                                        <p class="text-gray-950">Rp {{ number_format($cart->menu->price, 2) }}</p>
                                    </div>
                                    <div class="w-1/6 px-4 flex items-center" style="height: 100%; overflow: hidden;">
                                        <p class="text-gray-950">Rp <span id="subtotal_<?= $cart['menu_id'] ?>">{{ number_format($cart->menu->price * $cart['quantity'], 2) }}</span></p>
                                    </div>
                                    <div class="w-1/6 px-4 flex items-center" style="height: 100%; overflow: hidden;">
                                        <a href="/cart/{{ $cart->id }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            {{ __('Delete') }}
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end" style="padding-right: 100px;">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        {{ __('Checkout') }}
                    </button>
                </div>
            </form>
            @endif
        </div>
    </div>

    <script>
        function subtotal(input) {
            const quantity = input.value;
            const menuId = input.getAttribute('data-menu-id');
            const menuPrice = parseFloat(input.getAttribute('data-menu-price'));
            const totalElement = document.getElementById('subtotal_' + menuId);
            if (totalElement) {
                const total = quantity * menuPrice;
                totalElement.textContent = total.toFixed(2);
            }
        }
    </script>
</x-app-layout>