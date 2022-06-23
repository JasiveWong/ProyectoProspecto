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
        <li><a href="capturaProspecto.php" class="nav-link px-2">Capturar Prospecto</a></li>
        </ul>

        <div class="col-md-3 text-end">
        <a href="cerrarsesion.php" class="btn btn-outline-primary me-2">Cerrar Sesión</a>
        </div>
    </header>
        <h1 class="display-5 fw-bold text-center">Listado de Prospectos</h1>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>Nombre del prospecto</th>
                    <th>Primer apellido</th>
                    <th>Segundo apellido</th>
                    <th>Estatus</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php
                SESSION_START();
                if(isset($_SESSION['usuario'])&& isset($_SESSION['trabajador'])){
                    if($_SESSION['trabajador']=='Promotor'){
                        include("bd.php");
                        $con = conectarbd();
                        $sql = "SELECT id,nombre,primerAp,segundoAp,estatus FROM informacion";
                        $result = mysqli_query($con,$sql);

                        while ($row = $result->fetch_assoc()) {
                            echo '<tr>
                            <td>'. $row["nombre"] .'</td>
                            <td>'. $row["primerAp"] .'</td>
                            <td>'. $row["segundoAp"] .'</td>
                            <td>'. $row["estatus"] .'</td>
                            <td> <a href="verinfo.php?id='.$row['id'].'" class="btn btn-primary" type="button">Ver más</button> </td>
                            </tr>';
                        }
                    }else{
                        ?><script>history.back()</script><?php
                    }
                }else{
                    header('location:iniciarsesion.html');
                }
               ?>
            </tbody>
        </table>
    </div>
</body>
</html>