<!DOCTYPE html>
<html 
@if (!@empty(App\Models\setting::compnay_lang()))
@if (App\Models\setting::compnay_lang()== "ar")
dir="rtl"
lang="ar"
@elseif (App\Models\setting::compnay_lang()=="zh")
dir="ltr"
lang="zh"
@elseif (App\Models\setting::compnay_lang()=="es")
dir="ltr"
lang="es"
@elseif (App\Models\setting::compnay_lang()=="fr")
dir="ltr"
lang="fr"
@else
dir="ltr"
lang="en"
@endif
@else
dir="ltr"
lang="en"
@endif
>
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <!-- CSRF Token -->
   <meta name="csrf-token" content="{{ csrf_token() }}">
       @if (!@empty(App\Models\setting::compnay_name()))
           <title>{{ App\Models\setting::compnay_name() }}</title>
        @else
            <title>DSMS</title>
        @endif
  
   
      @if (!@empty(App\Models\setting::compnay_favi()))
          <link rel="icon" href="{{ asset('/public/Companyfavi_icon/'.App\Models\setting::compnay_favi()) }}" type="image/gif" sizes="16x16">
            @else
          <link rel="icon" href="{{ asset('/public/images/fvc-50x50.png') }}" type="image/gif" sizes="16x16">
            @endif
   
  
   <!-- Tell the browser to be responsive to screen width -->
   <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   <link rel="stylesheet" href="{{ asset('/public/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
   <!-- Font Awesome -->
   <link rel="stylesheet" href="{{ asset('/public/bower_components/font-awesome/css/font-awesome.min.css') }}">
   <!-- Ionicons -->
   <link rel="stylesheet" href="{{ asset('/public/bower_components/Ionicons/css/ionicons.min.css') }}">
   <link rel="stylesheet" href="{{ asset('/public/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
   <!-- daterange picker -->
   <link rel="stylesheet" href="{{ asset('/public/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
   <link rel="stylesheet" href="{{ asset('/public/plugins/timepicker/bootstrap-timepicker.min.css') }}">
   <!-- bootstrap datepicker -->
   <link rel="stylesheet" href="{{ asset('/public/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
   <link rel="stylesheet" href="{{ asset('/public/bower_components/fullcalendar/dist/fullcalendar.min.css') }}">
   <link rel="stylesheet" href="{{ asset('/public/bower_components/fullcalendar/dist/fullcalendar.print.min.css') }}" media="print">
   <!-- Theme style -->
   <link rel="stylesheet" href="{{ asset('/public/dist/css/AdminLTE.min.css') }}">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
   <!-- jvectormap -->
   <link rel="stylesheet" href="{{ asset('/public/bower_components/jvectormap/jquery-jvectormap.css') }}">
   <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
      page. However, you can choose any other skin. Make sure you
      apply the skin class to the body tag so the changes take effect. -->
   <link rel="stylesheet" href="{{ asset('/public/dist/css/skins/_all-skins.min.css') }}">
   <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">
   <script src="{{ asset('/public/bower_components/jquery/dist/jquery.min.js') }}"></script>
   <script src="{{ asset('/public/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
   <script src="{{ asset('/public/bower_components/moment/min/moment.min.js') }}"></script>
   <link rel="stylesheet" type="text/css" href="{{ asset('/public/css/datatables.css') }}">
   <script src="{{ asset('/public/bower_components/fullcalendar/dist/fullcalendar.min.js') }}"></script>
   <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
   <!-- WARNING: Respond.js doesnt work if you view the page via file:// -->
   <!--[if lt IE 9]>
   <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
   <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
   <![endif]-->
   <style>
      ::-webkit-file-upload-button {
      background: #FF4B2B;
      color: white;
      padding: 8px 25px;
      font-size: 10px;
      border-radius: 20px;
      box-shadow: 0 4px 6px rgba(50, 50, 93, 0.11), 0 1px 3px rgba(0, 0, 0, 0.08);
      border-color: #FF4B2B;
      transition: all 0.15s ease;
      letter-spacing: 1px;
      box-sizing: border-box;
      outline: none;
      cursor: pointer;
      line-height: 1.5;
      display: inline-block;
      font-weight: bold;
      text-align: center;
      white-space: nowrap;
      vertical-align: middle;
      user-select: none;
      border: 1px solid transparent;
      }
      /*******************************
      * MODAL AS LEFT/RIGHT SIDEBAR
      * Add "left" or "right" in modal parent div, after class="modal".
      * Get free snippets on bootpen.com
      *******************************/
      .modal.right .modal-dialog {
      position: fixed;
      margin: auto;
      /*width: 500px;*/
      height: 100%;
      -webkit-transform: translate3d(0%, 0, 0);
      -ms-transform: translate3d(0%, 0, 0);
      -o-transform: translate3d(0%, 0, 0);
      transform: translate3d(0%, 0, 0);
      }
      .modal.right .modal-content {
      height: 100%;
      overflow-y: auto;
      }
      .modal.right .modal-body {
      padding: 15px 15px 15px;
      }
      /*Right*/
      .modal.right.fade .modal-dialog {
      right: -320px;
      -webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
      -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
      -o-transition: opacity 0.3s linear, right 0.3s ease-out;
      transition: opacity 0.3s linear, right 0.3s ease-out;
      }
      .modal.right.fade.in .modal-dialog {
      right: 0;
      }
      /* ----- MODAL STYLE ----- */
      .modal-content {
      border-radius: 0;
      border: none;
      }
      .modal-header {
      border-bottom-color: #EEEEEE;
      background-color: #FAFAFA;
      }
      .invalid-feedback{
      color:red;
      }
      .switch {
      position: relative;
      display: inline-block;
      width: 60px;
      height: 34px;
      }
      .switch input { 
      opacity: 0;
      width: 0;
      height: 0;
      }
      .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      -webkit-transition: .4s;
      transition: .4s;
      }
      .slider:before {
      position: absolute;
      content: "";
      height: 26px;
      width: 26px;
      left: 4px;
      bottom: 4px;
      background-color: white;
      -webkit-transition: .4s;
      transition: .4s;
      }
      input:checked + .slider {
      background-color: #2196F3;
      }
      input:focus + .slider {
      box-shadow: 0 0 1px #2196F3;
      }
      input:checked + .slider:before {
      -webkit-transform: translateX(26px);
      -ms-transform: translateX(26px);
      transform: translateX(26px);
      }
      /* Rounded sliders */
      .slider.round {
      border-radius: 34px;
      }
      .slider.round:before {
      border-radius: 50%;
      }
      .dataTables_filter input { 
      border: 1px solid #eee;
      border-radius: 5px;
      height: 32px;
      margin-right: 9px;
      }
      #advance-1_length{
      margin-left: 9px;
      }
      #advance-1_length select{
      border: 1px solid #eee;
      border-radius: 5px;
      height: 29px;
      }
      #advance-1_info{
      margin-left: 12px;
      }
      #advance-1_paginate{
      margin-right: 32px;
      margin-bottom: 15px;
      }
      .sorting_asc{
      height: 40px;
      }
      .form-control{
      height:42px !important;
      border-radius:10px;
      }
      .button_slide {
      color: #FFF;
      /*border: 2px solid #00894F;*/
      border-radius: 0px;
      /*padding: 18px 36px;*/
      display: inline-block;
      /*font-family: "Lucida Console", Monaco, monospace;*/
      font-size: 14px;
      letter-spacing: 1px;
      cursor: pointer;
      box-shadow: inset 0 0 0 0 #D80286;
      -webkit-transition: ease-out 0.4s;
      -moz-transition: ease-out 0.4s;
      transition: ease-out 0.4s;
      }
      .slide_right:hover {
      box-shadow: inset 400px 0 0 0 #00894F;
      }
      button.close {
      background: #d73e4d;
      background: rgba(215, 62, 77, 0.75);
      border: 0 none !important;
      color: #fff7cc;
      display: inline-block;
      float: right;
      font-size: 34px;
      height: 40px;
      line-height: 1;
      margin: -9px 1px;
      opacity: 1;
      text-align: center;
      text-shadow: none;
      -webkit-transition: background 0.2s ease-in-out;
      transition: background 0.2s ease-in-out;
      vertical-align: top;
      width: 46px;
      }
      .fc-day-number{
          color:black;
          font-size: 25px;
          font-weight: 700;

      }
   </style>
   <!-- Google Font -->
   <link rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!--
   BODY TAG OPTIONS:
   =================
   Apply one or more of the following classes to get the
   desired effect
   |---------------------------------------------------------|
   | SKINS         | skin-blue                               |
   |               | skin-black                              |
   |               | skin-purple                             |
   |               | skin-yellow                             |
   |               | skin-red                                |
   |               | skin-green                              |
   |---------------------------------------------------------|
   |LAYOUT OPTIONS | fixed                                   |
   |               | layout-boxed                            |
   |               | layout-top-nav                          |
   |               | sidebar-collapse                        |
   |               | sidebar-mini                            |
   |---------------------------------------------------------|
   -->
