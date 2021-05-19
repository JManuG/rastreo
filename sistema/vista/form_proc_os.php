<?php 
include ("model/model_tab.php");
$db=new model_tab();

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Orden de Servicio </h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
            <li class="breadcrumb-item active">Formulario de orden de servicio</li>
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
      
            <!-- /.card-header -->
            <!-- form start -->
            <!--FORM-->
              <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Envio</th>
                                <th>Obs.</th>
                                <th>Origen</th>
                                <th>Destino</th>
                                <th>Destinatario</th>
                                <th>Fecha Hora</th>
                                <th>Usuario</th>  
                                <th>Opciones</th>      
                            </tr>
                        </thead>
                        <tbody id="developers">
                        <?php 
                            $id_ccosto = $_SESSION['ccosto'];
                            $id_usr    = $_SESSION['cod_user'];
                            $sql=$db->consulta_vineta_tabla($id_ccosto,$id_usr);
                            while ($row=$sql->fetch(PDO::FETCH_NUM))
                            { 
                        ?>
                                <tr>
                                    <td><?php echo $row[9]; ?></td>
                                    <td><?php echo $row[10]; ?></td>
                                    <td><?php echo "<b>A:</b> ".$row[2]."<br> <b>CC:</b>".$row[1]." ".$row[3]; ?></td>
                                    <td><?php echo "<b>A:</b> ".$row[5]."<br> <b>CC:</b>".$row[4]." ".$row[6]; ?></td>
                                    <td><?php echo $row[11]; ?></td>
                                    <td><?php echo $row[8]; ?></td>
                                    <td><?php echo $row[7]; ?></td>
                                    <td>
                                    <form role="form" id="formulario_<?php echo $row[0];?>" name="formulario_<?php echo $row[0];?>" method="post">
                                        <div  id="div_<?php echo $row[0];?>" name="div_<?php echo $row[0];?>">
                                             <!--div_<?php echo $row[0];?>-->
                                            <input type="hidden" id="id_vineta" name='id_vineta' value="<?php echo $row[0];?>">

                                            <input type="button" class="btn btn-danger" value="Borrar" onclick="delRegistro(formulario_<?php echo $row[0];?>.id_vineta.value)" />
                                        </div>
                                    </form>
                                    </td>
                                </tr>
                         <?php   
                            } 
                         ?>
                        </tbody>
                    </table>

                    <div class="col-md-12 text-center">
                        <ul class="pagination" id="developer_page"></ul>
                    </div>
                </div>

              </div>
              <!-- /.card-body -->

              <div class="card-footer">
              <form role="form" id="formulario" name="formulario" method="post">
                <input type="hidden" id="id_cli" name='id_cli' value="<?php echo $_SESSION['shi_codigo']; ?>">
                <input type="hidden" id="id_ccosto" name='id_ccosto' value="<?php echo $id_ccosto;?>">
                <button id="submitBtn" type="button" class="btn btn-outline-dark " data-toggle="modal" data-target="#modal-default"
                        onclick="procesarOS(formulario.id_cli.value,
                                            formulario.id_ccosto.value)">
                  Procesar Orden
                </button>
                </form>
              </div>

              <div class="modal fade" id="modal-default">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Creacion de Orden</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body" id="respuesta">
                                
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal" onclick="recargarTab()">Cerrar</button>
                      <!--<button type="button" class="btn btn-primary">Save changes</button>-->
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
             <!--FORM-->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
  </section>
</div>
<!-- ajax call -->
<script src="vista/funciones.js"></script>
