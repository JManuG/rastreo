<?php
///ini_set("display_errors", "1");
///error_reporting(E_ALL);
include('../model/model_con.php');
$id_ruta          = $_POST["id_ruta"];
$id_mensajero     = $_POST["id_mensajero"];

$db = new model_con();

if($id_ruta=='-' || $id_ruta ==NULL){
    $retorno = "Seleccione una ruta creada";
    $sql="";
}elseif($id_mensajero=='-' || $id_mensajero ==NULL){
    $retorno = "Seleccione un mensajero valido";
    $sql="";
}else{
    $sql = $db->ing_progra($id_ruta,$id_mensajero);

    if($sql=='Insertado'){
        $retorno = "200-".$sql."-".$id_ruta;

    }else{
        $retorno = "400-Error en proc_progra : ".$sql;
    }
}

//echo $retorno."-".$sql;
echo $retorno."-".$sql;
?>