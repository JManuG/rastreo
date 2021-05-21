<?php

include ("../../class/db.php");

class usuarios extends Db{

  public function __construct()
  {
    $db=Db::getInstance();
  }

  public function list_usr(){
    $db=Db::getInstance();
      $sql="select u.id_usr as id, u.usr_nombre as nombre, cc.ccosto_nombre as ccosto, u.nivel as perfil, u.usr_cod as usr from usuario u 
            inner join centro_costo cc on cc.id_ccosto=u.id_ccosto";
    $datos=$db->consultar($sql);
    return $datos;
  }

  public function password($pass,$usr){

    $db=Db::getInstance();
    $pss=md5($pass);
    $sql="update usuario set usr_pass='".$pss."' where usr_cod='".$usr."'";
    //echo $sql;
    $datos=$db->consultar($sql);
    if(!$datos){
      die('No se puede consultar: '.$datos);
    }
  }

  public function editar($string,$usr)
  {

    $db = Db::getInstance();

    $sql = "update usuario set " . $string . " where id_usr=" . $usr;

    $db->consultar($sql);

   /* $sql2="select u.usr_nombre, cc.ccosto_nombre from usuario u
            inner join centro_costo cc on cc.id_ccosto=u.id_ccosto
            where u.id_usr=".$usr;

    $data=$db->consultar($sql2);*/

    return $sql;
  }


  public function get_GPS(){

    $db = Db::getInstance();

    $sql="Select  mj.id_mensajero, mj.nombre, mj.telefono,gps.id_gps, gps.longitude, gps.latitude, gps.altitude, gps.fecha, gps.tiempo from mensajero mj 
    left join gps_mensajero gps on gps.id_mensajero=mj.id_mensajero
    where gps.id_gps=(select max(id_gps) from gps_mensajero where id_mensajero=mj.id_mensajero)";

    $datos=$db->consultar($sql);
    return $datos;

  }

}

?>
