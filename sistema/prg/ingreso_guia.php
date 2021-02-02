<?php
//ini_set ("display_errors","1" );
//error_reporting(E_ALL);
include('../model/model_con.php');
//$texto = preg_replace('([^A-Za-z0-9 ])', ' ', $texto);

$ccosto_ori     =$_POST["ccosto_ori"];//preg_replace('([^A-Za-z0-9 ])', ' ', $_POST["ccosto_ori"]);
$ccosto_des     =$_POST["id_ccosto"];//preg_replace('([^A-Za-z0-9 ])', ' ', $_POST["id_ccosto"]);//ccosto_des
$destinatario   =preg_replace('([^A-Za-z0-9 ])', '', $_POST["destinatario"]);
$descripcion    =preg_replace('([^A-Za-z0-9 ])', '', $_POST["descripcion"]);
//ultimos add
$tipo_envio     =preg_replace('([^A-Za-z0-9 ])', '', $_POST["tipo_envio"]);
$des_direccion  =preg_replace('([^A-Za-z0-9 ])', '', $_POST["des_direccion"]);
$id_cat         =$_POST["id_cat"];//preg_replace('([^A-Za-z0-9 ])', '', $_POST["id_cat"]);
$ccosto_nombre  =preg_replace('([^A-Za-z0-9 ])', '', $_POST["ccosto_nombre"]);
$agencia        =preg_replace('([^A-Za-z0-9 ])', '', $_POST["agencia"]);

$db=new model_con();

$vineta= $db->consulta_correlativo();

if($ccosto_ori=='' || $ccosto_ori ==NULL){
    $retorno = "Centro costo origen esta vacio";
    $sql="";
}elseif(($ccosto_des=='' || $ccosto_des ==NULL) && $tipo_envio !='E'){
    $retorno = "Centro costo destino esta vacio<br>Env&iacute;o marcado como Interno";
    $sql="";
}elseif($destinatario=='' || $destinatario ==NULL){
    $retorno = "Destinatario esta vacio";
    $sql="";
}elseif($descripcion=='' || $descripcion ==NULL){
    $retorno = "La descripcion esta vacia";
    $sql="";
}elseif($id_cat=='' || $id_cat ==NULL){
    $retorno = "Ingrese una categoria valida, seleccione una de la lista";
    $sql="";
}elseif($des_direccion=='' || $des_direccion ==NULL){
    $retorno = "Direcci&oacute;n destino esta vacia";
    $sql="";
}else{
    //Para efecto de envios EXTERNOS se colocara como ccosto_des = 1, el codigo 1 quedaria reservado para ccosto_externo

    if($tipo_envio=='E'){
        $ccosto_des=1;
    }else{
        $ccosto_des=$ccosto_des;
    }

    $con=$db->d_acuse($vineta,$tipo_envio,$destinatario,$ccosto_des,$ccosto_nombre,$des_direccion,$agencia,$descripcion,$id_cat);
    $sql=$db->registra_envio($ccosto_ori,$ccosto_des,$destinatario,$descripcion,$vineta,$tipo_envio,$des_direccion,$id_cat);


    if (intval($sql)>0)
    {

        $retorno="200-Ingresado correctamente $con -".$ccosto_ori."-".$ccosto_des."-".$destinatario."-".$descripcion."-".$vineta."-".$con;

        //$db->consultar($con);

    }else{
        $retorno="409-".$sql;
    }
}

echo $retorno.$con."-".$sql;


