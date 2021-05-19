<?php

include('../../class/db.php');

class model_con extends Db
{
  public function __construct()
  {
    $db=Db::getInstance();
  }

  public function reporte_n()
  {
    $db=Db::getInstance();
    $sql = "select
                            gi.barra as barra,
                            us.usr_nombre as remitente,
                            gi.destinatario as destinatario,
                            cct.ccosto_nombre as centro_costo,
                            gi.des_direccion as direccion,
                            ct.des_cat as categoria,
                            mv.descripcion as estado,
                            mj.nombre as mensajero,
                            cctu.ccosto_nombre as remitente_dep,
                            mv.id_motivo as idm
       
                        from guia gi
                        inner join usuario us on us.id_usr=gi.id_usr
                        inner join centro_costo cctu on cctu.id_ccosto=us.id_ccosto
                        inner join centro_costo cct on cct.id_ccosto=gi.des_ccosto
                        inner join categoria ct on ct.id_cat=gi.entero1
                        inner join movimiento mv on mv.id_envio=gi.id_envio
                        left join manifiesto_linea ml on ml.id_envio=gi.id_envio
                        left join manifiesto mnf on mnf.n_manifiesto=ml.n_manifiesto
                        left join mensajero mj on mj.id_mensajero=mnf.id_mensajero
        where mv.id_movimiento=(select max(id_movimiento) from movimiento where id_envio=gi.id_envio)
        
                        order by gi.barra desc";

    //and mv.descripcion='ARRIBO' or mv.descripcion='INGRESO'
    $c= $db->consultar($sql);

    while ($row=$c->fetch(PDO::FETCH_OBJ))
    {
      $data[] = $row;
    }

    return $data;
  }


  public function reporte_n2()
  {
    $db=Db::getInstance();
    $sql = "select
                            gi.barra as barra,
                            us.usr_nombre as remitente,
                            gi.destinatario as destinatario,
                            cct.ccosto_nombre as centro_costo,
                            gi.des_direccion as direccion,
                            ct.des_cat as categoria,
                            mv.descripcion as estado,
                            mj.nombre as mensajero,
                            cctu.ccosto_nombre as remitente_dep
       
                        from guia gi
                        inner join usuario us on us.id_usr=gi.id_usr
                        inner join centro_costo cctu on cctu.id_ccosto=us.id_ccosto
                        inner join centro_costo cct on cct.id_ccosto=gi.des_ccosto
                        inner join categoria ct on ct.id_cat=gi.entero1
                        inner join movimiento mv on mv.id_envio=gi.id_envio
                        left join manifiesto_linea ml on ml.id_envio=gi.id_envio
                        left join manifiesto mnf on mnf.n_manifiesto=ml.n_manifiesto
                        left join mensajero mj on mj.id_mensajero=mnf.id_mensajero      
                       

        where mv.id_movimiento=(select max(id_movimiento) from movimiento where id_envio=gi.id_envio)
        and gi.id_usr=".$_SESSION['cod_user']."
                        order by gi.barra desc";

    //and mv.descripcion='ARRIBO' or mv.descripcion='INGRESO'
    $c= $db->consultar($sql);

    while ($row=$c->fetch(PDO::FETCH_OBJ))
    {
      $data[] = $row;
    }

    return $data;
  }

////////////////////////////////////////////WARNING///////////////////////////////////
///
  public function centro_costos(){

    $db=Db::getInstance();

    $sql="select * from centro_costo";

    $c=$db->consultar($sql);

    while ($row=$c->fetch(PDO::FETCH_OBJ))
    {
      $data[] = $row;
    }

    return $data;
  }


  public function centroc($id_ccosto){

    $db=Db::getInstance();

    $sql="select c.ccosto_codigo, c.ccosto_nombre, c.centro_direccion, c.ccosto_telefono, a.agencia_nombre from centro_costo c 
          inner join agencia a on a.id_agencia=c.id_agencia 
         where c.id_ccosto=".$id_ccosto;

    $c=$db->consultar($sql);

    while ($row=$c->fetch(PDO::FETCH_OBJ))
    {
      $data[] = $row;
    }

    return $data;

  }

  public function centroup($string, $id_cc){
    $db=Db::getInstance();
    $sql="update centro_costo set ".$string." where id_ccosto=".$id_cc;
    $db->consultar($sql);
    //echo $sql;
  }



}
?>
