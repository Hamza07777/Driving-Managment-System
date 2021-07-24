@extends('../layouts.admin_app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-8">
         <div class="card">
            <div class="card-header text-center">
               <h3><strong>{{ __('trans.Add_Attendence_Status')}}</strong></h3>
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
               <form method="POST" action="{{ route('attendence_status.store')  }}" >
                  @csrf
                  <div class="form-group row">
                     <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('trans.Status_Name')}}</label>
                     <div class="col-md-6">
                        <input id="status" type="text" class="form-control @error('status') is-invalid @enderror" name="status" value="{{ old('status') }}" required autocomplete="status" autofocus>
                        @error('status')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row mb-0 ml-5">
                     <div class="col-md-6 offset-md-4" style=" margin-left: 15%;margin-top: 3%;">
                        <button type="submit" class="btn btn-primary">
                        {{ __('trans.Register')}}
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
