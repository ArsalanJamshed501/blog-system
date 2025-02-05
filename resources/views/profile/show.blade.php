{{-- @extends('layouts.app') --}}
<x-app-layout>

{{-- @section('content') --}}
<div class="container">
    <h1 class="text-3xl font-bold">{{ $user->name }}'s Profile</h1>

    @if ($user->profile_picture)
        <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="__profile__ ____picture____" class="w-32 h-32  rounded-full">
    @else
        <img src="{{ asset('default-avatar.png') }}" alt="__default__ ___profile pic___" class="w-32 h-32 rounded-full">
    @endif

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
