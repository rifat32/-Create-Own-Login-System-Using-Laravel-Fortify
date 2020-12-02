@extends('templet')
@section('content')
<main>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6 login-section-wrapper">
          <div class="brand-wrapper">
            <img src="assets/images/logo.svg" alt="logo" class="logo">
          </div>
          <div class="login-wrapper my-auto">
            <h1 class="login-title">Register</h1>
            <form action="{{route('register')}}" method="POST">
                @csrf 
                <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name"  class="form-control" placeholder="Your Name">
                @error('name') 
<span class="alert alert-danger" role="alert">
    <strong>{{$message}}</strong>
    
</span>
                @enderror
              </div>

              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="email@example.com">
                @error('email') 
<div class="alert alert-danger" role="alert">
    {{$message}}
</div>
                @enderror
              </div>
              <div class="form-group mb-4">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="enter your passsword">
                @error('password') 
<div class="alert alert-danger" role="alert">
    {{$message}}
</div>
                @enderror
              </div>
              <div class="form-group mb-4">
                <label for="password-conferm">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password-conferm" class="form-control" placeholder="enter your passsword">
                @error('password') 
<div class="alert alert-danger" role="alert">
    {{$message}}
</div>
                @enderror
              </div>
              <button type="submit" class="btn btn-block login-btn">
Register
              </button>
              
            </form>
           
            <p class="login-wrapper-footer-text">Already  have an account? <a href="{{route('login')}}" class="text-reset">Login here</a></p>
          </div>
        </div>
        <div class="col-sm-6 px-0 d-none d-sm-block">
          <img src="assets/images/login.jpg" alt="login image" class="login-img">
        </div>
      </div>
    </div>
  </main>
 
@endsection