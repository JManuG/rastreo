<?php
ini_set('session.cookie_lifetime', 0);
ini_set('session.use_cookies', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);
ini_set('session.use_trans_sid', 0);
ini_set('session.cache_limiter', 'private_no_expire');
ini_set('session.hash_function', 'sha256');
header( 'Strict-Transport-Security: max-age=15552000; includeSubdomains; preload' );

date_default_timezone_set('America/Guatemala');

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Env&iacute;a de Guatemala</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link  rel="icon"   href="vista/imgs/favicon.ico" type="image/ico" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="vista/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="vista/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="vista/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="vista/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="vista/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="vista/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="vista/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="vista/plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <link rel="stylesheet" href="vista/DataTables/datatables.min.css">

  <!--botones-->
  <link rel="stylesheet" href="vista/DataTables/DataTables-1.10.23/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="vista/DataTables/Buttons-1.6.5/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="vista/DataTables/Scroller-2.0.3/css/scroller.bootstrap4.min.css">

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-navy navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <span class="nav-link">Bienvenid@ <?php echo $_SESSION['shi_nombre']; ?></span>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
<!--        <span class="nav-link">--><?php //echo $_SESSION['shi_direccion']; ?><!--</span>-->
      </li>
    </ul>







    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
        <?php echo date('d-m-Y H:i:s'); ?>
        </a>


      </li>
      <li class="nav-item dropdown">
        <a class="nav-link"  href="../">
          <i class="fas fa-door-open mr-2"></i>
          <span class="float-right text-muted text-sm">Salir</span>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->





  <!--    <li class="nav-item">-->
<!--      <li class="brand-text" href="#" role="button">Env&iacute;a de Guatemala</li>-->
<!--    </li>-->

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->

  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-orange elevation-4">
    <!-- Brand Logo -->
    <a href="." class="brand-link bg-navy">
      <img src="vista/imgs/envia_blanco.png" alt="Envia" class="brand-image-xs elevation-4"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Env&iacute;aGT</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">

        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION['usr_nom']; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link ac-results">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Inicio
<!--                <i class="right fas fa-angle-left"></i>-->
              </p>
            </a>

          </li>

<?php include('menu.php'); ?>


          <li class="nav-item has-treeview menu-open ">
            <a class="nav-link ac_results" a href='../'>
              <i class="nav-icon fas fa-door-open"></i>
              <p>Salir</p>
            </a>
          </li>



            </ul>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </body>



    <!-- Main content -->
    <section class="content">
