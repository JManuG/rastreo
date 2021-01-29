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
                u.usr_nombre,
                mj.telefono,
                cc.id_ccosto
                from usuario u
                inner join mensajero mj on mj.id_usr=u.id_usr
                inner join centro_costo cc on cc.id_ccosto=u.id_ccosto
                where u.usr_cod='$u' and u.usr_pass='$p'";

        $c= $db->consultar($sql);

        //print_r($c);
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
        $sql="select 
                
                from usuario u
                inner join mensajero msj on msj.id_usr=u.id_usr
                inner join manifiesto mf on mf.id_mensajero=msj.id_mensajero
        ";

        $sql="select
                            gi.barra as barra,
                            gi.destinatario as destinatario,
                            cct.ccosto_nombre as centro_costo,
                            gi.des_direccion as direccion,
                            ct.des_cat as categoria,
                            mv.descripcion as estado,
                            
                        from guia gi
                        inner join usuario us on us.id_usr=gi.id_usr
                        inner join centro_costo cct on cct.id_ccosto=gi.des_ccosto
                        inner join categoria ct on ct.id_cat=gi.entero1
                        inner join movimiento mv on mv.id_envio=gi.id_envio
                        left join manifiesto_linea ml on ml.id_envio=gi.id_envio
                        left join manifiesto mnf on mnf.n_manifiesto=ml.n_manifiesto
                        left join mensajero mj on mj.id_mensajero=mnf.id_mensajero
                        where us.id_usr=$id_usr";

    }

    public function geolocal()
    {
        //geolocalizacion y fotos.

    }
}
?>