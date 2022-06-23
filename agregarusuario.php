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
            $secret = "6LdOVQMgAAAAAE1DUZi6vOAeA7YFMzfQw5Y7gIam";
            $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha");
            $arr=json_decode($response,TRUE);
            if($arr["success"]){
                include("bd.php");
                $conexionbd=conectarbd();
                $buscarUsuarioRegistrado="SELECT usuario FROM usuarios WHERE usuario='".$usuario."'";
                $resultado=mysqli_query($conexionbd,$buscarUsuarioRegistrado);
                $registro=mysqli_fetch_assoc($resultado);
                if(empty($registro)){
                    $sql="insert into usuarios(id,usuario, tipo, contrasenia)";
                    $sql=$sql. " values(DEFAULT,'".$usuario."','".$trabajador."','".$contra."')";   
                    $result = mysqli_query($conexionbd,$sql);
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