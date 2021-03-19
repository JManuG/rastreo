<?php 

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Mantenimiento de Programacion Ruta</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
            <li class="breadcrumb-item active">Formulario de ingreso de programacion ruta</li>
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
              <h3 class="card-title">Formulario de Ingreso de Programacion Rutas</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" id="formulario" name="formulario" method="post">
              <div class="card-body">

                <div class="col-md-12 col-sm-6 col-12"> 
  
                  <!-- /.info-box -->
                </div>
                        
                <div class="form-group">
                  <label for="id_ruta">Ruta</label>
                  <?php echo select_ruta_deta(); ?>
                </div>

                <div class="form-group">
                  <label for="nombre_ruta">Agencia </label>
                  <?php echo select_agencias(); ?>
                </div>

                <div class="form-group">
                  <label for="hora_ini">Hora Ini </label>
                  <input type="time" name="hora_ini">
                </div>

                <div class="form-group">
                  <label for="hora_fin">Hora Fin </label>
                  <input type="time" name="hora_fin">
                </div>
                <!--
                <div class="form-group">
                  <label for="periocidad">Periocidad </label>
                  <?php echo select_periocidad(); ?>
                </div>
               -->
               <div class="form-group">
                  <label for="comentario">Comentario </label>
                  <input type="text" class="form-control" id="comentario" name='comentario' placeholder="comentario"  required />
                </div>
              <!-- /.card-body -->
              <div class="col-md-12 col-sm-6 col-12">
                  <div class="info-box ">
                    <span class="info-box-icon bg-navy"><i class="far fa-envelope"></i></span>
                        <div class="info-box-content">
                          
                            <div class="form-group" id='msj_div'></div>
                         
                        </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
        

              <div class="card-footer">
                <button id="submitBtn" type="button" class="btn btn-outline-dark " data-toggle="modal" data-target="#modal-default"
                        onclick="procesaMantRutaProgramacion(formulario.id_ruta.value,
                                                              formulario.id_agencia.value,
                                                              formulario.hora_ini.value,
                                                              formulario.hora_fin.value,
                                                              formulario.comentario.value)">
                  Registrar Ruta
                </button>
              </div>

              <div class="modal fade" id="modal-default">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Registro de Programacion Ruta</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body" id="respuesta">
                                X
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                      <!--<button type="button" class="btn btn-primary">Save changes</button>-->
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
            </form>
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
  </section>
</div>
<!-- ajax call -->
<script src="vista/funciones.js"></script>
