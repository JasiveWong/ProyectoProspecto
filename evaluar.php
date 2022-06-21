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
                </ul>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end" onchange="mostrarTextArea()" id="estatus2">
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
                    <textarea cols="50" rows="5" class="observaciones ocultar" placeholder="Observaciones de rechazo"></textarea>
                </div>
                <br>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-primary me-md-2" type="button">Enviar</button>
                </div>
            '
        ?>
    </div>
</body>
</html>