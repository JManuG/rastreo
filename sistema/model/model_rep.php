<?php

//model model_rep
//0430080126
//
ini_set('post_max_size', '100M');
ini_set('upload_max_filesize', '100M');
ini_set('max_execution_time', '1000');
ini_set('max_input_time', '1000');

include('../../class/db.php');

class model_rep extends Db
{
    public function __construct()
    {
        $db = Db::getInstance();
    }

    public function informe1($date1, $date2)
    {
        $db=Db::getInstance();

        $sql_c = "SELECT m.id_chk,c.chk_descripcion, count(m.id_movimiento) as cantidad 
                    FROM `movimiento` m 
                    INNER JOIN chk_id c ON m.id_chk=c.id_chk 
                    WHERE m.fecha_date BETWEEN '$date1' AND '$date2' 
                    GROUP BY 1,2";

        $c= $db->consultar($sql_c);
        while ($row=$c->fetch(PDO::FETCH_OBJ))
        {
            $data[] = $row;
        }
        if(!empty($data)) {
            return $data;
        }else
            return $sql_c;
    }

}