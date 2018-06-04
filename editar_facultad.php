<?php

include 'conn.php';

// prepare and bind
$stmt = $conn->prepare("UPDATE facultad SET Nombre=?, cve_institucion=? WHERE cve_facultad=?");
$stmt->bind_param("sss", $facultad, $universidad,$id);

// set parameters and execute
$facultad = $_POST["inputEditarFacultad"];
$universidad = $_POST["inputEditarUniversidadFac"];
$id = $_POST["facultadId"];

$stmt->execute();

$stmt->close();
$conn->close();

header ("Location: facultad.php");
?>
