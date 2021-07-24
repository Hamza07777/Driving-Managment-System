@extends('../layouts.admin_app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-8">
         <div class="card">
            <div class="card-header text-center">
               <h3><strong>{{ __('trans.Employee_Detail') }}</strong></h3>
            </div>
            <div class="card-body text-center">
               @if ($errors->any())
               <div class="alert alert-danger">
                  <ul>
                     @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
                     @endforeach
                  </ul>
               </div>
               @endif
               <form method="POST" action="{{ route('user_meta.store')  }}" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group row">
                     <label for="wage_per_hours" class="col-md-4 col-form-label text-md-right">{{ __('trans.There_wage_per_hour') }}</label>
                     <div class="col-md-6">
                        <input id="wage_per_hours" type="text" class="form-control @error('time_period') is-invalid @enderror" name="wage_per_hours" value="{{ old('wage_per_hours') }}" required autocomplete="wage_per_hours" >
                        @error('wage_per_hours')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="total_hours" class="col-md-4 col-form-label text-md-right">{{ __('trans.Total_hour(per_day_or_per_week_or_per_month_per_year)') }}</label>
                     <div class="col-md-6">
                        <input id="total_hours" type="text" class="form-control @error('total_hours') is-invalid @enderror" name="total_hours" value="{{ old('total_hours') }}" required autocomplete="total_hours" >
                        @error('total_hours')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="total_hours_student" class="col-md-4 col-form-label text-md-right">{{ __('trans.There_hour_s_with_student') }}</label>
                     <div class="col-md-6">
                        <input id="total_hours_student" type="text" class="form-control @error('total_hours_student') is-invalid @enderror" name="total_hours_student" value="{{ old('total_hours_student') }}" required autocomplete="total_hours_student" >
                        @error('total_hours_student')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="license_pic" class="col-md-4 col-form-label text-md-right">{{ __('trans.License_pic') }}</label>
                     <div class="col-md-6">
                        <input id="license_pic" class="p-0 form-control @error('license_pic') is-invalid @enderror" required name="license_pic" type="file" accept="image/jpeg, image/png, application/pdf" value="{{ old('license_pic') }}"  style=" border: none;background-color: #EBF0F5;padding-bottom: 10%;"/>
                        @error('license_pic')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="instructor_card" class="col-md-4 col-form-label text-md-right">{{ __('trans.Instructor_card') }}</label>
                     <div class="col-md-6">
                        <input id="instructor_card" class="p-0 form-control @error('instructor_card') is-invalid @enderror"  name="instructor_card" type="file" accept="image/jpeg, image/png, application/pdf" value="{{ old('instructor_card') }}" required style=" border: none;background-color: #EBF0F5;padding-bottom: 10%;"/>
                        @error('instructor_card')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="cv_letter" class="col-md-4 col-form-label text-md-right">{{ __('trans.Experience_letter_or_cv') }}</label>
                     <div class="col-md-6">
                        <input id="cv_letter" class="p-0 form-control @error('cv_letter') is-invalid @enderror"  name="cv_letter" type="file" accept="image/jpeg, image/png, application/pdf" value="{{ old('cv_letter') }}" required style=" border: none;background-color: #EBF0F5;padding-bottom: 10%;"/>
                        @error('cv_letter')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="piece_of_identity" class="col-md-4 col-form-label text-md-right">{{ __('trans.Piece_of_identity') }}</label>
                     <div class="col-md-6">
                        <input id="piece_of_identity" class="p-0 form-control @error('piece_of_identity') is-invalid @enderror" required name="piece_of_identity" type="file" accept="image/jpeg, image/png, application/pdf" value="{{ old('piece_of_identity') }}" required style=" border: none;background-color: #EBF0F5;padding-bottom: 10%;"/>
                        @error('piece_of_identity')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="medical_form" class="col-md-4 col-form-label text-md-right">{{ __('trans.Medical_form') }}</label>
                     <div class="col-md-6">
                        <input id="medical_form" class="p-0 form-control @error('medical_form') is-invalid @enderror" required name="medical_form" type="file" accept="image/jpeg, image/png, application/pdf" value="{{ old('medical_form') }}" required style=" border: none;background-color: #EBF0F5;padding-bottom: 10%;"/>
                        @error('medical_form')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row mb-0 ml-5">
                     <div class="col-md-6 offset-md-4" style=" margin-left: 15%;margin-top: 3%;">
                        <button type="submit" class="btn btn-primary">
                        {{ __('trans.Register') }}
                        </button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
