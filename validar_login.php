<?php
        $usuario = $_POST['usuario'];
        $captcha = $_POST['g-recaptcha-response'];
        $contra = $_POST['contra'];

        if(!empty($captcha)){
            $secret = "6LdOVQMgAAAAAE1DUZi6vOAeA7YFMzfQw5Y7gIam";
            $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha");
            $arr=json_decode($response,TRUE);
            if($arr["success"]){
                session_start();
                include("bd.php");
                $conexionbd=conectarbd();
                $consulta = "SELECT*FROM usuarios WHERE usuario= '$usuario'";
                $resultado = mysqli_query($conexionbd,$consulta);
                $fila = mysqli_fetch_assoc($resultado);
                if(!empty($fila)){
                    if(password_verify($contra, $fila['contrasenia'])){
                        SESSION_START();
                        $_SESSION['usuario']=$usuario;
                        $_SESSION['trabajador']=$fila['tipo'];
                        if($fila['tipo'] == "Promotor"){
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
                    mysqli_free_result($resultado);
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





