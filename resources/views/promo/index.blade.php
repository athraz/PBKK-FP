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
</x-app-layout>