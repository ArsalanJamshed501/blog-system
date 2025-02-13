{{-- @extends('layouts.app') --}}
<x-app-layout>

{{-- @section('content') --}}
{{-- <x-slot name="post"> --}}
<div class="container max-w-7xl mx-auto sm:px-6 lg:px-8">
    <h1 class="text-2xl font-bold mb-4">All Posts</h1>

    <a href="{{ route('posts.create') }}" class="bg-blue-500 text-blue px-4 py-2 rounded">Create New Post</a>

    @foreach ($posts as $post)
        <div class="mt-4 p-4 border rounded">
            <h2 class="text-xl font-semibold">{{ $post->title }}</h2>
            <p class="text-gray-600">By 
                <a href="{{ route('profile.show', $post->user_id) }}">{{ $post->user->name }}</a>
                 in {{ $post->category->name }}</p>
            <p>{!! Str::limit(strip_tags($post->content, '<h1><h2><h3><h4><b><i><u><strong><em><p><br>'), 100, '...') !!}</p>
            <a href="{{ route('posts.show', $post) }}" class="text-blue-500">Read More</a>
        </div>
    @endforeach

    <div class="mt-4">
        {{ $posts->links() }}
    </div>
</div>
{{-- @endsection --}}
{{-- </x-slot> --}}

</x-app-layout>
