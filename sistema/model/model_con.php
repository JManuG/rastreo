<?php
//model model_con
//0430080126
//
ini_set('post_max_size','100M');
ini_set('upload_max_filesize','100M');
ini_set('max_execution_time','1000');
ini_set('max_input_time','1000');

include('../../class/db.php');
include('../sistema/model/model_con.php');
class model_con extends Db
{
	public function __construct()
	{
		$db=Db::getInstance();
	}

    public function  d_acuse($vineta,$tipo_envio,$destinatario,$ccosto_des,$ccosto_nombre,$des_direccion,$agencia,$descripcion,$id_cat){
        $db=Db::getInstance();
        $con="insert into detalle_acuse(barra,tipo_envio,nombre_destinatario,ccosto,nombre_ccosto,direccion,agencia,descripcion,categoría) 
                              values ('$vineta','$tipo_envio','$destinatario','$ccosto_des','$ccosto_nombre','$des_direccion','$agencia','$descripcion','$id_cat')";
        $stmt= $db->preparar($con);
        //echo '<pre>';
        //print_r($stmt);
        //echo '</pre>';
        if($stmt->execute()){
            $msj="Insertado";
        }else{
            $msj="Error".$con;
        }
        //echo $msj;
        return $msj;


    }

	public function registra_envio($ccosto_ori,$ccosto_des,$destinatario,$descripcion,$vineta,$tipo_envio,$des_direccion,$id_cat)
    {
		$db=Db::getInstance();
		session_start();
		$msg="";
        $usr	=$_SESSION['cod_user'];
		$date1	=date('Y/m/d');
		$date2	=date('Y/m/d H:i:s');
		$tiempo	=time();

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
            $msg=" La vi&ntilde;eta ya existe.";
        }else{
			//char1 : Sera el campo que contiene el tipo de envio si es Externo o Interno
			//Int1 : Sera el campo que tiene la categoria del envio 
			$insert="INSERT INTO guia (id_guia, id_envio, ori_ccosto, des_ccosto, estado,id_usr, fecha_date, fecha_datetime, tiempo, char1, entero1, id_orden, barra, comentario,destinatario,des_direccion) 
					VALUES($numero_guia,'$id_envio', '$ccosto_ori', '$ccosto_des', '1', '$usr', '$date1', '$date2', '$tiempo', '$tipo_envio','$id_cat', '$orden','$vineta', '$descripcion','$destinatario','$des_direccion')";
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


    public function registra_envio1($ccosto_ori,$ccosto_des,$destinatario,$descripcion,$vineta,$tipo_envio,$des_direccion,$id_cat,$id_usr)
    {
        $db=Db::getInstance();
        //session_start();
        $msg="";
        $usr	=$id_usr;
        $date1	=date('Y/m/d');
        $date2	=date('Y/m/d H:i:s');
        $tiempo	=time();

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
            $msg=" La vi&ntilde;eta ya existe.";
        }else{
            //char1 : Sera el campo que contiene el tipo de envio si es Externo o Interno
            //Int1 : Sera el campo que tiene la categoria del envio
            $insert="INSERT INTO guia (id_guia, id_envio, ori_ccosto, des_ccosto, estado,id_usr, fecha_date, fecha_datetime, tiempo, char1, entero1, id_orden, barra, comentario,destinatario,des_direccion) 
					VALUES($numero_guia,'$id_envio', '$ccosto_ori', '$ccosto_des', '1', '$usr', '$date1', '$date2', '$tiempo', '$tipo_envio','$id_cat', '$orden','$vineta', '$descripcion','$destinatario','$des_direccion')";
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

    ////////////////////funcion para autogenerados rutas>-------->
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
////////////////////funcion para autogenerados rutas--------<


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
								centro_direccion, 
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
						centro_direccion='$direccion_ccosto',
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

	public function ing_zona($cli_id,$id_zona,$codigo_zona,$nombre_zona)
	{
		$db=Db::getInstance();
		session_start();
		$date		=date('Y/m/d');
		$datetime	=date('Y/m/d H:i:s');
		$tiempo		=time();
		$id_usr		=$_SESSION['cod_user'];

		//Se valida que el codigo de la agencia venga lleno para insertar sino es un update
		if($id_zona==''){
			//Insert
			$sql="INSERT INTO rastreo.zona
								(
								id_zona,
								zon_codigo,
								zon_descripcion,
								id_usr
								)
					VALUES (0,
							'$codigo_zona',
							'$nombre_zona',
							'$id_usr'
							)";

		}else{
			//Update
			$sql="UPDATE rastreo.zona
					SET zon_codigo='$codigo_zona',
						zon_descripcion='$nombre_zona'
					WHERE id_zona='$id_zona'";
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

	public function ing_mensajero($id_mensajero,$nombre_mensajero,$direccion_mensajero,$telefono_mensajero)
	{
		$db=Db::getInstance();
		session_start();
		$date		=date('Y/m/d');
		$datetime	=date('Y/m/d H:i:s');
		$tiempo		=time();
		$id_usr		=$_SESSION['cod_user'];
	    $perfil     =4;
        $id_ccosto  =366;
        $shi_codigo=1;

		//Se valida que el codigo de la agencia venga lleno para insertar sino es un update
		if($id_mensajero==''){
			//Insert
			$sql="INSERT INTO rastreo.mensajero
								(
								id_mensajero,
								nombre, 
								direccion, 
								telefono, 
								id_usr, 
								fecha_date, 
								fecha_datetime
								)
					VALUES (0,
							'$nombre_mensajero',
							'$direccion_mensajero',
							'$telefono_mensajero',
							'$id_usr',
							'$date',
							'$datetime'
							)";




            $sql2="INSERT INTO rastreo.usuario
								(
									id_usr, 
									usr_cod, 
									usr_pass, 
									usr_nombre, 
									cli_codigo, 
									id_grupo, 
									nivel, 
									depto, 
									id_ccosto, 
									area, 
									producto, 
									posicion, 
									aud_usuario_proc, 
									aud_fecha_proc, 
									aud_hora_proc, 
									marca_tiempo, 
									estado, 
									dias_vencimiento, 
									char1, 
									entero1, 
									cliente_cli_id
								)
					VALUES (0,
							'$telefono_mensajero',
							'".md5($telefono_mensajero)."',
							'$nombre_mensajero',
							'$shi_codigo',
							1,
							$perfil,
							0,
							'$id_ccosto',
							0,
							0,
							0,
							'$id_usr',
							'".date('Y/m/d')."',
							'".date('H:i:s')."',
							$tiempo,
							1,
							30,
							0,
							0,
							0
							)";


            $stmt2= $db->preparar($sql2);
            //echo '<pre>';
            //print_r($stmt);
            //echo '</pre>';
            if($stmt2->execute()){
                $msj="Insertado";
            }else{
                $msj="Error";
            }

		}else{
			//Update
			$sql="UPDATE rastreo.mensajero
					SET nombre='$nombre_mensajero',
						direccion='$direccion_mensajero',
						telefono='$telefono_mensajero'
					WHERE id_mensajero='$id_mensajero'";
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

	public function ing_usuario($usr_cod2,$usr_nombre,$usr_pass,$id_ccosto,$perfil)
	{
		$db=Db::getInstance();
		session_start();
		$date		=date('Y-m-d');
		$datetime	=date('Y-m-d H:i:s');
		$tiempo		=time();
		$id_usr		=$_SESSION['cod_user'];
		$shi_codigo =1;//isset($_SESSION['cli_id']);

		//Se valida que el codigo de la agencia venga lleno para insertar sino es un update
		//if($id_usr==''){
			//Insert
				$sql1="select max(id_usr) as id_usr from usuario";
				$dd=$db->consultar($sql1);

				foreach($dd as $rw){
					
						$id_usr_las=$rw['id_usr']+1;
				}

					

			$sql="INSERT INTO rastreo.usuario
								(
									id_usr, 
									usr_cod, 
									usr_pass, 
									usr_nombre, 
									cli_codigo, 
									id_grupo, 
									nivel, 
									depto, 
									id_ccosto, 
									area, 
									producto, 
									posicion, 
									aud_usuario_proc, 
									aud_fecha_proc, 
									aud_hora_proc, 
									marca_tiempo, 
									estado, 
									dias_vencimiento, 
									char1, 
									entero1, 
									cliente_cli_id
								)
					VALUES ($id_usr_las,
							'$usr_cod2',
							'".md5($usr_pass)."',
							'$usr_nombre',
							'$shi_codigo',
							1,
							$perfil,
							0,
							'$id_ccosto',
							0,
							0,
							0,
							'$id_usr',
							'".date('Y-m-d')."',
							'".date('H:i:s')."',
							$tiempo,
							1,
							30,
							0,
							0,
							0
							)";

		/*}else{
			//Update
			$sql="UPDATE rastreo.mensajero
					SET nombre='$nombre_mensajero',
						direccion='$direccion_mensajero',
						telefono='$telefono_mensajero'
					WHERE id_mensajero='$id_mensajero'";
		}*/

		//echo $sql;	
		$stmt= $db->preparar($sql);
		//echo '<pre>';
		//print_r($stmt);
		//echo '</pre>';
		if($stmt->execute()){
			$msj="Insertado";
		}else{
			$msj="Error ";
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

	public function consulta_usuario($id_usuario)
    {
        $db=Db::getInstance();
        $msg="";
        $date1=date('Y-m-d');
        $date2=date('Y-m-d H:i:s');
    
        $tiempo=time();
        $orden=1;
        $existe_usr=0;

		$sql_c = "SELECT count(id_usr) FROM usuario WHERE usr_cod='$id_usuario'";
		
		$c= $db->consultar($sql_c);
		while ($row=$c->fetch(PDO::FETCH_NUM))
		{
			$existe_usr	    =$row[0];
		}

        if($existe_usr >0){
            return 1;
        }else{
            return 0;
        }
	}
	/*
	public function consulta_vineta_tabla($id_ccosto)
    {
        $db=Db::getInstance();
        $msg="";
        $date1=date('Y-m-d');
        $date2=date('Y-m-d H:i:s');
    
        $tiempo=time();
        $orden=1;
        $existe_usr=0;

		$sql = "SELECT id_envio,ori_ccosto,des_ccosto,id_usr,fecha_datetime,barra,comentario,destinatario
					FROM rastreo.orden 
					WHERE ori_ccosto='$id_ccosto' 
					AND estado=1 AND id_orden=1'";

		$stmt=$db->consultam($sql);
		
		return $stmt;
	}
	*/
	public function procesar_OS($id_cli)
    {
		$db=Db::getInstance();
		session_start();
		$date		=date('Y/m/d');
		$datetime	=date('Y/m/d H:i:s');
		$tiempo		=time();
		$id_usr		=$_SESSION['cod_user'];
		$llave      =$tiempo;
		$estado     =1;

		//Se crea primero la OS - Cuando se registra la Orden se ingresa con estado 1
		$sql="INSERT INTO rastreo.orden
				VALUES (0,'$id_cli','1','$date','OS Creada','$id_usr','$date','$datetime','$tiempo',$estado,NULL,NULL)";

		//echo $sql;	
		$stmt= $db->preparar($sql);
		//echo '<pre>';
		//print_r($stmt);
		//echo '</pre>';
		if($stmt->execute()){
			$id_os ="";
			//Buscamos el numero de OS creado segun tiempo
			$sql_1="SELECT id_orden FROM rastreo.orden WHERE llave='$tiempo'";

			$stmt_1= $db->consultar($sql_1);
			while ($row_1=$stmt_1->fetch(PDO::FETCH_NUM))
			{
				$id_os =$row_1[0];
			}

			$msj=$id_os;
		}else{
			$msj="Error";
		}
		//echo $msj;
		return $msj;
	}

    public function procesar_OS1($id_cli,$us)
    {
        $db=Db::getInstance();
        //session_start();
        $date		=date('Y/m/d');
        $datetime	=date('Y/m/d H:i:s');
        $tiempo		=time();
        $id_usr		=$us;
        $llave      =$tiempo;
        $estado     =1;

        //Se crea primero la OS - Cuando se registra la Orden se ingresa con estado 1
        $sql="INSERT INTO rastreo.orden
				VALUES (0,'$id_cli','1','$date','OS Creada','$id_usr','$date','$datetime','$tiempo',$estado,NULL,NULL)";

        //echo $sql;
        $stmt= $db->preparar($sql);
        //echo '<pre>';
        //print_r($stmt);
        //echo '</pre>';
        if($stmt->execute()){
            $id_os ="";
            //Buscamos el numero de OS creado segun tiempo
            $sql_1="SELECT id_orden FROM rastreo.orden WHERE llave='$tiempo'";

            $stmt_1= $db->consultar($sql_1);
            while ($row_1=$stmt_1->fetch(PDO::FETCH_NUM))
            {
                $id_os =$row_1[0];
            }

            $msj=$id_os;
        }else{
            $msj="Error";
        }
        //echo $msj;
        return $msj;
    }

	public function procesar_GuiaOS($id_cli,$id_ccosto,$id_orden)
	{
		$db=Db::getInstance();
		//session_start();
		$fecha_date		=date('Y/m/d');
		$fecha_datetime	=date('Y/m/d H:i:s');
		$id_usr			=$_SESSION['cod_user'];
		$marca     	 	=time();
		$estado     	=1;
		$cont_u     	=1;
		$cont_i     	=1;

		//Buscamos primero los registros aptos para actualziar
		$sql="SELECT *
				FROM rastreo.guia 
				WHERE ori_ccosto='$id_ccosto' 
				AND estado=1 
				AND id_orden=1
				ORDER BY id_envio";

		$stmt= $db->consultar($sql);
		while ($row=$stmt->fetch(PDO::FETCH_NUM))
		{
			$id_guia		=$row[0];
			$id_envio		=$row[1];
			$ori_ccosto		=$row[2];
			$des_ccosto		=$row[3];
			$estado			=$row[4];
			$id_usr			=$row[5];
			$tiempo			=$row[8];
			$char1			=$row[9];
			$entero1		=$row[10];
			$barra			=$row[12];
			$comentario		=$row[13];
			$destinatario	=$row[14];

			//Por ID guia actualizamos uno a uno
			$upd="UPDATE rastreo.guia
					SET id_orden='$id_orden', estado=2
					WHERE id_guia='$id_guia'
					AND  estado=1";
			//echo $upd;
			$stmt_u= $db->preparar($upd);
	
			//print_r($stmt);
			if($stmt_u->execute()){
				$msj_u=$cont_u++;
			}else{
				$msj_u="Error Update Guia".$id_guia;
			}

			//Luego se inserta el PI (Pre Ingreso) en movimiento
			$ing="INSERT INTO rastreo.movimiento 
							(id_movimiento,id_envio,id_chk,id_zona,id_mensajero,id_usr, fecha_date, fecha_datetime, tiempo, id_motivo, descripcion, movimientocol)
					VALUES (0,'$id_guia',1,1,1,'$id_usr','$fecha_date','$fecha_datetime','$marca','1','INGRESO',NULL) ";
			//echo "<br><br>".$ing;
			$stmt_i= $db->preparar($ing);

			//print_r($stmt);
			if($stmt_i->execute()){
				$msj_i=$cont_i++;
			}else{
				$msj_i="Error Insert Guia".$id_guia;
			}
		}

		if($msj_u > 0 && $msj_i > 0){
			$msj="Insertado";
		}else{
			$msj="Error";
		}

		//echo $msj;
		return $msj;
	}

    public function procesar_GuiaOS1($id_cli,$id_ccosto,$id_orden,$us)
    {
        $db=Db::getInstance();
        //session_start();
        $fecha_date		=date('Y/m/d');
        $fecha_datetime	=date('Y/m/d H:i:s');
        $id_usr			=$us;
        $marca     	 	=time();
        $estado     	=1;
        $cont_u     	=1;
        $cont_i     	=1;

        //Buscamos primero los registros aptos para actualziar
        $sql="SELECT *
				FROM rastreo.guia 
				WHERE ori_ccosto='$id_ccosto' 
				AND estado=1 
				AND id_orden=1
				ORDER BY id_envio";

        $stmt= $db->consultar($sql);
        while ($row=$stmt->fetch(PDO::FETCH_NUM))
        {
            $id_guia		=$row[0];
            $id_envio		=$row[1];
            $ori_ccosto		=$row[2];
            $des_ccosto		=$row[3];
            $estado			=$row[4];
            $id_usr			=$row[5];
            $tiempo			=$row[8];
            $char1			=$row[9];
            $entero1		=$row[10];
            $barra			=$row[12];
            $comentario		=$row[13];
            $destinatario	=$row[14];

            //Por ID guia actualizamos uno a uno
            $upd="UPDATE rastreo.guia
					SET id_orden='$id_orden', estado=2
					WHERE id_guia='$id_guia'
					AND  estado=1";
            //echo $upd;
            $stmt_u= $db->preparar($upd);

            //print_r($stmt);
            if($stmt_u->execute()){
                $msj_u=$cont_u++;
            }else{
                $msj_u="Error Update Guia".$id_guia;
            }

            //Luego se inserta el PI (Pre Ingreso) en movimiento
            $ing="INSERT INTO rastreo.movimiento 
							(id_movimiento,id_envio,id_chk,id_zona,id_mensajero,id_usr, fecha_date, fecha_datetime, tiempo, id_motivo, descripcion, movimientocol)
					VALUES (0,'$id_guia',1,1,1,'$id_usr','$fecha_date','$fecha_datetime','$marca','1','INGRESO',NULL) ";
            //echo "<br><br>".$ing;
            $stmt_i= $db->preparar($ing);

            //print_r($stmt);
            if($stmt_i->execute()){
                $msj_i=$cont_i++;
            }else{
                $msj_i="Error Insert Guia".$id_guia;
            }
        }

        if($msj_u > 0 && $msj_i > 0){
            $msj="Insertado";
        }else{
            $msj="Error";
        }

        //echo $msj;
        return $msj;
    }


	public function procesar_AR($id_vineta)
	{
		$db=Db::getInstance();
		session_start();
		$fecha_date		=date('Y/m/d');
		$fecha_datetime	=date('Y/m/d H:i:s');
		$id_usr			=$_SESSION['cod_user'];
		$id_cli         =$_SESSION['shi_codigo'];
		$marca     	 	=time();
		$estado     	=1;
		$cont_u     	=0;
		$cont_i     	=0;
		$existe_vineta  =0;

		//Buscamos si existe una vineta apta para AR  --  Debe estar la guia en estado 2 para AR 
		$sql="SELECT g.*
				FROM rastreo.guia g 
				INNER JOIN rastreo.orden o
				ON g.id_orden=o.id_orden
				WHERE g.barra='$id_vineta'
				AND o.cli_codigo='$id_cli'
				AND g.estado=2";

		$stmt= $db->consultar($sql);
		while ($row=$stmt->fetch(PDO::FETCH_NUM))
		{
			$id_guia		=$row[0];
			$id_envio		=$row[1];
			$ori_ccosto		=$row[2];
			$des_ccosto		=$row[3];
			$estado			=$row[4];
			$tiempo			=$row[8];
			$char1			=$row[9];
			$entero1		=isset($row[20]);
			$id_orden		=$row[11];
			$barra			=$row[12];
			$comentario		=$row[13];
			$destinatario	=$row[14];
			$existe_vineta  = 1;
		}

		//Por ID guia actualizamos el estado - Se actualiza a estado 3
		if($existe_vineta==1){
			//ACtualizamos el estado de la guia/vineta 
			$upd="UPDATE rastreo.guia
					SET estado=3
					WHERE id_envio='$id_guia'
					AND id_orden='$id_orden'
					AND  estado=2";

			$stmt_u= $db->preparar($upd);
	
			//print_r($stmt);
			if($stmt_u->execute()){
				$msj_u="Ingresado";
			}else{
				$msj_u="Error Update Orden".$id_orden;
			}
	
			//Luego se inserta el AR (Arribo) en movimiento
			$ing="INSERT INTO rastreo.movimiento 
						(id_movimiento,id_envio,id_chk,id_zona,id_mensajero,id_usr, fecha_date, fecha_datetime, tiempo, id_motivo, descripcion, movimientocol)
					VALUES (0,'$id_guia',2,1,1,'$id_usr','$fecha_date','$fecha_datetime','$marca','2','ARRIBO',NULL) ";

			$stmt_i= $db->preparar($ing);

			//print_r($stmt);
			if($stmt_i->execute()){
				$msj_i="Ingresado";
			}
			else{
				$msj_i="Error Insert Orden".$id_orden;
			}
		}
		
		if($existe_vineta==0){
			$msj="Existe";
		}
		elseif($msj_u =='Ingresado' && $msj_i =='Ingresado'){
			$msj="Insertado";
		}
		else{
			$msj="Error";
		}

		//echo $msj;
		return $msj;
	}


    public function procesar_AR1($id_vineta,$us,$cli)
    {
        $db=Db::getInstance();
        //session_start();
        $fecha_date		=date('Y/m/d');
        $fecha_datetime	=date('Y/m/d H:i:s');
        $id_usr			=$us;
        $id_cli         =$cli;
        $marca     	 	=time();
        $estado     	=1;
        $cont_u     	=0;
        $cont_i     	=0;
        $existe_vineta  =0;

        //Buscamos si existe una vineta apta para AR  --  Debe estar la guia en estado 2 para AR
        $sql="SELECT g.*
				FROM rastreo.guia g 
				INNER JOIN rastreo.orden o
				ON g.id_orden=o.id_orden
				WHERE g.barra='$id_vineta'
				AND o.cli_codigo='$id_cli'
				AND g.estado=2";

        $stmt= $db->consultar($sql);
        while ($row=$stmt->fetch(PDO::FETCH_NUM))
        {
            $id_guia		=$row[0];
            $id_envio		=$row[1];
            $ori_ccosto		=$row[2];
            $des_ccosto		=$row[3];
            $estado			=$row[4];
            $tiempo			=$row[8];
            $char1			=$row[9];
            $entero1		=isset($row[20]);
            $id_orden		=$row[11];
            $barra			=$row[12];
            $comentario		=$row[13];
            $destinatario	=$row[14];
            $existe_vineta  = 1;
        }

        //Por ID guia actualizamos el estado - Se actualiza a estado 3
        if($existe_vineta==1){
            //ACtualizamos el estado de la guia/vineta
            $upd="UPDATE rastreo.guia
					SET estado=3
					WHERE id_envio='$id_guia'
					AND id_orden='$id_orden'
					AND  estado=2";

            $stmt_u= $db->preparar($upd);

            //print_r($stmt);
            if($stmt_u->execute()){
                $msj_u="Ingresado";
            }else{
                $msj_u="Error Update Orden".$id_orden;
            }

            //Luego se inserta el AR (Arribo) en movimiento
            $ing="INSERT INTO rastreo.movimiento 
						(id_movimiento,id_envio,id_chk,id_zona,id_mensajero,id_usr, fecha_date, fecha_datetime, tiempo, id_motivo, descripcion, movimientocol)
					VALUES (0,'$id_guia',2,1,1,'$id_usr','$fecha_date','$fecha_datetime','$marca','2','ARRIBO',NULL) ";

            $stmt_i= $db->preparar($ing);

            //print_r($stmt);
            if($stmt_i->execute()){
                $msj_i="Ingresado";
            }
            else{
                $msj_i="Error Insert Orden".$id_orden;
            }
        }

        if($existe_vineta==0){
            $msj="Existe";
        }
        elseif($msj_u =='Ingresado' && $msj_i =='Ingresado'){
            $msj="Insertado";
        }
        else{
            $msj="Error";
        }

        //echo $msj;
        return $msj;
    }



	public function procesar_LD($id_zona,$id_mensajero,$vineta)
	{
		$db=Db::getInstance();
		session_start();
		$fecha_date		=date('Y/m/d');
		$fecha_datetime	=date('Y/m/d H:i:s');
		$id_usr			=$_SESSION['cod_user'];
		$id_cli         =$_SESSION['shi_codigo'];
		$marca     	 	=time();
		$estado     	=1;
		$cont_u     	=0;
		$cont_i     	=0;
		$existe_vineta  =0;
		$numid          =date('Ymdhis');
		$posicion       =1;

		//Buscamos si existe una vineta apta para LD  --  Debe estar la guia en estado 3 para LD
		$sql="SELECT g.*
				FROM rastreo.guia g 
				INNER JOIN rastreo.orden o
				ON g.id_orden=o.id_orden
				WHERE g.barra='$vineta'
				AND o.cli_codigo='$id_cli'
				AND g.estado=3";

		$stmt= $db->consultar($sql);
		while ($row=$stmt->fetch(PDO::FETCH_NUM))
		{
			$id_guia		=$row[0];
			$id_envio		=$row[1];
			$ori_ccosto		=$row[2];
			$des_ccosto		=$row[3];
			$estado			=$row[4];
			$tiempo			=$row[8];
			$char1			=$row[9];
			$entero1		=isset($row[20]);
			$id_orden		=$row[11];
			$barra			=$row[12];
			$comentario		=$row[13];
			$destinatario	=$row[14];
			$existe_vineta  = 1;
		}

		//El numid que se trae se evalua
		$sql_2="SELECT * FROM rastreo.manifiesto WHERE n_manifiesto='$numid'";
		$existe_numid=0;
		$stmt_2= $db->consultar($sql_2);
		while ($row_2=$stmt_2->fetch(PDO::FETCH_NUM))
		{
			$existe_numid=1;
		}

		//Si no existe insertamos el numid en el encabezado
		if($existe_numid==0)
		{
			$ing_1="INSERT INTO rastreo.manifiesto
						VALUES (0, '$numid', '$id_zona', '$id_mensajero', 1, '$id_usr', '$fecha_date', '$fecha_datetime', '$marca')";
			
			$stmt_i1= $db->preparar($ing_1);

			if($stmt_i1->execute()){
				$msj_i1="Ingresado";
			}
			else{
				$msj_i1="Error Insert manifiesto".$numid;
			}
		}

		//Por ID guia actualizamos el estado - Se actualiza a estado 4
		if($existe_vineta==1){
			//ACtualizamos el estado de la guia/vineta 
			$upd="UPDATE rastreo.guia
					SET estado=4
					WHERE id_envio='$id_guia'
					AND id_orden='$id_orden'
					AND  estado=3";

			$stmt_u= $db->preparar($upd);
	
			//print_r($stmt);
			if($stmt_u->execute()){
				$msj_u="Ingresado";
			}else{
				$msj_u="Error Update Orden LD".$id_orden;
			}

			//Insertamos la linea de cada posicion del manifiesto generado
			$ing_2="INSERT INTO rastreo.manifiesto_linea
					VALUES (0,'$numid','$posicion',3,1,'$id_guia')";

			$stmt_i2= $db->preparar($ing_2);
			//echo $ing_2;
			
			if($stmt_i2->execute()){
				$msj_i2="Ingresado";
			}
			else{
				$msj_i2="Error manifiesto_linea".$numid."-".$posicion;
			}		
	
			//Luego se inserta LD (Salida a Ruta) en movimiento
			$ing="INSERT INTO rastreo.movimiento 
						(id_movimiento,id_envio,id_chk,id_zona,id_mensajero,id_usr, fecha_date, fecha_datetime, tiempo, id_motivo, descripcion, movimientocol)
					VALUES (0,'$id_guia',3,'$id_zona','$id_mensajero','$id_usr','$fecha_date','$fecha_datetime','$marca','3','SALIDA A RUTA',NULL) ";

			$stmt_i= $db->preparar($ing);

			//print_r($stmt);
			if($stmt_i->execute()){
				$msj_i="Ingresado";
			}
			else{
				$msj_i="Error Insert Orden LD".$id_orden;
			}
		}
		
		if($existe_vineta==0){
			$msj="Existe";
		}
		elseif($msj_u =='Ingresado' && $msj_i =='Ingresado'){
			$msj="Insertado";
		}
		else{
			$msj="Error";
		}

		//echo $msj;
		return $msj;
	}

    public function procesar_LD1($id_zona,$id_mensajero,$vineta,$us,$cli)
    {
        $db=Db::getInstance();
        //session_start();
        $fecha_date		=date('Y/m/d');
        $fecha_datetime	=date('Y/m/d H:i:s');
        $id_usr			=$us;
        $id_cli         =$cli;
        $marca     	 	=time();
        $estado     	=1;
        $cont_u     	=0;
        $cont_i     	=0;
        $existe_vineta  =0;
        $numid          =date('Ymdhis');
        $posicion       =1;

        //Buscamos si existe una vineta apta para LD  --  Debe estar la guia en estado 3 para LD
        $sql="SELECT g.*
				FROM rastreo.guia g 
				INNER JOIN rastreo.orden o
				ON g.id_orden=o.id_orden
				WHERE g.barra='$vineta'
				AND o.cli_codigo='$id_cli'
				AND g.estado=3";

        $stmt= $db->consultar($sql);
        while ($row=$stmt->fetch(PDO::FETCH_NUM))
        {
            $id_guia		=$row[0];
            $id_envio		=$row[1];
            $ori_ccosto		=$row[2];
            $des_ccosto		=$row[3];
            $estado			=$row[4];
            $tiempo			=$row[8];
            $char1			=$row[9];
            $entero1		=isset($row[20]);
            $id_orden		=$row[11];
            $barra			=$row[12];
            $comentario		=$row[13];
            $destinatario	=$row[14];
            $existe_vineta  = 1;
        }

        //El numid que se trae se evalua
        $sql_2="SELECT * FROM rastreo.manifiesto WHERE n_manifiesto='$numid'";
        $existe_numid=0;
        $stmt_2= $db->consultar($sql_2);
        while ($row_2=$stmt_2->fetch(PDO::FETCH_NUM))
        {
            $existe_numid=1;
        }

        //Si no existe insertamos el numid en el encabezado
        if($existe_numid==0)
        {
            $ing_1="INSERT INTO rastreo.manifiesto
						VALUES (0, '$numid', '$id_zona', '$id_mensajero', 1, '$id_usr', '$fecha_date', '$fecha_datetime', '$marca')";

            $stmt_i1= $db->preparar($ing_1);

            if($stmt_i1->execute()){
                $msj_i1="Ingresado";
            }
            else{
                $msj_i1="Error Insert manifiesto".$numid;
            }
        }

        //Por ID guia actualizamos el estado - Se actualiza a estado 4
        if($existe_vineta==1){
            //ACtualizamos el estado de la guia/vineta
            $upd="UPDATE rastreo.guia
					SET estado=4
					WHERE id_envio='$id_guia'
					AND id_orden='$id_orden'
					AND  estado=3";

            $stmt_u= $db->preparar($upd);

            //print_r($stmt);
            if($stmt_u->execute()){
                $msj_u="Ingresado";
            }else{
                $msj_u="Error Update Orden LD".$id_orden;
            }

            //Insertamos la linea de cada posicion del manifiesto generado
            $ing_2="INSERT INTO rastreo.manifiesto_linea
					VALUES (0,'$numid','$posicion',3,1,'$id_guia')";

            $stmt_i2= $db->preparar($ing_2);
            //echo $ing_2;

            if($stmt_i2->execute()){
                $msj_i2="Ingresado";
            }
            else{
                $msj_i2="Error manifiesto_linea".$numid."-".$posicion;
            }

            //Luego se inserta LD (Salida a Ruta) en movimiento
            $ing="INSERT INTO rastreo.movimiento 
						(id_movimiento,id_envio,id_chk,id_zona,id_mensajero,id_usr, fecha_date, fecha_datetime, tiempo, id_motivo, descripcion, movimientocol)
					VALUES (0,'$id_guia',3,'$id_zona','$id_mensajero','$id_usr','$fecha_date','$fecha_datetime','$marca','3','SALIDA A RUTA',NULL) ";

            $stmt_i= $db->preparar($ing);

            //print_r($stmt);
            if($stmt_i->execute()){
                $msj_i="Ingresado";
            }
            else{
                $msj_i="Error Insert Orden LD".$id_orden;
            }
        }

        if($existe_vineta==0){
            $msj="Existe";
        }
        elseif($msj_u =='Ingresado' && $msj_i =='Ingresado'){
            $msj="Insertado";
        }
        else{
            $msj="Error";
        }

        //echo $msj;
        return $msj;
    }


	public function procesar_DL($numid)
	{
		$db=Db::getInstance();
		session_start();
		$fecha_date		=date('Y/m/d');
		$fecha_datetime	=date('Y/m/d H:i:s');
		$id_usr			=$_SESSION['cod_user'];
		$id_cli         =$_SESSION['shi_codigo'];
		$marca     	 	=time();
		$cont_u     	=1;
		$cont_i     	=1;
		$cont_m			=1;
		$existe_numid   =0;

		//Buscamos si existe una vineta apta para DL 
		$sql="SELECT m.* 
				FROM rastreo.manifiesto m 
				INNER JOIN usuario u
				ON m.id_usr=u.id_usr
				WHERE m.n_manifiesto='$numid'
				AND m.estado=1
				AND u.id_usr='$id_usr'";
		//echo $sql;
		$stmt= $db->consultar($sql);
		while ($row=$stmt->fetch(PDO::FETCH_NUM))
		{
			$id_manifiesto	=$row[0];
			$n_manifiesto	=$row[1];
			$id_zona		=$row[2];
			$id_mensajero	=$row[3];
			$estado			=$row[4];
			$id_usr			=$row[5];
			$fecha			=$row[6];
			$fecha_datetime	=$row[7];
			$tiempo			=$row[8];
			$existe_numid  	= 1;
		}

		//Por ID guia actualizamos el estado - Se actualiza a estado 5
		if($existe_numid==1){
			//Buscamos una a una las viñetas ingresadas por numid para actualizar
			$sql_u1="SELECT m.*,g.id_orden,g.barra
						FROM rastreo.manifiesto_linea m 
						INNER JOIN rastreo.guia g
						ON m.id_envio=g.id_envio
						INNER JOIN rastreo.usuario u
						ON g.id_usr=u.id_usr
						WHERE m.n_manifiesto='$numid'
						AND m.estado=1
						AND g.estado=4
						AND u.cli_codigo='$id_cli'";
			//echo $sql_u1;
			$stmt_u1= $db->consultar($sql_u1);
			while ($row_u1=$stmt_u1->fetch(PDO::FETCH_NUM))	
			{
				$id_linea		=$row_u1[0];
				$n_manifiesto	=$row_u1[1];
				$posicion		=$row_u1[2];
				$id_chk			=$row_u1[3];
				$estado			=$row_u1[4];
				$id_envio		=$row_u1[5];
				$id_orden		=$row_u1[6];
				$barra			=$row_u1[7];

				//Actualizamos el estado de la guia/vineta 
				$upd="UPDATE rastreo.guia
						SET estado=5
						WHERE id_envio='$id_envio'
						AND id_orden='$id_orden'
						AND  estado=4";

				$stmt_u= $db->preparar($upd);
		
				//print_r($stmt);
				if($stmt_u->execute()){
					$msj_u=$cont_u++;
				}else{
					$msj_u="Error Update Orden".$numid;
				}
				
				//Por ser una descarga completa de manifiesto se actualiza linea a linea
				$upd_l1="UPDATE rastreo.manifiesto_linea
							SET id_chk=4,estado=2
							WHERE n_manifiesto='$numid'
							AND posicion='$posicion'
							AND id_chk=3
							AND estado=1";	

				$stmt_l1= $db->preparar($upd_l1);
		
				//print_r($stmt);
				if($stmt_l1->execute()){
					$msj_l1=$cont_m++;
				}else{
					$msj_l1="Error Update Manifiesto Linea".$numid;
				}

				//Luego se inserta el DL (Entrega Efectiva) en movimiento
				$ing="INSERT INTO rastreo.movimiento 
							(id_movimiento,id_envio,id_chk,id_zona,id_mensajero,id_usr, fecha_date, fecha_datetime, tiempo, id_motivo, descripcion, movimientocol)
						VALUES (0,'$id_envio',4,'$id_zona','$id_mensajero','$id_usr','$fecha_date','$fecha_datetime','$marca','4','ENTREGA EFECTIVA',NULL) ";
				 
				$stmt_i= $db->preparar($ing);

				//print_r($stmt);
				if($stmt_i->execute()){
					$msj_i=$cont_i++;
				}
				else{
					$msj_i="Error Insert Orden".$id_orden;
				}
			}
		}
		
		if($existe_numid==0){
			$msj="Existe";
		}
		elseif($msj_u > 0 && $msj_i > 0 && $msj_l1 > 0){
			$msj="Insertado";

			//Actualizamos el encabezado al final
			$upd_l2="UPDATE rastreo.manifiesto
						SET estado=2
						WHERE n_manifiesto='$numid'
						AND estado=1";	

			$stmt_l2= $db->preparar($upd_l2);

			if($stmt_l2->execute()){
				$msj_l2="Ing";
			}else{
				$msj_l2="Error Update Manifiesto".$numid;
			}
		}
		else{
			$msj="Error";
		}

		//echo $msj;
		return $msj;
	}

	public function procesar_DV($numid,$posicion,$id_motivo)
	{
		$db=Db::getInstance();
		session_start();
		$fecha_date		=date('Y/m/d');
		$fecha_datetime	=date('Y/m/d H:i:s');
		$id_usr			=$_SESSION['cod_user'];
		$id_cli         =$_SESSION['shi_codigo'];
		$marca     	 	=time();
		$estado     	=1;
		$existe_vineta  =0;

		//Buscamos si existe una vineta apta para DV  -
		$sql="SELECT ml.*, g.id_guia,m.id_zona,m.id_mensajero
				FROM manifiesto m 
				INNER JOIN manifiesto_linea ml
				ON m.n_manifiesto=ml.n_manifiesto
				INNER JOIN guia g
				ON ml.id_envio=g.id_envio
				WHERE m.n_manifiesto='$numid'
				AND ml.posicion='$posicion'
				AND ml.id_chk=3
				AND ml.estado=1";

		$stmt= $db->consultar($sql);
		while ($row=$stmt->fetch(PDO::FETCH_NUM))
		{
			$id_linea		=$row[0];
			$n_manifiesto	=$row[1];
			$posicion		=$row[2];
			$id_chk			=$row[3];
			$estado			=$row[4];
			$id_envio		=$row[5];
			$id_guia		=$row[6];
			$id_zona        =$row[7];
			$id_mensajero   =$row[8];

			$existe_vineta  = 1;
		}

		//Por id manifiesto y posicion actualizamo
		if($existe_vineta==1){
			//ACtualizamos el estado de la posicion en especifico del manifieso
			$upd="UPDATE rastreo.manifiesto_linea
					SET id_chk=5,estado=2
					WHERE n_manifiesto='$numid'
					AND posicion=$posicion
					AND id_chk=3
					AND  estado=1";

			$stmt_u= $db->preparar($upd);
	
			//print_r($stmt);
			if($stmt_u->execute()){
				$msj_u="Ingresado";
			}else{
				$msj_u="Error Update manifiesto_linea".$numid."+".$posicion;
			}
	
			//ACtualizamos el estado de la guia
			$upd_g="UPDATE rastreo.guia
						SET estado=6
					WHERE id_guia='$id_guia'
					AND  estado=4";

			$stmt_g= $db->preparar($upd_g);
	
			//print_r($stmt);
			if($stmt_g->execute()){
				$msj_g="Ingresado";
			}else{
				$msj_g="Error Update guia".$numid."+".$posicion;
			}

			//Luego se inserta el AR (Arribo) en movimiento
			$ing="INSERT INTO rastreo.movimiento 
						(id_movimiento,id_envio,id_chk,id_zona,id_mensajero,id_usr, fecha_date, fecha_datetime, tiempo, id_motivo, descripcion, movimientocol)
					VALUES (0,'$id_envio',5,'$id_zona','$id_mensajero','$id_usr','$fecha_date','$fecha_datetime','$marca','$id_motivo','DEVOLUCION',NULL) ";

			$stmt_i= $db->preparar($ing);

			//print_r($stmt);
			if($stmt_i->execute()){
				$msj_i="Ingresado";
			}
			else{
				$msj_i="Error Insert Orden".$id_envio;
			}
		}
		
		if($existe_vineta==0){
			$msj="Existe";
		}
		elseif($msj_u =='Ingresado' && $msj_i =='Ingresado' && $msj_g =='Ingresado'){
			$msj="Insertado";
		}
		else{
			$msj="Error";
		}

		//echo $msj;
		return $msj;
	}

    public function consulta_correlativo(){
        $db=Db::getInstance();
        session_start();
        $msg="";

        $usr    =$_SESSION['cod_user'];
        $id_cli =$_SESSION['shi_codigo'];
	
  	    $sql = "SELECT *
					FROM rastreo.correlativo 
                    WHERE id_cli='$id_cli'
                    AND estado=1";
		//echo $sql;
		$stmt= $db->consultar($sql);
		while ($row=$stmt->fetch(PDO::FETCH_NUM))
		{
			$id_correlativo = $row[0];
			$id_cli			= $row[1];
			$seq_ini        = $row[2];
			$seq_fin        = $row[3];
			$seq            = $row[4];
			$estado         = $row[5];
			$seq_new        = $seq+1;
		}

		if($seq_new > $seq_ini && $seq_new < $seq_fin){
			//Actualizamos el nuevo registro seq en la tabla
			$upd="UPDATE rastreo.correlativo
					SET seq=$seq_new
					WHERE id_cli='$id_cli'
                    AND estado=1 ";

			$stmt_u= $db->preparar($upd);

			//print_r($stmt);
			if($stmt_u->execute()){
				$msj_u="Ingresado";
			}
			else{
				$msj_u="Error Actualizando proc_GeneraVineta";
			}

			$result = $seq_new;
		}else{
			$result="Error";
		}
		
		//echo $sql;
		return $result;
	}


    public function consulta_correlativo1(){
        $db=Db::getInstance();
        //session_start();
        $msg="";

        //$usr    =$_SESSION['cod_user'];
        $id_cli =1;

        $sql = "SELECT *
					FROM rastreo.correlativo 
                    WHERE id_cli='$id_cli'
                    AND estado=1";
        //echo $sql;
        $stmt= $db->consultar($sql);
        while ($row=$stmt->fetch(PDO::FETCH_NUM))
        {
            $id_correlativo = $row[0];
            $id_cli			= $row[1];
            $seq_ini        = $row[2];
            $seq_fin        = $row[3];
            $seq            = $row[4];
            $estado         = $row[5];
            $seq_new        = $seq+1;
        }

        if($seq_new > $seq_ini && $seq_new < $seq_fin){
            //Actualizamos el nuevo registro seq en la tabla
            $upd="UPDATE rastreo.correlativo
					SET seq=$seq_new
					WHERE id_cli='$id_cli'
                    AND estado=1 ";

            $stmt_u= $db->preparar($upd);

            //print_r($stmt);
            if($stmt_u->execute()){
                $msj_u="Ingresado";
            }
            else{
                $msj_u="Error Actualizando proc_GeneraVineta";
            }

            $result = $seq_new;
        }else{
            $result="Error";
        }

        //echo $sql;
        return $result;
    }

	public function data_acuse($vineta)
    {


        $db=Db::getInstance();
		/*
		$sql = "SELECT 
					id_envio,ori_ccosto,
					fn_AgeXCc(ori_ccosto) AS age_ori,
					fn_ccostoNombre(ori_ccosto) AS ori_ccosto_nombre,
					des_ccosto, 
					fn_AgeXCc(des_ccosto) AS age_des,
					fn_ccostoNombre(des_ccosto) AS des_ccosto_nombre,
					fn_usrNombre(id_usr) AS usr_ori,
					fecha_datetime,barra,comentario,destinatario,
					char1 as tipo,
					fn_catNombre(entero1) as categoria,
					fn_ccostoDirNombre(ori_ccosto) as ccDirOri,
					fn_ccostoDirNombre(des_ccosto) as ccDirdes
			FROM rastreo.guia 
			WHERE barra='$vineta'
			ORDER BY id_envio";
		*/

       /* $sql="SELECT
		id_envio,ori_ccosto,
		fn_AgeXCc(ori_ccosto) AS age_ori,
		fn_ccostoNombre(ori_ccosto) AS ori_ccosto_nombre,
		des_ccosto, 
		fn_AgeXCc(des_ccosto) AS age_des,
		fn_ccostoNombre(des_ccosto) AS des_ccosto_nombre,
		fn_usrNombre(g.id_usr) AS usr_ori,
		g.fecha_datetime,barra,comentario,destinatario,
		g.char1 as tipo,
		fn_catNombre(g.entero1) as categoria,
		fn_ccostoDirNombre(ori_ccosto) as ccDirOri,
		fn_ccostoDirNombre(des_ccosto) as ccDirdes,
		c.ccosto_codigo
		FROM rastreo.guia g inner join centro_costo c
		on g.des_ccosto=c.id_ccosto
		WHERE g.barra='$vineta'
		ORDER BY g.id_envio";*/

		$sql="
		SELECT 
		id_envio,ori_ccosto,
		fn_AgeXCc(ori_ccosto) AS age_ori,
		fn_ccostoNombre(ori_ccosto) AS ori_ccosto_nombre,
		des_ccosto, 
		fn_AgeXCc(des_ccosto) AS age_des,
		fn_ccostoNombre(des_ccosto) AS des_ccosto_nombre,
		s.usr_nombre AS usr_ori,
		g.fecha_datetime,barra,comentario,destinatario,
		g.char1 as tipo
		FROM rastreo.guia g inner join usuario s
		on g.id_usr=s.id_usr
		WHERE g.barra='$vineta'";

			$stmt=$db->consultar($sql);
			//echo $sql;
			return $stmt;
	}

    public function data_acuse2($vineta)
    {

        $db=Db::getInstance();


        $sql="
			select		barra,
			tipo_envio,
			nombre_destinatario,
			ccosto,
			nombre_ccosto,
			direccion,
			agencia,
			descripcion
			FROM detalle_acuse
			WHERE barra='$vineta'";

        $stmt=$db->consultar($sql);
        //echo $sql;
        return $stmt;
    }

	public function registra_envio_xls($usr_destino,$tipo,$descripcion,$id_cat)
    {
		$db=Db::getInstance();
		session_start();
		$msg="";
        $usr	=$_SESSION['cod_user'];
		$date1	=date('Y/m/d');
		$date2	=date('Y/m/d H:i:s');
		$tiempo	=time();
		
		if($tipo=='I')
		{
			$tipo_envio='I';
		}
		else
		{
			$tipo_envio='E';
		}

		$vineta= $this->consulta_correlativo();

		$sql_ud="SELECT cc.id_ccosto,cc.centro_direccion,u.usr_nombre
					FROM rastreo.centro_costo cc 
					INNER JOIN rastreo.usuario u
					ON u.id_ccosto=cc.id_ccosto
					WHERE u.id_usr='$usr_destino'";

		$c_ud= $db->consultar($sql_ud);
		while ($row_ud=$c_ud->fetch(PDO::FETCH_NUM))
		{
			$ccosto_des       =$row_ud[0];
			$des_direccion	  =$row_ud[1];
			$destinatario     =$row_ud[2];
		}

		$sql_uo="SELECT cc.id_ccosto,cc.centro_direccion
					FROM rastreo.centro_costo cc 
					INNER JOIN rastreo.usuario u
					ON u.id_ccosto=cc.id_ccosto
					WHERE u.id_usr='$usr'";

		$c_uo= $db->consultar($sql_uo);
		while ($row_uo=$c_uo->fetch(PDO::FETCH_NUM))
		{
			$ccosto_ori       =$row_uo[0];	
		}

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
					WHERE barra='$id_envio'";

        $d= $db->consultar($sql_d);
        while ($rowd=$d->fetch(PDO::FETCH_NUM))
        {
            $vin_anterior       =$rowd[0];
        }
		
		if(!empty($vin_anterior))
        {
            $msg=" La vi&ntilde;eta ya existe.";
        }else{
			//char1 : Sera el campo que contiene el tipo de envio si es Externo o Interno
			//Int1 : Sera el campo que tiene la categoria del envio 
			$insert="INSERT INTO guia (id_guia, id_envio, ori_ccosto, des_ccosto, estado,id_usr, fecha_date, fecha_datetime, tiempo, char1, entero1, id_orden, barra, comentario,destinatario,des_direccion) 
					VALUES($numero_guia,'$id_envio', '$ccosto_ori', '$ccosto_des', '1', '$usr', '$date1', '$date2', '$tiempo', '$tipo_envio','$id_cat', '$orden','$vineta', '$descripcion','$destinatario','$des_direccion')";
	    	//echo $insert.'<br>';
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

	public function ing_ruta($id_ruta,$nombre_ruta,$des_ruta)
	{
		$db=Db::getInstance();
		session_start();
		$date		=date('Y/m/d');
		$datetime	=date('Y/m/d H:i:s');
		$tiempo		=time();
		$id_usr		=$_SESSION['cod_user'];
	    $perfil     =4;
        $id_ccosto  =366;
        $shi_codigo=1;

		//Se valida que el codigo de la agencia venga lleno para insertar sino es un update
		if($id_ruta==''){
			//Insert
			$sql="INSERT INTO rastreo.ruta
								(
								id_ruta,
								nombre_ruta, 
								des_ruta, 
								estado, 
								id_cli
								)
					VALUES (0,
							'$nombre_ruta',
							'$des_ruta',
							1,
							'$shi_codigo'
							)";
		}else{
			//Update
			$sql="UPDATE rastreo.ruta
					SET nombre_ruta='$nombre_ruta',
						des_ruta='$des_ruta'
					WHERE id_ruta='$id_ruta'";
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

	public function ing_ruta_p($id_agencia,$comentario,$hora_ini,$hora_fin,$id_ruta)
	{
		$db=Db::getInstance();
		session_start();
		$date		=date('Y/m/d');
		$datetime	=date('Y/m/d H:i:s');
		$tiempo		=time();
		$id_usr		=$_SESSION['cod_user'];
	    $perfil     =4;
        $id_ccosto  =366;
        $shi_codigo=1;

		//Se valida que el codigo de la agencia venga lleno para insertar sino es un update
		if($id_ruta !='' || $id_ruta !=NULL){
			//Insert
			$sql="INSERT INTO ruta_detalle
								(
								id_rutadetalle,
								id_agencia, 
								comentario, 
								hora_ini, 
								hora_fin,
								id_periodicidad,
								estado,
								id_ruta,
								tiempo
								)
					VALUES (0,
							'$id_agencia',
							'$comentario',
							'$hora_ini',
							'$hora_fin',
							'1',
							1,
							$id_ruta,
							$tiempo
							)";
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

	public function ing_progra($id_ruta,$id_mensajero)
	{
		$db=Db::getInstance();
		session_start();
		$date		= "2021/05/25";//date('Y/m/d');
		$datetime	=date('Y/m/d H:i:s');
		$tiempo		=time();
		$id_usr		=$_SESSION['cod_user'];
	    $perfil     =4;
        $id_ccosto  =366;
        $shi_codigo=1;

		//Se valida que el codigo de la agencia venga lleno para insertar sino es un update
	
			//Insert
			$sql="INSERT INTO rastreo.programacion
								(
								id_progra,
								id_ruta, 
								id_mensajero, 
								id_guia, 
								id_chk,
								estado
								)
					VALUES (0,
							'$id_ruta',
							'$id_mensajero',
							NULL,
							NULL,
							1
							)";
		

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
?>