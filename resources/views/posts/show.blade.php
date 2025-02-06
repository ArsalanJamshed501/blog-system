{{-- @extends('layouts.app') --}}
<x-app-layout>

{{-- @section('content') --}}
<div class="container max-w-7xl mx-auto sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold mb-2">{{ $post->title }}</h1>
    
    <p class="text-gray-600">
        By <a href="{{ route('profile.show', $post->user->id) }}">{{ $post->user->name }}</a> in {{ $post->category->name }}
    </p>
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

    <form action="{{ route('posts.like', $post) }}" method="post">
        @csrf
        <button class="bg-red-500 text-white px-4 py-2 rounded">
            @if ($post->isLikedBy(Auth::user()))
                ❤️ Unlike ({{ $post->likes->count() }})
            @else
                🤍 Like ({{ $post->likes->count() }})
            @endif
        </button>
    </form>

    {{-- Comment Section --}}
    <div class="mt-8">
        <h2 class="text-2xl font-bold">Comments</h2>

        @foreach ($post->comments as $comment)
            <div class="mt-4 p-4 border rounded">
                <p class="text-gray-600">
                    <strong><a href="{{ route('profile.show', $comment->user->id) }}">{{ $comment->user->name }}</a></strong> said:
                </p>
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
            <p class="text-gray-500 mt-4">You must be <a href="{{ route('login') }}">logged in</a> to comment.</p>
        @endauth
    </div>
</div>
{{-- @endsection --}}
</x-app-layout>
