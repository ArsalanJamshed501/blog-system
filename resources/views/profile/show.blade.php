{{-- @extends('layouts.app') --}}
<x-app-layout>

{{-- @section('content') --}}
<div class="container">
    <h1 class="text-3xl font-bold">{{ $user->name }}'s Profile</h1>
    <p class="mt-2">{{ $user->bio ?? 'No bio available.' }}</p>

    <h2 class="text-2xl font-bold mt-6">Posts by {{ $user->name }}</h2>
    <ul class="mt-2">
        @foreach($user->posts as $post)
            <li>
                <a href="{{ route('posts.show', $post) }}" class="text-blue-500">{{ $post->title }}</a>
            </li>
        @endforeach
    </ul>
</div>
{{-- @endsection --}}
</x-app-layout>
