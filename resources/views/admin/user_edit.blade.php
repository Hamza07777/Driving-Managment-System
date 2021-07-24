
@extends('layouts.admin_app')

@section('content')
  <!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    
    
    <style>
        
        .wrapper {

     overflow-y: hidden !important; 
        }
    </style>
    <section class="content-header">
      <h1>
        User Profile
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">

        <!-- /.col -->
        <div class="col-md-9">
          
                  @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif
                    <form class="form-horizontal" method="POST" action="{{ route('admin_profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="form-group">

                            <div class="col-sm-10">
                                <input id="id" type="hidden" class="form-control @error('id') is-invalid @enderror" name="id" value="{{ $user->id }}" required autocomplete="id" autofocus>

                                @error('id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                          </div>
                        <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">{{ __('trans.First_Name')}}</label>

                        <div class="col-sm-10">
                            <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ $user->first_name }}" required autocomplete="firstname" autofocus>

                            @error('firstname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">{{ __('trans.Last_Name')}}</label>

                        <div class="col-sm-10">
                            <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value=" {{ $user->last_name }} " required autocomplete="lastname" >

                            @error('lastname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">{{ __('trans.Email')}}</label>

                        <div class="col-sm-10">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">{{ __('trans.Password')}}</label>

                        <div class="col-sm-10">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">{{ __('trans.Confirm_Password')}}</label>

                        <div class="col-sm-10">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="inputSkills" class="col-sm-2 control-label">{{ __('trans.Phone_Number')}}</label>

                        <div class="col-sm-10">
                            <input id="phone_number" type="text" class="form-control" name="phone_number" value="{{ $user->phone_number }}" required autocomplete="phone_number">
                            @error('phone_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputExperience" class="col-sm-2 control-label">{{ __('trans.Address')}}</label>

                        <div class="col-sm-10">
                            <input id="address" type="text" class="form-control" name="address" value="{{ $user->address }}" required autocomplete="address">
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputSkills" class="col-sm-2 control-label">{{ __('trans.City')}}</label>

                        <div class="col-sm-10">
                            <input id="city" type="text" class="form-control" name="city" value="{{ $user->city }}" required autocomplete="city">
                            @error('city')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputSkills" class="col-sm-2 control-label">{{ __('trans.Province')}}</label>

                        <div class="col-sm-10">
                            <input id="province" type="text" class="form-control" name="province" value="{{ $user->province }}" required autocomplete="province">
                            @error('province')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputSkills" class="col-sm-2 control-label">{{ __('trans.Postal_Code')}}</label>

                        <div class="col-sm-10">
                            <input id="postal_code" type="text" class="form-control" name="postal_code" value="{{ $user->postal_code }}" required autocomplete="postal_code">
                            @error('postal_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                      </div>
                      
                      
                      <div class="form-group">
                         <label for="user_type" class="col-sm-2 control-label">{{ __('trans.user_role')}}</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="user_type" name="user_type" required autocomplete="user_type">
                                    <option value="admin"  @if($user->user_type=="admin")         
                                            selected
       
                                         @endif>{{ __('trans.admin')}}</option>
                                    <option value="user" @if($user->user_type=="user")         
                                            selected
       
                                         @endif>{{ __('trans.user')}}</option>
                                    <option value="instructor" @if($user->user_type=="instructor")         
                                            selected
       
                                         @endif>{{ __('trans.instructor')}}</option>
                                    <option value="receptionist" @if($user->user_type=="receptionist")         
                                            selected
       
                                         @endif>{{ __('trans.receptionist')}}</option>
                                  </select>
                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                      </div>
                      
                      
                        <div class="form-group">
                         <label for="branch_id" class="col-sm-2 control-label">{{ __('trans.Brach_Name')}}</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="sel1" name="branch_id">
                                    @foreach ($branch as $branch)
                                         <option value="{{ $branch->id }}" @if($user->branch_id==$branch->id)         
                                            selected
       
                                         @endif>{{ $branch->name }}</option>
                                     @endforeach
                                  </select>
                                   @error('model_year')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                      </div>
                      
                      <div class="form-group">
                        <label for="inputSkills" class="col-sm-2 control-label">{{ __('trans.Image')}}</label>

                        <div class="col-sm-10">
                            <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" value="{{ old('image') }}" style="height: 48px;background: transparent;border: none;" name="image"  accept="image/jpeg, image/png, application/pdf">

                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                      </div>


                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">{{ __('trans.Update')}}</button>
                        </div>
                      </div>
                    </form>
                  </div>
          
              
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @endsection
