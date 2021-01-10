<?php
//model model_mov
//modelo de movimientos QR
//
ini_set('post_max_size','100M');
ini_set('upload_max_filesize','100M');
ini_set('max_execution_time','1000');
ini_set('max_input_time','1000');

include('../../class/db.php');

class model_mov extends Db
{
	public function __construct()
	{
		$db=Db::getInstance();
	}

	public function mov_completo($barra)
    {
        $db=Db::getInstance();
        $msg="";
        $date1=date('Y-m-d');
        $date2=date('Y-m-d H:i:s');
    
        $tiempo=time();
        $orden=1;
        $existe_usr=0;

		$sql = "SELECT m.id_movimiento,
						m.id_envio,
						m.id_chk,
						m.descripcion,
						m.id_zona,
						m.id_mensajero,
						m.id_usr,
						m.fecha_date,
						m.fecha_datetime,
						fn_ccostoNombre(g.ori_ccosto) as ori_ccosto,
						fn_ccostoNombre(g.des_ccosto) as des_ccosto,
						g.id_orden,
						g.barra,
						g.destinatario,
						g.des_direccion,
						g.comentario
				FROM rastreo.movimiento m
				INNER JOIN rastreo.guia g
				ON g.id_guia=m.id_envio
				WHERE g.barra='$barra'";

		$stmt=$db->consultar($sql);
		//echo $sql;
		return $stmt;
	}

	public function mov_enca($barra)
    {	
        $db=Db::getInstance();
        $msg="";
        $date1=date('Y-m-d');
        $date2=date('Y-m-d H:i:s');
    
        $tiempo=time();
        $orden=1;
        $existe_usr=0;

		$sql = "SELECT id_guia,
						id_envio,
						fn_ccostoNombre(ori_ccosto) as ori_ccosto,
						fn_ccostoNombre(des_ccosto) as des_ccosto,
						estado,
						fn_usrNombre(id_usr) as id_usr,
						fecha_date,
						fecha_datetime,
						tiempo,
						CASE char1 WHEN 'E' THEN 'EXTERNO' WHEN 'I' THEN 'INTERNO' END AS tipo_envio,
						fn_catNombre(entero1) as categoria,
						id_orden,
						barra,
						comentario,
						destinatario,
						des_direccion
				FROM rastreo.guia 
				WHERE barra='$barra'";

		$stmt=$db->consultar($sql);
		//echo $sql;
		return $stmt;
	}

	public function mov_tl($barra)
    {
        $db=Db::getInstance();
        $msg="";
        $date1=date('Y-m-d');
        $date2=date('Y-m-d H:i:s');
    
        $tiempo=time();
        $orden=1;
        $existe_usr=0;

		$sql = "SELECT m.id_movimiento,
						m.id_envio,
						m.id_chk,
						m.descripcion,
						m.id_zona,
						m.id_mensajero,
						m.id_usr,
						m.fecha_date,
						m.fecha_datetime,
						fn_ccostoNombre(g.ori_ccosto) as ori_ccosto,
						fn_ccostoNombre(g.des_ccosto) as des_ccosto,
						g.id_orden,
						g.barra,
						g.destinatario,
						g.des_direccion,
						g.comentario
				FROM rastreo.movimiento m
				INNER JOIN rastreo.guia g
				ON g.id_guia=m.id_envio
				WHERE g.barra='100006'";

		$stmt=$db->consultar($sql);
		//echo $sql;
		return $stmt;
	}
	
	
}
?>