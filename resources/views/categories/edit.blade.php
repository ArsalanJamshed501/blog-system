{{-- @extends('layouts.app') --}}
<x-app-layout>

{{-- @section('content') --}}
<div class="container">
    <h1 class="text-3xl font-bold mb-4">Edit Category</h1>
    <form action="{{ route('categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="name" value="{{ $category->name }}" class="w-full p-2 border rounded" required>
        <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded mt-2">Update</button>
    </form>
</div>
{{-- @endsection --}}
</x-app-layout>
