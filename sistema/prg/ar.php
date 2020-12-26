<?php
//ini_set ("display_errors","1" );
//error_reporting(E_ALL);
include('../model/model_con.php');
$vineta = $_POST["vineta"];

$db = new model_con();

$consulta = $db->consulta_vineta($vineta);



if (intval($consulta) > 0) {
    $retorno = "200-Vi&ntilde;eta ingresada correctamente -" . $ccosto_ori . "-" . $ccosto_des . "-" . $destinatario . "-" . $descripcion . "-" . $vineta;

} else {
    $retorno = "409-" . $insert;
}
echo $retorno;