<?php
include('../../class/db.php');
date_default_timezone_set('America/Guatemala');
class control_gs extends Db{

  public function __construct()
  {
    $db=Db::getInstance();
  }

  public function get_guia(){
    $db=Db::getInstance();

    $sql="select
                            gi.barra as idPedido,
                            gi.destinatario as name,
                            cct.ccosto_nombre as centro_costo,
                            gi.des_direccion as direccion,
                            ct.des_cat as categoria,
                            
                            gi.fecha_datetime as createdAt,
                            gi.comentario as comments,
                            
                            
                            gi.estado as estado_guia,
                            
                            us.usr_nombre as nombre_remitente,
                            cctr.ccosto_nombre as dep_remitente,
                            mj.nombre as mensajero
       
                        from guia gi
                        inner join usuario us on us.id_usr=gi.id_usr
                        inner join centro_costo cctr on cctr.id_ccosto=us.id_ccosto
                        inner join centro_costo cct on cct.id_ccosto=gi.des_ccosto
                        inner join categoria ct on ct.id_cat=gi.entero1
                        inner join movimiento mv on mv.id_envio=gi.id_envio
                        inner join manifiesto_linea ml on ml.id_envio=gi.id_envio
                        inner join manifiesto mnf on mnf.n_manifiesto=ml.n_manifiesto
                        
                        inner join mensajero mj on mj.id_mensajero=mnf.id_mensajero
                        
    and mv.id_chk=3
    and gi.estado=4
    and ml.estado=1";

    //cosas que no nesesito en la consulta.
    //us.id_usr as remitente,
    //mv.descripcion as estado,
    //gi.fecha_datetime as createdAt,
    //z.zon_descripcion as address, inner join zona z on z.id_zona=mv.id_zona


    $c=$db->consultar($sql);

    while ($row=$c->fetch(PDO::FETCH_OBJ))
    {
      $data[] = $row;
    }

    //print_r($data);
    return $data;

  }

  public function get_mensajero()
  {
    $db = Db::getInstance();

    $sql="select mj.nombre,mj.id_mensajero,u.id_usr, u.usr_cod from mensajero mj
            inner join usuario u on u.id_usr=mj.id_usr";

    $c1=$db->consultar($sql);

    while ($row1=$c1->fetch(PDO::FETCH_OBJ))
    {
      $data1[] = $row1;
    }

    //print_r($data);
    return $data1;

  }

  ///////////////////////////////////////////////////warning//////////////////////////////////////////////////////
  public function gui_mj($vineta,$id_mensajero){

    $db=Db::getInstance();
    //session_start();
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


//Buscamos si existe una vineta apta para reasignacion --  Debe estar la guia en estado 4 para LD
    $sql="SELECT g.*
				FROM rastreo.guia g 
				INNER JOIN rastreo.orden o
				ON g.id_orden=o.id_orden
				WHERE g.barra='$vineta'
				AND o.cli_codigo='$id_cli'
				AND g.estado=4";

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

   //update manifiesto_linea



    $mlinea="select n_manifiesto from manifiesto_linea where id_envio=".$id_envio;

    $ml=$db->consultar($mlinea);

    $n_manifiesto='';

     while ($row=$ml->fetch(PDO::FETCH_NUM))
    {
      $n_manifiesto=$row[0];
    }

    if($n_manifiesto!=''){

      //se relaizo el cmabio del mensajero asignado en el manifiesto
      $nmsql="update manifiesto set id_mensajero=".$id_mensajero." where n_manifiesto=".$n_manifiesto;

      $db->consultar($nmsql);

      ///se relaiza la actualizacion d elinformaicon del mensajero asignado a la tabla de linea manifiesto
      ///
      $lmsql="update manifiesto_linea set id_mensajero=".$id_mensajero." where n_manifiesto=".$n_manifiesto;

      $db->consultar($lmsql);

    }

      return $n_manifiesto;
    //update linea.

  }

  ///////////////////////////////////////////////////warning//////////////////////////////////////////////////////
}
?>
