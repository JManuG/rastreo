<?php
$postdata = json_decode(file_get_contents("php://input"));

$pedido=$postdata->pedido;
$proceso=$postdata->proceso;
$descripcion=$postdata->descripcion;
$latitudlongitud=$postdata->latitudlongitud;
$longitud=$postdata->longitud;
$tiempo=$postdata->tiempo;
$resurce=$postdata->resource;
$userid=$postdata->userid;

include("db_extend.php");
$x1=new model_con();

$guia=$x1->guiaup($proceso,$pedido);

foreach($guia as $row) {
    $id_guia=$row->id_guia;
}
list($fecha,$tiempo) = explode(" ", $tiempo);
$data_time=$fecha." ".$tiempo;

$marca=time();

if($proceso=='6' or $proceso=='8'){$pro='4';}
if($proceso=='4'){$pro='2';}
else{$pro=0;}

$x2=$x1->movimeintoup($id_guia,$userid,$fecha, $data_time, $marca, $proceso);

$x2=$x1->recursoup($proceso,$longitud,$longitud,$fecha,$data_time,$resurce,$userid,$pro);


?>
