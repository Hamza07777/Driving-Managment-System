@extends('layouts.app')
@section('content')
<style>
   .logobackground{
   height: 194px;
   background-color: #141E28;
   }
</style>
<div class="container-fluid" style="background-color: white">
   <div class="row justify-content-center">
      <div class="col-md-6 m-0 p-0">
         <div class="logobackground" style="padding: 0 15px;">
            <img class="img-fluid"  src="{{ asset('/public/images/logo1-white.png' )}}" alt="" >
         </div>
         <div class="card">
            <div class="card-header">{{ __('trans.Login')}}</div>
            <div class="card-body">
               <form method="POST" action="{{ route('login') }}">
                  @csrf
                  <div class="form-group row">
                     <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('trans.Email')}}</label>
                     <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('trans.Password')}}</label>
                     <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     <div class="col-md-6 offset-md-4">
                        <div class="form-check float-left" >
                           <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                           <label class="form-check-label" for="remember">
                           {{ __('trans.Remember_Me')}}
                           </label>
                        </div>
                        @if (Route::has('password.request'))
                        <a class="btn btn-link float-right" href="{{ route('password.request') }}" style="margin-top: -7px">
                        {{ __('trans.Forgot_Your_Password?')}}
                        </a>
                        @endif
                     </div>
                  </div>
                  <div class="form-group row mb-0">
                     <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary " style="width: 100%">
                        {{ __('trans.Login')}}
                        </button>
                        @if (Route::has('register'))
                        <a class="nav-link" href="{{ route('register') }}"> Don't have an account? {{ __('trans.Register') }}</a>
                        @endif
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
      <div class="col-md-6 m-0 p-0">
         <img class="img-fluid" src="{{ asset('/public/images/img1-1.jpg' )}}" alt="" style="height: 512px;">
      </div>
   </div>
</div>
@endsection
