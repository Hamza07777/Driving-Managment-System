@extends('layouts.admin_app')
@section('content')
<section class="content-header">
   <h1>
      User Profile
   </h1>
</section>
<section class="content">
   <div class="row">
      <div class="col-md-3">
         <div class="box box-primary">
            <div class="box-body box-profile">
               <?php $image= Auth::user()->image;?>
               @if($image ==Null)
               <img src="{{ asset('/public/userImages/avatar-5.jpg') }}"
                  class="profile-user-img img-responsive img-circle" alt="User Image">
               @else
               <img class="profile-user-img img-responsive img-circle"
                  src="{{ asset('/public/userImages/'.$user->image ) }}"
                  alt="User profile picture">
               @endif
               <h3 class="profile-username text-center">{{ $user->first_name }}</h3>
               <p class="text-muted text-center">{{ $user->user_type }}</p>
               <ul class="list-group list-group-unbordered">
               </ul>
            </div>
         </div>
         <div class="box box-primary">
            <div class="box-body">
               <strong><i class="fa fa-map-marker margin-r-5"></i>{{ __('trans.Location') }} </strong>
               <p class="text-muted">{{ $user->province }},{{ $user->city }},{{ $user->address }}</p>
            </div>
         </div>
      </div>
      <div class="col-md-9">
         <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
               <li class="active"><a href="#settings" data-toggle="tab">{{ __('trans.Settings') }}</a></li>
            </ul>
            <div class="tab-content">
               <div class=" active tab-pane" id="settings">
                  @if($errors->any())
                  <div class="alert alert-danger">
                     <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                     </ul>
                  </div>
                  @endif
                  <form class="form-horizontal" method="POST" action="{{ route('admin_profile.update') }}"
                     enctype="multipart/form-data">
                     @csrf
                     {{ method_field('PUT') }}
                     <div class="form-group">
                        <div class="col-sm-10">
                           <input id="id" type="hidden" class="form-control @error('id') is-invalid @enderror" name="id"
                              value="{{ $user->id }}" required autocomplete="id" autofocus>
                           @error('id')
                           <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                           </span>
                           @enderror
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="inputName"
                           class="col-sm-2 control-label">{{ __('trans.First_Name') }}</label>
                        <div class="col-sm-10">
                           <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror"
                              name="firstname" value="{{ $user->first_name }}" required autocomplete="firstname" autofocus>
                           @error('firstname')
                           <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                           </span>
                           @enderror
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="inputName"
                           class="col-sm-2 control-label">{{ __('trans.Last_Name') }}</label>
                        <div class="col-sm-10">
                           <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror"
                              name="lastname" value=" {{ $user->last_name }} " required autocomplete="lastname">
                           @error('lastname')
                           <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                           </span>
                           @enderror
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">{{ __('trans.Email') }}</label>
                        <div class="col-sm-10">
                           <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                              value="{{ $user->email }}" required autocomplete="email">
                           @error('email')
                           <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                           </span>
                           @enderror
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="inputName"
                           class="col-sm-2 control-label">{{ __('trans.Password') }}</label>
                        <div class="col-sm-10">
                           <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                              name="password" autocomplete="new-password">
                           @error('password')
                           <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                           </span>
                           @enderror
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="inputName"
                           class="col-sm-2 control-label">{{ __('trans.Confirm_Password') }}</label>
                        <div class="col-sm-10">
                           <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                              autocomplete="new-password">
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="inputSkills"
                           class="col-sm-2 control-label">{{ __('trans.Phone_Number') }}</label>
                        <div class="col-sm-10">
                           <input id="phone_number" type="text" class="form-control" name="phone_number"
                              value="{{ $user->phone_number }}" required autocomplete="phone_number">
                           @error('phone_number')
                           <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                           </span>
                           @enderror
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="inputExperience"
                           class="col-sm-2 control-label">{{ __('trans.Address') }}</label>
                        <div class="col-sm-10">
                           <input id="address" type="text" class="form-control" name="address" value="{{ $user->address }}"
                              required autocomplete="address">
                           @error('address')
                           <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                           </span>
                           @enderror
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="inputSkills" class="col-sm-2 control-label">{{ __('trans.City') }}</label>
                        <div class="col-sm-10">
                           <input id="city" type="text" class="form-control" name="city" value="{{ $user->city }}" required
                              autocomplete="city">
                           @error('city')
                           <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                           </span>
                           @enderror
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="inputSkills"
                           class="col-sm-2 control-label">{{ __('trans.Province') }}</label>
                        <div class="col-sm-10">
                           <input id="province" type="text" class="form-control" name="province" value="{{ $user->province }}"
                              required autocomplete="province">
                           @error('province')
                           <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                           </span>
                           @enderror
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="inputSkills"
                           class="col-sm-2 control-label">{{ __('trans.Postal_Code') }}</label>
                        <div class="col-sm-10">
                           <input id="postal_code" type="text" class="form-control" name="postal_code"
                              value="{{ $user->postal_code }}" required autocomplete="postal_code">
                           @error('postal_code')
                           <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                           </span>
                           @enderror
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="inputSkills"
                           class="col-sm-2 control-label">{{ __('trans.Image') }}</label>
                        <div class="col-sm-10">
                           <input id="image" type="file" class="form-control @error('image') is-invalid @enderror"
                              value="{{ old('image') }}" name="image"
                              accept="image/jpeg, image/png, application/pdf" style="border: none;padding: 0px;">
                           @error('image')
                           <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                           </span>
                           @enderror
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                           <button type="submit" class="btn btn-danger">{{ __('trans.Update') }}</button>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
</div>
@endsection
