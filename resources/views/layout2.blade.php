<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<title>Laravel</title>
	{!! Html::style('bootstrap/css/bootstrap.css')!!}
	{!! Html::style('bootstrap/css/bootstrap.min.css')!!}
	
	
	  <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    {!! Html::style('dist/css/skins/_all-skins.min.css') !!}
    {!! Html::style('dist/css/AdminLTE.min.css') !!}


	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
      <header class="main-header">
        <a href="#" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels 
          <span class="logo-mini"><b>A</b>LT</span>-->
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Soresoft Facturación</b></span>
        </a>
        <nav class="navbar navbar-static-top" role="navigation">
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
             @if(Auth::guest()) 
              <li class="dropdown user user-menu">
               <a href="{{route('login')}}">Login</a>
             </li>
             <li class="dropdown user user-menu">
               <a href="{{route('register')}}">Register</a>
             </li>
             @else
             <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            {{ Auth::user()->name }} 
                        </a>
                        <ul class="dropdown-menu">
                            <li class="user-footer">
                            	 <div class="pull-left">
                            	<a href="#" class="btn btn-default btn-flat">Perfil</a>
                            	</div>
                            	<div class="pull-right">
                            	<a href="{{ route('logout') }}" class="btn btn-default btn-flat">Logout</a>
                            	</div>
                            </li>
                        </ul>
              </li>
             @endif
            </ul>
          </div>
         </nav>
      </header>
	<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
      </div><!-- /.content-wrapper -->
      
      </div>
    

	@yield('content')

	<!-- Scripts -->
	<!-- jQuery 2.1.4 -->
    {!! Html::script('plugins/jQuery/jQuery-2.1.4.min.js') !!}
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
     <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    {!! Html::script('bootstrap/js/bootstrap.js') !!}
	{!! Html::script('bootstrap/js/bootstrap.min.js') !!}
	<!-- AdminLTE App -->
	{!! Html::script('dist/js/app.min.js') !!}
    
</body>
</html>