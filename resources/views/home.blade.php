<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Compose Message</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!-- Custom CSS -->
  <style>
    body {
      background-color: #f8f9fa;
      display: flex;
      flex-direction: row;
      justify-content: space-between;
      align-items: center;
    }
    
    .left-image,
    .right-image {
      flex: 1;
      height: 100vh;
      background-position: center;
      background-repeat: no-repeat;
    }

    .center-content {
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }

    
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="left-image" style="background-image: url('../../dist/img/image.jpg');"></div>
  <div class="center-content">
    <button type="button" class="btn btn-block btn-primary">Create Account</button>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <x-responsive-nav-link :href="route('logout')"
                onclick="event.preventDefault();
                            this.closest('form').submit();">
            {{ __('Logout') }}
        </x-responsive-nav-link>
    </form>
    <!-- <button type="button" class="btn btn-block btn-info">Logout</button> -->
  </div>
  <div class="right-image" style="background-image: url('../../dist/img/images5.jpg');"></div>
</body>
</html>
