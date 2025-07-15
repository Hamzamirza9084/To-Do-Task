@extends('layout.app')

@section('title')
    {{$task->title}}
@endsection

@section('content')
<div class="mb-4"><a class="link" href="{{ route('tasks.index')}}">← Go Back</a></div>
<p class="mb-4 text-slate-700">{{$task->description}}</p>

@if ($task->long_description)
    <p class="mb-4 text-slate-700">{{$task->long_description}}</p>
@else
    
@endif
<p class="mb-4 text-sm text-slate-500">Created {{$task->created_at->diffForHumans()}} • Updated Ago {{$task->updated_at->diffForHumans()}}</p>


<p class="mb-4">
    @if ($task->completed)
       <span class="font-medium text-green-500">Completed</span>
    @else
            <span class="font-medium text-red-500">Not Completed</span>
    @endif
</p>
<div class="flex gap-2">
<a href="{{ route('tasks.edit',['task'=>$task->id])}}"
    class="bg-blue-500 text-white px-2 py-1 rounded"
    >Edit</a>


    <form action="{{route('tasks.toggle',['task'=>$task])}}" method="post">
        @csrf
        @method('PUT')
        <button class="btn" type="submit">Mark as {{$task->completed ? 'not completed': 'completed'}}</button>
    </form>


<form action="{{ route('tasks.destory',['task'=>$task->id])}}" method="post">
    @csrf
    @method('DELETE')
    <button class="bg-red-500 text-white px-2 py-1 rounded" type="submit">Delete</button>
</form>
</div>
@endsection
