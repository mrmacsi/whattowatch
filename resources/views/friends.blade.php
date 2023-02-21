<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Friends') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="bg-white">
                        <span>
                            <span class="mb-5 text-lg font-medium text-gray-900">Share to a friend</span>
                            <input type="text" class="w-full" value="{{$value}}">
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="bg-white">
                        <span>
                            <span class="mb-5 text-lg font-medium text-gray-900">{{ auth()->user()->name }}'s friends</span>
                        </span>
                        @foreach($friends as $friend)
                            <div>
                                @if($friend->sender->id == auth()->user()->id)
                                    <a
                                        type="button"
                                        class="ml-2 inline-block px-6 py-2 border-2 border-blue-600 text-blue-600 font-medium text-xs leading-tight uppercase rounded hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out"
                                        href="{{ route('friend.matches',['user'=>$friend->receiver->id]) }}"> {{ $friend->receiver->name }}</a>
                                @else
                                    <a
                                        type="button"
                                        class="ml-2 inline-block px-6 py-2 border-2 border-blue-600 text-blue-600 font-medium text-xs leading-tight uppercase rounded hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out"
                                        href="{{ route('friend.matches',['user'=>$friend->sender->id]) }}"> {{ $friend->sender->name }}</a>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
