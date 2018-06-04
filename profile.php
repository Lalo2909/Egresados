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

$user = $_SESSION['username'];

$sql = "SELECT egresado.Nombre, egresado.Apellidos, egresado.FechaNacimiento, egresado.Genero, egresado.correo, egresado.Info, facultad.Nombre, carrera.Nombre, educacion.Gen_inicio, educacion.Gen_fin, empresa.nombre, puesto.nombre, puesto.descripcion, institucion.nombre FROM egresado, facultad, carrera, educacion, empresa, puesto, institucion WHERE egresado.cve_egresado = educacion.cve_egresado AND educacion.cve_carrera = carrera.cve_carrera AND institucion.cve_institucion = facultad.cve_institucion AND facultad.cve_facultad = carrera.cve_facultad AND puesto.cve_egresado = egresado.cve_egresado AND empresa.cve_empresa = puesto.cve_empresa AND egresado.correo = '" . $user . "'";

$result = $conn->query($sql);
$row = mysqli_fetch_row($result);

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
$imagen = "img/" . $nombre .".jpg";

$myObj->name = $nombre;
$myObj->apellido = $apellido;
$myObj->cumpleanos = $cumple;

$myJSON = json_encode($myObj);

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

<body class="profile-page sidebar-collapse">
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
  <div class="page-header header-filter" data-parallax="true" style="background-image: url('img/unidad.jpg');"></div>
  <div class="main main-raised">
    <div class="profile-content">
      <div class="container">
        <div class="row">
          <div class="col-md-6 ml-auto mr-auto">
            <div class="profile">
              <div class="avatar">
                <img src="<?php echo $imagen?>" alt="Circle Image" class="img-raised rounded-circle img-fluid">
              </div>
              <div class="name">
                <h1 class="title"><?php echo $nombre . " " . $apellido;?></h1>
                <h2><?php echo $puesto . " en " . $empresa;?></h2>
                <a href="#pablo" class="btn btn-just-icon btn-link btn-dribbble"><i class="fa fa-dribbble"></i></a>
                <a href="#pablo" class="btn btn-just-icon btn-link btn-twitter"><i class="fa fa-twitter"></i></a>
                <a href="#pablo" class="btn btn-just-icon btn-link btn-pinterest"><i class="fa fa-pinterest"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div >
          <h2>Datos:</h2>
          <h4><strong class="titulo-color">Fecha de Nacimiento:</strong> <?php echo $cumple;?></h4>
          <h4><strong class="titulo-color">Genero:</strong> <?php echo $genero;?></h4>
          <h4><strong class="titulo-color">Correo:</strong> <?php echo $correo;?></h4>

          <h2>Educación:</h2>
          <h4><strong class="titulo-color">Universidad:</strong> <?php echo $uni;?></h4>
          <h4><strong class="titulo-color">Carrera:</strong> <?php echo $carrera;?></h4>
          <h4><strong class="titulo-color">Facultad:</strong> <?php echo $facultad;?></h4>
          <h4><strong class="titulo-color">Fecha de Inicio:</strong> <?php echo $inicio;?></h4>
          <h4><strong class="titulo-color">Fecha de Fin:</strong> <?php echo $fin;?></h4>

          <h2>Experiencia Laboral:</h2>
          <h4><strong class="titulo-color">Empresa:</strong> <?php echo $empresa;?></h4>
          <h4><strong class="titulo-color">Puesto:</strong> <?php echo $puesto;?></h4>
          <h4><strong class="titulo-color">Descripción:</strong> <?php echo $descripcion;?></h4>
        </div>
        <div >
          <textarea><?php echo $myJSON; ?></textarea>
        </div>
        <br><br>
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

  <footer class="footer footer-default">
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
    </div>
  </footer>
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
