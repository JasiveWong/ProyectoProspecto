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
    <script src="./js/evaluacion.js"></script>
    <link href="css/estilos.css" rel="stylesheet" type="text/css">
    <title>Informacion del Prospecto</title>
</head>
<body>
    <div class="container">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">

            <div class="col-md-3 text-end">
            <a href="cerrarsesion.php" class="btn btn-outline-primary me-2">Cerrar Sesión</a>
            </div>
        </header>
        <?php
            SESSION_START();
            if(isset($_SESSION['usuario'])&& isset($_SESSION['trabajador'])){
                if($_SESSION['trabajador']=='Evaluador' && is_numeric($_GET['id'])){
                    include("bd.php");
                    $conexionbd=conectarbd();
                    $query="SELECT * FROM informacion WHERE id=".$_GET['id'];
                    $resultado=mysqli_query($conexionbd,$query);
                    $registro=mysqli_fetch_assoc($resultado);
                    if(!empty($registro)){
                        echo'<h1 class="display-5 fw-bold text-center">Información de: '.$registro['nombre']." ".$registro['primerAp'].'</h1>';
                        echo'
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><b>Nombre del prospecto: </b>'.$registro['nombre'].'</li>
                                <li class="list-group-item"><b>Primer apellido: </b>'.$registro['primerAp'].'</li>
                                <li class="list-group-item"><b>Segundo apellido: </b>'.$registro['segundoAp'].'</li>
                                <li class="list-group-item"><b>Calle: </b>'.$registro['calle'].'</li>
                                <li class="list-group-item"><b>Numero: </b>'.$registro['numero'].'</li>
                                <li class="list-group-item"><b>Colonia: </b>'.$registro['colonia'].'</li>
                                <li class="list-group-item"><b>Codigo Postal: </b>'.$registro['cp'].'</li>
                                <li class="list-group-item"><b>Telefono: </b>'.$registro['telefono'].'</li>
                                <li class="list-group-item"><b>RFC: </b>'.$registro['rfc'].'</li>
                                <li class="list-group-item"><b>Documentos: </b>';
                                    
                                $ruta=$ruta="archivos/".$registro['id']."-".$registro['primerAp']."".$registro['nombre']."";
                                if(is_dir($ruta)){
                                    $gestor = opendir($ruta);
                                    echo "<ol>";
                                        // Recorre todos los elementos del directorio
                                        while (($archivo = readdir($gestor)) !== false)  {
                                                
                                            $ruta_completa = $ruta . "/" . $archivo;
                                
                                            // Se muestran todos los archivos y carpetas excepto "." y ".."
                                            if ($archivo != "." && $archivo != "..") {
                                                // Si es un directorio se recorre recursivamente
                                                if (is_dir($ruta_completa)) {
                                                    echo "<li><a href='$ruta_completa' download='$archivo'>$archivo</a></li>";
                                                    obtener_estructura_directorios($ruta_completa);
                                                } else {
                                                    echo "<li><a href='$ruta_completa' download='$archivo'>$archivo</a></li>";
                                                }
                                            }
                                        }
                                        // Cierra el gestor de directorios
                                        closedir($gestor);
                                    echo '</ol>';
                                }else{
                                    echo '<p>Error al cargar los archivos</p>';
                                }
                            echo '</li>
                            </ul>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end" onchange="mostrarTextArea()" id="estatus2">
                            <form method="post" action="autorizarRechazar.php?id='.$registro['id'].'">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="estatus" id="inlineRadio1" value="Autorizar">
                                    <label class="form-check-label">Autorizar</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="estatus" id="Rechazar" value="Rechazar">
                                    <label class="form-check-label">Rechazar</label>
                                </div>
                                </div>
                                <br>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <textarea cols="50" rows="5" name="observaciones" class="observaciones ocultar" placeholder="Observaciones de rechazo"></textarea>
                                </div>
                                <br>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <input type="submit" class="btn btn-primary me-md-2" value="Enviar"></input>
                                </div>
                            </form>';
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
    </div>
</body>
</html>