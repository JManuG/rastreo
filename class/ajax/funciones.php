<?php
function valida_usuario($form){
    $respuesta = new xajaxResponse();
            $error_form="Usuario no Valido";
            $respuesta->assign("mensaje","innerHTML","<span class='textorojo_bold'>".$error_form."</span>");
        return $respuesta;
}
?>
