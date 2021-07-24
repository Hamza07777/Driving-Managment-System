@extends('../layouts.admin_app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-8">
         <div class="card">
            <div class="card-header text-center">
               <h3><strong>{{ __('trans.Update_Note') }}</strong></h3>
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
               <form method="POST" action="/note/{{$note->id}}" enctype="multipart/form-data">
                  @csrf
                  {{ method_field('PUT') }}
                  <div class="form-group row">
                     <label for="note" class="col-md-4 col-form-label text-md-right">{{ __('trans.Notes') }}</label>
                     <div class="col-md-6">
                        <input id="note" type="text" class="form-control @error('note') is-invalid @enderror" name="note" value="{{ $note->note }}" required autocomplete="note" autofocus>
                        @error('note')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row mb-0">
                     <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                        {{ __('trans.Update') }}  
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
