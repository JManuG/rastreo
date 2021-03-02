<?php
include ('vista/control_gs.php');
$x1 = new control_gs();


?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <?php

      if(isset($_POST['barra'])){

        $barra=$_POST['barra'];
        $estado=6;
        $comentario=$_POST['motivo'];
        $r=$x1->guia_delete($estado,$barra,$comentario);


       print '<div class="alert alert-danger" role="alert">
                       <i class="fas fa-exclamation-triangle"></i> Se efectuo la anulacion de la solisitud con exito, el cambio es permanente.
                      </div>
                      <script>
                      function redir(){
                          window.location="index.php?prc=reportehistorico";
                      }
                      setTimeout("redir()",3000);
                            </script>';


      }else{
      ?>
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Ingreso de Env&iacute;os</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
            <li class="breadcrumb-item active">Formulario de ingreso de env&iacute;os</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-orange">
            <div class="card-header">
              <h3 class="card-title">Formulario de anulacion</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" id="formulario" name="formulario" method="post" action="index.php?prc=control_guia&accion=anulacion">
              <div class="card-body">

                <div class="col-md-12 col-sm-6 col-12">
                  <div class="info-box ">
                    <span class="info-box-icon bg-navy"><i class="far fa-envelope"></i></span>
                    <div class="info-box-content">

                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <input type="text" id="barra" class="form-control"  name='barra' value="<?php echo $_GET['br']; ?>">




                <div class="form-group">
                  <label for="descripcion">Motivo</label>
                  <input type="text" class="form-control" id="motivo" name="motivo" placeholder="descripci&oacute;n" maxlength="50" required>
                </div>

              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#modal-default">
                  Anular Envío
                </button>
              </div>

            </form>
          </div>
          <?php
          }
          ?>
          <!-- /.card -->
        </div>
      </div>
    </div>
  </section>
</div>
