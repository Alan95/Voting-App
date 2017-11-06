@extends('header')
@section('content')
<div class="container margin-top">
   <div class="text-center">
      <h1 class="display-4">Login</h1>
   </div>
   <div class="row">
      <div class="col">
         <a href="{{ route('home') }}" class="btn btn-dark"><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i> Back</a>
      </div>
   </div>
   <hr>
   <br>
   <div class="form-style bg-dark rounded">
      <form class="form-horizontal" method="POST" action="{{ route('login') }}">
         {{ csrf_field() }}
         <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="control-label text-white">E-Mail</label>
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
            @if ($errors->has('email'))
            <span class="help-block">
            <strong class="text-danger">{{ $errors->first('email') }}</strong>
            </span>
            @endif
         </div>
         <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password" class="control-label text-white">Password</label>
            <input id="password" type="password" class="form-control" name="password" required>
            @if ($errors->has('password'))
            <span class="help-block">
            <strong class="text-danger">{{ $errors->first('password') }}</strong>
            </span>
            @endif
         </div>
         <div class="form-group">
            <div class="checkbox">
               <label>
               <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> <span class="text-white">Remember Me</span>
               </label>
            </div>
         </div>
         <div class="form-group text-center">
            <button type="submit" class="btn btn-primary btn-block">
            Login
            </button>
            <a class="btn btn-link" href="{{ route('password.request') }}">
            Forgot Your Password?
            </a>
         </div>
      </form>
   </div>
</div>
</div>
</div>
@endsection