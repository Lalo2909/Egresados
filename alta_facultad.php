<?php

include 'conn.php';

// prepare and bind
$stmt = $conn->prepare("INSERT INTO facultad (Nombre, cve_institucion) VALUES (?, ?)");
$stmt->bind_param("ss", $facultad, $universidad);

// set parameters and execute
$facultad = $_POST["facultadAlta"];
$universidad = $_POST["institucion"];

$stmt->execute();

$stmt->close();
$conn->close();

header ("Location: facultad.php");
?>
