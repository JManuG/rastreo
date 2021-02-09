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
    echo $sql;
    $datos=$db->consultar($sql);
    if(!$datos){
      die('No se puede consultar: '.$datos);
    }
  }

  public function editar(){

    $db=Db::getInstance();

    $sql="update usario set ";

  }

}

?>
