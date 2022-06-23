<?php
    //Inicia sesión
    SESSION_START();
    //Si existe la variable de sesión
    if(isset($_SESSION['trabajador'])){
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