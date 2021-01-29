<?php
class repor_ingresos1{

    public function index(){
        session_start();
        if(!empty($_SESSION['cod_usuario']))
        {
            //require('../class/cab.php');
            include('vista/inicio.php');
            include('vista/repor_ingresos1.php');
            include('vista/inicio_pie.php');
        }
        else
        {
            echo "Debes iniciar session";
        }

    }

}