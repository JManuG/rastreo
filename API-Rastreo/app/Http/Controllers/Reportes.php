<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Response;

class Reportes extends Controller
{
    public function rep_detalle(Request $request)
    {
        /* $tipo=$request->input('tipo');
         $fecha1=$request->input('f1');
         $fecha2=$request->input('f2');*/

        $sql="select * from moviemintos ";

        $data=DB::select($sql);

        return $data;

    }

    public function rep_ingresos(Request $request)
    {
        $sql = "select * from guia";
        $data = DB::select($sql);

        return View('reporte_detalle',['data'=>$data]);
    }
}
