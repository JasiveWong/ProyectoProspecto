<?php
    SESSION_START();
    if(isset($_SESSION['usuario'])&& isset($_SESSION['trabajador'])){
        SESSION_UNSET();
        SESSION_DESTROY();
        sleep(3);
        header('location:index.html');
    }else{
        header('location:iniciarsesion.html');
    }
?>