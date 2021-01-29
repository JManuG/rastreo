<?php

//ini_set ("display_errors","0" );
//error_reporting(E_ALL);
$u=$_GET['usr'];
$p=md5($_GET['pss']);
include("db_extend.php");
$x1=new model_con();

    $x2=$x1->login($u,$p);

    /**/
foreach($x2 as $row) {
    $a = array(
        'id' => $row->id_usr,
            'nombre' => $row->usr_nombre,
            'apellido' => ' ',
            'telefono' => $row->telefono,
            'correo' => trim($row->usr_nombre.'@envia.com.gt'),
            'comercio_id' => $row->id_ccosto,
            'foto' => 'null',
            'token' => '8fdsf1g885dfgg6489g7f8886448fgggf4fgffg886'

        );
    }

    echo json_encode($a);/**/
?>
