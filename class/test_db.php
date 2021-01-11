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

$sql_1="SELECT 
                a.id_usr, 
                a.usr_cod, 
                a.usr_pass, 
                a.usr_nombre, 
                a.cli_codigo, 
                a.id_grupo, 
                a.nivel, 
                a.depto, 
                a.id_ccosto, 
                a.area, 
                a.producto, 
                a.posicion, 
                a.estado, 
                a.dias_vencimiento, 
                c.cli_nombre, 
                c.cli_direccion,
                cc.ccosto_codigo, 
                cc.ccosto_nombre, 
                cc.ccosto_telefono 
            FROM usuario a 
            INNER JOIN cliente c 
            ON a.cli_codigo=c.cli_id
            INNER JOIN centro_costo cc 
            ON a.id_ccosto=cc.id_ccosto";
 
$stmt=$bd->consultar($sql_1);
  echo "4";
/*Realizamos un bucle para ir obteniendo los resultados*/
while ($row=$bd->obtener_fila($stmt,0)){
	 echo "5";
	echo $row[0].'<br />';
}
print_r($row);
 echo "6";
?>
