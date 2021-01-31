<?php
include("db_extend.php");
$x1=new model_con();

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

        );

   $id=	$_GET['mensajero'];

   $x2=$x1->manifiesto($id);
        $b=array();
        $cnt=0;
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
                'createdAt'=>$row->createdAt,
                'requestId'=>"1",
                'comments'=>$row->comments,
                'additionalShops'=>"",
                'vuelto'=>"",
                'recipe'=>"",
                'insuranceId'=>0,
                'nit'=>"",
                'cliId'=>"",
                'char1'=>$row->direccion,
                'estado'=>0
            ];
        }
        //echo $cnt."<br>";
        //print_r($b);
    echo json_encode($b);
?>
