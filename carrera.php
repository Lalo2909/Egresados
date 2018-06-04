<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
} else {
 header ("Location: errorMessage.html");
 exit;
}

$now = time();
if($now > $_SESSION['expire']) {
  session_destroy();
  header ("Location: timeout.html");
  exit;
}
include 'conn.php';

$consulta2="select cve_facultad, Nombre from facultad";
$resultadoFac=$conn->query($consulta2);
$edicionCarrera=$conn->query($consulta2);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="img/apple-icon.png">
  <link rel="icon" type="image/png" href="img/logo.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Egresados La salle
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="css/material-kit.css?v=2.0.3" rel="stylesheet" />
  <link href="css/main.css" rel="stylesheet" />
</head>

<body class="signup-page sidebar-collapse">
  <nav class="navbar navbar-transparent navbar-color-on-scroll fixed-top navbar-expand-lg" color-on-scroll="100" id="sectionsNav">
    <div class="container">
      <div class="navbar-translate">
        <a href="profile.php"><div class="site-logo"></div></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
          <span class="navbar-toggler-icon"></span>
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
          <li class="dropdown nav-item">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
              <i class="material-icons">apps</i> Opciones
            </a>
            <div class="dropdown-menu dropdown-with-icons">
              <a href="registro.php" class="dropdown-item">
                <i class="material-icons">person_add</i> Registrar Usuario
              </a>
              <a href="#baja" data-toggle="modal" data-target="#myModalBaja" class="dropdown-item">
                <i class="material-icons">delete</i> Eliminar Usuario
              </a>
              <a href="editar.php" class="dropdown-item">
                <i class="material-icons">edit</i> Editar Usuario
              </a>
              <a href="#buscar" data-toggle="modal" data-target="#myModalBusqueda" class="dropdown-item">
                <i class="material-icons">search</i> Busqueda
              </a>
              <a href="facultad.php" class="dropdown-item">
                <i class="material-icons">account_balance</i> Catalogo Facultad
              </a>
              <a href="universidad.php" class="dropdown-item">
                <i class="material-icons">location_city</i> Catalogo Universidades
              </a>
              <a href="carrera.php" class="dropdown-item">
                <i class="material-icons">school</i> Catalogo Carreras
              </a>
              <a href="tabla.php" class="dropdown-item">
                <i class="material-icons">group</i> Usuarios
              </a>
            </div>
          </li>
          <li class="dropdown nav-item">
            <a href="logout.php" class="nav-link">
              <i class="material-icons">exit_to_app</i> Exit
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="page-header header-filter" filter-color="purple" style="background-image: url('img/unidad.jpg')">
    <div class="container">
      <div class="row">
        <div class="col-md-10 ml-auto mr-auto">
          <div class="card card-signup">
            <h2 class="card-title text-center">Catálogo de Carreras</h2>
            <div class="text-center">
              <a class="btn btn-primary btn-round" href="#alta_carrera" data-toggle="modal" data-target="#addCarrera">
                <i class="material-icons">add</i>
              </a>
            </div>
            <div class="card-body">
              <div class="form-group" style="overflow-x:auto;">
                <table class='table center .table-bordered' id='tablaReporte'>
                  <tr>
                    <th>Carrera</th>
                    <th>Facultad</th>
                  </tr>
                  <?php
                    $sql = "SELECT carrera.Nombre, facultad.Nombre, facultad.cve_facultad, carrera.cve_carrera FROM carrera, facultad WHERE carrera.cve_facultad = facultad.cve_facultad";
                    $result = $conn->query($sql);
                    while($row = mysqli_fetch_row($result)){
                      $datos=$row[0]."||".
          						   $row[1]."||".
                         $row[2]."||".
                         $row[3];
                  ?>
                  <tr>
                    <td><?php echo $row[0] ?></td>
				            <td><?php echo $row[1] ?></td>
                    <td>
                      <button class="btn btn-primary btn-round" data-toggle="modal" data-target="#editarCarrera" onclick="editarCarrera('<?php echo $datos ?>')"><i class="material-icons">edit</i></button>
				            </td>
                    <td>
                      <button class="btn btn-primary btn-round" onclick="bajaCarrera('<?php echo $row[0] ?>')">
                        <i class="material-icons">delete</i>
                      </button>
                    </td>
                  </tr>
                  <?php
                }
                  ?>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal Delete -->
    <form action="baja_procesa.php" method="POST">
      <div class="modal fade" id="myModalBaja" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Baja de Alumno</h4>
            </div>
            <div class="modal-body">
              <span>Ingresa el correo del usuario: </span>
            	<div class="input-group">
              	<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
              	<input type="email" name="CorreoUpdate" class="form-control" placeholder="Correo" id="CorreoUpdate">
            	</div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary btn-round">Enviar</button>
              <button type="button" class="btn btn-primary btn-round" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    </form>
    <!--/Modal Delete-->

    <!-- Modal Add Carrera -->
    <form action="alta_carrera.php" method="POST">
      <div class="modal fade" id="addCarrera" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Añadir Carrera</h4>
            </div>
            <div class="modal-body">
              <span>Nombre: </span>
            	<div class="input-group">
              	<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
              	<input type="text" name="carrera" class="form-control" placeholder="Carrera" id="carrera">
            	</div>
              <br>
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <label for="exampleFormControlSelect1">Facultad</label>
                </span>
              </div>
              <select class="form-control" id="facultad" name="facultad">
              <option value="">Seleccionar</option>
              <?php

              while($fila=$resultadoFac->fetch_row()){
              echo "<option value=".$fila[0].">".$fila[1]."</option>";
              }
              ?>

              </select>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary btn-round">Enviar</button>
              <button type="button" class="btn btn-primary btn-round" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    </form>
    <!--/Modal Add Carrera-->

    <!-- Modal Editar Carrera-->
    <form action="editar_carrera.php" method="POST">
      <div class="modal fade" id="editarCarrera" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Editar Carrera</h4>
            </div>
            <div class="modal-body">
              <span>Nombre: </span>
            	<div class="input-group">
              	<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
              	<input type="text" name="inputEditarCarrera" class="form-control" placeholder="Carrera" id="inputEditarCarrera">
                <input type="hidden" id="carreraId" name="carreraId">
            	</div>
              <br>
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <label for="exampleFormControlSelect1">Facultad</label>
                </span>
              </div>
              <select class="form-control" id="inputEditarFacultadCar" name="inputEditarFacultadCar">
              <option value="">Seleccionar</option>
              <?php

              while($fila2=$edicionCarrera->fetch_row()){
              echo "<option value=".$fila2[0].">".$fila2[1]."</option>";
              }
              ?>

              </select>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary btn-round">Enviar</button>
              <button type="button" class="btn btn-primary btn-round" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    </form>
    <!--/Modal Editar Carrera-->

    <!-- Modal Buscar -->
    <form action="buscar.php" method="POST">
      <div class="modal fade" id="myModalBusqueda" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Busqueda de Alumno</h4>
            </div>
            <div class="modal-body">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">search</i>
                  </span>
                </div>
                <input type="text" name="buscarUser" id="buscarUser" class="form-control" placeholder="Introduce el correo para buscar:">
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary btn-round">Buscar</button>
              <button type="button" class="btn btn-primary btn-round" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    </form>
    <!--/Modal Buscar-->

    <footer class="footer">
      <div class="container">
        <nav class="float-left">
          <ul>
            <li>
              <a href="http://www.lasalle.mx/">
                La Salle mx
              </a>
            </li>

          </ul>
        </nav>
        <div class="copyright float-right">
          Programación de aplicaciones WEB
      </div>
    </footer>
  </div>
  <!--   Core JS Files   -->
  <script src="js/core/jquery.min.js" type="text/javascript"></script>
  <script src="js/core/popper.min.js" type="text/javascript"></script>
  <script src="js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
  <script src="js/plugins/moment.min.js"></script>
  <!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
  <script src="js/plugins/bootstrap-datetimepicker.js" type="text/javascript"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="js/plugins/nouislider.min.js" type="text/javascript"></script>
  <!-- Control Center for Now Ui Kit: parallax effects, scripts for the example pages etc -->
  <script src="js/material-kit.js?v=2.0.3" type="text/javascript"></script>
  <script src="js/main.js" type="text/javascript"></script>
</body>

</html>
