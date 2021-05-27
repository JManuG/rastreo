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

   $x2=$x1->manifiesto_ruta($id);
        $b=array();
        $cnt=0;
        
        //'estado'=>$row->estado_guia
        //echo $cnt."<br>";
        //print_r($b);
        if(isset($_GET['mj'])){

            foreach($x2 as $row) {
                $cnt++;
                $b[]=[
                    'barra'=> (int)$row->idPedido,
                    'pedido'=>$row->idenvio,
                    'destinatario' =>$row->destinatario,
                    'zona' =>$row->zona,
                    'fecha_hora'=>"$row->fecha_hora",
                    'comentario'=>$row->comentario,
                    'remitente'=>$row->remitente, //remitente
                    'nombre_remitente'=>$row->nombre_remitente,//nombre remitente
                    'dep_remitente'=>$row->dep_remitente,//departamento_remitente
                    'fecha'=>"$row->fecha_hora",
                    'categoria'=>$row->categoria,
                    'direccion'=>$row->direccion,
                    'estado'=>$row->estado
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
                    'barra'=> (int)$row->idPedido,
                    'pedido'=>$row->idenvio,
                    'destinatario' =>$row->destinatario,
                    'zona' =>$row->zona,
                    'fecha_hora'=>"$row->fecha_hora",
                    'comentario'=>$row->comentario,
                    'remitente'=>$row->remitente, //remitente
                    'nombre_remitente'=>$row->nombre_remitente,//nombre remitente
                    'dep_remitente'=>$row->dep_remitente,//departamento_remitente
                    'fecha'=>"$row->fecha_hora",
                    'categoria'=>$row->categoria,
                    'direccion'=>$row->direccion,
                    'estado'=>$row->estado
                ];
            }


            echo json_encode($b);

        } 


?>