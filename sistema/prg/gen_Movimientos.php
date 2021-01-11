<?php
//ini_set ("display_errors","1" );
//error_reporting(E_ALL);
include('../model/model_mov.php');

$db = new model_mov();

$barra = $_POST['vineta'];

//buscamos si existe la viñeta
 //Enca Envio   
 $sql_0=$db->mov_enca($barra);

 $existe_mov=0;
 while ($row_0=$sql_0->fetch(PDO::FETCH_NUM))
 { 
     $id_guia        =$row_0[0];
     $id_envio       =$row_0[1];
     $ori_ccosto     =$row_0[2];
     $des_ccosto     =$row_0[3];
     $estado         =$row_0[4];
     $id_usr         =$row_0[5];
     $fecha_date     =$row_0[6];
     $fecha_datetime =$row_0[7];
     $tiempo         =$row_0[8];
     $tipo_envio     =$row_0[9];
     $categoria      =$row_0[10];
     $id_orden       =$row_0[11];
     $barra          =$row_0[12];
     $comentario     =$row_0[13];
     $destinatario   =$row_0[14];
     $des_direccion  =$row_0[15];
     $existe_mov     =1;
 }

 if($existe_mov==1){
?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <!-- Timelime example  -->
        <div class="row">

            <div class="col-md-6">
                <!-- The time line -->
                <div class="timeline">
                    <!-- timeline item -->
                    <?php
                    
                    //Consulta para el TimeLine
                    $sql_1=$db->mov_tl($barra);
                    
                    while ($row_1=$sql_1->fetch(PDO::FETCH_NUM))
                    {
                        $id_envio   =$row_1[1];
                        $PI         =$row_1[2];
                        $AR         =$row_1[3];
                        $LD         =$row_1[4];
                        $DL         =$row_1[5];
                        $DV         =$row_1[6];

                        if($PI > 0){
                            $param_pi="fa-check bg-green";
                        }else{
                            $param_pi="fa-circle-thin bg-white";    
                        }

                        if($AR > 0){
                            $param_ar="fa-check bg-green";    
                        }else{
                            $param_ar="fa-circle-thin bg-white";
                        }

                        if($LD > 0){
                            $param_ld="fa-check bg-green";    
                        }else{
                            $param_ld="fa-circle-thin bg-white";
                        }

                        if($DL > 0){
                            $param_final="fa-check bg-green";
                            $des_final="Entrega";
                        }elseif($DV > 0){
                            $param_final="fa-check bg-green";
                            $des_final="Devoluci&oacute;n";
                        }else{
                            $param_final="fa-circle-thin bg-white";
                            $des_final="Entrega";   
                        }
                    }
                    ?>

                    <div>
                        <i class="fas <?php echo $param_pi;?>"></i>
                        <div class="timeline-item">
                            <h3 class="timeline-header"><a href="#">Solicitud de Env&iacute;o</a></h3>
                        </div>
                    </div>
                    <!-- END timeline item -->
                    <!-- timeline item -->
                    <div>
                        <i class="fas <?php echo $param_ar;?>"></i>
                        <div class="timeline-item">
                            <h3 class="timeline-header noborder-"><a href="#">Ingreso</a></h3>
                        </div>
                    </div>
                    <!-- END timeline item -->
                    <!-- timeline item -->
                    <div>
                        <i class="fas <?php echo $param_ld;?>"></i>
                        <div class="timeline-item">
                            <h3 class="timeline-header "><a href="#">Salida a Ruta</a></h3>
                        </div>
                    </div>
                    <!-- END timeline item -->
                    <!-- timeline item -->
                    <div>
                        <i class="fas <?php echo $param_final;?>"></i>
                        <div class="timeline-item">
                            <h3 class="timeline-header no-border"><a href="#"><?php echo $des_final;?></a></h3>
                        </div>
                    </div>
                    <?php ?>
                    <div>
                        <i class="fas fa-clock bg-gray"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card-orange">
                    <img class="img-fluid pad" src="vista/imgs/acuse.jpg" alt="Recolección">
                    <p>Imágen de recolección</p>
                </div>

                <div class="card-orange">
                    <img class="img-fluid pad" src="vista/imgs/acuse.jpg" alt="Entrega">
                    <p>Imágen de Entrega</p>
                </div>
            </div>
            <!-- /.col -->
        </div>

    </div>
        <!-- /.timeline -->
</section>
<!-- /.content -->

<div class="row">
    <div class="col-md-12">
        <!-- Box Comment -->
        <div class="card card-widget">
            <div class="card-header">
                <span class="card-title">Información de env&iacute;o</span>
                <!-- /.user-block -->
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                        </button>
                    </div>
                    <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                 <div class="row mb-12">
                    <div class="col"><b>ORDEN: </b><?php echo " ".$id_orden;?></div>
                    <div class="col"><b>VI&Ntilde;ETA: </b><?php echo " ".$barra;?></div>
                    <div class="col"><b>TIPO: </b><?php echo " ".$tipo_envio;?></div>
                    <div class="col"><b>CARACTERISTICAS: </b><?php echo " ".$categoria;?></div>
                </div>
                <br>
                <div class="row mb-6">
                    <div class="col"><b>DE: </b><?php echo " ".$ori_ccosto;?></div>
                    <div class="col"><b>PARA: </b><?php echo " ".$des_ccosto;?></div>
                </div>
                <div class="row mb-6">
                    <div class="col"><b>REMITENTE:</b> <?php echo " ".$id_usr;?></div>
                    <div class="col"><b>DESTINATARIO: </b><?php echo " ".$destinatario;?></div>
                </div>
                <br>
                <?php
                    //Movimientos Envio
                    $sql=$db->mov_completo($barra);

                    while ($row=$sql->fetch(PDO::FETCH_NUM))
                    { 
                ?>
                   <p><span class="description"><?php echo $row[8]." : <b>".$row[3]."</b>"; ?></span></p>
                    <!-- /.card-body -->
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
</div>

<!-- Main row -->
<div class="row">
        <!-- Left col -->
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Coordenadas de fin de proceso</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="d-md-flex">
                <div class="p-1 flex-fill" style="overflow: hidden">
                  <!-- Map will be created here -->
                  <div id="world-map-markers" style="height: 325px; overflow: hidden">
                    <div class="map">

                      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d36735.391016478556!2d-90.5269779011658!3d14.58012972001122!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8589a3ec427650ff%3A0xc4e8a64136d7a539!2sZone%2014%2C%20Guatemala%20City%2C%20Guatemala!5e0!3m2!1sen!2ssv!4v1609364277988!5m2!1sen!2ssv" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                    </div>
                  </div>
                </div>
                <div class="card-pane-right bg-navy pt-2 pb-2 pl-4 pr-4">
                  <div class="description-block mb-4">
                    <div class="sparkbar pad" data-color="#fff">latitud</div>
                    <h5 class="description-header"></h5>
                    <span class="description-text">Latitud</span>
                  </div>
                  <!-- /.description-block -->
                  <div class="description-block mb-4">
                    <div class="sparkbar pad" data-color="#fff">longitud</div>
                    <h5 class="description-header"></h5>
                    <span class="description-text">Longitud</span>
                  </div>
                    <!-- /.description-block -->
                  <div class="description-block">
                    <div class="sparkbar pad" data-color="#fff">Altura</div>
                    <h5 class="description-header"></h5>
                    <span class="description-text">Altura</span>
                  </div>
                  <!-- /.description-block -->
                </div><!-- /.card-pane-right -->
              </div><!-- /.d-md-flex -->
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
</div>
<?php 
 }else{
?>

<div class="card-body">
    <div class="row mb-12">
        <div class="col"><font color='red'>VI&Ntilde;ETA CONSULTADA NO REGISTRADA EN SISTEMA</font></div>
    </div>
    <div class="row mb-12">
        <div class="col"><a href="index.php?prc=movimientos">Retornar</a></div>     
    </div>
    <br>
</div>
<?php
 }
?>