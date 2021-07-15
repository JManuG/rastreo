<?php

use SimpleExcel\SimpleExcel;

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
    $sql = "select distinct distinct
                            gi.barra as barra,
                            us.usr_nombre as remitente,
                            gi.destinatario as destinatario,
                            if(gi.entero1!=5,cct.ccosto_nombre , cctu.ccosto_nombre)as centro_costo,
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
                        left join centro_costo cct on cct.id_ccosto=gi.des_ccosto
                        inner join categoria ct on ct.id_cat=gi.entero1
                        inner join movimiento mv on mv.id_envio=gi.id_envio
                        left join manifiesto_linea ml on ml.id_envio=gi.id_envio
                        left join manifiesto mnf on mnf.n_manifiesto=ml.n_manifiesto
                        left join mensajero mj on mj.id_mensajero=mnf.id_mensajero
        where mv.id_movimiento=(select max(id_movimiento) from movimiento where id_envio=gi.id_envio)
                and gi.fecha_date between '".$f1."' and '".$f2."' 
                and gi.estado<7
                        order by gi.barra desc";

    //and mv.descripcion='ARRIBO' or mv.descripcion='INGRESO' and gi.entero1!=5
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
                      where gi.fecha_date between '$f_iniocio' and '$f_fin' and gi.entero1=5
                      and gi.des_ccosto = $codigo_agencia";

  $dd_ruta=$db->consultar($sql);
  while ($row_detalle=$dd_ruta->fetch(PDO::FETCH_OBJ)){
    $data[]=$row_detalle;
  }

  return $data;

}


public function encuesta(){
  $db = Db::getInstance();
  $id_usr= $_SESSION['cod_user'];
  $sql="select * from encuesta where id_usr=".$id_usr;
  //print_r($sql);
  $data=0;
  $dd_ruta=$db->consultar($sql);
  while ($row_detalle=$dd_ruta->fetch(PDO::FETCH_OBJ)){
    $data=1;
  }

  return $data;


}
public function llenar_encuesta($r1,$r2,$r3,$r4,$r5){
  $db = Db::getInstance();
  $id_usr= $_SESSION['cod_user'];
  $sql="insert into encuesta (id_encuesta, id_usr, pregunta_1, pregunta_2, pregunta_3, pregunta_4, pregunta_5)
  values(0,$id_usr,$r1,$r2,$r3,$r4,'$r5')";
  $db->consultar($sql);
  //print_r($sql);
}


