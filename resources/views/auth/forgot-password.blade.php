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
            <h1 class="login-title">Reset Password</h1>
            @if(session('status'))
            <div class="alert alert-success" role='alert'>
                {{session('status')}}
            </div>
            @endif
            <form action="{{route('password.request')}}" method="POST">
                @csrf 
            
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="email@example.com">
                @error('email') 
<div class="alert alert-danger" role="alert">
    {{$message}}
</div>
                @enderror
              </div>
         
              <button type="submit" class="btn btn-block login-btn">
Get Password
              </button>
              
            </form>
           
          
          </div>
        </div>
        <div class="col-sm-6 px-0 d-none d-sm-block">
          <img src="assets/images/login.jpg" alt="login image" class="login-img">
        </div>
      </div>
    </div>
  </main>
 
@endsection