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
    <title>Evaluando...</title>
</head>
<body>
    <?php
        //inicia sesión
        SESSION_START();
        // si la variable de sesion existe
        if(isset($_SESSION['trabajador'])){
            //Si el usuario es evaluador, el valor get id es numerico y fue enviado el estatus
            if($_SESSION['trabajador']=='Evaluador' && is_numeric($_GET['id']) && isset($_POST['estatus'])){
                //Hace la conexión con la bd
                include("bd.php");
                $conexionbd=conectarbd();
                //Hace una consulta para buscar la informacion con el id enviado
                $consultaBusquedaId="SELECT * FROM informacion WHERE id=".$_GET['id'];
                $ejecucionBusqueda=mysqli_query($conexionbd,$consultaBusquedaId);
                $busquedaId=mysqli_fetch_assoc($ejecucionBusqueda);
                //Si existe información
                if(!empty($busquedaId)){
                    //Si el estatus fue autorizar entra
                    if($_POST['estatus']=='Autorizar'){
                        //Actualiza el estatus a Autorizado
                        $estatus='Autorizado';
                        $consultaEvaluado="UPDATE informacion SET estatus='".$estatus."', comentarios='' WHERE id=".$_GET['id'];
                    // si fue rechazado entra
                    }else{
                        //Actualiza el estatus a Rechazado
                        $estatus='Rechazado';
                        $consultaEvaluado="UPDATE informacion SET estatus='".$estatus."', comentarios='".$_POST['observaciones']."' WHERE id=".$_GET['id'];
                    }
                    //Ejecuta la consulta
                    $evaluado=mysqli_query($conexionbd,$consultaEvaluado);
                    //Si fue evaluado...
                    if($evaluado){
                        //Muestra en pantalla que el prospecto fue evaluado
                        echo '
                        <div class="px-4 py-5 my-5 text-center">
                        <h1 class="display-5 fw-bold">Prospecto '.$estatus.'!</h1>
                        <div class="col-lg-6 mx-auto">
                        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                            <a href="listaProspectosEvaluar.php" class="btn btn-primary btn-lg px-4 gap-3">Ver Lista</a>
                        </div>
                        </div>
                        </div>';
                    // si no...
                    }else{
                        //Muestra en pantalla que hubo un error
                        echo '
                        <div class="px-4 py-5 my-5 text-center">
                        <h1 class="display-5 fw-bold">Ocurrio un error al evaluar prospecto</h1>
                        <div class="col-lg-6 mx-auto">
                        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                            <a href="listaProspectosEvaluar.php" class="btn btn-outline-secondary btn-lg px-4">Volver a intentar</a>
                        </div>
                        </div>
                        </div>';
                    }
                    //Cierra conexión
                    mysqli_close($conexionbd);
                // si no existe
                }else{
                    // no entra a esta pantalla
                    ?><script>history.back()</script><?php    
                }
            // si no
            }else{
                //No entra a esta pantalla
                ?><script>history.back()</script><?php
            }
        // si no
        }else{
            //nos regresa al inicio de sesión
            header('location:iniciarsesion.html');
        }
    ?>
</body>
</html>