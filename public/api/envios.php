<?php
header('Strict-Transport-Security: max-age=0;');
//$postdata = json_decode(file_get_contents("php://input"));

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
