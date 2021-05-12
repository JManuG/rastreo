<?php

//ini_set ("display_errors","0" );
//error_reporting(E_ALL);

//$u="enviagt";
//$p=md5("enviagt");
$arr_cookie_options = array (
    'expires' => time() + 60*60*24*30,
    'path' => '/',
    'domain' => '.example.com', // leading dot for compatibility or use subdomain
    'secure' => true,     // or false
    'httponly' => true,    // or false
    'samesite' => 'None' // None || Lax  || Strict
);
setcookie('TestCookie', 'The Cookie Value', $arr_cookie_options);
///**/
///

header('Strict-Transport-Security: max-age=15552000; includeSubDomains;');
$postdata = json_decode(file_get_contents("php://input"));

//print_r($postdata);

$u=trim($postdata->correo);
$p=md5(trim($postdata->password));
$dvi=$postdata->device_id;

include("db_extend.php");
$x1=new model_con1();
 
$x2=$x1->login($u,$p);



$a=null;
$tk=20;
$token=$x1->generar_token_seguro($tk);
$a=null;
foreach($x2 as $row) {
    $a = array(
            'id' => (int)$row->id_mensajero,
            'nombre' => $row->usr_nombre,
            'apellido' => '',
            'telefono' => $row->telefono,
            'correo' => trim($row->usr_nombre.'@envia.com.gt'),
            'comercio_id' => (int)$row->id_ccosto,
            'foto' => 'null',
            'token' => $token,
            'status'=>'200'
        );
    }

if($a!=null) {
    http_response_code(200);
    //header("HTTP/1.1 200 OK");
    echo json_encode($a);/**/
}else{
    http_response_code(404);
    //header("HTTP/1.1 404 Not Found");
    $f=array(
        'status'=>'404',
        'informe'=>'usuario invalido'
    );
    echo json_encode($f);
}


/*
 * $a = array(
        'id' => 4,
            'nombre' => 'Marvin',
            'apellido' => 'Abrego',
            'telefono' => '30619361',
            'correo' => 'mabrego@envia.com.gt',
            'comercio_id' => 1,
            'foto' => 'null',
            'token' => '8fdsf1g885dfgg6489g7f8886448fgggf4fgffg886'

        );

    echo json_encode($a);/**/
?>
