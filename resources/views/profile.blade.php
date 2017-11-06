@extends('header')
@section('content')
@auth
    Hello {{ Auth::user()->name }}
@endauth
@guest
    Error
@endguest


@endsection('content')