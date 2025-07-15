@extends('layout.app')

@section('title','To Do Task')

@section('content')

<div class="mb-4"><a class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded" href="{{ route('task.create')}}">Add Task</a></div>

<div>

        @forelse ($tasks as $task)
        <div>
         <a href="{{route('tasks.show',['task'=>$task->id]) }}"
            @class(['font-bold','line-through'=>$task->completed])>
            {{$task->title}}</a>
        </div>
        @empty
        <div>There Are No Task!</div>
        @endforelse
 

    @if ($tasks->count())
        <nav class="mt-4">
            {{$tasks->links()}}
        </nav>
    @endif
</div>
@endsection
