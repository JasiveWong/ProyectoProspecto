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
        $usuario = $_POST['usuario'];
        $trabajador = $_POST['trabajador'];
        $contra = password_hash($_POST['contra'], PASSWORD_DEFAULT);
        $captcha = $_POST['g-recaptcha-response'];
        if(!empty($captcha)){
            $clave = "6LdOVQMgAAAAAE1DUZi6vOAeA7YFMzfQw5Y7gIam";
            $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$clave&response=$captcha");
            $aceptado=json_decode($response,TRUE);
            if($aceptado["success"]){
                include("bd.php");
                $conexionbd=conectarbd();
                $consultasBusquedaUsuario="SELECT usuario FROM usuarios WHERE usuario='".$usuario."'";
                $consultaEjecutadaBusquedaUsuario=mysqli_query($conexionbd,$consultasBusquedaUsuario);
                $resultadoBusqueda=mysqli_fetch_assoc($consultaEjecutadaBusquedaUsuario);
                if(empty($resultadoBusqueda)){
                    $consultaGuardarValores="insert into usuarios(id,usuario, tipo, contrasenia)";
                    $consultaGuardarValores=$consultaGuardarValores. " values(DEFAULT,'".$usuario."','".$trabajador."','".$contra."')";   
                    $ConsultaEjecutadaGuardarValores = mysqli_query($conexionbd,$consultaGuardarValores);
                    mysqli_close($conexionbd);
                }else{
                    header('location:registro.html');
                }                
            }
        }else{
            header('location:registro.html');
        }
    ?>
</body>
</html>