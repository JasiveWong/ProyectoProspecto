<?php
    function conectarbd(){
        $servidor="localhost";
        $nombrebd="prospectos";
        $usuario="root";
        $contra="";
        $conexion=mysqli_connect($servidor,$usuario,$contra);
        mysqli_select_db($conexion,$nombrebd);
        return $conexion;
    }
?>