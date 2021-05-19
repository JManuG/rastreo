<?php
//ini_set ("display_errors","1" );
//error_reporting(E_ALL);
//include('../model/model_con.php');
include('../../../class/db.php');
$dbp=Db::getInstance();

$id_ruta=$_POST["id_ruta"];
$existe          =0;

$sql="SELECT fn_rutaNombre(rd.id_ruta),
             fn_agenciaNombre(rd.id_agencia),
             hora_ini,
             hora_fin,
             id_periodicidad
      FROM ruta r INNER JOIN ruta_detalle rd
      ON r.id_ruta=rd.id_ruta
      WHERE r.id_ruta='$id_ruta' 
      AND r.estado=1";

$stmt=$dbp->consultar($sql);
while ($row=$stmt->fetch(PDO::FETCH_NUM)){
   $id_ruta         =$row[0]; 
   $nombre          =$row[1]; 
   $hora_ini        =$row[2];
   $hora_fin        =$row[3];
   $periodicidad    =$row[4]; 
   $existe          =1;

   $var .="Ruta: ".$id_ruta." Agencia: ".$nombre." Hora Ini: ".$hora_ini." Hora Fin: ".$hora_fin."<br>";
   //echo $cname." ZWX ".$dir." ZWX ".$tel."\n";
}

if($existe==1){
   echo "200-".$var."\n";
}
?>