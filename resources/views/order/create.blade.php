<x-guest-layout>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight flex justify-center">
        {{ __('Check your items!') }}
    </h2>

    <form method="POST" action="{{ route('order') }}" enctype="multipart/form-data">
        @csrf

        @php
        $usercarts = $carts->where('user_id', Auth::user()->id);
        $total = 0;
        @endphp

        <div class="flex flex-wrap justify-center">
            <div class="w-full" style="margin: 30px 0">
                <div class="flex flex-wrap">
                    @foreach($usercarts as $cart)
                    <div class="w-full">
                        <div class="flex justify-between" style="height: 100%;">
                            <div class="w-1/2 flex items-center" style="height: 100%; overflow: hidden;">
                                <h3 class="text-md font-semibold">{{$cart->menu->name}}</h3>
                            </div>
                            <div class="w-1/6 px-2 flex items-center justify-start" style="height: 100%; overflow: hidden;">
                                <h3 class="text-md font-semibold">{{$cart->quantity}}</h3>
                            </div>
                            <div class="w-1/3 flex items-center justify-end" style="height: 100%; overflow: hidden;">
                                <p class="text-gray-950">Rp {{ number_format($cart->menu->price * $cart['quantity'], 2) }}</p>
                                @php
                                $total = $total + $cart->menu->price * $cart['quantity']
                                @endphp
                            </div>
                        </div>
                        <hr>
                    </div>
                    @endforeach
                    <div class="w-full">
                        <input type="hidden" name="total_price" value="<?= $total ?>" />
                        <div class="flex justify-end" style="height: 100%;">
                            <div class="w-1/5 px-2 flex items-center justify-start" style="height: 100%; overflow: hidden;">
                                <h3 class="text-md font-semibold">Total</h3>
                            </div>
                            <div class="w-1/3 flex items-center justify-end" style="height: 100%; overflow: hidden;">
                                <p class="text-gray-950">Rp {{ number_format($total, 2) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Address -->
        <div>
            <x-input-label for="address" :value="__('Address')" />
            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required autofocus autocomplete="address" />
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

        <!-- Payment Method -->
        <div class="mt-4 mb-10">
            <x-input-label for="payment_method" :value="__('Payment Method')" />
            <select id="payment_method" name="payment_method" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
                <option value="null" selected>-</option>
                <option value="Cash">Cash</option>
                <option value="Transfer Bank">Transfer Bank</option>
                <option value="E-wallet">E-Wallet</option>
            </select>

            <x-input-error :messages="$errors->get('payment_method')" class="mt-2" />
        </div>


        <div class="flex items-center justify-end mt-4">
            <a href="/cart">
                <x-primary-button type="button">
                    {{ __('Back') }}
                </x-primary-button>
            </a>
            <x-primary-button type="submit" class="ml-4">
                {{ __('Checkout') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>