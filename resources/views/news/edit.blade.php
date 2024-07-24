<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('News edit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
                        <form method="POST" action="{{ route('news.update', $new) }}">
                            @csrf
                            @method('patch')
                            <select
                                name="store_id"
                                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                            >
                            @foreach ($stores as $store)
                                <option value="{{$store->id}}"
                                    @if ($store->id === $new->store_id)
                                        @selected(true)
                                    @endif
                                >{{$store->title}}</option>
                            @endforeach
                            </select>
                            <input
                                name="title"
                                placeholder="{{ __('Someting new in your Store?') }}"
                                class="block mt-2 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                value="{{ old('title', $new->title) }}"
                            >
                            <textarea
                                name="content"
                                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                            >{{ old('content', $new->content) }}</textarea>
                            <x-input-error :messages="$errors->get('message')" class="mt-2" />
                            <div class="mt-4 space-x-2">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>
                                <a href="{{ route('news.index') }}">{{ __('Cancel') }}</a>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>