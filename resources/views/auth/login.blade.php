@extends('layouts.auth')

@section('title')
    Login Panel
@endsection


@section('content')
@php
    $logo = DB::table('settings')->first();
@endphp
<div class="login-box">
    <div class="login-logo">
      <img src="{{ asset($logo->path_logo) }}" width="25%" alt=""><br>
      <a href="{{ url('/') }}"><b>Member</b>System</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Silahkan Login</p>
        
      <strong class="text-danger">
        <x-jet-validation-errors class="mb-4" />
      </strong>
      
      <form action="{{ route('login') }}" method="post">
        @csrf
        <div class="form-group has-feedback @error('email') has-error @enderror">
            
          <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required autofocus >
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          @error('email')
                <span class="help-block">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group has-feedback @error('password') has-error @enderror">
          <input type="password" class="form-control" placeholder="Password" name="password" required>
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          @error('password')
                <span class="help-block">{{ $message }}</span>
            @enderror
        </div>
        <div class="row">
          <div class="col-xs-8">
            <div class="checkbox icheck">
              <label>
                <input type="checkbox"> Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <!-- /.social-auth-links -->
  
      
  
    </div>
    <!-- /.login-box-body -->
  </div>
@endsection