<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Decide') }}
        </h2>
    </x-slot>

    @include('partials.genres')

    @if (session('success'))
    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-white">
                    <div class="bg-green-100 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
                        <div class="flex">
                            <p class="font-bold">It was a match!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="bg-white">
                        @if(isset($show))
                            @if(auth()->user()->isAdmin() && isset($show['show_id']))
                                <div class="p-3">
                                    You Are Administrator
                                    <a target="_blank" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                       href="{{ route('show.check',['show'=>$show['show_id']]) }}">Check Again</a>
                                </div>
                            @endif
                            <form method="POST" action="{{ route('decision.store') }}">
                            @csrf
                            <div class="mx-auto bg-white rounded-xl shadow-md overflow-hidden">
                                <div class="md:flex">
                                    <div class="md:shrink-0 flex justify-center items-center">
                                        <img class="object-cover w-full h-full md:w-48 md:rounded-lg sm:rounded-lg sm:max-w-sm sm:flex" src="{{$show['quality_pic_src']??$show['pic_src']}}">
                                    </div>
                                    <div class="p-4">
                                        <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">{{$show['title']}}</div>
                                        <p class="text-gray-700 text-base mb-4">
                                            {{$show['description']}}
                                        </p>
                                        <p class="text-gray-600"><strong>Type</strong> : {{$show['type']}}</p>
                                        <p class="text-gray-600"><strong>Duration</strong> : {{$show['duration']}}</p>
                                        <p class="text-gray-600"><strong>Genre</strong> : {{$show['genre']}}</p>
                                        <p class="text-gray-600"><strong>Rating</strong> : {{$show['rating']}}</p>
                                        @if(isset($show['release_date']))
                                        <p class="text-gray-600"><strong>Release Date</strong> : {{ Carbon\Carbon::parse($show['release_date'])->format('d F Y') }}</p>
                                        @endif
                                        <p class="text-gray-600"><a target="_blank" href="https://www.imdb.com/title/{{$show['show_id']}}">IMDB</a></p>
                                    </div>
                                    <div class="flex items-center justify-center mb-6 lg:hidden sm:hidden">
                                        <x-danger-button name="button" value="0" class="justify-center w-full">
                                            {{ __('Dislike') }}
                                        </x-danger-button>
                                        <x-primary-button name="button" value="1" class="justify-center w-full">
                                            {{ __('Like') }}
                                        </x-primary-button>
                                    </div>
                                    @if(isset($show['video_src']))
                                        <div class="md:shrink-0 flex justify-center items-center lg:w-96">
                                            <video class="object-cover w-full rounded-b-lg h-auto md:w-full sm:rounded-lg md:rounded-lg sm:w-full sm:flex" autoplay>
                                                <source src="{{$show['video_src']}}" type="video/mp4" />
                                            </video>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex items-center justify-center mt-6">
                                    <x-danger-button name="button" value="0" class="justify-center w-full">
                                        {{ __('Dislike') }}
                                    </x-danger-button>
                                    <x-primary-button name="button" value="1" class="justify-center w-full">
                                        {{ __('Like') }}
                                    </x-primary-button>
                                </div>
                            </div>
                            <input type="hidden" name="show_id" value="{{$show['show_id']}}">
                        </form>
                        @else
                            Nothing left to show, please change genre to explore more
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
