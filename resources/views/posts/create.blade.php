<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Post
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="/posts" method="POST">
                        @csrf

                        <div class="mb-6">
                            <label for="title" class="block mb-2 uppercase font-bold text-xs text-gray-700">
                                Title
                            </label>

                            <input type="text" class="border border-gray-400 p-2 w-full" name="title"
                                id="title" required>

                            @error('title')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="body" class="block mb-2 uppercase font-bold text-xs text-gray-700">
                                Body
                            </label>

                            <textarea class="border border-gray-400 p-2 w-full" name="body" id="body" required></textarea>

                            @error('body')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <x-honeypot />

                        <div class="mb-6">
                            <button type="submit" class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500">
                                Publish
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
