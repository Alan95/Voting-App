@extends('header')
@section('content')
    <div class="container margin-top">
        <div class="text-center">
                <h1 class="display-4">Register</h1> 
            </div>
        <div class="row">
            <div class="col">
                <a href="{{ url()->previous() }}" class="btn btn-dark"><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i> Back</a>
            </div>
        </div>
        <br>
        <form method="POST">
            {{ csrf_field() }}
            <div class="form-style bg-dark rounded">
                @if($errors->any())
                    <div class="col">
                        <div class="alert alert-danger" role="alert">
                            <ul>
                            <h4 class="alert-heading">Error!</h4>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
                <div class="form-group">
                    <label class="text-white" for="name">Username*</label>
                    <input name="name" class="form-control" type="text"/>
                </div>
                <div class="form-group">
                    <label class="text-white" for="password">Password*</label>
                    <input name="password" class="form-control" type="password"/>
                </div>
                <div class="form-group">
                    <label class="text-white" for="email">E-Mail</label>
                    <input name="email" class="form-control" type="email"/>
                </div>    
                <br>
                <button class="btn btn-block btn-primary" type="submit">Register</button>
            </div>
        </form>
    </div>
@endsection