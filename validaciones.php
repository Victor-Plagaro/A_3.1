<?php

    function valida_nombre($nombre){
        $expresionValoresValidos = '/^[A-Za-záéíóúÁÉÍÓÚñÑ0-9\s]+$/u';
        if(preg_match($expresionValoresValidos, $nombre) && !empty($nombre) && (strlen($nombre) > 1) && ctype_upper($nombre[0])){
            return true;
        }
        else{
            return false;
        }
        
    }

    function valida_precio($precio){
        if($precio>0){
            return true;
        }
        else{
            return false;        
        }
    }
?>