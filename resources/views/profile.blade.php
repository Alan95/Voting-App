@extends('header')
@section('content')
<div class="container">
    @auth
    <div id="app">
        <profile :user="{{ Auth::user() }}"></profile>
    </div>    
    @endauth
    @guest
    <div class="alert alert-dark" role="alert">
        Please login to see your profile.
    </div>    
    @endguest
</div>
@endsection('content')