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
                            <span class="mb-5 text-lg font-medium text-gray-900 dark:text-white">{{ auth()->user()->name }}'s friends</span>
                        </span>
                        @foreach($friends as $friend)
                            <div><a href="{{ route('friend.matches',['user'=>$friend->friend->id]) }}"> {{ $friend->friend->name }}</a></div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
