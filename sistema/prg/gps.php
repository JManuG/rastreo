<?php
session_start();

class  gps
{
    public function rastreo_rutas(){
        include('vista/inicio.php');
        include('vista/locacion_mj.php');
        include('vista/inicio_pie.php');
    }

    public function detalle_ruta(){
        include('vista/inicio.php');
        include('vista/ruta_detalle.php');
        include('vista/inicio_pie.php');
    }

    public function estado_ruta(){
        include('vista/inicio.php');
        include('vista/estado_ruta.php');
        include('vista/inicio_pie.php');
    }

    public function gps_mensajero(){
        include('vista/inicio.php');
        include('vista/gps_mj.php');
        include('vista/inicio_pie.php');
    }
}
?>
