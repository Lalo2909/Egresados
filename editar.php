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

$correoBusqueda = $_POST['editarUser'];

$sql = "SELECT egresado.Nombre, egresado.Apellidos, egresado.FechaNacimiento, egresado.Genero, egresado.correo, egresado.Info, facultad.Nombre, carrera.Nombre, educacion.Gen_inicio, educacion.Gen_fin, empresa.nombre, puesto.nombre, puesto.descripcion, institucion.nombre, pais.Nombre, egresado.cve_egresado, empresa.cve_empresa, puesto.cve_puesto FROM egresado, facultad, carrera, educacion, empresa, puesto, institucion, pais WHERE egresado.cve_egresado = educacion.cve_egresado AND educacion.cve_carrera = carrera.cve_carrera AND institucion.cve_institucion = facultad.cve_institucion AND facultad.cve_facultad = carrera.cve_facultad AND puesto.cve_egresado = egresado.cve_egresado AND empresa.cve_empresa = puesto.cve_empresa AND institucion.cve_pais = pais.cve_pais AND egresado.correo = '" . $correoBusqueda . "'";

$sql2 = "SELECT password FROM login WHERE user = '" . $correoBusqueda . "'";

$result = $conn->query($sql);
$row = mysqli_fetch_row($result);

$result2 = $conn->query($sql2);
$row2 = mysqli_fetch_row($result2);

$password = $row2[0];

$nombre =  $row[0];
$apellido = $row[1];
$cumple = $row[2];
$genero = $row[3];
$correo = $row[4];
$info = $row[5];
$facultad = $row[6];
$carrera = $row[7];
$inicio = $row[8];
$fin = $row[9];
$empresa = $row[10];
$puesto = $row[11];
$descripcion = $row[12];
$uni = $row[13];
$pais = $row[14];
$claveEgresado = $row[15];
$claveEmpresa = $row[16];
$clavePuesto = $row[17];

$consulta="select cve_carrera, Nombre from carrera";
$resultadoCarrea=$conn->query($consulta);

$consulta2="select cve_facultad, Nombre from facultad";
$resultadoFac=$conn->query($consulta2);

$consulta3="select cve_institucion, Nombre from institucion";
$resultadoIns=$conn->query($consulta3);

