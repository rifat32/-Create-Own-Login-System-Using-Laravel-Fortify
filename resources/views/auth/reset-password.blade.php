@extends('templet')
@section('content')
<main>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6 login-section-wrapper">
          <div class="brand-wrapper">
            <img src="/assets/images/logo.svg" alt="logo" class="logo">
          </div>
          <div class="login-wrapper my-auto">
            <h1 class="login-title">Reset Password</h1>
            <form action="{{route('password.update')}}" method="POST">
                @csrf 
            <input name='token' type="hidden" value='{{$request->route("token")}}'>
              <div class="form-group">
                <label for="email">Email</label>
                <input  type="email" name="email" id="email" class="form-control" value='{{$request->email}}'>
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
Update
              </button>
              
            </form>
           
           
          </div>
        </div>
        <div class="col-sm-6 px-0 d-none d-sm-block">
          <img src="/assets/images/login.jpg" alt="login image" class="login-img">
        </div>
      </div>
    </div>
  </main>
 
@endsection