@extends('layouts.app')
@php
    /** @var \App\Models\User[] $users*/
@endphp
@section('content')
    <div class="container">
        <a href="{{route('users.create')}}" class="btn btn-primary">Create</a>
        @if(session()->has('user_created'))
            @php
                $message = session('user_created')
            @endphp
            <div class="alert {{$message['class']}} mt-4" role="alert">
                {{$message['message']}}
            </div>
        @endif
        @if(session()->has('user_updated'))
            @php
                $message = session('user_updated')
            @endphp
            <div class="alert {{$message['class']}} mt-4" role="alert">
                {{$message['message']}}
            </div>
        @endif
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Tasks</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <th scope="row">{{$user->id}}</th>
                    <td>
                        @if($user->avatar)
                            <img src="{{ $user->avatar }}" class="w-2.5">
                        @endif
                        {{$user->name}}
                    </td>
                    <td>{{$user->email}}</td>
                    @if($user->active)
                        <td>
                            <s>{{ $user->task }}</s>
                        </td>
                    @else
                        <td>
                            <span>{{ $user->task }}</span>
                        </td>
                    @endif
                    <td class="mr-4">
                        <input type="checkbox" name="active" value="1" @checked(old('active', $user->active))/>
                    </td>

                    <td>
                        <a href="{{ route('users.edit', ['user'=>$user]) }}" class="btn btn-success">Edit</a>
                        @if($user->id !== \Illuminate\Support\Facades\Auth::id())
                            <form action="{{route('users.destroy', ['user'=>$user])}}" method="POST"
                                  class="d-inline-block">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div>
            {{$users->links()}}
        </div>
    </div>
@endsection
