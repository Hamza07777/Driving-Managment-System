@extends('../layouts.admin_app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-8">
         <div class="card">
            <div class="card-header text-center">
               <h3><strong>{{ __('Add Company Setting') }}</strong></h3>
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
               <form method="POST" action="{{ route('setting.store') }}" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group row">
                     <label for="Company_Name" class="col-md-4 col-form-label text-md-right">{{ __('Company Name') }}</label>
                     <div class="col-md-6">
                        <input id="Company_Name" type="text" class="form-control @error('Company_Name') is-invalid @enderror" name="Company_Name" value="{{ old('Company_Name') }}"   autocomplete="Company_Name" autofocus placeholder="Driving School Management System">
                        @error('Company_Name')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="Company_Email" class="col-md-4 col-form-label text-md-right">{{ __('Company Email') }}</label>
                     <div class="col-md-6">
                        <input id="Company_Email" type="email" class="form-control @error('Company_Email') is-invalid @enderror" name="Company_Email" value="{{ old('Company_Email') }}"   autocomplete="Company_Email">
                        @error('Company_Email')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="Company_Phone" class="col-md-4 col-form-label text-md-right">{{ __('Company Phone') }}</label>
                     <div class="col-md-6">
                        <input id="Company_Phone" type="text" class="form-control @error('Company_Phone') is-invalid @enderror" name="Company_Phone" value="{{ old('Company_Phone') }}"   autocomplete="Company_Phone" >
                        @error('Company_Phone')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="Company_Website" class="col-md-4 col-form-label text-md-right">{{ __('Company Website') }}</label>
                     <div class="col-md-6">
                        <input id="Company_Website" type="url" class="form-control @error('Company_Website') is-invalid @enderror" name="Company_Website" value="{{ old('Company_Website') }}"   autocomplete="Company_Website" >
                        @error('Company_Website')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="Company_Address" class="col-md-4 col-form-label text-md-right">{{ __('Company Address') }}</label>
                     <div class="col-md-6">
                        <input id="Company_Address" type="text" class="form-control @error('Company_Address') is-invalid @enderror" name="Company_Address" value="{{ old('Company_Address') }}"   autocomplete="Company_Address" >
                        @error('Company_Address')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="tax_ratio" class="col-md-4 col-form-label text-md-right">{{ __('Company Tax Ratio(Number)') }}</label>
                     <div class="col-md-6">
                        <input id="tax_ratio" type="number" class="form-control @error('tax_ratio') is-invalid @enderror" name="tax_ratio" value="{{ $setting->tax_ratio }}"   autocomplete="tax_ratio" >
                        @error('tax_ratio')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="Company_Address" class="col-md-4 col-form-label text-md-right">{{ __('Date Formats') }}</label>
                     <div class="col-md-6">
                        <select class="form-control" id="date_formate" name="date_formate">
                           <option value="m/d/Y"
                              > 02/21/2018</option>
                           <option value="m/d/y"
                              >02/21/18 </option>
                           <option value="d/m/Y"
                              >21/02/2018</option>
                           <option value="d/m/y"
                              >21/02/18</option>
                           <option value="d-m-Y"
                              >21-02-2018</option>
                           <option value="m-d-y"
                              >02-21-18</option>
                           <option value="Y-m-d"
                              >2018-02-21</option>
                           <option value="m/d/Y"
                              >2/21/2018</option>
                           <option value="m/d/yy"
                              >2/21/18</option>
                           <option value="d/m/Y"
                              >21/2/2018</option>
                           <option value="m-d-Y"
                              >2-21-2018</option>
                           <option value="Mth d, Y"
                              >Feb 21, 2018</option>
                           <option value="Month d, Y"
                              >February 21, 2018</option>
                        </select>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="Company_Address" class="col-md-4 col-form-label text-md-right">{{ __('Currency') }}</label>
                     <div class="col-md-6">
                        <select class="form-control" id="currency" name="currency">
                             @foreach( $currency as $currency )
                               <option value="{{$currency->currency_symbol }}"
                                  >{{$currency->currency_name}} </option>
                            @endforeach      
                            </select>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="logo" class="col-md-4 col-form-label text-md-right">{{ __('Logo') }}</label>
                     <div class="col-md-6">
                        <input id="logo" class="p-0 form-control @error('logo') is-invalid @enderror"   name="logo" type="file" accept="image/jpeg, image/png, application/pdf" value="{{ old('logo') }}"  style=" border: none;background-color: #EBF0F5;padding-bottom: 10%;"/>
                        <small style=" float: left;margin-top:1%">Size is 160 X 50</small>
                        @error('logo')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>
                    <div class="form-group row">
                     <label for="favi_icon" class="col-md-4 col-form-label text-md-right">{{ __('Favicon Image') }}</label>
                     <div class="col-md-6">
                        <input id="favi_icon" class="p-0 form-control @error('favi_icon') is-invalid @enderror"   name="favi_icon" type="file" accept="image/jpeg, image/png, application/pdf" value="{{ old('favi_icon') }}"  style=" border: none;background-color: #EBF0F5;padding-bottom: 10%;"/>
                        <small style=" float: left;margin-top:1%">Size is 64 X 64</small>
                        @error('logo')
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
