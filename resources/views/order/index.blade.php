<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('These are your orders!') }}
            </h2>
            <a href="/menu">
                <x-primary-button>
                    {{ __('Order another') }}
                </x-primary-button>
            </a>
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
                    @foreach($takenorder as $order)
                    <div class="w-full p-4">
                        <div class="bg-white shadow-lg rounded-lg p-4" style="display: flex; flex-direction: column; overflow: hidden;">
                            <div class="flex justify-between" style="height: 100%;">
                                <div class="w-1/6 px-4 flex items-center" style="height: 100%; overflow: hidden;">
                                    <h3 class="text-md font-semibold">Order ID: {{$order->id}}</h3>
                                </div>
                                @if(($order->status == "On Delivery" || $order->status == "Delivered"))
                                <div class="w-1/6 px-4 flex items-center" style="height: 100%; overflow: hidden;">
                                    <h3 class="text-md font-semibold">Employee: {{$order->employee->name}}</h3>
                                </div>
                                @endif
                                <div class="w-1/2 px-4 flex items-center justify-end" style="height: 100%; overflow: hidden;">
                                    <h3 class="text-md font-semibold">{{$order->address}}</h3>
                                </div>
                                <div class="w-1/6 px-4 flex items-center justify-end" style="height: 100%; overflow: hidden;">
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
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
            @if($userorders->count() > 0)
            <div class="w-full" style="margin-bottom: 30px">
                <div class="flex flex-wrap">
                    @foreach($userorders as $order)
                    <div class="w-full p-4">
                        <div class="bg-white shadow-lg rounded-lg p-4" style="display: flex; flex-direction: column; overflow: hidden;">
                            <div class="flex justify-between" style="height: 100%;">
                                <div class="w-1/3 px-4 flex items-center" style="height: 100%; overflow: hidden;">
                                    <h3 class="text-md font-semibold">Order ID: {{$order->id}}</h3>
                                </div>
                                @if(($order->status == "On Delivery" || $order->status == "Delivered"))
                                <div class="w-1/6 px-4 flex items-center" style="height: 100%; overflow: hidden;">
                                    <h3 class="text-md font-semibold">Employee: {{$order->employee->name}}</h3>
                                </div>
                                @endif
                                <div class="w-1/2 px-4 flex items-center justify-end" style="height: 100%; overflow: hidden;">
                                    <h3 class="text-md font-semibold">{{$order->address}}</h3>
                                </div>
                                <div class="w-1/6 px-4 flex items-center justify-end" style="height: 100%; overflow: hidden;">
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
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>