<?php 

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Mantenimiento de Usuarios</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
            <li class="breadcrumb-item active">Formulario de ingreso de usuarios</li>
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
              <h3 class="card-title">Formulario de Ingreso de Usuarios</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" id="formulario" name="formulario" method="post">
              <div class="card-body">

                <div class="col-md-12 col-sm-6 col-12"> 
  
                  <!-- /.info-box -->
                </div>
                  <!--      
                <div class="form-group">
                  <label for="usr_cod">Codigo</label>
                  <?php echo select_usuario(); ?>
                </div>
                -->
                <div class="form-group">
                  <label for="usr_cod2">Usuario </label>
                  <input autofocus type="text" maxlength='16' class="form-control" id="usr_cod2" name='usr_cod2' placeholder="Usuario"  required />
                </div>

                <div class="form-group">
                  <label for="usr_pass">Contrase&ntilde;a </label>
                  <input type="password" class="form-control" id="usr_pass" name='usr_pass' placeholder="Contraseña"  required />
                </div>

                <div class="form-group">
                  <label for="usr_nombre">Nombre Usuario </label>
                  <input type="text" class="form-control" id="usr_nombre" name='usr_nombre' placeholder="Nombre Usuario"  required />
                </div>

                <div class="form-group">
                  <label for="id_ccosto">Centro de Costo </label>
                  <?php echo select_age_ccosto(); ?>
              </div>
              
              <div class="form-group">
                  <label for="perfil">Perfil</label>
                  <select name='perfil' id='perfil' class="form-control">
                        <option value=''>-</option>
                        <option value='1'>Administrador</option>
                        <option value='2'>Soporte</option>
                        <option value='3'>Agencia</option>
                </select>
              </div>

              <div class="card-footer">
                <button id="submitBtn" type="button" class="btn btn-outline-dark " data-toggle="modal" data-target="#modal-default"
                        onclick="procesarMantUsuario(
                                                       formulario.usr_cod2.value,
                                                       formulario.usr_pass.value,
                                                       formulario.usr_nombre.value,
                                                       formulario.id_ccosto.value,
                                                       formulario.perfil.value
                                                       )">
                  Registrar Usuario
                </button>
              </div>

              <div class="modal fade" id="modal-default">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Registro de Usuario</h4>
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
