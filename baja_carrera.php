<?php

include 'conn.php';

// prepare and bind
$stmt = $conn->prepare("DELETE FROM carrera WHERE Nombre=?");
$stmt->bind_param("s", $carrera);

// set parameters and execute

$carrera = $_GET["carrera"];

$result = $stmt->execute();

header ("Location: carrera.php");

$stmt->close();
$conn->close();

?>
