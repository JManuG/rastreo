<?php

header('Strict-Transport-Security: max-age=15552000; includeSubDomains;');
$postdata = json_decode(file_get_contents("php://input"));

$latitud=$postdata->latitud;
$longitud=$postdata->longitud;
$mj=$postdata->mj;
$accuracy=$postdata->accuracy;
$altitude=$postdata->altitude;
$heading =$postdata->heading;
$speed =$postdata->speed;
$speedacurracy =$postdata->speedacurracy;
list($fecha,$tiempo) =explode(" ",$postdata->fecha); /// 01/01/1001 00:00:00


include("db_extend.php");
$x1=new model_con1();

$x1->gps_mensajero($longitud,$latitud,$mj,$accuracy,$altitude,$heading,$speed,$speedacurracy,$fecha,$tiempo);

$f=array(
    'status'=>'200',
    'informe'=>'pocision guardada'
);
echo json_encode($f);


?>