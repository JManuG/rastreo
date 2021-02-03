<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("db_extend.php");
$x1=new model_con();

$postdata = json_decode(file_get_contents("php://input"));

$barra=$_GET['barra'];
$imagen=$postdata->image;


$x2=$x1->carga_img('ENTREGA',$barra,$imagen);

$return=array(
    'status'=>'200',
    'descripcion'=>'imagen ingresada con exito'
);

echo json_encode($return);
?>