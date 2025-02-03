{{-- @extends('layouts.app') --}}
<x-app-layout>

{{-- @section('content') --}}
<div class="container">
    <h1 class="text-3xl font-bold mb-4">Create Category</h1>
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Category Name" class="w-full p-2 border rounded" required>
        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded mt-2">Save</button>
    </form>
</div>
{{-- @endsection --}}
</x-app-layout>
