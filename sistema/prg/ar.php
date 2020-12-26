<?php
//ini_set ("display_errors","1" );
//error_reporting(E_ALL);
include('../model/model_con.php');
$vineta = $_POST["vineta"];

$db = new model_con();

$consulta = $db->consulta_vineta($vineta);

while ($rowd=$consulta)
{
    $id_guia        =$rowd[0];
    $id_envio       =$rowd[1];
    $ori_ccosto     =$rowd[2];
    $des_ccosto     =$rowd[3];
    $estado	        =$rowd[4];
    $id_usr	        =$rowd[5];
    $fecha_date	    =$rowd[6];
    $fecha_datetime	=$rowd[7];
    $tiempo	        =$rowd[8];
    $char1	        =$rowd[9];
    $entero1	    =$rowd[10];
    $id_orden	    =$rowd[11];
    $barra	        =$rowd[12];
    $comentario     =$rowd[13];


}


if (intval($id_guia) > 0) {
    $retorno = "200-" . $comentario . "-" . $des_ccosto . "-" . $comentario . "-" . $vineta;

} else {
    $retorno = "409 - No se encuentra la viñeta";
}
echo $retorno;