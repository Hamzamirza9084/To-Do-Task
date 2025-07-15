@extends('layout.app')

@section('title','Add Task')



@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white shadow-md rounded-2xl mt-8">
    {{-- <h1 class="text-2xl font-semibold text-gray-800 mb-6">Add Task</h1> --}}
    <form action="{{ route('tasks.store')}}" method="post" class="space-y-6">
        @csrf
        <div>
            <label for="title" class="block text-gray-700 font-medium mb-2">Title</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}"
                   class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('title')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description" class="block text-gray-700 font-medium mb-2">Description</label>
            <textarea name="description" id="description" rows="5"
                      class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description') }}</textarea>
            @error('description')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="long_description" class="block text-gray-700 font-medium mb-2">Long Description</label>
            <textarea name="long_description" id="long_description" rows="10"
                      class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('long_description') }}</textarea>
            @error('long_description')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-all duration-200">
                Add Task
            </button>
        </div>
    </form>
</div>
@endsection
