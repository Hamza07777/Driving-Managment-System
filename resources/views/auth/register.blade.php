@extends('layouts.app')
@section('content')
<div class="container-fluid">
   <div class="row justify-content-center">
      <div class="col-md-6 m-0 p-0">
         <div class="card">
            <div class="card-header">{{ __('trans.Register')}}</div>
            <div class="card-body">
               <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group row">
                     <label for="firstname" class="col-md-4 col-form-label text-md-right">{{ __('trans.First_Name')}}</label>
                     <div class="col-md-6">
                        <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" required autocomplete="firstname" autofocus>
                        @error('firstname')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('trans.Last_Name')}}</label>
                     <div class="col-md-6">
                        <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" >
                        @error('lastname')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('trans.Email')}}</label>
                     <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
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
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('trans.Confirm_Password')}}</label>
                     <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="phone_number" class="col-md-4 col-form-label text-md-right">{{ __('trans.Phone_Number')}}</label>
                     <div class="col-md-6">
                        <input id="phone_number" type="text" class="form-control" name="phone_number" value="{{ old('phone_number') }}" required autocomplete="phone_number">
                        @error('phone_number')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('trans.Address')}}</label>
                     <div class="col-md-6">
                        <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}" required autocomplete="address">
                        @error('address')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('trans.City')}}</label>
                     <div class="col-md-6">
                        <input id="city" type="text" class="form-control" name="city" value="{{ old('city') }}" required autocomplete="city">
                        @error('city')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="province" class="col-md-4 col-form-label text-md-right">{{ __('trans.Province')}}</label>
                     <div class="col-md-6">
                        <input id="province" type="text" class="form-control" name="province" value="{{ old('province') }}" required autocomplete="province">
                        @error('province')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="postal_code" class="col-md-4 col-form-label text-md-right">{{ __('trans.Postal_Code')}}</label>
                     <div class="col-md-6">
                        <input id="postal_code" type="text" class="form-control" name="postal_code" value="{{ old('postal_code') }}" required autocomplete="postal_code">
                        @error('postal_code')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('trans.Gender')}}</label>
                     <div class="col-md-6">
                        <select class="form-control" id="gender" name="gender" required autocomplete="gender">
                           <option value="male">{{ __('trans.Male')}}</option>
                           <option value="female">{{ __('trans.Female')}}</option>
                        </select>
                        @error('gender')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row mb-0">
                     <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary" style="width: 100%">
                        {{ __('trans.Register')}}
                        </button>
                        @if (Route::has('login'))
                        <a class="nav-link" href="{{ route('login') }}"> Already have an account? {{ __('trans.Login') }}</a>
                        @endif
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
      <div class="col-md-6 m-0 p-0">
         <img class="img-fluid" src="{{ asset('/public/images/img2.jpg' )}}" alt="" >
      </div>
   </div>
</div>
@endsection