<body class="hold-transition skin-blue  sidebar-mini">
   <div class="wrapper">
      <!-- Main Header -->
      <header class="main-header">
         <!-- Logo -->
         <a href="{{ url('/') }}" class="logo">
            @if (!@empty(App\Models\setting::compnay_logo()))
         
            <span class="logo-lg"><img class="img-fluid" src="{{ asset('/public/CompanyLogo/'.App\Models\setting::compnay_logo() )}}" alt="" style="width: 160px;height:51px;"></span>
            @else
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><img class="img-fluid" src="{{ asset('/public/images/logo1-white.png' )}}" alt="" style="width: 87%"></span>
            @endif
  
             @if (!@empty(App\Models\setting::compnay_favi()))
            <span class="logo-mini"><img class="img-fluid" src="{{ asset('/public/Companyfavi_icon/'.App\Models\setting::compnay_favi()) }}" alt="" style=" width: 50px;height: 50px;"></span>
            <!-- logo for regular state and mobile devices -->

            @else
            <span class="logo-mini"><img class="img-fluid" src="{{ asset('/public/images/fvc-50x50.png' )}}" alt=""></span>
            @endif
            <!-- mini logo for sidebar mini 50x50 pixels -->
         </a>
         <!-- Header Navbar -->
         <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
               <ul class="nav navbar-nav">
                  <!-- Messages: style can be found in dropdown.less-->
                  <li class="dropdown user user-menu">
                     <!-- Menu Toggle Button -->
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->
                        <?php $image= Auth::user()->image;?>
                        @if ($image ==Null)
                        <img src="{{ asset('/public/userImages/avatar-5.jpg')}}" class="user-image" alt="User Image">
                        @else
                        <img src="{{ asset('/public/userImages/'.Auth::user()->image )}}" class="user-image" alt="User Image">
                        @endif
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs">{{ Auth::user()->first_name }}</span>
                     </a>
                     <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                        <li class="user-header" style="height:103px !important">
                           <?php $image= Auth::user()->image;?>
                           @if ($image ==Null)
                           <img src="{{ asset('/public/userImages/avatar-5.jpg')}}" class="user-image" alt="User Image">
                           @else
                           <img src="{{ asset('/public/userImages/'.Auth::user()->image )}}" class="user-image" alt="User Image">
                           @endif
                           <p>
                              {{ Auth::user()->first_name }} - {{ Auth::user()->last_name }}
                              <small>Member since {{ date("Y-m-d", strtotime(Auth::user()->created_at))}} </small>
                           </p>
                        </li>
                        <!-- Menu Body -->
                        {{--  
                        <li class="user-body">
                           <div class="row">
                              <div class="col-xs-4 text-center">
                                 <a href="#">Followers</a>
                              </div>
                              <div class="col-xs-4 text-center">
                                 <a href="#">Sales</a>
                              </div>
                              <div class="col-xs-4 text-center">
                                 <a href="#">Friends</a>
                              </div>
                           </div>
                           <!-- /.row -->
                        </li>
                        --}}
                        <!-- Menu Footer-->
                        <li class="user-footer">
                           <div class="pull-left">
                              <a href=" {{ route('admin_profile') }} " class="btn btn-default btn-flat">{{ __('trans.Profile')}}</a>
                           </div>
                           <div class="pull-right">
                              <a href="{{ route('logout') }}"
                                 onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();" class="btn btn-default btn-flat">
                              {{ __('trans.Logout')}}</a>
                              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                 @csrf
                              </form>
                           </div>
                        </li>
                     </ul>
                  </li>
                  <!-- Control Sidebar Toggle Button -->
                  <li>
                     <a href="{{ route('setting.create') }}"><i class="fa fa-gears"></i></a>
                  </li>
               </ul>
            </div>
         </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
         <!-- sidebar: style can be found in sidebar.less -->
         <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
               <div class="pull-left image">
                  <?php $image= Auth::user()->image;?>
                  @if ($image ==Null)
                  <img src="{{ asset('/public/userImages/avatar-5.jpg')}}" class="user-image" alt="User Image">
                  @else
                  <img src="{{ asset('/public/userImages/'.Auth::user()->image )}}" class="user-image" alt="User Image">
                  @endif
               </div>
               <div class="pull-left info">
                  <p>{{ Auth::user()->first_name }}</p>
                  <a href="#"><i class="fa fa-circle text-success"></i> {{ Auth::user()->status }}</a>
               </div>
            </div>
            <!-- search form -->
            <!--<form action="#" method="get" class="sidebar-form">-->
            <!--  <div class="input-group">-->
            <!--    <input type="text" name="q" class="form-control" placeholder="Search...">-->
            <!--    <span class="input-group-btn">-->
            <!--          <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>-->
            <!--          </button>-->
            <!--        </span>-->
            <!--  </div>-->
            <!--</form>-->
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
               <!--<li class="header">{{ __('trans.MAIN_NAVIGATION')}}</li>-->
               <li class="{{ Request::is('/') ? 'active' : '' }}" >
                  <a href="{{ url('/') }}">
                  <i class="fa fa-dashboard"></i> <span>{{ __('trans.Dashboard')}}</span>
                  </a>
               </li>
               <li class="treeview {{ Route::is('branch.index') ? 'active' : '' }}">
                  <a href="#">
                  <i class="fa fa-building-o"></i>
                  <span>{{ __('trans.Branches')}}</span>
                  <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  </a>
                  <ul class="treeview-menu">
                     <li class="{{ Route::is('branch.index') ? 'active' : '' }}"><a href="{{ route('branch.index') }}"><i class="fa fa-circle-o"></i>{{ __('trans.All_Branches')}}</a></li>
                  </ul>
               </li>
               <li class="treeview {{ Route::is('note.index') ? 'active' : '' }}">
                  <a href="#">
                  <i class="fa fa-edit"></i> <span>{{ __('trans.Notes')}}</span>
                  <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  </a>
                  <ul class="treeview-menu">
                     <li class="{{ Route::is('note.index') ? 'active' : '' }}"><a href="{{ route('note.index') }}"><i class="fa fa-circle-o"></i>{{ __('trans.All_Notes')}}</a></li>
                  </ul>
               </li>
               <li>
               <li class="treeview {{ Route::is('admin_show_user') ? 'active' : '' }}">
                  <a href="#">
                  <i class="fa fa-user"></i> <span>{{ __('trans.Users')}}</span>
                  <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  </a>
                  <ul class="treeview-menu">
                     <li class="{{ Route::is('admin_show_user') ? 'active' : '' }}"><a href="{{ route('admin_show_user') }}"><i class="fa fa-circle-o"></i>{{ __('trans.All_users')}}</a></li>
                  </ul>
               </li>
               <li class="treeview {{ Route::is('vehical.index') ? 'active' : '' }}">
                  <a href="#">
                  <i class="fa fa-car"></i> <span>{{ __('trans.Vehicals')}}</span>
                  <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  </a>
                  <ul class="treeview-menu">
                     <li class="{{ Route::is('vehical.index') ? 'active' : '' }}"><a href="{{ route('vehical.index') }}"><i class="fa fa-circle-o"></i>{{ __('trans.All_Vehicals')}}</a></li>
                  </ul>
               </li>
               <li class="treeview {{ Route::is('roadschedule.index') ? 'active' : ''}}{{  Route::is('show_calender') ? 'active' : ''}}">
                  <a href="#">
                  <i class="fa fa-road"></i> <span>{{ __('trans.Road_Schedule')}} </span>
                  <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  </a>
                  <ul class="treeview-menu">
                     <li class="{{ Route::is('roadschedule.index') ? 'active' : ''}}"><a href="{{ route('roadschedule.index') }}"><i class="fa fa-circle-o"></i>{{ __('trans.All_Schedule')}}</a></li>
                     <li class="{{  Route::is('show_calender') ? 'active' : ''}}"><a href="{{ url('/show_calender') }}"><i class="fa fa-circle-o"></i>{{ __('trans.Calender')}}</a></li>
                  </ul>
               </li>
               <li class="treeview {{ Route::is('classes.index') ? 'active' : '' }} {{  Route::is('course.index') ? 'active' : ''}} {{  Route::is('student_course.index') ? 'active' : ''}}">
                  <a href="#">
                  <i class="fa fa-book"></i> <span>{{ __('trans.Classes')}}</span>
                  <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  </a>
                  <ul class="treeview-menu">
                     <li class="{{ Route::is('classes.index') ? 'active' : '' }}">
                        <a href="{{ route('classes.index') }}"><i class="fa fa-circle-o"></i>{{ __('trans.All_classes')}}  </a>
                     </li>
                     <li class="treeview {{  Route::is('course.index') ? 'active' : ''}}">
                        <a href="#">
                        <i class="fa fa-circle-o"></i>{{ __('trans.Courses')}}
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        </a>
                        <ul class="treeview-menu">
                           <li class="{{  Route::is('course.index') ? 'active' : ''}}"><a href="{{ route('course.index') }}"><i class="fa fa-circle-o"></i>{{ __('trans.All_Courses')}} </a></li>
                        </ul>
                     </li>
                     <li class="treeview {{  Route::is('student_course.index') ? 'active' : ''}}">
                        <a href="#">
                        <i class="fa fa-circle-o"></i>{{ __('trans.Student_Courses')}}
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        </a>
                        <ul class="treeview-menu">
                           <li class="{{  Route::is('student_course.index') ? 'active' : ''}}"><a href="{{ route('student_course.index') }}"><i class="fa fa-circle-o"></i>{{ __('trans.All_Student_Courses')}} </a></li>
                        </ul>
                     </li>
                  </ul>
               </li>
               <li class="treeview {{ Route::is('appoinment.index') ? 'active' : '' }} {{  Route::is('appoinment_calender') ? 'active' : ''}} {{  Route::is('student_appoinment.index') ? 'active' : ''}}">
                  <a href="#">
                  <i class="fa fa-calendar"></i> <span>{{ __('trans.Appoinments')}}   </span>
                  <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  </a>
                  <ul class="treeview-menu">
                     <li class="{{ Route::is('appoinment.index') ? 'active' : '' }}"><a href="{{ route('appoinment.index') }}"><i class="fa fa-circle-o"></i>{{ __('trans.All_Appoinment')}} </a></li>
                     <li class="{{  Route::is('appoinment_calender') ? 'active' : ''}}"><a href="{{ route('appoinment_calender') }}"><i class="fa fa-circle-o"></i>{{ __('trans.All_Appoinment_on_Calender')}} </a></li>
                     <li class="{{  Route::is('student_appoinment.index') ? 'active' : ''}}"><a href="{{ route('student_appoinment.index') }}"><i class="fa fa-circle-o"></i>{{ __('trans.Student_Appoinments')}} </a></li>
                  </ul>
               </li>
               <li class="treeview {{ Route::is('package.index') ? 'active' : '' }} {{ Route::is('student_package.index') ? 'active' : '' }}">
                  <a href="#">
                  <i class="fa fa-credit-card"></i> <span>{{ __('trans.Packages')}}   </span>
                  <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  </a>
                  <ul class="treeview-menu">
                     <li class="{{ Route::is('package.index') ? 'active' : '' }}">
                        <a href="{{ route('package.index') }}"><i class="fa fa-circle-o"></i>{{ __('trans.All_Packages')}} </a>
                     </li>
                     <li class="treeview {{ Route::is('student_package.index') ? 'active' : '' }}">
                        <a href="#">
                        <i class="fa fa-circle-o"></i>{{ __('trans.Student_Packages')}}
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        </a>
                        <ul class="treeview-menu">
                           <li class="{{ Route::is('student_package.index') ? 'active' : '' }}"><a href="{{ route('student_package.index') }}"><i class="fa fa-circle-o"></i>{{ __('trans.All_Student_Packages')}}</a></li>
                        </ul>
                     </li>
                  </ul>
               </li>
               <!--<li class="treeview {{ Route::is('student_sms.create') ? 'active' : '' }}">-->
               <!--    <a href="#">-->
               <!--        <i class="fa fa-envelope"></i> <span>{{ __('trans.SMS')}}     </span>-->
               <!--      <span class="pull-right-container">-->
               <!--        <i class="fa fa-angle-left pull-right"></i>-->
               <!--      </span>-->
               <!--    </a>-->
               <!--    <ul class="treeview-menu">-->
               <!--      <li class="{{ Route::is('student_sms.create') ? 'active' : '' }}"><a href="{{ route('student_sms.create') }}"><i class="fa fa-circle-o"></i> {{ __('trans.Send_SMS')}}</a></li>-->
               <!--    </ul>-->
               <!--</li>-->
               <!--<li class="treeview {{ Route::is('mail.create') ? 'active' : '' }}">-->
               <!--    <a href="#">-->
               <!--        <i class="fa fa-envelope"></i> <span>{{ __('trans.Mail')}}  </span>-->
               <!--      <span class="pull-right-container">-->
               <!--        <i class="fa fa-angle-left pull-right"></i>-->
               <!--      </span>-->
               <!--    </a>-->
               <!--    <ul class="treeview-menu">-->
               <!--      <li class="{{ Route::is('mail.create') ? 'active' : '' }}"><a href="{{ route('mail.create') }}"><i class="fa fa-circle-o"></i>{{ __('trans.Send_Mail')}}</a></li>-->
               <!--    </ul>-->
               <!--</li>-->
               <li class="treeview {{ Route::is('invoices.index') ? 'active' : '' }}">
                  <a href="#">
                  <i class="fa fa-file"></i> <span>{{ __('trans.Invoices')}}  </span>
                  <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  </a>
                  <ul class="treeview-menu">
                     <li class="{{ Route::is('invoices.index') ? 'active' : '' }}"><a href="{{ route('invoices.index') }}"><i class="fa fa-circle-o"></i>{{ __('trans.All_Invoices')}}</a></li>
                  </ul>
               </li>
               <li class="treeview {{ Route::is('expenses.index') ? 'active' : '' }} {{ Route::is('expense_detail.index') ? 'active' : '' }}">
                  <a href="#">
                  <i class="fa fa-balance-scale"></i> <span>{{ __('trans.Expenses')}}  </span>
                  <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  </a>
                  <ul class="treeview-menu">
                     <li >
                     <li class="{{ Route::is('expenses.index') ? 'active' : '' }}"><a href="{{ route('expenses.index') }}"><i class="fa fa-circle-o"></i>{{ __('trans.All_expenses')}}</a></li>
                     </li>
                     <li class="treeview {{ Route::is('expense_detail.index') ? 'active' : '' }}">
                        <a href="#">
                        <i class="fa fa-circle-o"></i> {{ __('trans.Vehical_expenses')}}
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        </a>
                        <ul class="treeview-menu">
                           <li class="{{ Route::is('expense_detail.index') ? 'active' : '' }}"><a href="{{ route('expense_detail.index') }}"><i class="fa fa-circle-o"></i>{{ __('trans.All_Vehical_expenses')}} </a></li>
                        </ul>
                     </li>
                  </ul>
               </li>
               <!--<li class="treeview {{ Route::is('user_meta.index') ? 'active' : '' }}">-->
               <!--    <a href="#">-->
               <!--        <i class="fa fa-user"></i> <span>{{ __('trans.Instructor')}}  </span>-->
               <!--      <span class="pull-right-container">-->
               <!--        <i class="fa fa-angle-left pull-right"></i>-->
               <!--      </span>-->
               <!--    </a>-->
               <!--    <ul class="treeview-menu">-->
               <!--      <li class="{{ Route::is('user_meta.index') ? 'active' : '' }}"><a href="{{ route('user_meta.index') }}"><i class="fa fa-circle-o"></i>{{ __('trans.Instructor_Details')}}</a></li>-->
               <!--    </ul>-->
               <!--</li>-->
               <li class="treeview {{ Route::is('attendence.create') ? 'active' : '' }} {{ Route::is('attendence_status.create') ? 'active' : '' }}">
                  <a href="#">
                  <i class="fa fa-user"></i> <span>{{ __('trans.Attendence')}}  </span>
                  <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  </a>
                  <ul class="treeview-menu">
                     <li class="{{ Route::is('attendence.create') ? 'active' : '' }}"><a href="{{ route('attendence.create') }}"><i class="fa fa-circle-o"></i>{{ __('trans.Mark_Attendence')}}</a></li>
                     <li class="{{ Route::is('attendence_status.index') ? 'active' : '' }}"><a href="{{ route('attendence_status.index') }}"><i class="fa fa-circle-o"></i>{{ __('trans.Attendence_Status')}}</a></li>
                  </ul>
               </li>
               <li class="treeview {{ Route::is('currency.index') ? 'active' : '' }}">
                  <a href="#">
                  <i class="fa fa-money"></i>
                  <span>{{ __('Currencies')}}</span>
                  <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  </a>
                  <ul class="treeview-menu">
                     <li class="{{ Route::is('currency.index') ? 'active' : '' }}"><a href="{{ route('currency.index') }}"><i class="fa fa-money"></i>{{ __('All Currencies')}}</a></li>
                  </ul>
               </li>
               
               <li class="{{ Route::is('setting.create') ? 'active' : '' }}">
                  <a href="{{ route('setting.create') }}">
                  <i class="fa fa-user"></i> <span>Setting</span>
                  </a>
               </li>
            </ul>
         </section>
         <!-- /.sidebar -->
      </aside>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
         <!-- Content Header (Page header) -->
         {{--  
         <section class="content-header">
            <ol class="breadcrumb">
               <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
               <li class="active">Here</li>
            </ol>
         </section>
         --}}
         <!-- Main content -->
         <section class="content container-fluid">
            @include('../layouts.flash-message')
            @yield('content')
            <!--------------------------
               | Your Page Content Here |
               -------------------------->
         </section>
         <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
      <!-- Control Sidebar -->
   </div>
   <!-- ./wrapper -->
   <!-- REQUIRED JS SCRIPTS -->
   <!-- jQuery 3 -->
   <!-- Bootstrap 3.3.7 -->
   <script src="{{ asset('/public/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
   <!-- AdminLTE App -->
   <script src="{{ asset('/public/dist/js/adminlte.min.js') }}"></script>
   <!-- FastClick -->
   <script src="{{ asset('/public/bower_components/fastclick/lib/fastclick.js') }}"></script>
   <script src="{{ asset('/public/js/jquery.dataTables.min.js') }}"></script>
   <script src="{{ asset('/public/js/datatable.custom.js') }}"></script>
   <!--<script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>-->
   <!--<script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>-->
   <script src="{{ asset('/public/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
   <script src="{{ asset('/public/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
   <script src="{{ asset('/public/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
   <script src="{{ asset('/public/dist/js/demo.js') }}"></script>
   <script src="{{ asset('/public/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
   <!-- jvectormap  -->
   <script src="{{ asset('/public/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
   <script src="{{ asset('/public/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
   <!-- SlimScroll -->
   <script src="{{ asset('/public/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
   <script src="{{ asset('/public/bower_components/chart.js/Chart.js') }}"></script>
   <script src="{{ asset('/public/dist/js/pages/dashboard2.js') }}"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
   <script>
      $(function () {
      
          $('#datepicker').datepicker({
              format: 'yyyy/mm/dd',
              autoclose: true,
              todayHighlight: true
            });
        $('.timepicker').timepicker({
          showInputs: false
        });
            $('#datepicker2').datepicker({
              format: 'yyyy/mm/dd',
              autoclose: true,
              todayHighlight: true
            });
        $('.timepicker2').timepicker({
          showInputs: false
        });
      })
      setTimeout(function() {
      $('.alert-block').remove();
      $('.alert-danger').remove();
      
      }, 8000); 
      
   </script>
   <!-- Optionally, you can add Slimscroll and FastClick plugins.
      Both of these plugins are recommended to enhance the
      user experience. -->
</body>
</html>
