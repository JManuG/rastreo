
<style>
    /* Style the Image Used to Trigger the Modal */
    #myImg {
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }

    #myImg:hover {opacity: 0.7;}

    /* The Modal (background) */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
    }

    /* Modal Content (Image) */
    .modal-content {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
    }

    /* Caption of Modal Image (Image Text) - Same Width as the Image */
    #caption {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
        text-align: center;
        color: #ccc;
        padding: 10px 0;
        height: 150px;
    }

    /* Add Animation - Zoom in the Modal */
    .modal-content, #caption {
        animation-name: zoom;
        animation-duration: 0.6s;
    }

    @keyframes zoom {
        from {transform:scale(0)}
        to {transform:scale(1)}
    }

    /* The Close Button */
    .close {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
    }

    .close:hover,
    .close:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }

    /* 100% Image Width on Smaller Screens */
    @media only screen and (max-width: 700px){
        .modal-content {
            width: 100%;
        }
    }
</style>

<?php
//ini_set ("display_errors","1" );
//error_reporting(E_ALL);

//America/Guatemala

date_default_timezone_set ( 'America/Guatemala');

ini_set("date.timezone", 'America/Guatemala');

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
                    $sql_1=$db->mov_tl2($barra);
                    
                    while ($row_1=$sql_1->fetch(PDO::FETCH_NUM))
                    {
                        $id_envio   =$row_1[1];
                        $PI         =$row_1[2];
                        $AR         =$row_1[3];
                        $LD         =$row_1[4];
                        $DL         =$row_1[5];
                        $DV         =$row_1[6];

                        if(($PI)!=0){
                            $param_pi="fa-check bg-green";
                            $datetime_pi=$db->humanizando_fecha($row_1[2]);
                        }else{
                            $param_pi="fa-circle-thin bg-white";
                            $datetime_pi="";
                        }

                        if(($AR)!=0){


                            $row_imagen_ar=$db->recurso_origen($barra);
                            while ($row_ar=$row_imagen_ar->fetch(PDO::FETCH_NUM))
                            {
                                $imagen_ar=base64_encode($row_ar[0]);
                                $lat_ar=$row_ar[1];
                                $lon_ar=$row_ar[2];
                            }





                            $param_ar="fa-check bg-green";
                            $datetime_ar=$db->humanizando_fecha($row_1[3]);
                        }else{
                            $param_ar="fa-circle-thin bg-white";
                            $datetime_ar="";
                        }

                        if($LD != 0){
                            $param_ld="fa-check bg-green";
                            $datetime_ld=$db->humanizando_fecha($row_1[4]);
                        }else{
                            $param_ld="fa-circle-thin bg-white";
                            $datetime_ld="";
                        }

                        if($DL != 0){
                            $param_final="fa-check bg-green";
                            $des_final="Entrega";
                            $datetime_dl=$db->humanizando_fecha2($row_1[5]);

                            $imagen_dl="";
                            $lat_dl=0;
                            $lon_dl=0;
                            $geo_dl="";

                            $row_imagen_dl=$db->recurso_destino($barra);
                            while ($row_dl=$row_imagen_dl->fetch(PDO::FETCH_NUM))
                            {
                                $imagen_dl=$row_dl[0];
                                $lat_dl=$row_dl[1];
                                $lon_dl=$row_dl[2];
                                $geo_dl="https://www.google.com/maps/place/".$lat_dl.",".$lon_dl;
                            }


                        }elseif($DV != 0){
                            $param_final="fa-check bg-green";
                            $des_final="Devoluci&oacute;n";
                            $datetime_dl=$db->humanizando_fecha2($row_1[6]);

                            $row_imagen_dl=$db->recurso_destino($barra);
                            while ($row_dl=$row_imagen_dl->fetch(PDO::FETCH_NUM))
                            {
                                $imagen_dl=$row_dl[0];
                                $lat_dl=$row_dl[1];
                                $lon_dl=$row_dl[2];
                                $geo_dl="https://www.google.com/maps/place/".$lat_dl.",".$lon_dl;
                            }
                        }else{
                            $param_final="fa-circle-thin bg-white";
                            $des_final="Entrega";
                            $datetime_dl="";
                        }
                    }
                    ?>

                    <div>
                        <i class="fas <?php echo $param_pi;?>"></i>
                        <div class="timeline-item">
                            <h3 class="timeline-header"><a href="#">Solicitud de Env&iacute;o</a> <?php echo $datetime_pi; ?></h3>

                        </div>
                    </div>
                    <!-- END timeline item -->
                    <!-- timeline item -->
                    <div>
                        <i class="fas <?php echo $param_ar;?>"></i>
                        <div class="timeline-item">
                            <h3 class="timeline-header noborder-"><a href="#">Ingreso</a> <?php echo $datetime_ar; ?></h3>
                        </div>
                    </div>
                    <!-- END timeline item -->
                    <!-- timeline item -->
                    <div>
                        <i class="fas <?php echo $param_ld;?>"></i>
                        <div class="timeline-item">
                            <h3 class="timeline-header "><a href="#">Salida a Ruta</a> <?php echo $datetime_ld; ?></h3>
                        </div>
                    </div>
                    <!-- END timeline item -->
                    <!-- timeline item -->
                    <div>
                        <i class="fas <?php echo $param_final;?>"></i>
                        <div class="timeline-item">
                            <h3 class="timeline-header no-border"><a href="#"><?php echo $des_final;?></a> <?php echo $datetime_dl; ?>
                                <a href="<?php echo $geo_dl; ?>" target="_blank">
                                        <i class="fas fa-map-marker-alt mr-1"></i>
                                    </a>
                            </h3>
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
                    <img class="img-fluid pad" src="'data:image/jpeg;base64,<?php echo $imagen_ar;?>" alt="Recolección">
                    <p>Imágen de recolección</p>
                </div>

                <div class="card-orange">
                    <img class="img-fluid pad" src="'data:image/jpeg;base64,<?php echo $imagen_dl;?>" alt="Entrega">
                    <p>Imágen de Entrega</p>
                    <?php
                    $img = '<img id="myImg" alt="Entrega Efectiva" style="width:20%;" src="data:image/jpeg;base64,'. $imagen_dl .'" >
                    
                    <!--------------------------------------Waning-------------------------------->
                    <div id="myModal" class="modal">

                        <!-- The Close Button -->
                        <span class="close">&times;</span>

                        <!-- Modal Content (The Image) -->
                        <img class="modal-content" id="img01">

                        <div id="caption"></div>
                    </div>
                    <!--------------------------------------Waning-------------------------------->
                    <script>
                        // Get the modal
                        var modal = document.getElementById("myModal");

                        // Get the image and insert it inside the modal - use its "alt" text as a caption
                        var img = document.getElementById("myImg");
                        var modalImg = document.getElementById("img01");
                        var captionText = document.getElementById("caption");
                        img.onclick = function(){
                            modal.style.display = "block";
                            modalImg.src = this.src;
                            captionText.innerHTML = this.alt;
                        }

                        // Get the <span> element that closes the modal
                        var span = document.getElementsByClassName("close")[0];

                        // When the user clicks on <span> (x), close the modal
                        span.onclick = function() {
                            modal.style.display = "none";
                        }
                    </script>';
                    print $img;
                    ?>


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
        <div class="card card-widget collapsed-card">
            <div class="card-header">
                <span class="card-title">Información de env&iacute;o</span>
                <!-- /.user-block -->
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
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

                        if($row[2]==4||$row[2]==5||$row[3]=="ENVIO EN RUTA"||$row[3]=="ENVIO RECIBIDO POR MENSAJERO")
                        {
                            echo "<p><span class='description'>".$row[8]." : <b>".$row[3]."</b></span></p>";
                        }else{
                            echo "<p><span class='description'>".$db->correccion_fecha_hora1($row[8])." : <b>".$row[3]."</b></span></p>";
                        }
                ?>
                    <!-- /.card-body -->
                <?php
                    }
                ?>
            </div>
        </div>
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