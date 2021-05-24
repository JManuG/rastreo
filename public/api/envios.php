<?php
header('Strict-Transport-Security: max-age=0;');
//$postdata = json_decode(file_get_contents("php://input"));


        $a=array(
            [
              'idPedido'=> random_int(0,100),
              'idRequest'=>"2",
              'quantity'=>0,
              'total'=>0.0,
              'name' =>'Roberto scamilla',
              'address' =>'zona 12',
              'wayToPay'=>"Tarjeta",
              'createdAt'=>"2021-01-28T09:53:00",
              'requestId'=>"1",
              'comments'=>"tarjeta visa",
              'additionalShops'=>"",
              'vuelto'=>"",
              'recipe'=>"",
              'insuranceId'=>0,
              'nit'=>"",
              'cliId'=>"",
              'char1'=>"Altos de Verapaz zona 15, Ciudad de Guatemala",
              'estado'=>0,
            ],
            [
                    
                    'idPedido'=> random_int(101,200),
                'idRequest'=>"3",
                'quantity'=>0,
                'total'=>0.0,
                'name' =>'JOSE PEREZ',
                'address' =>'zóna 12',
                'wayToPay'=>"Tarjeta",
                'createdAt'=>"2021-01-28T09:54:00",
                'requestId'=>"1",
                'comments'=>"tarjeta visa",
                'additionalShops'=>"",
                'vuelto'=>"",
                'recipe'=>"",
                'insuranceId'=>0,
                'nit'=>"",
                'cliId'=>"",
                'char1'=>"Arkadia Nivel 1 Departamento de Seguridad de datos",
                'estado'=>0,
            ],
            [
                'idPedido'=> random_int(201,300),
                'idRequest'=>"4",
                'quantity'=>0,
                'total'=>0.0,
                'name' =>'JUAN GONZALEZ',
                'address' =>'zóna 12',
                'wayToPay'=>"Tarjeta",
                'createdAt'=>"2021-01-28T08:55:00",
                'requestId'=>"1",
                'comments'=>"tarjeta visa",
                'additionalShops'=>"",
                'vuelto'=>"",
                'recipe'=>"",
                'insuranceId'=>0,
                'nit'=>"",
                'cliId'=>"",
                'char1'=>"Agencia Zona 9 Anexo nivel 2",
                'estado'=>0,
            ],
            [
                'idPedido'=> random_int(301,400),
                'idRequest'=>"5",
                'quantity'=>0,
                'total'=>0.0,
                'name' =>'MARIO MARTINEZ',
                'address' =>'zóna 12',
                'wayToPay'=>"Tarjeta",
                'createdAt'=>"2021-01-28T07:35:00",
                'requestId'=>"1",
                'comments'=>"tarjeta visa",
                'additionalShops'=>"",
                'vuelto'=>"",
                'recipe'=>"",
                'insuranceId'=>0,
                'nit'=>"",
                'cliId'=>"",
                'char1'=>"Primer nivel, Créditos y Cobros",
                'estado'=>0,
            ],
            [
                'idPedido'=> random_int(401,500),
                'idRequest'=>"6",
                'quantity'=>0,
                'total'=>0.0,
                'name' =>'ABEL RAMOS',
                'address' =>'zóna 12',
                'wayToPay'=>"Tarjeta",
                'createdAt'=>"2021-01-28T10:20:15",
                'requestId'=>"1",
                'comments'=>"tarjeta visa",
                'additionalShops'=>"",
                'vuelto'=>"",
                'recipe'=>"",
                'insuranceId'=>0,
                'nit'=>"",
                'cliId'=>"",
                'char1'=>"Edificio Arkadia Nivel 1 Gestión comercial",
                'estado'=>0,
            ],
=======
include("db_extend.php");

$x1=new model_con1();

   $id=	$_GET['mensajero'];

   /**autogenerados prueba de recorrido*/
   $data_auto=$x1->rutas_auto($id);

     //echo json_encode($data_auto);
    // echo "/*/*/*/*/*/*/*/*/******/*/*/*/*/*/*/*/*/*/*/*///////////////////////**************";
   /*prueba de recorrido logico*/

   $x2=$x1->manifiesto($id);
        $b=array();
        $cnt=0;
        
        //'estado'=>$row->estado_guia
        //echo $cnt."<br>";
        //print_r($b);
        if(isset($_GET['mj'])){

            foreach($x2 as $row) {
                $cnt++;
                $b[]=[
                    'idPedido'=> (int)$row->idPedido,
                    'idRequest'=>$row->idPedido,
                    'quantity'=>0,
                    'total'=>0.0,
                    'name' =>$row->name,
                    'address' =>$row->address,
                    'wayToPay'=>"Tarjeta",
                    'createdAt'=>"$row->createdAt",
                    'requestId'=>"1",
                    'comments'=>$row->comments,
                    'additionalShops'=>$row->remitente, //remitente
                    'vuelto'=>$row->nombre_remitente,//nombre remitente
                    'recipe'=>$row->dep_remitente,//departamento_remitente
                    'insuranceId'=>0,
                    'nit'=>"$row->createdAt",
                    'cliId'=>$row->categoria,
                    'char1'=>$row->direccion,
                    'estado'=>0
                ];
            }

    
            $data= array(
                "cantidad"=>"$cnt",
                "datos" => $b
            );
            header('Content-Type: application/json');
        
            echo json_encode($data);
        
        }else{

            foreach($x2 as $row) {
                $cnt++;
                $b[]=[
                    'idPedido'=> (int)$row->idPedido,
                    'idRequest'=>$row->idPedido,
                    'quantity'=>0,
                    'total'=>0.0,
                    'name' =>$row->name,
                    'address' =>$row->address,
                    'wayToPay'=>"Tarjeta",
                    'createdAt'=>str_replace(" ", "T", $row->createdAt),
                    'requestId'=>"1",
                    'comments'=>$row->comments,
                    'additionalShops'=>$row->remitente, //remitente
                    'vuelto'=>$row->nombre_remitente,//nombre remitente
                    'recipe'=>$row->dep_remitente,//departamento_remitente
                    'insuranceId'=>0,
                    'nit'=>"",
                    'cliId'=>$row->categoria,
                    'char1'=>$row->direccion,
                    'estado'=>0
                ];
            }


            echo json_encode($b);

        } 

?>
