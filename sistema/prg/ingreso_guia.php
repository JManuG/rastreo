<?php
ini_set ("display_errors","1" );
error_reporting(E_ALL);
include('../model/model_con.php');

$ccosto_ori=$_POST["ccosto_ori"];
$ccosto_des=$_POST["ccosto_des"];
$destinatario=$_POST["destinatario"];
$descripcion=$_POST["descripcion"];
$vineta=$_POST["vineta"];

$db=new model_con();

$insert=$db->registra_envio($ccosto_ori,$ccosto_des,$destinatario,$descripcion,$vineta);

$retorno="200-".$ccosto_ori."-".$ccosto_des."-".$destinatario."-".$descripcion."-".$vineta;

echo $retorno;

?>
