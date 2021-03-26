<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include('db_extend.php');
$x1=new model_con();
//$sql = "SHOW TABLES FROM rastreo";
//$sql = "select * from agencia";
//$sql = "select * from categoria";
//$sql = "select * from centro_costo where id_ccosto=381";
//$sql = "select * from chk_id";
//$sql = "select * from cliente";
//$sql = "select * from correlativo";
//$sql = "select id_envio from manifiesto_linea";
//$sql = "select * from manifiesto";
//$sql = "select * from guia";
//$sql = "select * from mensajero";
//$sql = "select * from recurso";
//$sql = "select * from movimiento" ;
//$sql = "select * from orden";
//$sql = "select * from recurso";
//$sql = "select * from usuario where id_usr=4";
//$sql = "select * from zona";

/*$sql="UPDATE rastreo.guia
						SET estado=3
						WHERE id_envio='104317'";*/

date_default_timezone_set("America/Guatemala");

$date=date('Y/m/d');
$date2	=date('Y/m/d H:i:s');

echo $date2;

?>