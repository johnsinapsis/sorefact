<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Soresoft | Facturación</title>
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    
    {!! Html::style('bootstrap/css/bootstrap.min.css')!!}
    <!-- Font Awesome -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> -->
    {!! Html::style('dist/css/awesome/font-awesome.min.css')!!}
    <!-- Ionicons -->
    <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
    {!! Html::style('dist/css/ionicons/css/ionicons.min.css')!!}
    <!-- Datatables -->
    {!! Html::style('dist/css/dataTables.min.css') !!}
    <!-- Theme style -->
    {!! Html::style('dist/css/AdminLTE.min.css') !!}
    
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    {!! Html::style('dist/css/skins/_all-skins.min.css') !!}
    
    {!! Html::style('dist/css/suggest.css') !!}

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="{{route('main')}}" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels 
          <span class="logo-mini"><b>A</b>LT</span>-->
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Soresoft Facturación</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              @if(Auth::guest()) 
              <li class="dropdown user user-menu">
               <a href="{{route('login')}}">Login</a>
             </li>
            <!-- <li class="dropdown user user-menu">
               <a href="{{route('register')}}">Registrar</a>
             </li> -->
             @else
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  {{ Auth::user()->name }} 
                </a>
                <ul class="dropdown-menu">
                                    
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Perfil</a>
                    </div>
                    <div class="pull-right">
                      <a href="{{ route('logout') }}" class="btn btn-default btn-flat">Cerrar Sesión</a>
                    </div>
                  </li>
                </ul>
              </li>  
              @endif           
            </ul>
          </div>
        </nav>
      </header>

       @if(Auth::guest()) 

       @else

       <aside class="main-sidebar">
          @if(Auth::user()->role=="superadmin")
          <ul class="sidebar-menu">
            <li class="header">MENU ADMINISTRADOR</li>
            
            <li><a href="{{route('register')}}"><i class="fa fa-book"></i> <span>Registrar Usuario</span></a></li>
            <li><a href="{{url('account/password')}}"><i class="fa fa-key"></i> <span>Cambiar Contraseña</span></a></li>

            <li class="active treeview">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Opciones de Cartera</span>
                
              </a>
              <ul class="treeview-menu">
                <li><a href="{{route('anupago')}}"><i class="fa fa-circle-o"></i> Anular Pagos</a></li>
                <!-- <li><a href="pages/layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>
                <li><a href="pages/layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>
                <li><a href="pages/layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li> -->
              </ul>
            </li>
          </ul>
          @endif
       </aside>

       @endif
        
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
      
      @yield('content')
 
      </div><!-- /.content-wrapper -->

      <div class="control-sidebar-bg"></div>

      </div> <!-- ./wrapper -->

     

    <!-- jQuery 2.1.4 -->
    {!! Html::script('plugins/jQuery/jQuery-2.1.4.min.js') !!}
    <!-- jQuery UI 1.11.4 -->
    <!--<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>--> 
     {!! Html::script('plugins/jQuery/jquery-ui.min.js') !!}
     {!! Html::script('plugins/jQuery/dataTables.min.js') !!}
      
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script type="text/javascript">
      $.widget.bridge('uibutton', $.ui.button);

       $(document).ready(function(){

        $("#entidad").bind({

        });

        $("#entidad").autocomplete({
          //dataType: 'json',
          minLength:3,
          autoFocus:true,
          source : "{{URL('liq/autocomplete')}}",
          //source:disponible,
          select : function(event, ui){
            $("#ident").val(ui.item.id);
            $("#fecha").prop('disabled', true);
            $("#entidad").prop('disabled', true);
            $("#servicio").removeAttr("readonly");
            $("#cantidad").removeAttr("readonly");

          }
        });
      });

        $(document).ready(function(){

        var y = $("#ident").val();
        var p = "liq/autocomplete2?ident="+y;
        //var token = $("#token").val();
        $("#servicio").autocomplete({
          //dataType: 'json',
          minLength:3,
          autoFocus:true,
          //source : "{{URL('liq/autocomplete2')}}",
          //source: "{{url('liq/autocomplete2/}}"+ $("#ident").val()+"{{')}}",
          source: function(request,response){
            $.ajax({
              url:"{{URL('liq/autocomplete2')}}",
              //headers:{'X-CSRF-TOKEN':token},
              dataType: "json",
              data: {
                term: request.term,
                ident: $("#ident").val(),
              },
              success: function(data) {
               response(data);
             }
            });
          },
          select : function(event, ui){
            $("#idserv").val(ui.item.id);
            $("#valuni").val(ui.item.precio);
            $("#agrefila").attr('disabled', false);
          }
        });
      });

$("#previa").click(function(){
 var ident = $("#ident").val();
 var idserv = new Array();
 var cant = new Array();
 var route = "{{URL('liq/prev')}}";
 var valuni = new Array();
 var token = $("#token").val();
 var fecha = $("#fecha").val();
 var fullDate = new Date();
 var startDate = new Date($('#fecha').val());
 if(startDate>fullDate){
  alert("la fecha no puede ser mayor a la actual");
 }
 else
 {
  $('#previa').hide();
  $('#modif').show(3000);
  $('#liqui').show(3000); 
 $('#detservi').DataTable().column(4).visible(true);
 $("#detservi tbody tr").each(function (index){
    idserv[index] = $(this).attr("data-id").substring(1);
     cant[index]  = $(this).find("td").eq(1).html();
     valuni[index]  = $(this).find("td").eq(4).html();
    });
 $('#detservi').DataTable().column(4).visible(false);
    //alert(cant[1]);
    $.ajax({
       url:"{{URL('liq/prev')}}",
     //url:"{{URL('liq/autocomplete2')}}"
       headers:{'X-CSRF-TOKEN':token},
       type: "POST",
       dataType: "json",
       data:{ident:ident,fecha:fecha,idserv:idserv,cantidad:cant,valuni:valuni},
       success: function(data) {
                var pdf = "pdfprev/"+ident+"/"+fecha;
                //var url = "{{"+pdf+"}}";
                window.open(pdf,'_blank');
             }
    });
  } //fin else cuando la fecha está correcta
});

     
    </script>
    {!! Html::script('dist/js/liqui.js') !!} 
    <!-- Bootstrap 3.3.5 -->
     {!! Html::script('bootstrap/js/bootstrap.min.js') !!}
    
    <!-- Texto enriquecido. Solo se usa para que no arroje error en la plantilla. -->
    {!! Html::script('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') !!}

        
     <!-- AdminLTE App -->
    {!! Html::script('dist/js/app.min.js') !!}

    
      
    {!! Html::script('dist/js/pages/dashboard.js') !!}
    <!-- AdminLTE for demo purposes -->
    {!! Html::script('dist/js/demo.js') !!}

 
  </body>
</html>
