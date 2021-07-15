<?php

$f1=$_GET['f1'];
$f2=$_GET['f2'];

//echo $f1."------>".$f2;

include("historico.php");

$nivel=$_SESSION['nivel'];


$x1= new historico_ingresos();

$x1->rep_historico_full($f1,$f2);

?>
