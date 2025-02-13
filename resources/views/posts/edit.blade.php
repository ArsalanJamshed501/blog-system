{{-- @extends('layouts.app') --}}
<x-app-layout>

{{-- @section('content') --}}
<div class="container max-w-7xl mx-auto sm:px-6 lg:px-8">
    <h1 class="text-2xl font-bold mb-4">Edit Post</h1>

    <form action="{{ route('posts.update', $post) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="title" class="block text-gray-700">Title</label>
            <input type="text" name="title" id="title" value="{{ $post->title }}" class="w-full p-2 border rounded" required>
        </div>

        <div class="mb-4">
            <label for="content" class="block text-gray-700">Content</label>
            <input name="content" id="content" class="w-full p-2 border rounded" rows="5" value="{{ $post->content }}" type="hidden" required>
            <trix-editor input="content"></trix-editor>
        </div>

        <div class="mb-4">
            <label for="category_id" class="block text-gray-700">Category</label>
            <select name="category_id" id="category_id" class="w-full p-2 border rounded" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Update Post</button>
    </form>
</div>
{{-- @endsection --}}
</x-app-layout>
