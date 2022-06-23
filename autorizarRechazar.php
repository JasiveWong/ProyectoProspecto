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
        SESSION_START();
        if(isset($_SESSION['usuario'])&& isset($_SESSION['trabajador'])){
            if($_SESSION['trabajador']=='Evaluador' && is_numeric($_GET['id']) && isset($_POST['estatus'])){
                include("bd.php");
                $conexionbd=conectarbd();
                $consultaBusquedaId="SELECT * FROM informacion WHERE id=".$_GET['id'];
                $ejecucionBusqueda=mysqli_query($conexionbd,$consultaBusquedaId);
                $busquedaId=mysqli_fetch_assoc($ejecucionBusqueda);
                if(!empty($busquedaId)){
                    if($_POST['estatus']=='Autorizar'){
                        $estatus='Autorizado';
                        $consultaEvaluado="UPDATE informacion SET estatus='".$estatus."', comentarios='' WHERE id=".$_GET['id'];
                    }else{
                        $estatus='Rechazado';
                        $consultaEvaluado="UPDATE informacion SET estatus='".$estatus."', comentarios='".$_POST['observaciones']."' WHERE id=".$_GET['id'];
                    }
                    $evaluado=mysqli_query($conexionbd,$consultaEvaluado);
                    if($evaluado){
                        echo '
                        <div class="px-4 py-5 my-5 text-center">
                        <h1 class="display-5 fw-bold">Prospecto '.$estatus.'!</h1>
                        <div class="col-lg-6 mx-auto">
                        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                            <a href="listaProspectosEvaluar.php" class="btn btn-primary btn-lg px-4 gap-3">Ver Lista</a>
                        </div>
                        </div>
                        </div>';
                    }else{
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
                }else{
                    ?><script>history.back()</script><?php    
                }
            }else{
                ?><script>history.back()</script><?php
            }
        }else{
            header('location:iniciarsesion.html');
        }
    ?>
</body>
</html>