<?php
session_start();
class guia
{
    public function ingreso()
    {
        if(!empty($_SESSION['cod_usuario']))
        {
            //require('../class/cab.php');
            include('vista/inicio.php');
            include('vista/form_ingreso_guia.php');
            ?>

            <?php
            include('vista/inicio_pie.php');
        }
        else
        {
            echo "Debes iniciar session";
        }
    }


}
?>