<!DOCTYPE html>
<html>
<head>  <?php $latest = ""; ?>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  
  <title>{{ config('app.project.name') }} {{'| Admin'}} </title>
  <link rel="shortcut icon" href="{{url('/')}}/public/upload/default/favicon.png" />
  
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{ url('/') }}/front/bootstrap/css/bootstrap.css?head=<?php echo $latest;?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css?head=<?php echo $latest;?>">
  <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700" rel="stylesheet">

  <!-- Ionicons -->

  <link href="{{ url('/') }}/front/plugins/datatables/dataTables.bootstrap.css?head=<?php echo $latest;?>" rel="stylesheet" type="text/css" />
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('/') }}/front/dist/css/AdminLTE.min.css?head=<?php echo $latest;?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins

   folder instead of downloading all of them to reduce the load. -->
   <link rel="stylesheet" href="{{ url('/') }}/front/bootstrap/css/style.css?head=<?php echo $latest;?>">

   <link rel="stylesheet" href="{{ url('/') }}/front/dist/css/skins/_all-skins.min.css?head=<?php echo $latest;?>">

   <link rel="stylesheet" href="{{ url('/') }}/front/dist/css/skins/skin-yellow.css?head=<?php echo $latest;?>">
   

   <link rel="stylesheet" href="{{ url('/') }}/front/dist/css/skins/skin-yellow.min.css?head=<?php echo $latest;?>">
   <!-- iCheck -->
   <link rel="stylesheet" href="{{ url('/') }}/front/plugins/iCheck/flat/blue.css?head=<?php echo $latest;?>">

</head>
<body class="hold-transition skin-yellow-light   sidebar-mini">

  <div class="wrapper">
    <header class="main-header">
      <!-- Logo -->
      <a href="#" class="logo" style="background-color: #434242">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini" style="color: white">
          IN
        </span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">
          
          {{ config('app.project.name') }}
          

        </span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>


        <form name="" method="post"> 
          {{ csrf_field() }}
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li class="dropdown notifications-menu">
               <?php 
               $user=\Sentinel::check();
               $user->inRole('admin');

               $path  = url('/') ."/public/".config('app.project.user_path');

               $name = $user->first_name;
               $email = $user->email;
               $profile = $user->profile_image;

               ?>
             </li>


             <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                @if($profile!=null)
                <img src="{{$path}}{{$profile}}" class="user-image" alt="User Image">
                @else
                <img src="{{url('/')}}/public/upload/default/not-available.jpg" class="user-image" alt="User Image">
                @endif
                <span class="hidden-xs" style="color: fff">{{ $name }}</span>
              </a>



              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  @if($profile!=null)
                  <img src="{{$path}}{{$profile}}" class="img-circle" alt="User Image">
                  @else
                  <img src="{{url('/')}}/public/upload/default/not-available.jpg" class="img-circle" alt="User Image">
                  @endif
                  <p>
                    {{$name}}
                    <small> -  {{ $email }}</small>
                  </p>
                </li>

            <li class="user-footer">
                <div class="pull-left">
                  <a href="{{url('/')}}/admin/profile" class="btn btn-default btn-xs btn-flat">Profile</a>
                   <a href="{{url('/')}}/admin/change_password" class="btn btn-default btn-xs btn-flat">Change Password</a>
                </div>
                <div class="pull-right">
                  <a href="{{url('/')}}/admin/logout" class="btn btn-default btn-xs btn-flat">Sign out</a>
                </div>
              </li>

              </ul>
              
            </li>
          </ul>
        </div>
      </form>
    </nav>
  </header>

  
