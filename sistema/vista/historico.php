<?php

include('../../class/db.php');

class historico_ingresos extends Db
{
  public function __construct()
  {
    $db=Db::getInstance();
  }

  public function reporte_h($f1,$f2)
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
                            gi.fecha_datetime as fecha,
                            cctu.ccosto_nombre as remitente_dep,
                            gi.estado as ge

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
                and gi.fecha_date between '".$f1."' and '".$f2."' 
                        order by gi.barra desc";

    //and mv.descripcion='ARRIBO' or mv.descripcion='INGRESO'
    $c= $db->consultar($sql);

    //print_r($c);

    while ($row=$c->fetch(PDO::FETCH_OBJ))
    {
      $data[] = $row;
    }

    return $data;
  }

  public function reporte_h2($f1,$f2)
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
                            gi.fecha_datetime as fecha,
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
                and gi.fecha_date between '".$f1."' and '".$f2."' 
                and gi.id_usr=".$_SESSION['cod_user']."
                        order by gi.barra desc";

    //and mv.descripcion='ARRIBO' or mv.descripcion='INGRESO'
    $c= $db->consultar($sql);

    //print_r($c);

    while ($row=$c->fetch(PDO::FETCH_OBJ))
    {
      $data[] = $row;
    }

    return $data;
  }

  public function get_img($barra){
    $db=Db::getInstance();
    $sql = "select r.imagen
                from recurso r 
                inner join guia g
                on r.char1=g.barra
                where g.barra=$barra
                and r.estado=4";
    $c=$db->consultar($sql);
    $imagen="";
    while ($row_dl=$c->fetch(PDO::FETCH_NUM))
    {
      $imagen=$row_dl[0];
    }

    return $imagen;
  }

}
?>

