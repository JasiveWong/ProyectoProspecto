<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor"
      crossorigin="anonymous"
    />
    <title>Listado de Prospectos</title>
</head>
<body>
    <div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
            <li><a href="listaProspectosEvaluar.php" class="nav-link px-2 link-secondary">Ver lista</a></li>
        </ul>
        <div class="col-md-3 text-end">
            <a href="cerrarsesion.php" class="btn btn-outline-primary me-2">Cerrar Sesión</a>
        </div>
    </header>
        <h1 class="display-5 fw-bold text-center">Listado de Prospectos a Evaluar</h1>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>Nombre del prospecto</th>
                    <th>Primer apellido</th>
                    <th>Segundo apellido</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php
                //Inicia sesión
                SESSION_START();
                //Si existen las variables de sesión
                if(isset($_SESSION['usuario'])&& isset($_SESSION['trabajador'])){
                    //Si el usuario es Evaluador
                    if($_SESSION['trabajador']=='Evaluador'){
                        //Hace la conexión con la bd
                        include("bd.php");
                        $conexionbd = conectarbd();
                        //Hace una consulta para mostrar informacion de prospectos con estatus enviado
                        $consultaDatosEnviados = "SELECT id,nombre,primerAp,segundoAp,estatus FROM informacion WHERE estatus='Enviado'";
                        $resultadoConsultaEnviados = mysqli_query($conexionbd,$consultaDatosEnviados);
                        //Recorre el arreglo de información
                        while ($arregloResultados = $resultadoConsultaEnviados->fetch_assoc()) {
                            //Muestra la información
                            echo '<tr>
                            <td>'. $arregloResultados["nombre"] .'</td>
                            <td>'. $arregloResultados["primerAp"] .'</td>
                            <td>'. $arregloResultados["segundoAp"] .'</td>
                            <td> <a href="evaluar.php?id='.$arregloResultados['id'].'" class="btn btn-primary" type="button">Ver más</button> </td>
                            </tr>';
                        }
                        //Cierra conexion
                        mysqli_close($conexionbd);
                    //Si no
                    }else{
                        //No entra a la pagina
                        ?><script>history.back()</script><?php
                    }
                //si no
                }else{
                    //Nos lleva a iniciar sesión
                    header('location:iniciarsesion.html');
                }   
               ?>
            </tbody>
        </table>
    </div>
</body>
</html>