@extends('layouts.app')
@php
    /** @var \App\Models\TodoList[] $tasks */
@endphp
@section('content')
    <div class="container">
        <a href="{{route('tasks.create')}}" class="btn btn-primary">Create</a>
    </div>
    <div class="container">
        @if(session()->has('task_created'))
            @php
                $message = session('task_created')
            @endphp
        @endif
    @if(session()->has('message'))
        <div class="alert alert-success mt-4" role="alert">
            {{session('message')}}
        </div>
    @endif
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Tasks</th>
                <th scope="col">Description</th>
                <th scope="col">Status</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tasks as $task)
                <tr>
                    <td>
                        {{$task->title}}
                    </td>
                    <td>
                        {{$task->description}}
                    </td>
                    <td>
                        <form  action="{{ route('tasks.complete', ['task'=>$task]) }}" method="POST">
                            @csrf
                            @method('POST')
                            <input type="hidden" value="0" name="complete">
                            <input type="checkbox" name="complete" value="1" onchange="this.form.submit()"
                                   @if($task->completed) checked  @endif>
                        </form>
                    </td>
                    <td>
                        <a href="{{ route('tasks.edit', ['task'=>$task]) }}" class="btn btn-success">Edit</a>
                        <form action="{{route('tasks.destroy', ['task'=>$task])}}" method="POST"
                              class="d-inline-block">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
