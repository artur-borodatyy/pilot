<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('News create') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
                        <form method="POST" action="{{ route('news.store') }}">
                            @csrf
                            <select
                                name="store_id"
                                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                            >
                            @foreach ($stores as $store)
                                <option value="{{$store->id}}">{{$store->title}}</option>
                            @endforeach
                            </select>
                            <input
                                name="title"
                                placeholder="{{ __('Someting new in your Store?') }}"
                                class="block mt-2 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                value="{{ old('content') }}"
                            >
                            <textarea
                                name="content"
                                placeholder="{{ __('Post it here!') }}"
                                class="block mt-2 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                            >{{ old('content') }}</textarea>
                            <x-input-error :messages="$errors->get('message')" class="mt-2" />
                            <x-primary-button class="mt-4">{{ __('Post') }}</x-primary-button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>