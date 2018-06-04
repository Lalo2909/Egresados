<?php

include 'conn.php';

// prepare and bind
$stmt = $conn->prepare("UPDATE carrera SET Nombre=?, cve_facultad=? WHERE cve_carrera=?");
$stmt->bind_param("sss", $carrera, $facultad,$id);

// set parameters and execute
$carrera = $_POST["inputEditarCarrera"];
$facultad = $_POST["inputEditarFacultadCar"];
$id = $_POST["carreraId"];

$stmt->execute();

$stmt->close();
$conn->close();

header ("Location: carrera.php");
?>