public function rep_historico_full($fecha_inicial, $fecha2){

  ini_set('display_errors', 1);

  ini_set('display_startup_errors', 1);
  
  error_reporting(E_ALL);


  $db = Db::getInstance();

  $sql="select distinct gi.id_guia, gi.barra, us.usr_nombre, 
              cco.ccosto_nombre 	as costo_origen,gi.destinatario, 
              ccd.ccosto_nombre 	as costo_destino, gi.comentario,
              ct.des_cat 		  	  as categoria,
              mj.nombre 			    as mensajero,
              max(IF(mv.id_chk=1, subtime(mv.fecha_Datetime, '06:00:00'),0)) AS Solicitud_de_Envío,
              max(IF(mv.id_chk=2, subtime(mv.fecha_Datetime, '06:00:00'),0)) AS Ingreso,
              max(IF(mv.id_chk=2, subtime(mv.fecha_Datetime, '06:00:00'),0)) AS Salida_a_Ruta,
              max(IF(mv.id_chk=4, mv.fecha_datetime,0)) AS Entrega,
              max(IF(mv.id_chk=5, mv.fecha_datetime,0)) AS Devolucion
              from guia gi
              inner join usuario us 		 	    on us.id_usr=gi.id_usr
              inner join centro_costo cco 	  on cco.id_ccosto=gi.ori_ccosto
              inner join centro_costo ccd 	  on ccd.id_ccosto=gi.des_ccosto
              inner join movimiento mv	 	    on mv.id_envio=gi.id_envio
              inner join categoria ct 	 	    on ct.id_cat=gi.entero1
              left join manifiesto_linea ml 	on ml.id_envio=gi.id_envio
              left join manifiesto mnf 		    on mnf.n_manifiesto=ml.n_manifiesto
              left join mensajero mj 		      on mj.id_mensajero=mnf.id_mensajero
              where gi.fecha_date 		 	      between '".$fecha_inicial."' and '".$fecha2."'
              and gi.estado<7
              group by gi.id_guia order by gi.id_guia desc ;";

            $c= $db->consultar($sql);

            //print_r($c);

            $data=[];
            $fecha = date("d-m-Y H:i:s");
           $filename = "libros.xls";

           header('Content-type: application/vnd.ms-excel');
           header("Content-Disposition: attachment; filename=Reporte_$fecha.xls"); //Indica el nombre del archivo resultante
           header("Pragma: no-cache");
           header("Expires: 0");




            /*echo "<style>
            table {
                border-collapse: collapse;
                width: 100%;
              }
              
              th, td {
                text-align: left;
                padding: 8px;
              }
              
              tr:nth-child(even){background-color: #f2f2f2}
              
              th {
                background-color: #04AA6D;
                color: white;
              }
                    </style>";*/
                    echo"<table border='1'>";

                    echo utf8_decode("<thead> 
            <th>N°</th>
            <th>Barra</th> 
            <th>Nombre Remitente</th> 
            <th>Departamento Remitente</th> 
            <th>Nombre Destinatario</th> 
            <th>Departamento Destinatario</th> 
            <th>Comentario</th> 
            <th>Categoria</th>  
            <th>Mensajero</th>
            <th>Solicitud de Envío</th>
            <th>Ingreso</th>
            <th>Salida a Ruta</th>
            <th>Entrega</th>
            <th>Devolucion</th>");
              $cnt=0;
              $x=false;
              $css="";
            while ($row=$c->fetch(PDO::FETCH_OBJ))
            {

              if($x){
                $css="style='background-color: #f2f2f2'";
                $x=false;
            }else{
                $css="";
                $x=true;
            }
              $cnt++;
              echo "<tr>";
              echo "<td>".$cnt."</td>";
                    echo"<td>".utf8_decode($row->barra)."</td>";
                    echo"<td>".utf8_decode($row->usr_nombre)."</td>";
                    echo"<td>".utf8_decode($row->costo_origen)."</td>";
                    echo"<td>".utf8_decode($row->destinatario)."</td>";
                    echo"<td>".utf8_decode($row->costo_destino)."</td>";
                    echo"<td>".utf8_decode($row->comentario)."</td>";
                    echo"<td>".utf8_decode($row->categoria)."</td>";
                    echo"<td>".utf8_decode($row->mensajero)."</td>";
                    echo"<td>".utf8_decode($row->Solicitud_de_Envío)."</td>";
                    echo"<td>".utf8_decode($row->Ingreso)."</td>";
                    echo"<td>".utf8_decode($row->Salida_a_Ruta)."</td>";
                    echo"<td>".utf8_decode($row->Entrega)."</td>";
                    echo"<td>".utf8_decode($row->Devolucion)."</td>";
                    echo"</tr>";
            }
        
            echo "</table>";


            $fecha = date("d-m-Y H:i:s");
 
            //Inicio de exportación en Excel
           
            //print_r($salida);


            
            /*require_once("../../lib/simple-excel-php/src/SimpleExcel/SimpleExcel.php");

            $excel = new SimpleExcel('xml');                    // instantiate new object (will automatically construct the parser & writer type as CSV)

            $excel->writer->setData(
                array
                (
                    array('ID',  'Name',            'Kode'  ),
                    array('1',   'Kab. Bogor',       '1'    ),
                    array('2',   'Kab. Cianjur',     '1'    ),
                    array('3',   'Kab. Sukabumi',    '1'    ),
                    array('4',   'Kab. Tasikmalaya', '2'    )
                )
            );                                                  // add some data to the writer
            $excel->writer->setDelimiter(";");                  // (optional) if delimiter not set, by default comma (",") will be used instead
            $excel->writer->saveFile('example');                // save the file with specified name (example.csv) 
                                          */            

            
}

}


?>



