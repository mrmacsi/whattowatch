<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="bg-white">
                    <h3 class="m-2 text-lg font-medium text-gray-900">Your Genres</h3>
                    <span class="items-center justify-center">
                            @foreach($userGenres as $genre)
                            <button class="m-1 px-3 py-1 border-2 border-blue-600 text-blue-600 font-medium text-xs leading-tight uppercase rounded hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out">
                                    {{$genre->genre}}
                                </button>
                        @endforeach
                        </span>
                </div>
            </div>
        </div>
    </div>
</div>