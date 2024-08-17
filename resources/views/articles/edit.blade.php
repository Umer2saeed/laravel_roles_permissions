<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Articles / Edit
            </h2>
            <a href="{{ route('articles.index') }}" class="shadow bg-gray-500 hover:bg-gray-600 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded-full">Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('articles.update', $article->id) }}" method="post">
                        @csrf
                        <div>
                            <label class="text-md font-medium" for="title">Title</label>
                            <div class="my-3">
                                <input value="{{ old('title', $article->title) }}" class="w-1/2 border-gray-300 shadow-sm rounded-lg text-gray-700 leading-tight" id="title" type="text" name="title" placeholder="Title">
                                @error('title')
                                <p class="text-red-400 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <label class="text-md font-medium" for="text">Content</label>
                            <div class="my-3">
                                <textarea class="w-1/2 border-gray-300 shadow-sm rounded-lg text-gray-700 leading-tight" id="text" name="text" placeholder="Content" cols="30" rows="15">{{ old('text', $article->text) }}</textarea>
                            </div>

                            <label class="text-md font-medium" for="author">Author</label>
                            <div class="my-3">
                                <input value="{{ old('author', $article->author) }}" class="w-1/2 border-gray-300 shadow-sm rounded-lg text-gray-700 leading-tight" id="author" type="text" name="author" placeholder="Author">
                                @error('author')
                                <p class="text-red-400 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit" class="shadow bg-gray-500 hover:bg-gray-600 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded-full">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
