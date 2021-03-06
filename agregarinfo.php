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
    //Inicio de sesión
    SESSION_START();
    //Si existen la variable de sesion
    if(isset($_SESSION['promotor']) && isset($_SESSION['trabajador'])){
        //Si el trabajador es promotor
        if($_SESSION['trabajador']=='Promotor'){
            //Hace la conexión con la base de datos
            include("bd.php");
            $conexionbd=conectarbd();
            //Hace una consulta para guardar la informaición en la tabla
            $consultaGuardarInfo= "INSERT INTO informacion (nombre,primerAp,segundoAp,calle,numero,colonia,cp,telefono,rfc,promotor) VALUES ('".$_POST['nombre']."',
                                '".$_POST['primerAp']."',
                                '".$_POST['segundoAp']."',
                                '".$_POST['calle']."',
                                ".$_POST['numero'].",
                                '".$_POST['colonia']."',
                                '".$_POST['codigoP']."',
                                '".$_POST['telefono']."',
                                '".$_POST['rfc']."',
                                '".$_SESSION['promotor']."'
                                )";
            $guardadoDatos=mysqli_query($conexionbd,$consultaGuardarInfo);
            //Si existe archivo
            if($_FILES["archivo"]){
                //Recorre el array de los archivos a subir
                foreach($_FILES["archivo"]['tmp_name'] as $key => $tmp_name){
                    //Si el archivo existe
                    if($_FILES["archivo"]["name"][$key]){
                        // Nombres de archivos de temporales
                        $archivonombre = $_FILES["archivo"]["name"][$key]; 
                        $fuente = $_FILES["archivo"]["tmp_name"][$key];
                        //Hace una consulta sobre cual es el ultimo id registrado en la base de datos
                        $consultaIdMayor="SELECT MAX(id) FROM informacion";
                        $busquedaId=mysqli_query($conexionbd,$consultaIdMayor);
                        $id=mysqli_fetch_assoc($busquedaId);
                        //Crea el nombre de la carpeta 
                        $carpeta = "archivos/".$id['MAX(id)']."-".$_POST['primerAp']."".$_POST['nombre'].""; //Carpeta donde guardamos los archivos
                        //Si no existe la carpeta
                        if(!file_exists($carpeta)){
                            //Se crea o se genera un error.
                            mkdir($carpeta, 0777) or die("Hubo un error al crear la carpeta");	
                        }
                        //Abre la conexion con la carpeta destino
                        $directorio=opendir($carpeta);
                        //Verificamos si el archivo se ha subido
                        $guardadoArchivos=move_uploaded_file($fuente, $carpeta.'/'.$archivonombre);
                        //Cerramos la conexion con la carpeta destino
                        closedir($directorio);
                    }
                }
            }
            //Si se guardaron los archivos y los datos muestra en pantalla que la información fue enviada
            if($guardadoArchivos && $guardadoDatos){
                echo '
                <div class="px-4 py-5 my-5 text-center">
                <i class="bi bi-check-circle-fill" style="font-size: 5rem; color: green;"></i>
                <h1 class="display-5 fw-bold">Información del prospecto enviada!</h1>
                <div class="col-lg-6 mx-auto">
                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                    <a href="listadoProspectos.php" class="btn btn-primary btn-lg px-4 gap-3">Ver Lista</a>
                    <a href="capturaProspecto.php" class="btn btn-outline-secondary btn-lg px-4">Registrar otro</a>
                </div>
                </div>
                </div>';
            //si no muestra en pantalla que ocurrio un error
            }else{
                echo '
                <div class="px-4 py-5 my-5 text-center">
                <i class="bi bi-x-circle-fill" style="font-size: 5rem; color: red;"></i>
                <h1 class="display-5 fw-bold">Ocurrio un error al enviar información</h1>
                <div class="col-lg-6 mx-auto">
                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                    <a href="capturaProspecto.php" class="btn btn-outline-secondary btn-lg px-4">Volver a intentar</a>
                </div>
                </div>
                </div>';
            }
        // si no
        }else{
            //No muestra la pantalla
            ?><script>history.back()</script><?php
        }
        //si no
    }else{
        //Nos manda a que iniciemos sesión
        header('location:iniciarsesion.html');
    }
?>
</body>
</html>