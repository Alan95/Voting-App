@extends('header')
@section('content')
<div class="container">
    <div id="app">
    @if(isset($polls))
        <polls :polls="{{ $polls }}"></polls>
    @else
    
        <div class="text-center">
            No polls created.
        </div>
      
    @endif    
    </div>  
</div>
@endsection('content')