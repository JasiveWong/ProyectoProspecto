<?php
    //Inicia sesión
    SESSION_START();
    //Si existen las variables de sesión
    if(isset($_SESSION['usuario'])&& isset($_SESSION['trabajador'])){
        //Destruye la sesión 
        SESSION_UNSET();
        SESSION_DESTROY();
        //Tiempo de espera de 3 segundos
        sleep(3);
        //Nos devuelve al index
        header('location:index.html');
    //si no
    }else{
        //Nos envia a que iniciemos sesión
        header('location:iniciarsesion.html');
    }
?>