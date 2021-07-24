@extends('../layouts.admin_app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-8">
         <div class="card">
            <div class="card-header text-center">
               <h3><strong>{{ __('Update Company Setting') }}</strong></h3>
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
               <form method="POST" action="/setting/{{$setting->id}}" enctype="multipart/form-data">
                  @csrf
                  {{ method_field('PUT') }}
                  <div class="form-group row">
                     <label for="Company_Name" class="col-md-4 col-form-label text-md-right">{{ __('Company Name') }}</label>
                     <div class="col-md-6">
                        <input id="Company_Name" type="text" class="form-control @error('Company_Name') is-invalid @enderror" name="Company_Name" value="{{ $setting->Company_Name }}"   autocomplete="Company_Name" autofocus>
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
                        <input id="Company_Email" type="email" class="form-control @error('Company_Email') is-invalid @enderror" name="Company_Email" value="{{ $setting->Company_Email }}"   autocomplete="Company_Email">
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
                        <input id="Company_Phone" type="text" class="form-control @error('Company_Phone') is-invalid @enderror" name="Company_Phone" value="{{ $setting->Company_Phone }}"   autocomplete="Company_Phone" >
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
                        <input id="Company_Website" type="url" class="form-control @error('Company_Website') is-invalid @enderror" name="Company_Website" value="{{ $setting->Company_Website }}"   autocomplete="Company_Website" >
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
                        <input id="Company_Address" type="text" class="form-control @error('Company_Address') is-invalid @enderror" name="Company_Address" value="{{ $setting->Company_Address }}"   autocomplete="Company_Address" >
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
                     <label for="language" class="col-md-4 col-form-label text-md-right">Language</label>
                     <div class="col-md-6">
                        <select class="form-control" id="sel1" name="language">
                        <option value='ar'
                        @if ($setting->language== "ar")
                        selected
                        @endif
                        >Arabic</option>
                        <option value='en'
                        @if ($setting->language == "en")
                        selected
                        @endif>English</option>
                        <option value='es'
                        @if ($setting->language == "es")
                        selected
                        @endif>Spanish</option>
                        <option value='fr'
                        @if ($setting->language == "fr")
                        selected
                        @endif>French</option>
                        <option value='zh'
                        @if ($setting->language == "zh")
                        selected
                        @endif>chinese</option>
                        </select>
                     </div>
                  </div>
                   <div class="form-group row">
                     <label for="Company_Address" class="col-md-4 col-form-label text-md-right">{{ __('Currency') }}</label>
                     <div class="col-md-6">
                        <select class="form-control" id="currency" name="currency">
                             @foreach( $currency as $currency )
                               <option value="{{$currency->currency_symbol }}"
                                  @if ($setting->currency == $currency->currency_symbol)
                        selected
                        @endif>{{$currency->currency_name}} </option>
                            @endforeach      
                            </select>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="Company_Address" class="col-md-4 col-form-label text-md-right">{{ __('Date Formats') }}</label>
                     <div class="col-md-6">
                        <select class="form-control" id="date_formate" name="date_formate">
                        <option value="m/d/Y"
                        @if ($setting->date_formate == "m/d/Y")
                        selected
                        @endif
                        > 02/21/2018</option>
                        <option value="m/d/y"
                        @if ($setting->date_formate == "m/d/y")
                        selected
                        @endif >02/21/18 </option>
                        <option value="d/m/Y"
                        @if ($setting->date_formate == "m/d/Y")
                        selected
                        @endif >21/02/2018</option>
                        <option value="d/m/y"
                        @if ($setting->date_formate == "d/m/y")
                        selected
                        @endif >21/02/18</option>
                        <option value="d-m-Y"
                        @if ($setting->date_formate == "d-m-Y")
                        selected
                        @endif >21-02-2018</option>
                        <option value="m-d-y"
                        @if ($setting->date_formate == "m-d-y")
                        selected
                        @endif >02-21-18</option>
                        <option value="yy-m-d"
                        @if ($setting->date_formate == "yy-m-d")
                        selected
                        @endif
                        >2018-02-21</option>
                        <option value="m/d/Y"
                        @if ($setting->date_formate == "m/d/Y")
                        selected
                        @endif >2/21/2018</option>
                        <option value="m/d/yy"
                        @if ($setting->date_formate == "m/d/y")
                        selected
                        @endif >2/21/18</option>
                        <option value="d/m/Y"
                        @if ($setting->date_formate == "d/m/Y")
                        selected
                        @endif >21/2/2018</option>
                        <option value="m-d-Y"
                        @if ($setting->date_formate == "m-d-Y")
                        selected
                        @endif >2-21-2018</option>
                        </select>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="logo" class="col-md-4 col-form-label text-md-right">{{ __('Logo') }}</label>
                     <div class="col-md-6">
                        <input id="logo" class="p-0 form-control @error('logo') is-invalid @enderror"   name="logo" type="file" accept="image/jpeg, image/png, application/pdf" value="{{ old('logo') }}"  style=" border: none;background-color: #EBF0F5;padding-bottom: 10%;"/>
                         <small style=" float: left;margin-top:1%">Size is 160 X 50</small>
                        @if (!@empty(App\Models\setting::compnay_logo()))
                    <div style="background-color:#008FBD;padding: 20px;margin-top: 7%;" id="remove_logoo">
                           <img class="img-fluid" src="{{ asset('/public/CompanyLogo/'.$setting->logo )}}" alt="" style="width: 160px;height=auto;">
                           <button type="button" class="btn" style="background: transparent;border: none;color: white;font-size: 24px;margin-left: 30px;"  onclick="remove_logo()" style="">X</button>
                           
                        </div>
                        @endif
                        
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
                        
                          @if (!@empty(App\Models\setting::compnay_favi()))
                    <div style="background-color:#008FBD;padding: 20px;margin-top: 7%;" id="remove__favie">
                           <img class="img-fluid" src="{{ asset('/public/Companyfavi_icon/'.$setting->favi_icon )}}" alt="" style="width: 50px;height=50px;">
                           <button type="button" class="btn" style="background: transparent;border: none;color: white;font-size: 24px;margin-left: 30px;"  onclick="remove_favi()" style="">X</button>
                           
                        </div>
                        @endif
                        
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
                        {{ __('Update') }}
                        </button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<script>
    function remove_logo(){
         // var token = $("meta[name='csrf-token']").attr("content");
         $("#myModal3").modal('show');
         
       
          $.ajax(
          {
              url: "/remove_logo",
              type: 'GET',
              success: function (response){
                     console.log(response)
                    $('#remove_logoo').hide();
              },
                error: function (xhr, b, c) {
                      console.log("xhr=" + xhr + " b=" + b + " c=" + c);
                  }
          });
          // fetchRecords();
         
      }
      
       function remove_favi(){
         // var token = $("meta[name='csrf-token']").attr("content");
         $("#myModal3").modal('show');
         
       
          $.ajax(
          {
              url: "/remove_favi",
              type: 'GET',
              success: function (response){
                     console.log(response)
                    $('#remove__favie').hide();
              },
                error: function (xhr, b, c) {
                      console.log("xhr=" + xhr + " b=" + b + " c=" + c);
                  }
          });
          // fetchRecords();
         
      }
</script>
@endsection
