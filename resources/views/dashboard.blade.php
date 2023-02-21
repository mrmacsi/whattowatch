<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Genres') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="bg-white">
                        <h3 class="m-2 text-lg font-medium text-gray-900">Your Genres</h3>
                        <span class="items-center justify-center">
                            @foreach($userGenres as $genre)
                                <button class="m-2 px-6 py-2 border-2 border-blue-600 text-blue-600 font-medium text-xs leading-tight uppercase rounded hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out">
                                    {{$genre->genre}}
                                </button>
                            @endforeach
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="bg-white">

                        <form method="POST" action="{{ route('genre.store') }}">
                            @csrf
                            <h3 class="mb-5 text-lg font-medium text-gray-900 dark:text-white">Choose Genre:</h3>
                            <div class="flex mt-4 m-2">
                                <x-primary-button class="w-full">
                                    {{ __('Submit') }}
                                </x-primary-button>
                            </div>
                            @foreach($genres as $chunkedGenres)
                                <div class="flex flex-wrap lg:flex-nowrap">
                                    @foreach($chunkedGenres as $genre)
                                        <div class="w-full lg:w-1/5 m-2">
                                            <input type="checkbox"  name="{{$genre['title']}}" id="{{$genre['title']}}" value="{{$genre['title']}}" class="hidden peer" >
                                            <label for="{{$genre['title']}}" class="inline-flex items-center justify-center w-full p-5 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 peer-checked:border-blue-600 hover:text-gray-600 dark:peer-checked:text-gray-300 peer-checked:text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                                <div class="block">
                                                    <img src="{{$genre['src']}}" class="">
                                                </div>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach

                            <div class="flex mt-4 m-2">
                                <x-primary-button class="w-full">
                                    {{ __('Submit') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
