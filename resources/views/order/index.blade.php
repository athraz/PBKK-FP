<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('These are your orders!') }}
            </h2>

            <div class="flex justify-end">
                <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 mx-2" type="button">Status <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                    </svg>
                </button>

                <!-- Dropdown menu -->
                <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg border border-gray-300 shadow w-30 dark:bg-gray-700">
                    <ul class="px-4 py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                        <li>
                            <div class="flex items-center">
                                <input checked id="waiting-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="waiting-checkbox" class="px-2 py-2 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Waiting</label>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <input checked id="ondelivery-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="ondelivery-checkbox" class="px-2 py-2 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">On Delivery</label>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <input id="delivered-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="delivered-checkbox" class="px-2 py-2 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Delivered</label>
                            </div>
                        </li>
                    </ul>
                </div>

                <a href="/menu">
                    <x-primary-button>
                        {{ __('Order another') }}
                    </x-primary-button>
                </a>
            </div>
        </div>
    </x-slot>

    @if(Auth::user()->role == 'admin')
    @php
    $userorders = $orders->sortByDesc('id');
    @endphp
    @elseif(Auth::user()->role == 'employee')
    @php

    $userorders = $orders->where('status', 'Waiting');
    @endphp
    @else
    @php
    $userorders = $orders->where('user_id', Auth::user()->id)->sortByDesc('id');
    @endphp
    @endif

    @php
    $takenorder = $orders->where('status', 'On Delivery')->where('employee_id', Auth::user()->id);
    @endphp

    <div class="flex flex-wrap justify-center">
        <div class="w-4/5 p-4">
            @if($takenorder->count() > 0)
            <div class="w-full" style="margin-bottom: 30px">
                <div class="flex flex-wrap">
                    <div class="w-full p-4">
                        @foreach($takenorder as $order)
                        <div class="bg-white shadow-lg rounded-lg p-4 mb-8" style="display: flex; flex-direction: column; overflow: hidden;">
                            <div class="flex justify-between" style="height: 100%;">
                                <div class="w-1/4 px-4 flex items-center" style="height: 100%; overflow: hidden;">
                                    <h3 class="text-md font-semibold">Order ID: {{$order->id}}</h3>
                                </div>
                                @if(($order->status == "On Delivery" || $order->status == "Delivered"))
                                <div class="w-1/6 px-4 flex items-center" style="height: 100%; overflow: hidden;">
                                    <h3 class="text-md font-semibold">Employee: {{$order->employee->name}}</h3>
                                </div>
                                @endif
                                <div class="w-1/3 px-4 flex items-center justify-end" style="height: 100%; overflow: hidden;">
                                    <h3 class="text-md font-semibold">{{$order->address}}</h3>
                                </div>
                                <div class="w-1/4 px-4 flex items-center justify-end" style="height: 100%; overflow: hidden;">
                                    <h3 class="text-md font-semibold">{{$order->created_at}}</h3>
                                </div>
                            </div>
                            <div>
                                <hr class="my-5">
                                <div class="flex mb-3" style="height: 100%;">
                                    <div class="w-1/2 px-4 flex items-center" style="height: 100%; overflow: hidden;">
                                        <h3 class="text-md font-semibold">Name</h3>
                                    </div>
                                    <div class="w-1/6 px-4 flex items-center" style="height: 100%; overflow: hidden;">
                                        <h3 class="text-md font-semibold">Quantity</h3>
                                    </div>
                                    <div class="w-1/6 px-4 flex items-center justify-end" style="height: 100%; overflow: hidden;">
                                        <h3 class="text-md font-semibold">Price</h3>
                                    </div>
                                    <div class="w-1/6 px-4 flex items-center justify-end" style="height: 100%; overflow: hidden;">
                                        <h3 class="text-md font-semibold">Subtotal</h3>
                                    </div>
                                </div>
                                @php
                                $menuorders = $ordermenus->where('order_id', $order->id);
                                @endphp
                                @foreach($menuorders as $menuorder)
                                <div class="flex" style="height: 100%;">
                                    <div class="w-1/2 px-4 flex items-center" style="height: 100%; overflow: hidden;">
                                        <h3 class="text-md font-semibold">{{$menuorder->menu->name}}</h3>
                                    </div>
                                    <div class="w-1/6 px-4 flex items-center" style="height: 100%; overflow: hidden;">
                                        <h3 class="text-md font-semibold">{{$menuorder->quantity}}</h3>
                                    </div>
                                    <div class="w-1/6 px-4 flex items-center justify-end" style="height: 100%; overflow: hidden;">
                                        <p class="text-gray-950">Rp {{ number_format($menuorder->order_price, 2) }}</p>
                                    </div>
                                    <div class="w-1/6 px-4 flex items-center justify-end" style="height: 100%; overflow: hidden;">
                                        <p class="text-gray-950">Rp <span id="subtotal_<?= $menuorder['menu_id'] ?>">{{ $menuorder->order_price * $menuorder['quantity'] }}</span></p>
                                    </div>
                                </div>
                                @endforeach
                                <hr class="my-5">
                                <div class="w-full mb-1">
                                    <div class="flex" style="height: 100%;">
                                        <div class="w-3/5 px-4 flex items-center" style="height: 100%; overflow: hidden;">
                                            <h3 class="text-md font-semibold">{{$order->status}}</h3>
                                        </div>
                                        <div class="w-1/5 px-2 flex items-center justify-end" style="height: 100%; overflow: hidden;">
                                            <h3 class="text-md font-semibold">Total</h3>
                                        </div>
                                        <div class="w-1/5 px-4 flex items-center justify-end" style="height: 100%; overflow: hidden;">
                                            <p class="text-gray-950">Rp {{ number_format($order->total_price, 2) }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full">
                                    <div class="flex justify-between" style="height: 100%;">
                                        <div class="w-1/5 flex items-center justify-start" style="height: 100%; overflow: hidden;">
                                            @if((Auth::user()->role == 'employee' || Auth::user()->role == 'admin') && $order->status == "On Delivery")
                                            <form method="POST" action="{{ route('order.done', ['id' => $order->id]) }}">
                                                @csrf
                                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 my-2 ml-2">
                                                    {{ __('Finish Order') }}
                                                </button>
                                            </form>
                                            @endif
                                        </div>
                                        <div class="w-1/5 px-4 flex items-center justify-end" style="height: 100%; overflow: hidden;">
                                            <h3 class="text-md font-semibold">(
                                                @if ($order->payment_method == 1)
                                                Cash
                                                @elseif ($order->payment_method == 2)
                                                Transfer Bank
                                                @elseif ($order->payment_method == 3)
                                                E-Wallet
                                                @endif)
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
            @if($takenorder->count() == 0 && $userorders->count() > 0)
            <div class="w-full" style="margin-bottom: 30px">
                <div class="flex flex-wrap">
                    <div class="w-full p-4 ">
                        @foreach($userorders as $order)
                        <div class="bg-white shadow-lg rounded-lg p-4 mb-8 @if($order->status == 'Waiting') waiting-order @elseif($order->status == 'On Delivery') ondelivery-order @elseif($order->status == 'Delivered') delivered-order @endif" style="display: flex; flex-direction: column; overflow: hidden;">
                            <div class="flex justify-between" style="height: 100%;">
                                <div class="w-1/4 px-4 flex items-center" style="height: 100%; overflow: hidden;">
                                    <h3 class="text-md font-semibold">Order ID: {{$order->id}}</h3>
                                </div>
                                @if(($order->status == "On Delivery" || $order->status == "Delivered"))
                                <div class="w-1/6 px-4 flex items-center" style="height: 100%; overflow: hidden;">
                                    <h3 class="text-md font-semibold">Employee: {{$order->employee->name}}</h3>
                                </div>
                                @endif
                                <div class="w-1/3 px-4 flex items-center justify-end" style="height: 100%; overflow: hidden;">
                                    <h3 class="text-md font-semibold">{{$order->address}}</h3>
                                </div>
                                <div class="w-1/4 px-4 flex items-center justify-end" style="height: 100%; overflow: hidden;">
                                    <h3 class="text-md font-semibold">{{$order->created_at}}</h3>
                                </div>
                            </div>
                            <div>
                                <hr class="my-5">
                                <div class="flex mb-3" style="height: 100%;">
                                    <div class="w-1/2 px-4 flex items-center" style="height: 100%; overflow: hidden;">
                                        <h3 class="text-md font-semibold">Name</h3>
                                    </div>
                                    <div class="w-1/6 px-4 flex items-center" style="height: 100%; overflow: hidden;">
                                        <h3 class="text-md font-semibold">Quantity</h3>
                                    </div>
                                    <div class="w-1/6 px-4 flex items-center justify-end" style="height: 100%; overflow: hidden;">
                                        <h3 class="text-md font-semibold">Price</h3>
                                    </div>
                                    <div class="w-1/6 px-4 flex items-center justify-end" style="height: 100%; overflow: hidden;">
                                        <h3 class="text-md font-semibold">Subtotal</h3>
                                    </div>
                                </div>
                                @php
                                $menuorders = $ordermenus->where('order_id', $order->id);
                                @endphp
                                @foreach($menuorders as $menuorder)
                                <div class="flex" style="height: 100%;">
                                    <div class="w-1/2 px-4 flex items-center" style="height: 100%; overflow: hidden;">
                                        <h3 class="text-md font-semibold">{{$menuorder->menu->name}}</h3>
                                    </div>
                                    <div class="w-1/6 px-4 flex items-center" style="height: 100%; overflow: hidden;">
                                        <h3 class="text-md font-semibold">{{$menuorder->quantity}}</h3>
                                    </div>
                                    <div class="w-1/6 px-4 flex items-center justify-end" style="height: 100%; overflow: hidden;">
                                        <p class="text-gray-950">Rp {{ number_format($menuorder->menu->price, 2) }}</p>
                                    </div>
                                    <div class="w-1/6 px-4 flex items-center justify-end" style="height: 100%; overflow: hidden;">
                                        <p class="text-gray-950">Rp <span id="subtotal_<?= $menuorder['menu_id'] ?>">{{ $menuorder->menu->price * $menuorder['quantity'] }}</span></p>
                                    </div>
                                </div>
                                @endforeach
                                <hr class="my-5">
                                <div class="w-full mb-1">
                                    <div class="flex" style="height: 100%;">
                                        <div class="w-3/5 px-4 flex items-center" style="height: 100%; overflow: hidden;">
                                            <h3 class="text-md font-semibold">{{$order->status}}</h3>
                                        </div>
                                        <div class="w-1/5 px-2 flex items-center justify-end" style="height: 100%; overflow: hidden;">
                                            <h3 class="text-md font-semibold">Total</h3>
                                        </div>
                                        <div class="w-1/5 px-4 flex items-center justify-end" style="height: 100%; overflow: hidden;">
                                            <p class="text-gray-950">Rp {{ number_format($order->total_price, 2) }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full">
                                    <div class="flex justify-between" style="height: 100%;">
                                        <div class="w-1/5 flex items-center justify-start" style="height: 100%; overflow: hidden;">
                                            @if((Auth::user()->role == 'employee' || Auth::user()->role == 'admin') && $order->status == "Waiting" && $takenorder->count() == 0)
                                            <form method="POST" action="{{ route('order.take', ['id' => $order->id]) }}">
                                                @csrf
                                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 my-2 ml-2">
                                                    {{ __('Take Order') }}
                                                </button>
                                            </form>
                                            @endif
                                        </div>
                                        <div class="w-1/5 px-4 flex items-center justify-end" style="height: 100%; overflow: hidden;">
                                            <h3 class="text-md font-semibold">({{ $order->payment_method }})</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var waitingCheckbox = document.getElementById("waiting-checkbox");
            var waitingOrders = document.querySelectorAll(".waiting-order");

            function toggleWaitingOrders() {
                var displayValue = waitingCheckbox.checked ? "flex" : "none";
                waitingOrders.forEach(function(order) {
                    order.style.display = displayValue;
                });
            }

            toggleWaitingOrders();
            waitingCheckbox.addEventListener("change", toggleWaitingOrders);

            var ondeliveryCheckbox = document.getElementById("ondelivery-checkbox");
            var ondeliveryOrders = document.querySelectorAll(".ondelivery-order");

            function toggleOnDeliveryOrders() {
                var displayValue = ondeliveryCheckbox.checked ? "flex" : "none";
                ondeliveryOrders.forEach(function(order) {
                    order.style.display = displayValue;
                });
            }

            toggleOnDeliveryOrders();
            ondeliveryCheckbox.addEventListener("change", toggleOnDeliveryOrders);

            var deliveredCheckbox = document.getElementById("delivered-checkbox");
            var deliveredOrders = document.querySelectorAll(".delivered-order");

            function toggleDeliveredOrders() {
                var displayValue = deliveredCheckbox.checked ? "flex" : "none";
                deliveredOrders.forEach(function(order) {
                    order.style.display = displayValue;
                });
            }

            toggleDeliveredOrders();
            deliveredCheckbox.addEventListener("change", toggleDeliveredOrders);
        });
    </script>
</x-app-layout>