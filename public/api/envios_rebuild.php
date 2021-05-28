<?php
header('Strict-Transport-Security: max-age=0;');
//$postdata = json_decode(file_get_contents("php://input"));

include("db_extend.php");

$x1=new model_con1();

   $id=	$_GET['mensajero'];

  

   $x2=$x1->manifiesto_rebuild($id);
        $b=array();
        $cnt=0;
        
        //'estado'=>$row->estado_guia
       
        if(isset($_GET['mj'])){

            foreach($x2 as $row) {
                $cnt++;
                $b[]=[
                    'barra'                 =>(int)$row->barra,
                    'idenvio'               =>$row->id_envio,
                    'destinatario'          =>$row->destinatario,
                    'cc_destinatario'       =>$row->cc_destinatario,
                    'fecha_time'            =>"$row->fecha_cracion",
                    'comentario'            =>$row->comentario,
                    'remitente'             =>$row->remitente, //remitente
                    'nombre_remitente'      =>$row->nombre_remitente,//nombre remitente
                    'dep_remitente'         =>$row->dep_remitente,//departamento_remitente
                    'direccion'             =>$row->destino_direccion,
                    'fecha'                 =>"$row->fecha_cracion",
                    'categoria'             =>$row->categoria,
                    'estado'                =>$row->estado,
                ];
            }

    
            $data= array(
                "cantidad"=>"$cnt",
                "datos" => $b
            );
            header('Content-Type: application/json');
        
            echo json_encode($data);
        
        }else{

            $data= array(
                "cantidad"=>"$cnt",
                "datos" => $b
            );

            header('Content-Type: application/json');
        
            echo json_encode($data);
        }

?>