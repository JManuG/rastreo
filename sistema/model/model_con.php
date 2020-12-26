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
	public function __construct()
	{
		$db=Db::getInstance();
	}

	public function registra_envio($ccosto_ori,$ccosto_des,$destinatario,$descripcion,$vineta)
    {
		$db=Db::getInstance();
		session_start();
		$msg="";
		$date1=date('Y-m-d');
		//echo "Fecha 1: ".$date1."<br>";
		$date2=date('Y-m-d H:i:s');
        $usr=$_SESSION['cod_user'];
		//echo "Fecha 2: ".$date2;
		$tiempo=time();
		$orden=1;
        $numero_guia=0;
		$sql_c = "SELECT max(id_guia) 
					FROM guia ";
		
		$c= $db->consultar($sql_c);
		while ($row=$c->fetch(PDO::FETCH_NUM))
		{
			$gui_anterior       =$row[0];
			$numero_guia	    =$gui_anterior+1;
		}

		$id_envio=$numero_guia;




        $sql_d = "SELECT barra
					FROM guia 
					WHERE barra='$vineta'";

        $d= $db->consultar($sql_d);
        while ($rowd=$d->fetch(PDO::FETCH_NUM))
        {
            $vin_anterior       =$rowd[0];
        }
            if(!empty($vin_anterior))
            {
                $msg=" La vi&ntilde;eta ya existe...";
            }else{

    		$insert="INSERT INTO guia (id_guia, id_envio, ori_ccosto, des_ccosto, estado,id_usr, fecha_date, fecha_datetime, tiempo, char1, entero1, id_orden, barra, comentario) 
					VALUES($numero_guia,'$id_envio', '$ccosto_ori', '$ccosto_des', '1', '$usr', '$date1', '$date2', '$tiempo', '',0, '$orden','$vineta', '$descripcion')";
	    	//echo $insert;
		    $insert1= $db->consultar($insert);
            }

		if(empty($msg)){
		    //echo $msg;
            return $numero_guia;
        }else
        {
            //echo $msg;
            return $msg;
        }


	}

	public function ing_agencia($cli_id,$id_agencia,$codigo_agencia,$nombre_agencia,$direccion_agencia,$telefono_agencia)
	{
		$db=Db::getInstance();
		session_start();
		$date		=date('Y/m/d');
		$datetime	=date('Y/m/d H:i:s');
		$tiempo		=time();
		$id_usr		=$_SESSION['cod_user'];

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

	public function ing_ccosto($id_ccosto,$cli_id,$id_agencia,$codigo_ccosto,$nombre_ccosto,$direccion_ccosto,$telefono_ccosto)
	{
		$db=Db::getInstance();
		session_start();
		$date		=date('Y/m/d');
		$datetime	=date('Y/m/d H:i:s');
		$tiempo		=time();
		$id_usr		=$_SESSION['cod_user'];

		//Se valida que el codigo del centro costo venga lleno para insertar sino es un update
		if($id_ccosto==''){
			//Insert
			$sql="INSERT INTO rastreo.centro_costo
								(
								id_ccosto, 
								id_agencia, 
								cli_id, 
								ccosto_codigo,
								ccosto_nombre, 
								centro_dirección, 
								ccosto_telefono, 
								ccosto_estado, 
								char1, 
								entero1, 
								id_usr, 
								fecha_date, 
								fecha_datetime, 
								tiempo
								)
					VALUES (0,
							$id_agencia,
							$cli_id,
							'$codigo_ccosto',
							'$nombre_ccosto',
							'$direccion_ccosto',
							'$telefono_ccosto',
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
			$sql="UPDATE rastreo.centro_costo
					SET ccosto_codigo='$codigo_ccosto',
						ccosto_nombre='$nombre_ccosto',
						centro_dirección='$direccion_ccosto',
						ccosto_telefono='$telefono_ccosto' 
					WHERE id_ccosto='$id_ccosto'
					AND ccosto_estado=1";
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


    public function consulta_vineta($vineta)
    {
        $db=Db::getInstance();
        session_start();
        $msg="";
        $date1=date('Y-m-d');
        //echo "Fecha 1: ".$date1."<br>";
        $date2=date('Y-m-d H:i:s');
        $usr=$_SESSION['cod_user'];
        //echo "Fecha 2: ".$date2;
        $tiempo=time();
        $orden=1;
        $numero_guia=0;

        $sql_d = "SELECT id_guia,id_envio,ori_ccosto,des_ccosto,estado,id_usr,
                         fecha_date,fecha_datetime,tiempo,char1,entero1,id_orden,
                         barra,comentario
					FROM guia 
					WHERE barra='$vineta'";

        $d= $db->consultar($sql_d);
        $result = $d->fetch(PDO::FETCH_BOTH);
/*
        while ($rowd=$d->fetch(PDO::FETCH_NUM))
        {
            $id_guia        =$rowd[0];
            $id_envio       =$rowd[1];
            $ori_ccosto     =$rowd[2];
            $des_ccosto     =$rowd[3];
            $estado	        =$rowd[4];
            $id_usr	        =$rowd[5];
            $fecha_date	    =$rowd[6];
            $fecha_datetime	=$rowd[7];
            $tiempo	        =$rowd[8];
            $char1	        =$rowd[9];
            $entero1	    =$rowd[10];
            $id_orden	    =$rowd[11];
            $barra	        =$rowd[12];
            $comentario     =$rowd[13];


        }
*/


        if(empty($id_guia))
        {
            $msg="La vi&ntilde;eta no ha sido ingresada...";
        }

        if(empty($msg)){
            //echo $msg;
            return $msg;
        }else
        {
            //echo $msg;
            return $result;
        }


    }


}