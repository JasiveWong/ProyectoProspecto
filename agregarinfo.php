<?php
    include("bd.php");
    $conexionbd=conectarbd();
    $query= "INSERT INTO informacion (nombre,primerAp,segundoAp,calle,numero,colonia,cp,telefono,rfc,documentos) VALUES ('".$_POST['nombre']."',
                        '".$_POST['primerAp']."',
                        '".$_POST['segundoAp']."',
                        '".$_POST['calle']."',
                        ".$_POST['numero'].",
                        '".$_POST['colonia']."',
                        '".$_POST['codigoP']."',
                        '".$_POST['telefono']."',
                        '".$_POST['rfc']."',
                        '".$_POST['file']."'
                        )";
    $exito=mysqli_query($conexionbd,$query);
?>