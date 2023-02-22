<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your Matches with '. $user->name) }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="bg-white">
                        <div class="pb-5">You have {{ $count }} Matches</div>
                        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($decisions as $decision)
                                <li class="pb-3 sm:pb-4">
                                    <a href="{{ route('show.show',['show'=>$decision->show->id]) }}">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-shrink-0">
                                            <img class="w-8 h-8 rounded-full" src="{{ $decision->show->pic_src }}" alt="Neil image">
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                {{ $decision->show->title }}
                                            </p>
                                            @if($decision->show->type || $decision->show->release_date)
                                                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                    {{ $decision->show->type }} | {{ Carbon\Carbon::parse($decision->show->release_date)->format('d F Y') }}
                                                </p>
                                            @endif
                                            @if($decision->show->duration || $decision->show->rating || $decision->show->genre)
                                                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                    {{ $decision->show->duration }} | {{ $decision->show->rating }} | {{ $decision->show->genre }}
                                                </p>
                                            @endif
                                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                {{ $decision->show->description }}
                                            </p>
                                        </div>
                                        <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                            @if($decision->decision)
                                                <button type="button" class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Both Liked</button>
                                            @else
                                                <button type="button" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Disliked</button>
                                            @endif
                                        </div>
                                    </div>
                                    </a>
                                </li>
                            @endforeach
                            <li class="pb-3 sm:pb-4 mt-3">
                                {{ $decisions->links() }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
