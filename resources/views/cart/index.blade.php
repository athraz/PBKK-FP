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

    @php
    $usercarts = $carts->where('user_id', Auth::user()->id);
    @endphp

    <div class="flex flex-wrap justify-center">
        <div class="w-4/5 p-4">
            @if($usercarts->count() > 0)
            <div class="w-full" style="margin-bottom: 60px">
                <div class="flex flex-wrap">
                    @foreach($usercarts as $cart)
                    <div class="w-full p-4">
                        <div class="bg-white shadow-lg rounded-lg p-4" style="display: flex; flex-direction: column; height: 100px; overflow: hidden;">
                            <div class="flex" style="height: 100%;">
                                <div class="w-32 flex items-center" style="height: 100%; overflow: hidden;">
                                    <form method="POST" action="{{ route('order.create')}}" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="menu_id" value="<?= $cart['menu_id'] ?>" />
                                        <input type="number" name="quantity" min="1" max="99" value="<?= $cart['quantity'] ?>" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-s text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" onchange="subtotal(this)" data-menu-id="<?= $cart['menu_id'] ?>" data-menu-price="{{ $cart->menu->price }}" />

                                    </form>
                                </div>
                                <div class="w-1/5 px-4" style="height: 100%; overflow: hidden;">
                                    <img src="{{ asset('storage/photo-menu/'.$cart->menu->photo) }}" class="w-full h-auto object-cover rounded-lg" style="max-height: 100%;">
                                </div>
                                <div class="w-1/3 px-4 flex items-center" style="height: 100%; overflow: hidden;">
                                    <h3 class="text-xl font-semibold">{{$cart->menu->name}}</h3>
                                </div>
                                <div class="w-1/5 px-4 flex items-center" style="height: 100%; overflow: hidden;">
                                    <p class="text-gray-950">Rp {{ number_format($cart->menu->price, 2) }}</p>
                                </div>
                                <div class="w-1/5 px-4 flex items-center" style="height: 100%; overflow: hidden;">
                                    <p class="text-gray-950">Rp <span id="subtotal_<?= $cart['menu_id'] ?>">{{ $cart->menu->price * $cart['quantity'] }}</span></p>
                                </div>
                                <div class="w-1/5 px-4 flex items-center" style="height: 100%; overflow: hidden;">
                                    <form method="POST" action="{{ route('cart.delete')}}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="<?= $cart['id'] ?>" />
                                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            {{ __('Delete') }}
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