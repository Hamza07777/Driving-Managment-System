@extends('../layouts.install_app')

@section('content')

<?php
$error = false;
if (!is_writable('../uploads/estimates')){
    $error = true;
    $requirement_estimates = "<span class='label label-danger'>No (Make uploads/estimates writable) - Permissions 0755</span>";
} else {
    $requirement_estimates = "<span class='label label-success'>Ok</span>";
}
if (!is_writable('../uploads/proposals')){
    $error = true;
    $requirement_proposals = "<span class='label label-danger'>No (Make uploads/proposals writable) - Permissions 0755</span>";
} else {
    $requirement_proposals = "<span class='label label-success'>Ok</span>";
}
if (!is_writable('../uploads/ticket_attachments')){
    $error = true;
    $requirement1 = "<span class='label label-danger'>No (Make uploads/ticket_attachments writable) - Permissions 0755</span>";
} else {
    $requirement1 = "<span class='label label-success'>Ok</span>";
}
if (!is_writable('../uploads/tasks')){
    $error = true;
    $requirement2 = "<span class='label label-danger'>No (Make uploads/tasks writable) - Permissions 0755</span>";
} else {
    $requirement2 = "<span class='label label-success'>Ok</span>";
}
if (!is_writable('../uploads/staff_profile_images')){
    $error = true;
    $requirement3 = "<span class='label label-danger'>No (Make uploads/staff_profile_images writable) - Permissions 0755</span>";
} else {
    $requirement3 = "<span class='label label-success'>Ok</span>";
}
if (!is_writable('../uploads/projects')){
    $error = true;
    $requirement4 = "<span class='label label-danger'>No (Make uploads/projects writable) - Permissions 0755</span>";
} else {
    $requirement4 = "<span class='label label-success'>Ok</span>";
}
if (!is_writable('../uploads/newsfeed')){
    $error = true;
    $requirement5 = "<span class='label label-danger'>No (Make uploads/newsfeed writable) - Permissions 0755</span>";
} else {
    $requirement5 = "<span class='label label-success'>Ok</span>";
}
if (!is_writable('../uploads/leads')){
    $error = true;
    $requirement6 = "<span class='label label-danger'>No (Make uploads/leads writable) - Permissions 0755</span>";
} else {
    $requirement6 = "<span class='label label-success'>Ok</span>";
}
if (!is_writable('../uploads/invoices')){
    $error = true;
    $requirement7 = "<span class='label label-danger'>No (Make uploads/invoices writable) - Permissions 0755</span>";
} else {
    $requirement7 = "<span class='label label-success'>Ok</span>";
}
if (!is_writable('../uploads/expenses')){
    $error = true;
    $requirement8 = "<span class='label label-danger'>No (Make uploads/expenses writable) - Permissions 0755</span>";
} else {
    $requirement8 = "<span class='label label-success'>Ok</span>";
}
if (!is_writable('../uploads/discussions')){
    $error = true;
    $requirement9 = "<span class='label label-danger'>No (Make uploads/discussions writable) - Permissions 0755</span>";
} else {
    $requirement9 = "<span class='label label-success'>Ok</span>";
}
if (!is_writable('../uploads/contracts')){
    $error = true;
    $requirement10 = "<span class='label label-danger'>No (Make uploads/contracts writable) - Permissions 0755</span>";
} else {
    $requirement10 = "<span class='label label-success'>Ok</span>";
}
if (!is_writable('../uploads/company')){
    $error = true;
    $requirement11 = "<span class='label label-danger'>No (Make uploads/company writable) - Permissions 0755</span>";
} else {
    $requirement11 = "<span class='label label-success'>Ok</span>";
}
if (!is_writable('../uploads/clients')){
    $error = true;
    $requirement12 = "<span class='label label-danger'>No (Make uploads/clients writable) - Permissions 0755</span>";
} else {
    $requirement12 = "<span class='label label-success'>Ok</span>";
}
if (!is_writable('../uploads/client_profile_images')){
    $error = true;
    $requirement13 = "<span class='label label-danger'>No (Make uploads/client_profile_images writable) - Permissions 0755</span>";
} else {
    $requirement13 = "<span class='label label-success'>Ok</span>";
}
if (!is_writable('../application/config')){
    $error = true;
    $requirement14 = "<span class='label label-danger'>No (Make application/config/ writable - Permissions 0755</span>";
} else {
    $requirement14 = "<span class='label label-success'>Ok</span>";
}
if (!is_writable('../application/config/config.php')){
    $error = true;
    $requirement15 = "<span class='label label-danger'>No (Make application/config/config.php writable) - Permissions 0644</span>";
} else {
    $requirement15 = "<span class='label label-success'>Ok</span>";
}
if (!is_writable('../application/config/app-config-sample.php')){
    $error = true;
    $requirement16 = "<span class='label label-danger'>No (Make application/config/app-config-sample.php writable) - Permissions - 0644</span>";
} else {
    $requirement16 = "<span class='label label-success'>Ok</span>";
}
if (!is_writable('../temp')){
    $error = true;
    $requirement17 = "<span class='label label-danger'>No (Make temp folder writable) - Permissions 0755</span>";
} else {
    $requirement17 = "<span class='label label-success'>Ok</span>";
}

?>

