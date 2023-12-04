<div class="modal fade" id="ModalDelete{{$cart->id}}" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">                
            <div class="flex flex-wrap justify-center">
                <div class="w-3/5 p-4">
                    <div class="w-full" style="margin-bottom: 30px">
                        <div class="flex flex-wrap">
                            <div class="w-full p-4">
                                <div class="bg-white shadow-lg rounded-lg p-4" style="display: flex; flex-direction: column; overflow: hidden;">
                                    <div class="flex justify-between" style="height: 100%;">
                                        <div class="modal-header">
                                            <div class="w-2/3 px-4 flex items-center" style="height: 100%; overflow: hidden;">
                                                <h3 class="text-xl font-semibold">Are you sure you want to delete this cart?</h3>
                                            </div>
                                        </div>
                                        <div class="w-1/3 flex justify-end">
                                            <div class="w-1/2 flex justify-end items-center" style="height: 100%; overflow: hidden;">
                                                <a href="/cart">
                                                    <x-primary-button>
                                                        {{ __('Cancel') }}
                                                    </x-primary-button>
                                                </a>
                                            </div>
                                            <div class="w-1/2 px-4 flex justify-end items-center" style="height: 100%; overflow: hidden;">
                                                <form method="POST" action="/cart/{{ $cart->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                        {{ __('Delete') }}
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="my-5">
                                    <div class="flex justify-between items-center" style="height: 50px;">
                                        <div class="w-1/5 px-4 flex items-center" style="height: 100%; overflow: hidden;">
                                            <img src="{{ asset('storage/photo-menu/'.$cart->menu->photo) }}" class="w-full h-auto object-cover rounded-lg" style="max-height: 100%;">
                                        </div>
                                        <div class="w-1/5 px-4 flex items-center" style="height: 100%; overflow: hidden;">
                                            <h3 class="text-xl font-semibold">{{$cart->menu->name}}</h3>
                                        </div>
                                        <div class="w-1/5 px-4 flex items-center" style="height: 100%; overflow: hidden;">
                                            <h3 class="text-xl font-semibold">x {{$cart->quantity}}</h3>
                                        </div>
                                        <div class="w-1/5 px-4 flex items-center" style="height: 100%; overflow: hidden;">
                                            <p class="text-gray-950">Rp <span id="subtotal_<?= $cart['menu_id'] ?>">{{ $cart->menu->price * $cart['quantity'] }}</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
