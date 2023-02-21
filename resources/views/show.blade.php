<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Show') }}
        </h2>
    </x-slot>
    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="bg-white">
                        <form method="POST" action="{{ route('decision.store') }}">
                            @csrf
                            <h3 class="mb-5 text-lg font-medium text-gray-900 dark:text-white pl-3">Decide: {{$show['title']}}</h3>
                            <input type="hidden" name="show_id" value="{{$show['show_id']}}">
                            <div class="grid grid-flow-col gap-3 pl-3">
                                <div class="col-span-2">
                                    <img class="h-96 md:h-auto object-cover md:w-48 rounded-t-lg md:rounded-none md:rounded-l-lg"
                                         src="{{$show['quality_pic_src']}}" />
                                </div>
                                <div class="col-span-4">
                                    <div class="p-6 flex flex-col justify-start">
                                        <p class="text-gray-700 text-base mb-4">
                                            {{$show['description']}}
                                        </p>
                                        <p class="text-gray-600"><strong>Duration</strong> : {{$show['duration']}}</p>
                                        <p class="text-gray-600"><strong>Genre</strong> : {{$show['genre']}}</p>
                                        <p class="text-gray-600"><strong>Rating</strong> : {{$show['rating']}}</p>
                                        <p class="text-gray-600"><a target="_blank" href="https://www.imdb.com/title/{{$show['show_id']}}">IMDB</a></p>
                                    </div>
                                </div>
                                <div class="col-span-5">
                                    <div class="flex flex-col justify-start">
                                        <video class="w-full" autoplay>
                                            <source src="{{$show['video_src']}}" type="video/mp4" />
                                        </video>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
