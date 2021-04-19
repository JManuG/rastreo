<?php

include('../../sistema/model/model_con.php');
date_default_timezone_set("America/Guatemala");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class model_con1 extends model_con
{
    public function __construct()
    {
        $db = Db::getInstance();
    }

    public function login($u,$p){
        //login de la api.

        $db=Db::getInstance();
        //datos no encontrados: apellido, correo,
        $sql="select 
                u.id_usr,
                mj.id_mensajero,
                u.usr_nombre,
                mj.telefono,
                cc.id_ccosto
                from mensajero mj
                inner join usuario u on u.usr_cod=mj.telefono
                inner join centro_costo cc on cc.id_ccosto=u.id_ccosto
                where u.usr_cod='$u' and u.usr_pass='$p'";

        $c= $db->consultar($sql);
        $data=[];
        //print_r($sql);
        while ($row=$c->fetch(PDO::FETCH_OBJ))
        {
            $data[] = $row;
        }

        //print_r($data);
        return $data;

    }

    public function manifiesto($id_usr)
    {
        //captura lo datos de manifiesto.
        $fecha_actual=date('Y-m-d');
        $db = Db::getInstance();

       $fun=new model_con();

        ///////////////////////////////////////////validacion de ruta asignada///////////////////

        $com="Select id_progra,fecha from programacion where id_mensajero=$id_usr";
        $ru=$db->consultar($com);
        $fecha_ruta=$fecha_actual;

        while($rutas=$ru->fetch(PDO::FETCH_OBJ)) {
            $fecha_ruta=$rutas->fecha;
            $id_progra=$rutas->id_progra;
        }
        //print_r($fecha_ruta);

        if($fecha_actual!=$fecha_ruta){

            $conp = "select ru.nombre_ruta,ag.agencia_nombre,ag.agencia_direccion,ag.agencia_codigo from programacion pro
                inner join ruta ru on ru.id_ruta=pro.id_ruta
                inner join ruta_detalle rd on rd.id_ruta=ru.id_ruta
                inner join agencia ag on ag.id_agencia=rd.id_agencia
                where id_mensajero=$id_usr";

            $progra = $db->consultar($conp);
            while ($rowp = $progra->fetch(PDO::FETCH_OBJ)) {

                $vineta=$fun->consulta_correlativo1();
                $tipo_envio='1';
                $destinatario="Agencia ".$rowp->agencia_codigo." - ".$rowp->agencia_nombre;
                $ccosto_des=$rowp->agencia_codigo;
                $ccosto_nombre= "Agencia ".$rowp->agencia_nombre;
                $des_direccion=$rowp->agencia_direccion;
                $agencia=$rowp->agencia_nombre;
                $descripcion='Ruta Automática';
                $id_cat='5';
                $ccosto_ori=1;
                $id_cli=$id_usr;
                $id_ccosto=1;
                $id_orden='';
                $id_zona=1;




                            try {

                                $fun->d_acuse($vineta, $tipo_envio, $destinatario, $ccosto_des, $ccosto_nombre, $des_direccion, $agencia, $descripcion, $id_cat);
                                $fun->registra_envio1($ccosto_ori, $ccosto_des, $destinatario, $descripcion, $vineta, $tipo_envio, $des_direccion, $id_cat, $id_usr);

                                $os = $fun->procesar_OS1($id_cli, $id_usr);
                                if ($os > 0) {
                                    $id_orden = $os;
                                    $fun->procesar_GuiaOS1($id_cli, $id_ccosto, $id_orden, $id_usr);
                                    $fun->procesar_AR1($vineta, $id_usr, $id_cli);
                                    $fun->procesar_LD1($id_zona, $id_usr, $vineta, $id_usr, $id_cli);
                                }

                            }catch (Exception $e){
                                print_r($e);
                            }

                            }

                            $rutafin="update programacion set fecha='$fecha_actual' where id_progra=$id_progra";
                            $db->consultar($rutafin);

                            //print_r($rutafin);

                        }
                        ////////////////////////////////////////validacion de ruta asignada/////////////////////////////

        $sql="select
                            gi.barra as idPedido,
                            gi.destinatario as name,
                            cct.ccosto_nombre as centro_costo,
                            gi.des_direccion as direccion,
                            ct.des_cat as categoria,
                            mv.descripcion as estado,
                            gi.fecha_datetime as createdAt,
                            gi.comentario as comments,
                            cct.ccosto_nombre as centro_costo,
                            z.zon_descripcion as address,
                            gi.estado as estado_guia,
                            us.id_usr as remitente,
                            us.usr_nombre as nombre_remitente,
                            cctr.ccosto_nombre as dep_remitente
       
                        from guia gi
                        inner join usuario us on us.id_usr=gi.id_usr
                        left join centro_costo cctr on cctr.id_ccosto=us.id_ccosto
                        left join centro_costo cct on cct.id_ccosto=gi.des_ccosto
                        left join categoria ct on ct.id_cat=gi.entero1
                        inner join movimiento mv on mv.id_envio=gi.id_envio
                        inner join manifiesto_linea ml on ml.id_envio=gi.id_envio
                        inner join manifiesto mnf on mnf.n_manifiesto=ml.n_manifiesto
                        left join zona z on z.id_zona=mv.id_zona
                        inner join mensajero mj on mj.id_mensajero=mnf.id_mensajero
                        where mj.id_mensajero=$id_usr
                        and mv.id_chk=3
                        and gi.estado=4
                        and ml.estado=1";

/*--and mv.id_chk=3
                        --and gi.estado=4
                        --and ml.estado=1*/
        $c= $db->consultar($sql);

        //print_r($c);

        while ($row=$c->fetch(PDO::FETCH_OBJ))
        {
            $data[] = $row;
        }

        //print_r($data);
        return $data;

    }

    public function guiaup($estado,$barra)
    {

        $db = Db::getInstance();
        //comentar el porblema
        $sql = "update guia set estado='" . $estado . "'
        where barra='" . $barra . "'";
        $c=$db->consultar($sql);
        //print_r($c);
    }

    public function obtener_guia($barra){

        $db=Db::getInstance();
        $sql2="select id_guia,id_envio from guia
        where barra='".$barra."'";
        $gui=$db->consultar($sql2);

        return $gui;
    }



    public function movimeintoup($id_guia,$id_usr,$fecha_date,$fecha_datetime,$marca,$chk,$des){
        $db=Db::getInstance();


        $sql="INSERT INTO movimiento 
							(id_movimiento,id_envio,id_chk,id_zona,id_mensajero,id_usr, fecha_date, fecha_datetime, tiempo, id_motivo, descripcion, movimientocol)
					VALUES (0,$id_guia,$chk,1,'$id_usr','$id_usr','$fecha_date','$fecha_datetime','$marca','1','$des',NULL) ";
        $c= $db->consultar($sql);

//echo $sql;
    }

    public function obtener_movimeinto($barra,$id_guia,$chk){

        $db=Db::getInstance();
        $sql2="select max(id_movimiento) from movimiento
        where id_envio=".$id_guia."
        and id_chk=".$chk;
        $mov=$db->consultar($sql2);

        return $mov;
    }


    public function recursoup($barra,$latitud,$longitud,$fecha,$fecha_datetime,$foto,$id_usr,$estado,$tiempo,$movimiento)
    {
        //geolocalizacion y fotos.
        $db=Db::getInstance();

        $sql="insert into recurso 
                (id_recurso, id_movimiento, url, tipo, estado, latitud, longitud, altitud, id_usr, fecha_date, fecha_datetime, tiempo, char1, entero1, imagen)
                VALUES(0,$movimiento,'Esperando imagen','-',$estado,'$latitud','$longitud','0',$id_usr,'$fecha','$fecha_datetime','$tiempo','$barra','1','$foto')";
        $c= $db->consultar($sql);



    }




public function carga_img($movimiento,$barra,$imagen)
{
    try {
        $url="";
        if($imagen==""){
            $url="sin imagen";
        }else{
            $url="imagen ingresada";
        }

        $db=Db::getInstance();
        $imagen=addcslashes($imagen,"\x00\'\"\r\n");
        $sql="update recurso set imagen=_binary'".$imagen."', tipo='".$movimiento."', url='".$url."'
    where char1='".$barra."'";

        $c=$db->consultar($sql);
        return $url;
    } catch (Exception $e){
        return $e->errorMessage();
    }


}




    public function manifiestoup($id_envio){
        $db=Db::getInstance();
        $sql="update manifiesto_linea set estado=2 where id_envio=".$id_envio;
        $c= $db->consultar($sql);
    }


    function generar_token_seguro($longitud)
    {
        if ($longitud < 4) {
            $longitud = 4;
        }

        return bin2hex(random_bytes(($longitud - ($longitud % 2)) / 2));
    }

    function consul($sql)
    {
       $db = Db::getInstance();
       $c=$db->consultar($sql);

        while ($row=$c->fetch(PDO::FETCH_OBJ))
        {
            $data[] = $row;
        }

        //print_r($data);
        return $data;


    }



}
?>