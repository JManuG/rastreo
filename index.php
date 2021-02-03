<?php

// ini_set ("display_errors","0" );
// error_reporting(E_ALL);

require_once ("lib/ajax/xajax_core/xajax.inc.php");
include ("class/ajax/funciones.php");

$xajax = new xajax();
$xajax->registerFunction("valida_usuario");
//$xajax->register(XAJAX_FUNCTION, array('valida_usuario', &$this, 'valida_usuario'));
session_start();
$_SESSION['ccosto']="";// Unset session variables.
$_SESSION['usrcod']="";// Unset session variables.
$_SESSION['usrnom']="";// Unset session variables.
$_SESSION['shi_codigo']="";// Unset session variables.
$_SESSION['shi_nombre']="";// Unset session variables.
session_destroy(); // End Session we created earlier.

//$xajax->configure('debug',true);

$xajax->processRequest();


echo "<?xml version=\'1.0\' encoding=\'UTF-8\'?>";

		$xajax->printJavascript('lib/ajax/');
$info='';
if(isset($_GET['m'])){
    $info="<div class='alert alert-danger' role='alert'>
        Su sesión a expirado por motivos de seguridad!!<br> favor ingresar nuevamente.
        </div>;";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Envía de Guatemala</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link  rel="icon"   href="sistema/vista/imgs/favicon.ico" type="image/ico" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="sistema/vista/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="sistema/vista/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="sistema/vista/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box ">
    <div class="login-logo">

<!--        <b>Env&iacute;a</b> de Guatemala-->
    </div>
    <!-- /.login-logo -->
    <?php echo $info;?>
    <div class="card">

        <div class="card-body login-card-body bg-gradient-navy">
            <p class="login-box-msg"><img src="sistema/vista/imgs/envia5.png" width="200"></p>

            <p class="login-box-msg" id="mensaje">Ingresa tus credenciales de acceso</p>
            <p class="login-box-msg" id="mensaje"><b>Sistema de Rastreo</b></p>

            <form method="post" id="formulario">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Nombre" id='usr' name='usr'>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-smile-beam"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Clave" id='pass' name='pass'>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="button" class="btn btn-secondary btn-block" onclick="xajax_valida_usuario(xajax.getFormValues('formulario'))">Ingresar</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="sistema/vista/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="sistema/vista/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="sistema/vista/dist/js/adminlte.min.js"></script>

</body>
</html>