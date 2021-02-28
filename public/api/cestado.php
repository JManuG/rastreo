<?php
header('Strict-Transport-Security: max-age=0;');
$postdata = json_decode(file_get_contents("php://input"));

$pedido=$postdata->pedido;
$proceso=$postdata->proceso;
$descripcion=$postdata->descripcion;
$latitude=$postdata->latitude;
$longitude=$postdata->longitude;
$tiempo=$postdata->tiempo;
$resurce=$postdata->resource;
$userid=$postdata->userid;

if($proceso==6 ){$pro=4;}
if($proceso==8){$pro=5;}
if($proceso==5){$pro=3;}
if($proceso==4){$pro=2;}
//else{$pro=0;}

//print_r($postdata);
include("db_extend.php");
$x1=new model_con();

$x1->guiaup($pro,$pedido);

$gui=$x1->obtener_guia($pedido);

while ($row=$gui->fetch(PDO::FETCH_ASSOC))
{
    $gi= $row['id_guia'];
    $id_envio=$row['id_envio'];
}



list($fecha,$tiempo) = explode(" ", $tiempo);
$data_time=$fecha." ".$tiempo;

$marca=time();

/*if($proceso==6 or $proceso==8){$pro=4;}
if($proceso==5){$pro=3;}
if($proceso==4){$pro=2;}*/
//else{$pro=0;}

/**/

$x2=$x1->movimeintoup($gi,$userid,$fecha, $data_time, $marca, $pro, $descripcion);

$mov=$x1->obtener_movimeinto($pedido,$gi,$pro);

while ($row=$mov->fetch(PDO::FETCH_ASSOC))
{

    $mv= $row['max(id_movimiento)'];
}

$x1->manifiestoup($id_envio);


$x2=$x1->recursoup($pedido,$latitude,$longitude,$fecha,$data_time,$resurce,$userid,$pro,$marca,$mv);
//echo "--".$proceso."---".$pro;
/**/
?>
