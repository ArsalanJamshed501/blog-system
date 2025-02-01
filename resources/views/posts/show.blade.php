{{-- @extends('layouts.app') --}}
<x-app-layout>

{{-- @section('content') --}}
<div class="container">
    <h1 class="text-3xl font-bold mb-2">{{ $post->title }}</h1>
    <p class="text-gray-600">By {{ $post->user->name }} in {{ $post->category->name }}</p>
    <p class="mt-4">{{ $post->content }}</p>

    @auth
        @if(auth()->id() === $post->user_id)
            <div class="mt-4">
                <a href="{{ route('posts.edit', $post) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">Edit</a>

                <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded"
                        onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                </form>
            </div>
        @endif
    @endauth
</div>
{{-- @endsection --}}
</x-app-layout>
