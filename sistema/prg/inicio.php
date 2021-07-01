<?php
session_start();
class inicio
{

public function index()
{


if(!empty($_SESSION['cod_usuario']))
{
include('vista/inicio.php');

    include('vista/encuesta.php');

include('vista/inicio_pie.php');
}
else
{
echo "Debes iniciar session";
}
}


}

?>