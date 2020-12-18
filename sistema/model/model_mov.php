<?php
//model model_mov
//modelo de movimientos QR
//
if (file_exists('track/class/db2.php'))
{
require ('track/class/db2.php'); //Habilitando conexion
}elseif(file_exists('class/db2.php'))
{
require ('class/db2.php'); //Habilitando conexion
}
class model_mov extends dbp
{

	public function __construct()
	{
		//$dbp=dbp::getInstance();
	}
 
	public function cabecera(){
		$bd=dbp::getInstance();
		$consulta = $bd->consultar("");
		return $consulta;
	}
	
	public function consulta_cuenta($cuenta){
		$dbp=dbp::getInstance();
		$shi_codigo=$_SESSION['shi_codigo'];
		
		$consulta= $dbp->consultar("	select * from cliente
						where shi_codigo='".$shi_codigo."'
						and gui_llave='".trim($cuenta)."'
						");
	return $consulta;
	}
	
	public function detalle_cuenta_qr($guia,$id_referencia)
	{
	$dbp=dbp::getInstance();

	$sql="
	select * from detalle_cuenta
	where barra='$guia'
	and referencia='$id_referencia'
	";
	//echo $sql;
	$data= $dbp->consultar($sql);

	return $data;
	}

	public function detalle_cuenta_qr2($guia)
	{
	$dbp=dbp::getInstance();

	$sql="
	select * from detalle_cuenta
	where barra='$guia'
	";
	//echo $sql;
	$data= $dbp->consultar($sql);

	return $data;
	}


	public function consulta_municipio($mun)
	{

	$dbp=dbp::getInstance();
	$consulta= $dbp->consultar("	select * from ruta_destino
		where municipio='".strtoupper(trim($mun))."'");
		return $consulta;
	}

	public function detalle_shipper($shi)
	{
	$dbp=dbp::getInstance();
	$consulta= $dbp->consultar("select * from shipper where shi_codigo='".(trim($shi))."'");
	return $consulta;
	}

	
public function llave_consulta($llave)
{
$dbm=dbp::getInstancem();

$consulta="select guia,referencia
from llaves_consulta
where llave='".$llave."'
";
//echo $consulta;
$ejecutar= $dbm->consultam($consulta);

while($item = $dbm->fetchm($ejecutar))
{
$guia		=$item[0];
$referencia	=$item[1];
}
return $guia."-".$referencia;
}




public function consulta_referencia($cli_codigo)
{
$dbp=dbp::getInstance();
$cli_codigo_int=0;
if(is_numeric($cli_codigo)) {
$cli_codigo_int=$cli_codigo;
}

$referencia=0;
$consulta_guia2="
select * from guia_referen
where (barra ='$cli_codigo_int' or referencia='$cli_codigo')
order by rowid desc
";
$consulta= $dbp->consultar($consulta_guia2);
//echo $consulta_guia2;
while($item = $dbp->fetch($consulta))
{
$referencia=$item[0];
}

return $referencia;
}


public function consulta_detalle_cuenta($ref)
{
$dbp=dbp::getInstance();

$referencia=0;
$consulta_guia2="
select * from detalle_cuenta
where referencia='".$ref."'
order by rowid desc";
$consulta= $dbp->consultar($consulta_guia2);
//echo $consulta_guia2;
while($item = $dbp->fetch($consulta))
{
$referencia=$item[1];
}

return $referencia;
}


public function consulta_guia_detalle($barra)
{
$dbp=dbp::getInstance();

$consulta_guia="
select gui_llave from guia_detalle
where barra='$barra'
";

$consulta= $dbp->consultar($consulta_guia);

while($item = $dbp->fetch($consulta))
{
$guia_detalle=$item[0];
}

return $guia_detalle;

}


public function consulta_movimientos($gui_llave)
{
$dbp=dbp::getInstance();

$consulta_movimiento="
select a.* from
movimiento a
where a.gui_llave='".trim($gui_llave)."'
order by a.aud_fecha_proc,a.aud_hora_proc,a.rowid";

$consulta= $dbp->consultar($consulta_movimiento);

return $consulta;
}



public function consulta_chk_detalle($chk)
{
$dbp=dbp::getInstance();

$consulta_guia="
select chk_descripcion from chk_id
where chk_codigo='".$chk."'
";

$consulta= $dbp->consultar($consulta_guia);

while($item = $dbp->fetch($consulta))
{
$descripcion=$item[0];
}

return $descripcion;

}



public function consulta_origen_destino($gui_llave)
{
$dbp=dbp::getInstance();

$consulta_guia="
select cod_sucursal_ori,cod_sucursal_des from guia_detalle
where gui_llave='$gui_llave'
";

$consulta= $dbp->consultar($consulta_guia);

while($item = $dbp->fetch($consulta))
{
$cod_sucursal_ori=$item[0];
$cod_sucursal_des=$item[1];
}

return $cod_sucursal_ori."-".$cod_sucursal_des;

}





















	
}
?>