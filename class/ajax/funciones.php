<?php
function valida_usuario($form){
    $respuesta = new xajaxResponse();


            //session_unset();   // Eliminando Variables desesion.
            //session_destroy(); // Terminando sesion creadaantes.
            $error_form="Usuario no Valido";
            $respuesta->assign("mensaje","innerHTML","<span class='textorojo_bold'>".$error_form."</span>");
        //}
        return $respuesta;
    //}
}
?>
