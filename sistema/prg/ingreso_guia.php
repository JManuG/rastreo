<?php
//ini_set ("display_errors","1" );
//error_reporting(E_ALL);
include('../model/model_con.php');

$ccosto_ori     =$_POST["ccosto_ori"];
$ccosto_des     =$_POST["id_ccosto"];//ccosto_des
$destinatario   =$_POST["destinatario"];
$descripcion    =$_POST["descripcion"];
$vineta         =$_POST["vineta"];

$db=new model_con();

if($ccosto_ori=='' || $ccosto_ori ==NULL){
    $retorno = "Centro costo origen esta vacio";
    $sql="";
}elseif($ccosto_des=='' || $ccosto_des ==NULL){
    $retorno = "Centro costo destino esta vacio";
    $sql="";
}elseif($destinatario=='' || $destinatario ==NULL){
    $retorno = "Destinatario esta vacio";
    $sql="";
}elseif($descripcion=='' || $descripcion ==NULL){
    $retorno = "La descripcion esta vacia";
    $sql="";
}elseif($vineta=='' || $vineta ==NULL){
    $retorno = "Ingrese una vi&ntilde;eta valida";
    $sql="";
}else{
    $sql=$db->registra_envio($ccosto_ori,$ccosto_des,$destinatario,$descripcion,$vineta);

    if (intval($sql)>0)
    {
        $retorno="200-Vi&ntilde;eta ingresada correctamente -".$ccosto_ori."-".$ccosto_des."-".$destinatario."-".$descripcion."-".$vineta;
    
    }else{
        $retorno="409-".$sql;
    }
}

echo $retorno."-".$sql;