<!-- MultiStep Form -->
<div class="container-fluid" id="grad1">
    <div class="row justify-content-center mt-0">
        <div class="col-11 col-sm-9 col-md-7 col-lg-6 text-center p-0 mt-3 mb-2">
            <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                <h2><strong>Install DMS</strong></h2>
                <p>Fill all form field to go to next step</p>
                <div class="row">
                    <div class="col-md-12 mx-0">
                        <form id="msform" method="POST" action="{{ route('permission')}}">
                            @csrf
                            <!-- progressbar -->
                            <ul id="progressbar">

                                <li class="active" id="personal"><strong>System Requirements</strong></li>
                                <li  id="account"><strong>Database</strong></li>
                                <li id="payment"><strong>Admin login</strong></li>
                                <li id="confirm"><strong>License</strong></li>
                            </ul> <!-- fieldsets -->

                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title">System Requirements</h2><table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th><b>File/Folder</b></th>
                                                <th><b>Result</b></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>uploads/proposals</td>
                                                <td><?php echo $requirement_proposals; ?></td>
                                            </tr>
                                            <tr>
                                                <td>uploads/estimates</td>
                                                <td><?php echo $requirement_estimates; ?></td>
                                            </tr>
                                            <tr>
                                                <td>uploads/ticket_attachments</td>
                                                <td><?php echo $requirement1; ?></td>
                                            </tr>
                                            <tr>
                                                <td>uploads/tasks</td>
                                                <td><?php echo $requirement2; ?></td>
                                            </tr>
                                            <tr>
                                                <td>uploads/staff_profile_images</td>
                                                <td><?php echo $requirement3; ?></td>
                                            </tr>
                                            <tr>
                                                <td>uploads/projects</td>
                                                <td><?php echo $requirement4; ?></td>
                                            </tr>
                                            <tr>
                                                <td>uploads/newsfeed</td>
                                                <td><?php echo $requirement5; ?></td>
                                            </tr>
                                            <tr>
                                                <td>uploads/leads</td>
                                                <td><?php echo $requirement6; ?></td>
                                            </tr>
                                            <tr>
                                                <td>uploads/invoices</td>
                                                <td><?php echo $requirement7; ?></td>
                                            </tr>
                                            <tr>
                                                <td>uploads/expenses</td>
                                                <td><?php echo $requirement8; ?></td>
                                            </tr>
                                            <tr>
                                                <td>uploads/discussions</td>
                                                <td><?php echo $requirement9; ?></td>
                                            </tr>
                                            <tr>
                                                <td>uploads/contracts</td>
                                                <td><?php echo $requirement10; ?></td>
                                            </tr>
                                            <tr>
                                                <td>uploads/company</td>
                                                <td><?php echo $requirement11; ?></td>
                                            </tr>
                                            <tr>
                                                <td>uploads/clients</td>
                                                <td><?php echo $requirement12; ?></td>
                                            </tr>
                                            <tr>
                                                <td>uploads/client_profile_images</td>
                                                <td><?php echo $requirement13; ?></td>
                                            </tr>
                                            <tr>
                                                <td>application/config Writable</td>
                                                <td><?php echo $requirement14; ?></td>
                                            </tr>
                                            <tr>
                                                <td>config.php Writable</td>
                                                <td><?php echo $requirement15; ?></td>
                                            </tr>
                                            <tr>
                                                <td>app-config-sample.php Writable (Auto Updated & Renamed on Install)</td>
                                                <td><?php echo $requirement16; ?></td>
                                            </tr>
                                            <tr>
                                                <td>/temp folder Writable</td>
                                                <td><?php echo $requirement17; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div>

                                    </div>
                                    <?php if ($error == true){
                                        echo '<div class="text-center alert alert-danger">You need to fix the requirements in order to install DMS</div>';
                                    } else {
                                        echo '<div class="text-center">';
                                        echo '<form action="" method="post" accept-charset="utf-8">';
                                        echo '<input type="hidden" name="permissions_success" value="true">';
                                        echo '<div class="text-left">';
                                        echo '<button type="submit" class="btn btn-success">Setup Database</button>';
                                         echo '</div>';
                                        echo '</form>';
                                        echo '</div>';
                                    }
                                    ?>
                                </div>  <input type="button" name="next" class="next action-button" value="Setup Database" />
                            </fieldset>

                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title">Admin Information</h2>

                                        @csrf

                                        <div class="form-group row">
                                            <label for="firstname" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

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
                                            <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

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
                                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

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
                                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

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
                                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                            <div class="col-md-6">
                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                            </div>
                                        </div>

                                        <div class="form-group row mb-0">

                                        </div>

                                </div>
                                <input type="button" name="previous" class="previous action-button-previous" value="Previous" />    <input type="button" name="next" class="next action-button" value="install" />


                            </fieldset>
                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title">Database Information</h2> <input type="text" name="username" placeholder="User Name" /> <input type="password" name="pwd" placeholder="Password" /> <input type="password" name="cpwd" placeholder="Confirm Password" />
                                </div><input type="button" name="previous" class="previous action-button-previous" value="Previous" /> <input type="button" name="next" class="next action-button" value="Next Step" />
                            </fieldset>

                            <fieldset>
                                <div class="form-card">

                                        <h2 class="fs-title">License Information</h2>
                                        <input type="Text" id='license'  name="license" placeholder="License Key XXXXXXXXXXXXXX" />
                                        <button onclick="fetchRecords()" type='button' class='btn btn-primary'>
                                            {{ __('Register') }}
                                        </button>
                                </div>
                                  <div id='chk_boxes_jquery'>

                                       
                                </div>
                               
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
 function fetchRecords(){
var licensee=document.getElementById("license").value;

   $.ajax({
        type:'get',
        url:'http://jhamt.com/verification/shahbaz.php?license='+licensee,
        contentType:"application/json",
        dataType:'jsonp',
        data:{ 
            license:licensee,
               
            },
            
        crossDomain:true,
        // data:data,
  

    });
  $.getJSON("http://jhamt.com/verification/shahbaz.php?license="+licensee, function(json) {
       $('#chk_boxes_jquery').empty();
         $("#chk_boxes_jquery").append(json);
   });
}
  

  







      


</script>
@endsection
