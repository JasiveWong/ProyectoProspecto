<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            window.location.href = "iniciarsesion.html";
        });
    </script>
    <title>Document</title>
</head>
<body>
    <?php
        //Asigna en variables los datos enviados por POST                        
        $usuario = $_POST['usuario'];
        $trabajador = $_POST['trabajador'];
        $contra = password_hash($_POST['contra'], PASSWORD_DEFAULT);
        $captcha = $_POST['g-recaptcha-response'];
        //Verifica si el captcha fue validado
        if(!empty($captcha)){
            $clave = "6LdOVQMgAAAAAE1DUZi6vOAeA7YFMzfQw5Y7gIam";
            $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$clave&response=$captcha");
            $aceptado=json_decode($response,TRUE);
            //Si el captcha fue validado
            if($aceptado["success"]){
                //Hace la conexión con la bd
                include("bd.php");
                $conexionbd=conectarbd();
                //Hace una consulta para saber si el usuario que queremos guardar ya existe
                $consultasBusquedaUsuario="SELECT usuario FROM usuarios WHERE usuario='".$usuario."'";
                $consultaEjecutadaBusquedaUsuario=mysqli_query($conexionbd,$consultasBusquedaUsuario);
                $resultadoBusqueda=mysqli_fetch_assoc($consultaEjecutadaBusquedaUsuario);
                //Si no lo encontro continua
                if(empty($resultadoBusqueda)){
                    //Inserta los datos del nuevo usuario
                    $consultaGuardarValores="insert into usuarios(id,usuario, tipo, contrasenia)";
                    $consultaGuardarValores=$consultaGuardarValores. " values(DEFAULT,'".$usuario."','".$trabajador."','".$contra."')";   
                    $ConsultaEjecutadaGuardarValores = mysqli_query($conexionbd,$consultaGuardarValores);
                    // cierra la conexion
                    mysqli_close($conexionbd);
                // si no
                }else{
                    //Nos regresa al registro para volver a intentar
                    header('location:registro.html');
                }                
            }
        //si no
        }else{
            //nos regresa a registrarnos de nuevo
            header('location:registro.html');
        }
    ?>
</body>
</html>