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
      //Inicia sesión
      SESSION_START();
      // Si la variable de sesión existe
      if(isset($_SESSION['promotor']) && isset($_SESSION['trabajador'])){
        //Si el trabajador es promotor
        if($_SESSION['trabajador']=='Promotor'){
          //Muestra pantalla
          echo'
            <div class="container">
            <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">

              <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <li><a href="listadoProspectos.php" class="nav-link px-2">Ver lista</a></li>
                <li><a href="capturaProspecto.php" class="nav-link px-2 link-secondary">Capturar Prospecto</a></li>
              </ul>

              <div class="col-md-3 text-end">
                <a href="cerrarsesion.php" class="btn btn-outline-primary me-2">Cerrar Sesión</a>
              </div>
            </header>

            <div class="d-flex mb-3 mt-3">
              <h1 class="display-5 fw-bold p-2 w-100">Información del Prospecto</h1>
              <button type="button" class="btn btn-danger mb-3 mt-3" onclick="Salir()">Salir</button>
            </div>
            <form action="agregarinfo.php" method="post" enctype="multipart/form-data">
              <div class="form-floating mb-3">
                <input type="text" class="form-control" name="nombre" onkeypress="return checkLetras(event)" maxlength="50" required/>
                <label>Nombre del prospecto</label>
              </div>
              <div class="form-floating mb-3">
                <input type="text" class="form-control" onkeypress="return checkLetras(event)" name="primerAp" maxlength="20" required/>
                <label>Primer apellido</label>
              </div>
              <div class="form-floating mb-3">
                <input type="text" class="form-control" onkeypress="return checkLetras(event)" maxlength="20" name="segundoAp" />
                <label>Segundo apellido</label>
              </div>
              <div class="form-floating mb-3">
                <input type="text" class="form-control" onkeypress="return check(event)" name="calle" maxlength="40" required/>
                <label>Calle</label>
              </div>
              <div class="form-floating mb-3">
                <input type="number" class="form-control" name="numero" maxlength="11" required/>
                <label>Número</label>
              </div>
              <div class="form-floating mb-3">
                <input type="text" class="form-control" onkeypress="return check(event)" name="colonia" maxlength="40" required/>
                <label>Colonia</label>
              </div>
              <div class="form-floating mb-3">
                <input type="number" class="form-control" name="codigoP" maxlength="6" required/>
                <label>Código Postal</label>
              </div>
              <div class="form-floating mb-3">
                <input type="number" class="form-control" name="telefono" maxlength="10" required/>
                <label>Teléfono</label>
              </div>
              <div class="form-floating mb-3">
                <input type="text" class="form-control" onkeypress="return check(event)" name="rfc" maxlength="13" required/>
                <label>RFC</label>
              </div>
              <label class="col-sm-2 control-label">Documentos</label>
                <div class="col-sm-8">
                  <input type="file" class="form-control" id="archivo[]" name="archivo[]" multiple="" required>
                </div>
              <input class="btn btn-success" type="submit" name="" value="Enviar" />
            </form>
          </div>';
        //si no
        }else{
          //No entra
          ?><script>history.back()</script><?php
        }
      //si no
      }else{
        //Nos envia a que iniciemos sesión
        header('location:iniciarsesion.html');
      }
    ?>
  </body>
</html>
