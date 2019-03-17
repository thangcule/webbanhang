<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>AdminLTE 2 | Fixed Layout</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('adminlte/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('adminlte/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
  <!-- create calendar -->
  <link rel="stylesheet" href="{{asset('adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
  <link rel="stylesheet" href="{{asset('adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
  <!-- create chart -->
  <link rel="stylesheet" href="{{asset('adminlte/bower_components/morris.js/morris.css')}}">
  <link rel="stylesheet" href="{{asset('adminlte/dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('adminlte/dist/css/skins/_all-skins.min.css')}}">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
   
  <!-- REVOLUTION BANNER CSS SETTINGS -->
  <link rel="stylesheet" type="text/css" href="{{asset('front/slider/css/settings.css')}}" media="screen" />
  <!-- My style css -->
  <link rel="stylesheet" href="{{asset('adminlte/css/style.css')}}">
  {{--<link rel="stylesheet" href="{{asset('login/profile.css')}}">--}}
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!-- ADD THE CLASS fixed TO GET A FIXED HEADER AND SIDEBAR LAYOUT -->
<!-- the fixed layout is not compatible with sidebar-mini -->
<body class="hold-transition skin-blue fixed sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <header class="main-header">
    <!-- Logo -->
    <a href="/admin" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">  
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning" id="notify"></span>
            </a>
            <ul class="dropdown-menu">
              <li>
                <ul class="menu">
                  @foreach($orders as $order)
                      @if($order->status == 1)
                          <li>
                              <a href="/admin/orders/{{$order->id}}">
                                  <i class="fa fa-users text-aqua"></i>New Order 
                              </a>
                          </li>
                      @endif
                  @endforeach
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="https://t4.ftcdn.net/jpg/01/05/72/55/240_F_105725545_wjyNkHco8leWLvlw3kWJbDas8MwBz9Wl.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs">{{session('admin')}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="https://t4.ftcdn.net/jpg/01/05/72/55/240_F_105725545_wjyNkHco8leWLvlw3kWJbDas8MwBz9Wl.jpg" class="img-circle" alt="User Image">

                <p>
                  {{session('admin')}}
                  <small>Member since Nov. 2012</small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{route('profile')}}" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="{{route('signout')}}" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="https://t4.ftcdn.net/jpg/01/05/72/55/240_F_105725545_wjyNkHco8leWLvlw3kWJbDas8MwBz9Wl.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{session('admin')}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <div style="height: 30px;"></div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li>
          <a href="/admin/orders">
            <span>&nbsp; </span><i class="fa fa-usd"></i><span>Order</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-product-hunt"></i> <span>Products</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/admin/products_new"><i class="fa fa-circle-o"></i>Slide Products</a></li>
            <li><a href="/admin/products"><i class="fa fa-circle-o"></i>Products</a></li>
            <li><a href="/admin/products_catagories"><i class="fa fa-circle-o"></i>Catagories</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-user" aria-hidden="true"></i> <span>User manager</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/admin/members"><i class="fa fa-circle-o"></i>Members</a></li>
            <li><a href="/admin/customers"><i class="fa fa-circle-o"></i>Customers</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-tasks" aria-hidden="true"></i> <span>Report</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/admin/report/products"><i class="fa fa-circle-o"></i>Sales</a></li>
            <li><a href="/admin/report/members"><i class="fa fa-circle-o"></i>Profit</a></li>
          </ul>
        </li>
        <li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-industry" aria-hidden="true"></i> <span>Warehouse</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/admin/goods-receipt"><i class="fa fa-truck"></i>Goods receipt</a></li>
            <li><a href="/admin/warehouse-history"><i class="fa fa-history"></i>Hitory</a></li>
          </ul>
        </li>

      </ul>
    </section>
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <!-- /.content-wrapper -->

  <!-- ================================================= -->
</div>

<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{asset('adminlte/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/jQueryUI/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script type="text/javascript">
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- DataTables -->
<script src="{{asset('adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('adminlte/bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{asset('adminlte/bower_components/morris.js/morris.js')}}"></script>
<script src="{{asset('adminlte/bower_components/raphael/raphael.min.js')}}"></script>
<script src="{{asset('adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<!-- Datepicker -->
<script src="{{asset('adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('adminlte/dist/js/adminlte.min.js')}}"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{asset('adminlte/dist/js/demo.js')}}"></script>
<script type="text/javascript" src="{{asset('front/slider/js/jquery.themepunch.plugins.min.js')}}"></script>
<script type="text/javascript" src="{{asset('front/slider/js/jquery.themepunch.revolution.min.js')}}"></script>
<script src="https://js.pusher.com/4.1/pusher.min.js"></script>
  <div class="content-wrapper">
    <!-- Main content -->
      @yield('content')
    <!-- /.content -->
  </div>
  <div class="col-md-8 col-md-offset-4">
      <p>Message preview:</p>
      <ul id="messages" class="list-group"></ul>
  </div>

  <script type="text/javascript">
      $(document).ready(function() {
          $('.data_table').DataTable();
          $('input[name="daterange"]').daterangepicker();
      });    

      $(document).ready(function(){
        // Khởi tạo một đối tượng Pusher với app_key
        var pusher = new Pusher('0ecb938b731b76d0164b', {
            cluster: 'ap1',
            encrypted: true
        });

        //Đăng ký với kênh chanel-demo-real-time mà ta đã tạo trong file DemoPusherEvent.php
        var channel = pusher.subscribe('DemoChanel');

        //Bind một function addMesagePusher với sự kiện DemoPusherEvent
        channel.bind('App\\Events\\DemoPusher', addMessageDemo);
      });

      //function add message
      function addMessageDemo(data) {
        var liTag = $("<li class='list-group-item'></li>");
        liTag.html(data.message);
        console.log(data);
        $('#messages').append(liTag);
      }
  </script>
</body>
</html>
