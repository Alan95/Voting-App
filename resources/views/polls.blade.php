@extends('header')
@section('content')
<div class="container">
<nav></nav>
    <div id="app">
    @if(isset($polls))
        <polls :polls="{{ $polls }}"></polls>
    @else
    
        <div class="text-center">
            No polls created.
        </div>
      
    @endif    
    </div>  
<footer></footer>    
</div>
@endsection('content')