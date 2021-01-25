<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
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
              <h3 class="card-title">Formulario de Ingreso de env&iacute;os</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" id="formulario" name="formulario" method="post">
              <div class="card-body">

                <div class="col-md-12 col-sm-6 col-12">
                  <div class="info-box ">
                    <span class="info-box-icon bg-navy"><i class="far fa-envelope"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Remitente: <?php echo $_SESSION['usr_nom'];?></span>
                      <span class="info-box-text">Centro de Costo: <?php echo $_SESSION['ccosto_codigo']." ".$_SESSION['ccosto_nombre'];?></span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                  <input type="hidden" id="ccosto_ori" name='ccosto_ori' value="<?php echo $_SESSION['ccosto']; ?>">

                <div class="form-group">
                  <label for="tipo_envio">Tipo env&iacute;o</label>
                  <select name='tipo_envio' id='tipo_envio' class="form-control" >
                    <option value='I'>INTERNO</option>
                    <option value='E'>EXTERNO</option>
                  </select>
                </div>


                <div class="form-group">
                  <label for="id_ccosto">Centro de costo destino</label>
                  <?php echo select_ccosto_simple(); ?>
                </div>

                <div class="form-group">
                  <label for="destinatario">Destinatario</label>
                  <input type="text" class="form-control" id="destinatario" name='destinatario' placeholder="Nombre del destinatario">
                </div>
                
                <div class="form-group">
                  <label for="des_direccion">Direcci&oacute;n</label>
                  <input type="text" class="form-control" id="des_direccion" name='des_direccion' placeholder="Direccion del destinatario">
                </div>

                <div class="form-group">
                  <label for="descripcion">Descripci&oacute;n del env&iacute;o</label>
                  <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="descripci&oacute;n">
                </div>

                <div class="form-group">
                  <label for="id_cat">Categoria del env&iacute;o Form</label>
                  <?php echo select_categoria(); ?>
                </div>
                <!--
                <div class="form-group">
                  <label for="vineta">Vi&ntilde;eta</label>
                  <input type="text" class="form-control" id="vineta" name='vineta' placeholder="vi&ntilde;eta"  autocomplete="off">

                  <div role="form" id="form" name="form" method="post">
                    <div class="card-footer">
                      <button id="boton_v" type="button" class="btn btn-outline-dark" onclick="generarVinetas()">
                      Generar Vi&ntilde;eta
                      </button>   <div id="div_msj">  </div>
                    </div>
                  </div>
                </div>
                -->
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#modal-default"
                        onclick="procesarformulario(formulario.ccosto_ori.value,
                                                    formulario.id_ccosto.value,
                                                    formulario.destinatario.value,
                                                    formulario.descripcion.value,
                                                    formulario.tipo_envio.value,
                                                    formulario.des_direccion.value,
                                                    formulario.id_cat.value)">
                  Registrar Env&iacute;o en Sistema
                </button>
              </div>

              <div class="modal fade" id="modal-default">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Ingreso de Env&iacute;o</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body" id="respuesta">

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
