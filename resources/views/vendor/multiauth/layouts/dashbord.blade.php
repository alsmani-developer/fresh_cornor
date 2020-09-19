<!--
  This System Is Developed In CitySoft Co ,  By : 
  1-Alsmani Anwar : alsmani3344@gmail.com
  
-->
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>لوحه التحكم</title>
   {{-- <link rel = "icon" href =  
"{{asset('logo/logo.jpeg')}}" 
        type = "image/x-icon">  --}}
          
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
   <!-- DataTables -->
 
  
  <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Bootstrap 4 RTL -->
  <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css">
  <!-- Custom style for RTL -->
  <link rel="stylesheet" href="{{asset('dist/css/custom.css')}}">
  <link rel="stylesheet" href="{{asset('dist/css/Breadcrumbs.css')}}">
  <link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


  <style>

body {
  font-family: 'Cairo', sans-serif;
}

table {
  
  width:80% !important;
}
thead{
  background-color:#F6B42C !important;
}
td, th{
  
  font-size:14px;
  width:90%
  text-align:center;
  background-color:white;
}

    </style>
      <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
     
    </ul>

    <ul class="navbar-nav mr-auto-navbav">
      <!-- Messages Dropdown Menu -->
    

      <li class="nav-item">
      <button data-toggle="modal" data-target="#SettingsModal" type="button" class="name-area btn btn-outline-warning "  style=" font-family: 'Cairo', sans-serif;" class="btn btn-secondary">
       <i class="fa fa-power-off fa-2x" aria-hidden="true" style="color:red;"></i>
        </button>
      </li>

    </ul>

    
  </nav>
  <!-- /.navbar -->



<!-- Modal -->
<div class="modal fade" id="SettingsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">تسجيـل خروج</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      تأكيـد تسجيـل الخـروج ؟
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">لا</button>
      
        <a href="{{route('admin.logout')}}"  class="btn btn-primary" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();" >   <b>نـعـم   </b></a>

                                <form id="logout-form" action="{{route('admin.logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
   
    
      </div>
    </div>
  </div>
</div>

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.home')}}" class="brand-link">
    <center> فريش كورنر </center>
      <!-- <img src="{{asset('dist/img/drspareLogo.jpeg')}}" style="width:220px;height:60px" > -->
           <!-- <i class="fas fa-car"></i> -->
      <!-- <span class="brand-text font-weight-light">Dr. spare</span> -->
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('dist/img/defalutUser.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{auth('admin')->user()->name}} </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>  الطلبات </p>
                </a>
              </li>

             

              <li class="nav-item has-treeview ">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                  اداره المنتجات
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>  المنتج</p>
                    </a>
                  </li>
                </ul>

                <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>  الانواع</p>
                      </a>
                    </li>
                  </ul>

                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>  اصل النوع</p>
                        </a>
                      </li>
                    </ul>

                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                          <a href="#" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>  مكان اللحمه</p>
                          </a>
                        </li>
                      </ul>

                      <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>  شكل اللحمه</p>
                            </a>
                          </li>
                        </ul>
  
              </li>

              <li class="nav-item has-treeview ">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                  الاعدادات العامه
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                @admin('super')
                <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('admin.register')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>  اضافه مشرفين</p>
                    </a>
                  </li>
                </ul>
                @endadmin
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="{{route('admin.password.change')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>  تغير كلمه السر</p>
                      </a>
                    </li>
                  </ul>
              </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <!-- <h1 class="m-0 text-dark">لـوحـة التحــكم</h1> -->
          </div><!-- /.col -->
          <div class="col-sm-6"  >
           


<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Library</a></li>
    <li class="breadcrumb-item active" aria-current="page">Data</li> -->
  </ol>
</nav>

          </div>
          
           <br>
           <hr>
         
           

          <!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" id="app">
       
            @yield('content')


      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
  <center>
    <strong>Copyright &copy; 2020 <a href="#">Dr. Spare</a>. </strong>
    All rights reserved. Designed By  <a  class="txt1" href="https://citysoftech.net" style="font-family:algerian;" target="_blank">City Soft  </a>
   </center>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


<!-- jQuery UI 1.11.4 -->
<script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 rtl -->
<script src="https://cdn.rtlcss.com/bootstrap/v4.2.1/js/bootstrap.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{asset('plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('plugins/jqvmap/maps/jquery.vmap.world.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>

<!-- DataTables -->


<script src="{{asset('plugins/datatables/datatables.min.js')}}"></script>
</body>
</html>
