<?php

include 'conn.php';

// prepare and bind
$stmt = $conn->prepare("UPDATE egresado SET Nombre=?, Apellidos=?, FechaNacimiento=?, Genero=?, Info=? WHERE cve_egresado=?");
$stmt->bind_param("ssssss", $nombre, $apellido, $bday, $genero, $info, $claveEgresado);

// set parameters and execute
$nombre = $_POST["nombreEditar"];
$apellido = $_POST["apellidoEditar"];
$bday = $_POST["bdayEditar"];
$genero = $_POST["generoEditar"];
$info = $_POST["si"];
$claveEgresado = $_POST["claveEgresado"];

$stmt->execute();

$stmt2 = $conn->prepare("UPDATE login SET password=? WHERE user=?");
$stmt2->bind_param("ss", $password, $correo);

$password = $_POST["passwordEditar"];
$correo = $_POST["correoEditar"];

$stmt2->execute();

$stmt3 = $conn->prepare("UPDATE empresa SET Nombre=? WHERE cve_empresa=?");
$stmt3->bind_param("ss", $empresa, $claveEmpresa);

$empresa = $_POST["empresaEditar"];
$claveEmpresa = $_POST["claveEmpresa"];

$stmt3->execute();

$stmt4 = $conn->prepare("UPDATE puesto SET nombre=?, descripcion=? WHERE cve_egresado=? AND cve_puesto=?");
$stmt4->bind_param("ss", $puesto, $desc,$claveEgresado, $clavePuesto);

$puesto = $_POST["puestoEditar"];
$desc = $_POST["descripcionEditar"];
$clavePuesto = $_POST["clavePuesto"];

$stmt4->execute();

$stmt4->close();
$stmt3->close();
$stmt2->close();
$stmt->close();
$conn->close();

header ("Location: profile.php");
?>
