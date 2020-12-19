<?php
//model model_con
//0430080126
//
ini_set('post_max_size','100M');
ini_set('upload_max_filesize','100M');
ini_set('max_execution_time','1000');
ini_set('max_input_time','1000');

include('../../class/db.php');

class model_con extends Db
{
	public function __construct(){
		$db=Db::getInstance();
	}

	public function registra_envio($ccosto_ori,$ccosto_des,$destinatario,$descripcion,$vineta){
		$db=Db::getInstance();
		
		$date1=date('d/m/Y');
		//echo "Fecha 1: ".$date1."<br>";
		$date2=date('d/m/Y H:i:s');
		//echo "Fecha 2: ".$date2;
		$tiempo=time();
		$orden=1;
        $numero_guia=0;
		$sql_c = "SELECT id_guia 
					FROM guia 
					WHERE ccosto_ori='$ccosto_ori' 
					AND ccosto_des='$ccosto_des'
					AND fecha_date='$date1'";
		
		$c= $db->consultar($sql_c);
		while ($row=$c->fetch(PDO::FETCH_NUM))
		{
			$gui_anterior       =$row[0];
			$numero_guia	    =$gui_anterior+1;
		}

		if(intval($numero_guia)==0)
		{
			$numero_guia=0;
		}

		$insert="INSERT INTO guia (id_guia, id_envio, ori_ccosto, des_ccosto, estado,id_usr, fecha_date, fecha_datetime, tiempo, char1, entero1, id_orden, barra, comentario) 
					VALUES($numero_guia,'$id_envio', '$ccosto_ori', '$ccosto_des', '1', '$usr', '$date1', '$date2', '$tiempo', '',0, '$orden','$vineta', '$descripcion')";
		echo $insert;	
		$insert1= $db->consultar($insert);
		return $numero_guia;
	}

	public function ing_agencia($cli_id,$id_agencia,$codigo_agencia,$nombre_agencia,$direccion_agencia,$telefono_agencia){
		$db=Db::getInstance();
		
		$date=date('Y/m/d');
		$datetime=date('Y/m/d H:i:s');
		$tiempo=time();
		//$id_usr=$_SESSION['cod_usuario'];
		$id_usr=1;

		//Se valida que el codigo de la agencia venga lleno para insertar sino es un update
		if($id_agencia==''){
			//Insert
			$sql="INSERT INTO rastreo.agencia
								(id_agencia,
								cli_id,
								agencia_codigo,
								agencia_nombre,
								agencia_direccion,
								agencia_telefono,
								agencia_estado,
								char1,
								entero1,
								id_usr,
								fecha_date,
								fecha_datetime,
								tiempo)
					VALUES (0,
							'$cli_id',
							'$codigo_agencia',
							'$nombre_agencia',
							'$direccion_agencia',
							'$telefono_agencia',
							1,
							NULL,
							NULL,
							'$id_usr',
							'$date',
							'$datetime',
							'$tiempo'
							)";

		}else{
			//Update
			$sql="UPDATE rastreo.agencia
					SET agencia_codigo='$codigo_agencia',
						agencia_nombre='$nombre_agencia',
						agencia_direccion='$direccion_agencia',
						agencia_telefono='$telefono_agencia'
					WHERE id_agencia='$id_agencia'";
		}

		//echo $sql;	
		$stmt= $db->preparar($sql);
		//echo '<pre>';
		//print_r($stmt);
		//echo '</pre>';
		if($stmt->execute()){
			$msj="Insertado";
		}else{
			$msj="Error";
		}
		//echo $msj;
		return $msj;
	}
}