<?php
        //Guarda la información en variables
        $usuario = $_POST['usuario'];
        $captcha = $_POST['g-recaptcha-response'];
        $contra = $_POST['contra'];
        //Si fue validado el captcha
        if(!empty($captcha)){
            //Valida el captcha
            $clave = "6LdOVQMgAAAAAE1DUZi6vOAeA7YFMzfQw5Y7gIam";
            $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$clave&response=$captcha");
            $aceptado=json_decode($response,TRUE);
            //Si fue aceptado
            if($aceptado["success"]){
                //Hace la conexion con la bd
                include("bd.php");
                $conexionbd=conectarbd();
                //Hace una consulta para buscar informacion sobre el usuario
                $consultaBusquedaUsuario = "SELECT*FROM usuarios WHERE usuario= '$usuario'";
                $ejecucionBusquedaUsuario = mysqli_query($conexionbd,$consultaBusquedaUsuario);
                $resultadoBusquedaUsuario = mysqli_fetch_assoc($ejecucionBusquedaUsuario);
                //Si no se encontro información 
                if(!empty($resultadoBusquedaUsuario)){
                    //Verifica la contraseña ingresada y la contraseña guardada en la bd encriptada
                    if(password_verify($contra, $resultadoBusquedaUsuario['contrasenia'])){
                        //Inicia sesión
                        SESSION_START();
                        //Crea variable de sesión
                        $_SESSION['trabajador']=$resultadoBusquedaUsuario['tipo'];
                        $_SESSION['promotor'] = $usuario;
                        //Si el usuario es promotor
                        if($resultadoBusquedaUsuario['tipo'] == "Promotor"){
                            //Lo lleva al listado de prospectos
                            header("location:listadoProspectos.php");
                        //Si el usuario es evaluador
                        }else{
                            //Lo lleva al listado de prospectos a evaluar
                            header("location:listaProspectosEvaluar.php");
                        }
                    //si no
                    } else{
                        //Nos pide que verifiquemos la contraseña y el usuario
                        ?>
                        <?php
                        include("iniciarsesion.html");
                        ?>
                        <script type = "text/javascript"> 
                            alert("Verifique que el usuario y contraseña sean correctos ");
                        </script>
                        <?php
                    }
                    //Cierra la conexion
                    mysqli_free_result($ejecucionBusquedaUsuario);
                    mysqli_close($con);
                // si no
                }else{
                    //Nos dice que el usuario no existe
                    ?>
                    <?php
                        include("iniciarsesion.html");
                    ?>
                    <script type = "text/javascript"> 
                        alert("El usuario no existe");
                    </script>
                    <?php
                }
                //Cierra conexión
                mysqli_close($conexionbd);
            }
        //si no
        }else{
            //Nos lleva a iniciar sesión
            header('location:iniciarsesion.html');
        }
?>





