@extends('header')
@section('content')
<div class="container">
    <div id="app">
    @if(isset($poll))
        <poll :poll="{{ $poll }}"></poll>
    @else
    
        <div class="text-center">
            Error! Please go back.
        </div>
      
    @endif    
    </div>     
</div>
@endsection('content')