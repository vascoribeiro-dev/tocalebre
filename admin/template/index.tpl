<head>
    <link href="../ext/select2/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../ext/bootstrap-4.4.1/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="../ext/bootstrap-4.4.1/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="../ext/bootstrap-4.4.1/css/bootstrap.min.css">
    <link href="../ext/fontawesome/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link type="text/css" rel="stylesheet" href="../ext/jsgrid-1.5.3/jsgrid.min.css" />
    <link type="text/css" rel="stylesheet" href="../ext/jsgrid-1.5.3/jsgrid-theme.min.css" />
    <link rel="stylesheet" href="../ext/trumbowyg/dist/ui/trumbowyg.min.css">

    <link rel="stylesheet" href="theme.css">
    <link rel="stylesheet" href="modules/[@MODULE]/css/[@PAGE].css"></script>

    <script src="../ext/jquery/jquery-3.4.1.min.js"></script>
    <script src="../ext/select2/js/select2.min.js"></script>
    <script src="../ext/bootstrap-4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="../ext/bootstrap-4.4.1/js/bootstrap.min.js"></script>
    <script defer src="../ext/fontawesome/js/all.js"></script>
    <script src="dist/js/adminlte.js"></script>
    <script type="text/javascript" src="../ext/jsgrid-1.5.3/jsgrid.min.js"></script>
    <script src="../ext/trumbowyg/dist/trumbowyg.min.js"></script>
   

    <script src="../farmework/js/script.js?v=[@VERSION]"></script>
    <script src="modules/[@MODULE]/js/[@PAGE].js?v=[@VERSION]"></script>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light pt-1">
    <!-- Left navbar links -->

    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
     <!-- <li class="nav-item ml-3">
        [@COMPANY]
      </li> -->
    </ul>
    <ul class="navbar-nav ">
      <li class="nav-item">
    
      </li>
    </ul>
   
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
       <!-- <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li> -->
      <li class="nav-item dropdown">
        <a id="disconect" class="nav-link" data-toggle="dropdown" href="#">
            <i class="fas fa-door-open"> </i> Sair
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link ">
      <span class="brand-text pl-3 font-weight-light">TOCA DA LEBRE</span>
    </a>
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div style="margin-left: 10px; height: 54; width:54;" >
            <div  class="circleimagem" style="background-image: url([@USERPHOTO]);"></div>
            <!--  <img src="[@USERPHOTO]" s class="img-circle elevation-2" style="height: 44; width: 44;" alt="User Image"> -->
          </div>
          <div class="font-weight-light">
            <h4>   <span  style= "color: white;"class=" brand-text pl-3 font-weight-light">  [@USERNAME] </span></h4>
          </div>
      
    </div>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          [@MENU]
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
            <h1 class="m-0 text-dark">[@TITLE]</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <div id="messageAlert"> </div>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div  class="container-fluid">
        [@BODY]
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2020 Vasco Ribeiro.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> [@VERSION]
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

</body>
</html>
