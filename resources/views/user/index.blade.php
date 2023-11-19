<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('This is the list of users!') }}
            </h2>
            <a href="/user/create">
                <x-primary-button>
                    {{ __('Add User') }}
                </x-primary-button>
            </a>
        </div>
    </x-slot>

    <div class="flex flex-wrap justify-center">
        <div class="w-4/5 p-4">
            <div class="w-full" style="margin-bottom: 30px">
                <div class="flex flex-wrap">
                    <div class="w-full p-4">
                        <div class="bg-white shadow-lg rounded-lg p-4" style="display: flex; flex-direction: column; overflow: hidden;">
                            <div class="flex mb-3 items-center" style="height: 100%;">
                                <div class="w-1/6 px-4 flex justify-start" style="height: 100%; overflow: hidden;">
                                    <h3 class="text-md font-semibold">Name</h3>
                                </div>
                                <div class="w-1/6 px-4 flex justify-start" style="height: 100%; overflow: hidden;">
                                    <h3 class="text-md font-semibold">Email</h3>
                                </div>
                                <div class="w-1/6 px-4 flex justify-start" style="height: 100%; overflow: hidden;">
                                    <h3 class="text-md font-semibold">Role</h3>
                                </div>
                                <div class="w-1/6 px-4 flex justify-start" style="height: 100%; overflow: hidden;">
                                    <h3 class="text-md font-semibold">Created at</h3>
                                </div>
                                <div class="w-1/6 px-4 flex justify-start" style="height: 100%; overflow: hidden;">
                                    <h3 class="text-md font-semibold">Updated at</h3>
                                </div>
                                <div class="w-1/6 px-4 flex justify-center" style="height: 100%; overflow: hidden;">
                                    <h3 class="text-md font-semibold">Delete</h3>
                                </div>
                            </div>
                            <hr class="my-1">
                            @foreach($users as $user)
                            <div class="flex my-1 items-center" style="height: 100%;">
                                <div class="w-1/6 px-4 flex justify-start" style="height: 100%; overflow: hidden;">
                                    <h3 class="text-md font-semibold">{{$user->name}}</h3>
                                </div>
                                <div class="w-1/6 px-4 flex justify-start" style="height: 100%; overflow: hidden;">
                                    <h3 class="text-md font-semibold">{{$user->email}}</h3>
                                </div>
                                <div class="w-1/6 px-4 flex justify-start" style="height: 100%; overflow: hidden;">
                                    <h3 class="text-md font-semibold">{{$user->role}}</h3>
                                </div>
                                <div class="w-1/6 px-4 flex justify-start" style="height: 100%; overflow: hidden;">
                                    <h3 class="text-md font-semibold">{{$user->created_at}}</h3>
                                </div>
                                <div class="w-1/6 px-4 flex justify-start" style="height: 100%; overflow: hidden;">
                                    <h3 class="text-md font-semibold">{{$user->updated_at}}</h3>
                                </div>
                                <div class="w-1/6 px-4 flex justify-center" style="height: 100%; overflow: hidden;">
                                    <form method="POST" action="/user/{{ $user->id }}" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 my-2 ml-2">
                                            {{ __('Delete') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <hr>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>