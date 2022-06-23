<?php
        $usuario = $_POST['usuario'];
        $captcha = $_POST['g-recaptcha-response'];
        $contra = $_POST['contra'];

        if(!empty($captcha)){
            $clave = "6LdOVQMgAAAAAE1DUZi6vOAeA7YFMzfQw5Y7gIam";
            $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$clave&response=$captcha");
            $aceptado=json_decode($response,TRUE);
            if($aceptado["success"]){
                session_start();
                include("bd.php");
                $conexionbd=conectarbd();
                $consultaBusquedaUsuario = "SELECT*FROM usuarios WHERE usuario= '$usuario'";
                $ejecucionBusquedaUsuario = mysqli_query($conexionbd,$consultaBusquedaUsuario);
                $resultadoBusquedaUsuario = mysqli_fetch_assoc($ejecucionBusquedaUsuario);
                if(!empty($resultadoBusquedaUsuario)){
                    if(password_verify($contra, $resultadoBusquedaUsuario['contrasenia'])){
                        SESSION_START();
                        $_SESSION['usuario']=$usuario;
                        $_SESSION['trabajador']=$resultadoBusquedaUsuario['tipo'];
                        if($resultadoBusquedaUsuario['tipo'] == "Promotor"){
                            header("location:listadoProspectos.php");
                        }else{
                            header("location:listaProspectosEvaluar.php");
                        }
                    } else{
                        ?>
                        <?php
                        include("iniciarsesion.html");
                        ?>
                        <script type = "text/javascript"> 
                            alert("Verifique que el usuario y contraseña sean correctos ");
                        </script>
                        <?php
                    }
                    mysqli_free_result($ejecucionBusquedaUsuario);
                    mysqli_close($con);
                }else{
                    ?>
                    <?php
                        include("iniciarsesion.html");
                    ?>
                    <script type = "text/javascript"> 
                        alert("El usuario no existe");
                    </script>
                    <?php
                }
            }
        }else{
            header('location:iniciarsesion.html');
        }
?>





