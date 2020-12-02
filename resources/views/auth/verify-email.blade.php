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
            <h1 class="login-title">You Must verify your Email, Please check your email for a verification link</h1>
            @if(session('status'))
            <div class="alert alert-success" role='alert'>
                {{session('status')}}
            </div>
            @endif
            <form action="{{route('verification.send')}}" method="POST">
              @csrf 
              
          
              <button type="submit" class="btn btn-block login-btn">Resend Email</button>
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