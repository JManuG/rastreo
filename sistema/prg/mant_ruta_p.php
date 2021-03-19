<?php
///ini_set("display_errors", "1");
///error_reporting(E_ALL);
include('../model/model_con.php');
$id_ruta          = $_POST["id_ruta"];
$id_agencia       = $_POST["id_agencia"];
$hora_ini         = $_POST["hora_ini"];
$hora_fin         = $_POST["hora_fin"];
$comentario       = $_POST['comentario'];

$db = new model_con();

if($id_ruta=='-' || $id_ruta ==NULL){
    $retorno = "Seleccione una ruta creada";
    $sql="";
}elseif($id_agencia=='-' || $id_agencia ==NULL){
    $retorno = "Seleccione una agencia creada";
    $sql="";
}elseif($hora_ini=='-' || $hora_ini ==NULL){
    $retorno = "Seleccione una hora de inicio";
    $sql="";
}elseif($hora_fin=='-' || $hora_fin ==NULL){
    $retorno = "Seleccione una hora final";
    $sql="";
}else{
    $sql = $db->ing_ruta_p($id_agencia,$comentario,$hora_ini,$hora_fin,$id_ruta);

    if($sql=='Insertado'){
        $retorno = "200-".$sql."-".$id_ruta;

    }else{
        $retorno = "400-Error en mant_ruta_p : ".$sql;
    }
}

//echo $retorno."-".$sql;
echo $retorno."-".$sql;
?>