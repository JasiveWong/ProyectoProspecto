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
    <title>Informacion del Prospecto</title>
</head>
<body>
    <div class="container">
        <?php
            include("bd.php");
            $conexionbd=conectarbd();
            $query="SELECT * FROM informacion WHERE id=".$_GET['id'];
            $resultado=mysqli_query($conexionbd,$query);
            $registro=mysqli_fetch_assoc($resultado);
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
                    <li class="list-group-item"><b>Documentos: </b>'.$registro['documentos'].'</li>
                    <li class="list-group-item"><b>Estatus: </b>'.$registro['estatus'].'</li>';
                    if ($registro['estatus']=='Rechazado') {
                        '<li class="list-group-item">Estatus: '.$registro['estatus'].'</li>';
                    }
                '</ul>
            '
        ?>
    </div>
</body>
</html>