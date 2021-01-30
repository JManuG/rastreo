<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Response;

class Usr extends Controller
{
    public function wel(){
        ini_set('display_errors', 1);

        ini_set('display_startup_errors', 1);

        error_reporting(E_ALL);
        //$sql = "SHOW TABLES FROM rastreo";
        //$sql = "select * from agencia";
        //$sql = "select * from categoria";
        //$sql = "select * from centro_costo";
        //$sql = "select * from chk_id";
        //$sql = "select * from cliente";
        //$sql = "select * from correlativo";
        //$sql = "select * from guia";
        //$sql = "select * from manifiesto";
        //$sql = "select * from manifiesto_linea  where id_envio=92";
        //$sql = "select * from mensajero";
        //$sql = "select * from motivo";
        //$sql = "select * from movimiento where id_movimiento=(select max(id_movimiento) from movimiento where id_envio=65)";
        //$sql = "select * from orden";
        //$sql = "select * from recurso";
        //$sql = "select * from usuario";
        //$sql = "select * from zona";
        $sql="select gi.barra as idPedido, gi.destinatario as name, cct.ccosto_nombre as centro_costo, gi.des_direccion as address, ct.des_cat as categoria, mv.descripcion as estado, gi.fecha_datetime as createdAt, gi.comentario as comments, cct.ccosto_nombre as centro_costo, z.zon_descripcion as address from guia gi inner join usuario us on us.id_usr=gi.id_usr inner join centro_costo cct on cct.id_ccosto=gi.des_ccosto inner join categoria ct on ct.id_cat=gi.entero1 inner join movimiento mv on mv.id_envio=gi.id_envio inner join manifiesto_linea ml on ml.id_envio=gi.id_envio inner join manifiesto mnf on mnf.n_manifiesto=ml.n_manifiesto inner join zona z on z.id_zona=mv.id_zona inner join mensajero mj on mj.id_mensajero=mnf.id_mensajero where mj.id_mensajero=3 ";
        $datos=DB::select($sql);


        return $datos;

        $token= csrf_token();
        echo $token;
    }

    //inicio de sesion de usurio api.
    public function login(Request $request)
    {
        $user=trim($request->input('usr'));
        $pass=trim($request->input('pass'));
        $datos=DB::table('usuario')
                    ->join('cliente','cliente.cli_id','usuario.cli_codigo')
                    ->join('centro_costo','centro_costo.id_ccosto','usuario.id_ccosto')
        ->select(
                'usuario.id_usr',
                'usuario.usr_cod',
                'usuario.usr_pass',
                'usuario.usr_nombre',
                'usuario.cli_codigo',
                'usuario.id_grupo',
                'usuario.nivel',
                'usuario.depto',
                'usuario.id_ccosto',
                'usuario.area',
                'usuario.producto',
                'usuario.posicion',
                'usuario.estado',
                'usuario.dias_vencimiento',
                'cliente.cli_nombre',
                'cliente.cli_direccion',
                'centro_costo.ccosto_codigo',
                'centro_costo.ccosto_nombre',
                'centro_costo.ccosto_telefono',
        )->where('usuario.usr_cod','=',$user)
         ->where('usuario.usr_pass','=',md5($pass)
         )->get();

         return $datos;
    }

    public function cambio()
    {

        return View('change_password');
        /*/enviagt
        $usr = $request->input('usr');
        //$pass = $request->input('pass');
        $newpass= md5($request->input('newpass'));

        $affected = DB::table()
                        ->where('usr_cod','=',$usr)
                        ->update(['usr_pass' => $newpass]);

        return $affected;
        */
    }
    public function cambio_p(Request $request)
    {
        $usr = $request->input('usr');
        $pass = md5($request->input('clave1'));

        //echo $usr."----->".$pass;
       $newpass= md5($request->input('clave2'));

        $affected = DB::table('usuario')
                        ->where('usr_cod','=',$usr)
                        ->update(['usr_pass' => $pass]);


        return
        View('resultado',['resultado'=>$affected]);
    }


    public function rep_detalle(Request $request)
    {
       /* $tipo=$request->input('tipo');
        $fecha1=$request->input('f1');
        $fecha2=$request->input('f2');*/

        $sql="select * from movimiento where id_envio in (
            select id_envio from guia where fecha_date between '2021-01-01' and '2021-01-19')
            ";

        $data=DB::select($sql);

        return View('reporte_detalle',['data' => $data]);

    }


}
