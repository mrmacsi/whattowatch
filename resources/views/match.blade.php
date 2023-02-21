<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Match') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="bg-white">
                        <span>
                            <form method="POST" action="{{ route('friend.store') }}">
                                @csrf
                                <input type="hidden" name="sender_id" value="{{$user->id}}">
                                <span class="mb-5 text-lg font-medium text-gray-900 dark:text-white">Match : {{ $user->name }}</span>
                                <button name="approved" value="0" class="ml-2 inline-block px-6 py-2 border-2 border-red-600 bg-red-300 text-red-600 font-medium text-xs leading-tight uppercase rounded hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out">
                                    No
                                </button>
                                <button name="approved" value="1" class="ml-2 inline-block px-6 py-2 border-2 border-green-600 bg-green-300 text-green-600 font-medium text-xs leading-tight uppercase rounded hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out">
                                    Yes
                                </button>
                            </form>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
