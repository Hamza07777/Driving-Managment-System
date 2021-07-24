@extends('../layouts.admin_app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-8">
         <div class="card">
            <div class="card-header text-center">
               <h3><strong>    {{ __('trans.Send_SMS') }}</strong></h3>
            </div>
            <div class="card-body text-center">
               <form method="POST" action="{{route('student_sms.store')  }}">
                  @csrf
                  <div class="form-group row">
                     <label for="text" class="col-md-4 col-form-label text-md-right">    {{ __('trans.Text') }}</label>
                     <div class="col-md-6">
                        <input id="text" type="text" class="form-control @error('text') is-invalid @enderror" name="text" value="{{ old('text') }}" required autocomplete="text" autofocus>
                        @error('text')
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
