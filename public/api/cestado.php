<?php
$postdata = json_decode(file_get_contents("php://input"));

$pedido=$postdata->pedido;
$proceso=$postdata->proceso;
$descripcion=$postdata->descripcion;
$latitudlongitud=$postdata->latitudlongitud;
$longitud=$postdata->longitud;
$tiempo=$postdata->tiempo;
$resurce=$postdata->resource;


?>
