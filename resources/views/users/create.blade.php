@extends('layouts.app')

@section('content')
<div class="container">
    @include('users.inc._form'. ['task'=>$task])
</div>
@endsection
