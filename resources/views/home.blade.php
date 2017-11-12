@extends('header')
@section('content')
    <div class="container">
            <div id="app">
                @if(Auth::user())
                <home :user="{{ Auth::user() }} "></home>
                @else
                <home :user="''"></home>
                @endif
            </div>
    </div>
@endsection


