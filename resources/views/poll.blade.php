@extends('header')
@section('content')
<div class="container">
    <div id="app">
    @if(isset($pollId))
        <poll :pollid="{{ $pollId }}"></poll>
    @else
    
        <div class="text-center">
            Error! Please go back.
        </div>
      
    @endif    
    </div>     
</div>
@endsection('content')