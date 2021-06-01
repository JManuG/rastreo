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
                and gi.entero1!=5
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

///////////////////////////////////////////////////*rutas autogeneradas*/////////////////////////////////////////////
public function reporte_rutas(){

  $db = Db::getInstance();
  $sql="select * from ruta";
  $ruta=$db->consultar($sql);
  while($row_ruta=$ruta->fetch(PDO::FETCH_OBJ)){
    $data[] = $row_ruta;
  }
  return $data;
}

public function ruta_detalle($id_ruta){
  //aqui obtenemos el detalle de las rutas las cuales esta siguiendo el mensajero
  $db = Db::getInstance();
  $sql="select rd.comentario, rd.hora_ini, rd.hora_fin, ag.agencia_nombre, ag.agencia_direccion, pdd.des_periodicidad, ag.agencia_codigo
        from ruta_detalle rd
        inner join agencia ag on ag.id_agencia=rd.id_agencia
        inner join periodicidad pdd on pdd.id_periodicidad=rd.id_periodicidad
        
        where rd.id_ruta=".$id_ruta;

  $dd_ruta=$db->consultar($sql);
  while ($row_detalle=$dd_ruta->fetch(PDO::FETCH_OBJ)){
    $data[]=$row_detalle;
  }

  return $data;
}

public function vineta_ruta($codigo_agencia,$f_iniocio,$f_fin){

  $db = Db::getInstance();
  $sql=" select gi.barra  from guia gi
                      inner join agencia ag on ag.id_agencia=gi.des_ccosto 
          inner join manifiesto_linea ml on ml.id_envio=gi.id_envio
                      inner join manifiesto mnf on mnf.n_manifiesto=ml.n_manifiesto
                      inner join mensajero mj on mj.id_mensajero=mnf.id_mensajero
                      where gi.fecha_date between '$f_iniocio' and '$f_fin' and gi.entero1=5
                      and gi.des_ccosto = $codigo_agencia";

  $dd_ruta=$db->consultar($sql);
  while ($row_detalle=$dd_ruta->fetch(PDO::FETCH_OBJ)){
    $data[]=$row_detalle;
  }

  return $data;

}


public function reporte_automaticas(){
      

}

}
?>



