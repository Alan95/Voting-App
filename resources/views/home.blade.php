@extends('header')
@section('content')
    <div class="container">
            <div id="app">
                @if(Auth::user())
                <home :user="{{ Auth::user() }} "></home>
                @else
                <home></home>
                @endif
            </div>
    </div>
@endsection


