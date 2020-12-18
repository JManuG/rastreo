<?php

ini_set ("display_errors","1" );
error_reporting(E_ALL);

/*Incluimos el fichero de la clase*/
require 'db.php';
 
//$mi = new Db;
 
/*Creamos la instancia del objeto. Ya estamos conectados*/
$bd=Db::getInstance();
 
 /*Creamos una consulta sencilla de los CHK*/
$sql='SELECT cod_chk FROM chk';
 
/*Ejecutamos la consulta*/
$stmt=$bd->consultar($sql);


 
/*Realizamos un bucle para ir obteniendo los resultados*/
while ($row=$bd->obtener_fila($stmt,0)){
	echo $row['cod_chk'].'<br />';
}

$sql_1="SELECT cod_usuario FROM usuario";
 
$stmt=$bd->consultar($sql_1);
 
/*Realizamos un bucle para ir obteniendo los resultados*/
while ($row=$bd->obtener_fila($stmt,0)){
	echo $row['cod_usuario'].'<br />';
}

?>