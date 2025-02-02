{{-- @extends('layouts.app') --}}
<x-app-layout>

{{-- @section('content') --}}
<div class="container">
    <h1 class="text-3xl font-bold mb-2">{{ $post->title }}</h1>
    {{-- @dd($post->id) --}}
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

    <div class="mt-8">
        <h2 class="text-2xl font-bold">Comments</h2>

        @foreach ($post->comments as $comment)
            <div class="mt-4 p-4 border rounded">
                <p class="text-gray-600"><strong>{{ $comment->user->name }}</strong> said:</p>
                <p>{{ $comment->content }}</p>

                @auth
                    @if(auth()->id() === $comment->user_id)
                        <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500">Delete</button>
                        </form>
                    @endif
                @endauth
            </div>
        @endforeach

        @auth
            <form action="{{ route('comments.store', $post) }}" method="POST" class="mt-4">
                @csrf
                <textarea name="content" class="w-full p-2 border rounded" rows="3" required></textarea>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-2">Add Comment</button>
            </form>
        @else
            <p class="text-gray-500 mt-4">You must be logged in to comment.</p>
        @endauth
</div>
{{-- @endsection --}}
</x-app-layout>
