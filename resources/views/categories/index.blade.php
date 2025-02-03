{{-- @extends('layouts.app') --}}
<x-app-layout>

{{-- @section('content') --}}
<div class="container">
    <h1 class="text-3xl font-bold mb-4">Categories</h1>
    <a href="{{ route('categories.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add Category</a>

    <ul class="mt-4">
        @foreach ($categories as $category)
            <li class="p-2 border rounded flex justify-between items-center">
                {{ $category->name }}
                <div>
                    <a href="{{ route('categories.edit', $category) }}" class="text-yellow-500">Edit</a>

                    <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
</div>
{{-- @endsection --}}
</x-app-layout>
