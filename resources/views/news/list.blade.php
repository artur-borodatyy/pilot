<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('News') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="bg-white rounded-lg divide-y">
                        <div class="flex-1">
                            <div class="flex justify-between items-center">
                                <form method="GET" action="{{ route('news.index') }}">
                                    @csrf
                                    <select
                                        name="store_id"
                                        class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                        onchange="event.preventDefault(); this.closest('form').submit();"
                                    >
                                        @foreach ($stores as $store)
                                            <option
                                                value="{{ $store->id }}"
                                                @if ($selected == $store->id)
                                                    @selected(true)
                                                @endif
                                            >{{ $store->title }}</option>
                                        @endforeach
                                    </select>
                                    @if ($selected)
                                        <a href="{{ route('news.index') }}">{{ __('Show all') }}</a>
                                    @endif
                                </form>
                                <div>
                                    <a href="{{ route('news.create') }}">{{ __('Create new Post') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="mt-6">

                    <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
                        @foreach ($news as $new)
                            <div class="p-6 flex space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                                <div class="flex-1">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <span class="text-gray-800">{{ $new->user->name }}</span>
                                            <span class="text-gray-800">@</span>
                                            <span class="text-gray-800">{{ $new->store->title }}</span>
                                            <small class="ml-2 text-sm text-gray-600">{{ $new->created_at->format('d.m.Y, H:i') }}</small>
                                            @unless ($new->created_at->eq($new->updated_at))
                                                <small class="text-sm text-gray-600"> &middot; {{ __('edited') }}</small>
                                            @endunless
                                        </div>
                                        @if ($new->user->is(auth()->user()))
                                            <x-dropdown>
                                                <x-slot name="trigger">
                                                    <button>
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                                        </svg>
                                                    </button>
                                                </x-slot>
                                                <x-slot name="content">
                                                    <x-dropdown-link :href="route('news.edit', $new)">
                                                        {{ __('Edit') }}
                                                    </x-dropdown-link>
                                                    <form method="POST" action="{{ route('news.destroy', $new) }}">
                                                        @csrf
                                                        @method('delete')
                                                        <x-dropdown-link :href="route('news.destroy', $new)" onclick="event.preventDefault(); this.closest('form').submit();">
                                                            {{ __('Delete') }}
                                                        </x-dropdown-link>
                                                    </form>
                                                </x-slot>
                                            </x-dropdown>
                                        @endif
                                    </div>
                                    <strong class="mt-4 text-lg text-gray-900">{{ $new->title }}</strong>
                                    <p class="mt-4 text-gray-900">{{ $new->content }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
