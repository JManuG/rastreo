<?php
class repor_ingresos1{

    public function index(){

        session_start();
        if(!empty($_SESSION['cod_usuario']))
        {
            //require('../class/cab.php');
            include('vista/inicio.php');
            include('vista/repor_ingresos1.php');
            include('vista/pie_report.php');
        }
        else
        {
            echo "Debes iniciar session";
        }

    }

}