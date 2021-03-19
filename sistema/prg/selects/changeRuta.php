<?php
//ini_set ("display_errors","1" );
//error_reporting(E_ALL);
//include('../model/model_con.php');
include('../../../class/db.php');
$dbp=Db::getInstance();

$id_ruta=$_POST["id_ruta"];

$sql="SELECT * FROM ruta WHERE id_ruta='$id_ruta'";

$stmt=$dbp->consultar($sql);
while ($row=$stmt->fetch(PDO::FETCH_NUM)){
   $id_ruta         =$row[0]; 
   $nombre          =$row[1]; 
   $descripcion     =$row[2]; 

   echo "200-".$id_ruta."-".$nombre."-".$descripcion."\n";
   //echo $cname." ZWX ".$dir." ZWX ".$tel."\n";
}
?>