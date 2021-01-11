<?php

ini_set ("display_errors","1" );
error_reporting(E_ALL);
echo "1;";
/*Incluimos el fichero de la clase*/
require 'db.php';
 echo "2";
//$mi = new Db;
 
/*Creamos la instancia del objeto. Ya estamos conectados*/
$bd=Db::getInstance();
 echo "3";

$sql_1="SELECT * FROM usuario";
 
$stmt=$bd->consultar($sql_1);
  echo "4";
/*Realizamos un bucle para ir obteniendo los resultados*/
while ($row=$bd->obtener_fila($stmt,0)){
	 echo "5";
	echo $row['cod_usuario'].'<br />';
}
print_r($row);
 echo "6";
?>
