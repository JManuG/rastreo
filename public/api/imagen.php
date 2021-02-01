<?php
include("db_extend.php");
$x1=new model_con();

$postdata = json_decode(file_get_contents("php://input"));

$barra=$_GET['barra'];
$imagen=$postdata->image;

$x2=$x1->carga_img('ENTREGA',$barra,$imagen);

?>