$consulta4="select cve_pais, Nombre from pais";
$resultadoPais=$conn->query($consulta4);

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
              <a href="#editar" data-toggle="modal" data-target="#myModalEditar" class="dropdown-item">
                <i class="material-icons">search</i> Editar Usuario
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
            <h2 class="card-title text-center">Editar Usuario</h2>
            <div class="card-body">
              <form class="form" method="POST" action="cambios_procesa.php">
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                            <i class="material-icons">face</i>
                      </span>
                    </div>
                    <input type="text" name="nombreEditar" id="nombreEditar" class="form-control" value="<?php echo $nombre ?>">
                    <input type="hidden" id="claveEgresado" name="claveEgresado" value="<?php echo $claveEgresado; ?>">
                    <input type="hidden" id="claveEmpresa" name="claveEmpresa" value="<?php echo $claveEmpresa; ?>">
                    <input type="hidden" id="clavePuesto" name="clavePuesto" value="<?php echo $clavePuesto; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="material-icons">perm_identity</i>
                    </span>
                    </div>
                    <input type="text" name="apellidoEditar" id="apellidoEditar" class="form-control" value="<?php echo $apellido ?>">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="material-icons">cake</i>
                    </span>
                    </div>
                    <input type="date" class="form-control datetimepicker" name="bdayEditar" id="bdayEditar" value="<?php echo $cumple ?>">
                  </div>
                </div>
                <div class="form-check form-check-inline">
                  Genero:
                  <label class="form-check-label">
                    <?php
                      if($genero == "Mujer"){
                        echo "<input class='form-check-input' type='radio' name='generoEditar' id='generoEditar' value='Mujer' checked='checked'> Mujer";
                      }else {
                        echo "<input class='form-check-input' type='radio' name='generoEditar' id='generoEditar' value='Mujer'> Mujer";
                      }
                    ?>
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                  </label>
                </div>
                <div class="form-check form-check-inline">
                  <label class="form-check-label">
                    <?php
                      if($genero == "Hombre"){
                        echo "<input class='form-check-input' type='radio' name='generoEditar' id='generoHEditar' value='Hombre' checked='checked'> Hombre";
                      }else{
                        echo "<input class='form-check-input' type='radio' name='generoEditar' id='generoHEditar' value='Hombre'> Hombre";
                      }
                    ?>

                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                  </label>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="material-icons">mail</i>
                      </span>
                    </div>
                    <input type="text" name="correoEditar" id="correoEditar" class="form-control" value="<?php echo $correo ?>">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="material-icons">lock_outline</i>
                      </span>
                    </div>
                    <input type="text" name="passwordEditar" id="passwordEditar" class="form-control" value="<?php echo $password; ?>">
                  </div>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <?php
                      if($info == "Si"){
                        echo "<input class='form-check-input' type='checkbox' value='Si' checked name='si' id='eventos'>";
                      }else {
                        echo "<input class='form-check-input' type='checkbox' value='Si' name='si' id='eventos'>";
                      }
                    ?>
                    <span class="form-check-sign">
                      <span class="check"></span>
                    </span>
                    Deseo recibir información de proximos eventos lasallistas
                  </label>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <label for="exampleFormControlSelect1">Institución</label>
                      </span>
                    </div>
                    <select class="form-control" id="institucionEditar" name="institucionEditar">
                      <?php
                      while($fila=$resultadoIns->fetch_row()){
                        if($uni == $fila[1]){
                          echo "<option value=".$fila[0]." selected>".$fila[1]."</option>";
                        }else{
                          echo "<option value=".$fila[0].">".$fila[1]."</option>";
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <label for="exampleFormControlSelect1">Facultad</label>
                      </span>
                    </div>
                    <select class="form-control" id="facultadEditar" name="facultadEditar">
                      <?php
                      while($fila=$resultadoFac->fetch_row()){
                        if($facultad == $fila[1]){
                          echo "<option value=".$fila[0]." selected>".$fila[1]."</option>";
                        }else{
                          echo "<option value=".$fila[0].">".$fila[1]."</option>";
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="material-icons">school</i>
                      </span>
                    </div>
                    <select class="form-control" id="carreraEditar" name="carreraEditar">
                      <?php
                        while($fila=$resultadoCarrea->fetch_row()){
                          if($carrera == $fila[1]){
                            echo "<option value=".$fila[0]." selected>".$fila[1]."</option>";
                          }else{
                            echo "<option value=".$fila[0].">".$fila[1]."</option>";
                          }
                        }

                      ?>
                    </select>
                    <!-- <input type="text" name="carrera" id="carrera" class="form-control" placeholder="Carrera...">-->
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        Inicio:
                      </span>
                    </div>
                    <input type="month" class="form-control datetimepicker" name="yearEditar" id="yearEditar" value="<?php echo $inicio ?>">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        Fin:
                      </span>
                    </div>
                    <input type="month" class="form-control datetimepicker" name="year2Editar" id="year2Editar" value="<?php echo $fin ?>">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="material-icons">location_city</i>
                      </span>
                    </div>
                    <input type="text" name="empresaEditar" id="empresaEditar" class="form-control" value="<?php echo $empresa ?>">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <label for="exampleFormControlSelect1">Pais</label>
                      </span>
                    </div>
                    <select class="form-control" id="paisEditar" name="paisEditar">
                      <?php
                      while($fila=$resultadoPais->fetch_row()){
                        if($pais == $fila[1]){
                          echo "<option value=".$fila[0]." selected>".$fila[1]."</option>";
                        }else{
                          echo "<option value=".$fila[0].">".$fila[1]."</option>";
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="material-icons">work</i>
                      </span>
                    </div>
                    <input type="text" name="puestoEditar" id="puestoEditar" class="form-control" value="<?php echo $puesto ?>">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        Descripción:
                      </span>
                    </div>
                    <textarea class="form-control" rows="5" id="descripcionEditar" name="descripcionEditar"><?php echo $descripcion ?></textarea>
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary btn-round">Editar</button>
                </div>
              </form>
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

    <!-- Modal Editar -->
    <form action="editar.php" method="POST">
      <div class="modal fade" id="myModalEditar" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Editar Alumno</h4>
            </div>
            <div class="modal-body">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">search</i>
                  </span>
                </div>
                <input type="text" name="editarUser" id="editarUser" class="form-control" placeholder="Introduce el correo para editar:">
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
    <!--/Modal Editar-->

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
</body>

</html>
