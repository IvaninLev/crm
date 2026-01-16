@extends('layouts.app')

@section('content')
    <div class="container">
        @include('users.inc._form', ['user'=>$user])
    </div>
@endsection
