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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <title>Agregando informacion...</title>
</head>
<body>
<?php
    include("bd.php");
    $conexionbd=conectarbd();
    $query= "INSERT INTO informacion (nombre,primerAp,segundoAp,calle,numero,colonia,cp,telefono,rfc) VALUES ('".$_POST['nombre']."',
                        '".$_POST['primerAp']."',
                        '".$_POST['segundoAp']."',
                        '".$_POST['calle']."',
                        ".$_POST['numero'].",
                        '".$_POST['colonia']."',
                        '".$_POST['codigoP']."',
                        '".$_POST['telefono']."',
                        '".$_POST['rfc']."'
                        )";
    $guardadoDatos=mysqli_query($conexionbd,$query);
        //Si hay archivos a subir
        if($_FILES["archivo"]){
            //Recorre el array de los archivos a subir
            foreach($_FILES["archivo"]['tmp_name'] as $key => $tmp_name){
                //Si el archivo existe
                if($_FILES["archivo"]["name"][$key]){
                    // Nombres de archivos de temporales
                    $archivonombre = $_FILES["archivo"]["name"][$key]; 
                    $fuente = $_FILES["archivo"]["tmp_name"][$key]; 
                    
                    $carpeta = "archivos/".$_POST['primerAp']."".$_POST['segundoAp']."".$_POST['nombre'].""; //Carpeta donde guardamos los archivos
                    
                    //Si no existe la carpeta
                    if(!file_exists($carpeta)){
                        //Se crea o se genera un error.
                        mkdir($carpeta, 0777) or die("Hubo un error al crear la carpeta");	
                    }
                    
                    //Abrimos la conexion con la carpeta destino
                    $dir=opendir($carpeta);
                    
                    //Verificamos si el archivo se ha subido
                    $guardadoArchivos=move_uploaded_file($fuente, $carpeta.'/'.$archivonombre);
                    //Cerramos la conexion con la carpeta destino
                    closedir($dir); 
                }
            }
        }
    if($guardadoArchivos && $guardadoDatos){
        echo '
        <div class="px-4 py-5 my-5 text-center">
        <i class="bi bi-check-circle-fill" style="font-size: 5rem; color: green;"></i>
        <h1 class="display-5 fw-bold">Información del prospecto guardada!</h1>
        <div class="col-lg-6 mx-auto">
        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
            <a href="listadoProspectos.php" class="btn btn-primary btn-lg px-4 gap-3">Ver Lista</a>
            <a href="capturaProspecto.html" class="btn btn-outline-secondary btn-lg px-4">Registrar otro</a>
        </div>
        </div>
        </div>';
    }else{
        echo '
        <div class="px-4 py-5 my-5 text-center">
        <i class="bi bi-x-circle-fill" style="font-size: 5rem; color: red;"></i>
        <h1 class="display-5 fw-bold">Ocurrio un error al guardar información</h1>
        <div class="col-lg-6 mx-auto">
        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
            <a href="capturaProspecto.html" class="btn btn-outline-secondary btn-lg px-4">Volver a intentar</a>
        </div>
        </div>
        </div>';
    }
?>
</body>
</html>