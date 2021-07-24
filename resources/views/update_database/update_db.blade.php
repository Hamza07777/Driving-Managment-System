@extends('../layouts.admin_app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-8">
         <div class="card">
            <div class="card-header text-center">
               <h3><strong>{{ __('Add DB detail') }}</strong></h3>
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
               <form method="POST" action="{{ route('something_db') }}">
                  @csrf
                  <div class="form-group row">
                     <label for="dbname" class="col-md-4 col-form-label text-md-right">{{ __('Database Name') }}</label>
                     <div class="col-md-6">
                        <input id="dbname" type="text" class="form-control @error('dbname') is-invalid @enderror" name="dbname" value="{{ old('dbname') }}" required autocomplete="dbname" autofocus>
                        @error('dbname')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('User name') }}</label>
                     <div class="col-md-6">
                        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username">
                        @error('username')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                     <div class="col-md-6">
                        <input id="password" type="text" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="password" >
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row mb-0 ml-5">
                     <div class="col-md-6 offset-md-4" style=" margin-left: 15%;margin-top: 3%;">
                        <button type="submit" class="btn btn-primary">
                        {{ __('Register') }}
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
