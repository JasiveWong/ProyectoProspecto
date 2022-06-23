<?php
    function conectarbd(){
        //Informacion necesaria para conectarse con la base de datos
        $servidor="localhost";
        $nombrebd="prospectos";
        $usuario="root";
        $contra="";
        //Hace la conexión
        $conexion=mysqli_connect($servidor,$usuario,$contra);
        //Selecciona la base de datos
        mysqli_select_db($conexion,$nombrebd);
        //devuelve el resultado
        return $conexion;
    }
?>