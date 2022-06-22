<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor"
      crossorigin="anonymous"
    />
    <script src="./js/evaluacion.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <title>Captura de Prospectos</title>
  </head>
  <body>
    <?php
      if(isset($_SESSION['usuario'])&& isset($_SESSION['trabajador'])){
        echo'
            <div class="container">

            <div class="d-flex mb-3 mt-3">
              <h1 class="display-5 fw-bold p-2 w-100">Información del Prospecto</h1>
              <button type="button" class="btn btn-danger mb-3 mt-3" onclick="Salir()">Salir</button>
            </div>
            <form action="agregarinfo.php" method="post" enctype="multipart/form-data">
              <div class="form-floating mb-3">
                <input type="text" class="form-control" name="nombre" required/>
                <label>Nombre del prospecto</label>
              </div>
              <div class="form-floating mb-3">
                <input type="text" class="form-control" name="primerAp" required/>
                <label>Primer apellido</label>
              </div>
              <div class="form-floating mb-3">
                <input type="text" class="form-control" name="segundoAp" />
                <label>Segundo apellido</label>
              </div>
              <div class="form-floating mb-3">
                <input type="text" class="form-control" name="calle" required/>
                <label>Calle</label>
              </div>
              <div class="form-floating mb-3">
                <input type="number" class="form-control" name="numero" required/>
                <label>Numero</label>
              </div>
              <div class="form-floating mb-3">
                <input type="text" class="form-control" name="colonia" required/>
                <label>Colonia</label>
              </div>
              <div class="form-floating mb-3">
                <input type="number" class="form-control" name="codigoP" required/>
                <label>Codigo Postal</label>
              </div>
              <div class="form-floating mb-3">
                <input type="text" class="form-control" name="telefono" required/>
                <label>Telefono</label>
              </div>
              <div class="form-floating mb-3">
                <input type="text" class="form-control" name="rfc" required/>
                <label>RFC</label>
              </div>
              <label class="col-sm-2 control-label">Archivos</label>
                <div class="col-sm-8">
                  <input type="file" class="form-control" id="archivo[]" name="archivo[]" multiple="" required>
                </div>
              <input class="btn btn-success" type="submit" name="" value="Enviar" />
            </form>
          </div>';
      }else{
        header('location:iniciarsesion.html');
      }
    ?>
  </body>
</html>