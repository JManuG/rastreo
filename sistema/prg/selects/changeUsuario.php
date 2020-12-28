<?php
//ini_set ("display_errors","1" );
//error_reporting(E_ALL);
//include('../model/model_con.php');
include('../../../class/db.php');
$dbp=Db::getInstance();

$id_usr=$_POST["id_usr"];

$sql="SELECT * FROM usuario WHERE id_usr='$id_usr' AND estado=1";

$stmt=$dbp->consultar($sql);
while ($row=$stmt->fetch(PDO::FETCH_NUM)){
    $id_usr     =trim($row[0]); 
    $usr_cod    =trim($row[1]); 
    $usr_pass   =trim($row[2]); 
    $usr_nombre =trim($row[3]); 
    $cli_codigo =trim($row[4]); 
    $id_grupo   =trim($row[5]); 
    $nivel      =trim($row[6]); 
    $depto      =trim($row[7]); 
    $id_ccosto  =trim($row[8]); 
    $area       =trim($row[9]); 
    $producto   =trim($row[10]); 
    $posicion   =trim($row[11]);

    echo "200-".$id_usr."-".$usr_cod."-".$usr_nombre."-".$id_grupo."-".$nivel."-".$depto."-".$id_ccosto."\n";
    //echo $cname." ZWX ".$dir." ZWX ".$tel."\n";
}
?>