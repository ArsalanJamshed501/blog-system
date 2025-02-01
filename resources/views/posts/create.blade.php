{{-- @extends('layouts.app') --}}
<x-app-layout>

{{-- @section('content') --}}
<div class="container">
    <h1 class="text-2xl font-bold mb-4">Create New Post</h1>

    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700">Title</label>
            <input type="text" name="title" class="w-full p-2 border rounded" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Content</label>
            <textarea name="content" class="w-full p-2 border rounded" rows="5" required></textarea>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Category</label>
            <select name="category_id" class="w-full p-2 border rounded" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-blue-500 text-blue px-4 py-2 rounded">Publish Post</button>
    </form>
</div>
{{-- @endsection --}}
</x-app-layout>
