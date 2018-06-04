<?php

include 'conn.php';

// prepare and bind
$stmt = $conn->prepare("INSERT INTO carrera (Nombre, cve_facultad) VALUES (?, ?)");
$stmt->bind_param("ss", $carrera, $facultad);

// set parameters and execute
$carrera = $_POST["carrera"];
$facultad = $_POST["facultad"];

$stmt->execute();

$stmt->close();
$conn->close();

header ("Location: carrera.php");
?>
