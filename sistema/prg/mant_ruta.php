<?php
//ini_set("display_errors", "1");
//error_reporting(E_ALL);
include('../model/model_con.php');
$id_ruta          = $_POST["id_ruta"];
$nombre_ruta      = $_POST["nombre_ruta"];
$des_ruta         = $_POST["des_ruta"];

$db = new model_con();

if($nombre_ruta=='' || $nombre_ruta ==NULL){
    $retorno = "Nombre de ruta esta vacio";
    $sql="";
}elseif($des_ruta=='' || $des_ruta ==NULL){
    $retorno = "Descripcion de ruta esta vacio";
    $sql="";
}else{
    $sql = $db->ing_ruta($id_ruta,$nombre_ruta,$des_ruta);

    if($sql=='Insertado'){
        $retorno = "200-".$sql."-".$id_ruta;

    }else{
        $retorno = "400-Error en mant_ruta : ".$sql;
    }
}
echo $retorno."-".$sql;
?>