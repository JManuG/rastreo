<?php
include('../../class/db.php');

class model_con extends Db
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
        //captura lso datos de manifiesto.

        $db=Db::getInstance();



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
                            z.zon_descripcion as address
       
                        from guia gi
                        inner join usuario us on us.id_usr=gi.id_usr
                        inner join centro_costo cct on cct.id_ccosto=gi.des_ccosto
                        inner join categoria ct on ct.id_cat=gi.entero1
                        inner join movimiento mv on mv.id_envio=gi.id_envio
                        inner join manifiesto_linea ml on ml.id_envio=gi.id_envio
                        inner join manifiesto mnf on mnf.n_manifiesto=ml.n_manifiesto
                        inner join zona z on z.id_zona=mv.id_zona
                        inner join mensajero mj on mj.id_mensajero=mnf.id_mensajero
                        where mj.id_mensajero=$id_usr
                        and mv.id_chk=3
                        and gi.estado=4";
        $c= $db->consultar($sql);

        //print_r($c);
        while ($row=$c->fetch(PDO::FETCH_OBJ))
        {
            $data[] = $row;
        }

        //print_r($data);
        return $data;

    }

    public function geolocal()
    {
        //geolocalizacion y fotos.



    }

    function generar_token_seguro($longitud)
    {
        if ($longitud < 4) {
            $longitud = 4;
        }

        return bin2hex(random_bytes(($longitud - ($longitud % 2)) / 2));
    }
}
?>