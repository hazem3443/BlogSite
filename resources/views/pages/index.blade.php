@extends('layouts.app')

@section('content')
    <div class="jumbotron text-center">
        <h1>Welcome To Laravel</h1>
        <p>this is the Laravel application</p>
        <p>
        @if (Auth::guest())
            <a class="btn btn-primary btn-lg" href="{{ route('login') }}" role="button">Login</a>
            <a class="btn btn-success btn-lg" href="{{ route('register') }}" role="button">Register</a>
        @else
            <a class="btn btn-primary btn-lg" href="/dashboard" role="button">Login</a>
            <a class="btn btn-success btn-lg" href="/dashboard" role="button">Register</a>
        @endif
        </p>
    </div>
@endsection 