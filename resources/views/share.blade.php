<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Share') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="bg-white">
                        <span>
                            <span class="mb-5 text-lg font-medium text-gray-900 dark:text-white">Share to a friend</span>
                            <input type="text" class="w-full" value="{{$value}}">
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
