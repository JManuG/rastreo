<?php
//ini_set("display_errors", "1");
//error_reporting(E_ALL);
include('../model/model_con.php');

$llave              = time();
$cli_id             = $_POST["cli_id"];

$db = new model_con();

//Creacion de OS
$sql = $db->procesar_OS($id_cli);

if($sql=='Insertado'){
    $retorno = "200-".$sql."-".$id_cli;

}else{
    $retorno = "400-Error en proc_OS : ".$sql;
}

echo $retorno;

?>

