<?php

include 'conn.php';

// prepare and bind
$stmt = $conn->prepare("INSERT INTO institucion (Nombre, cve_pais) VALUES (?, ?)");
$stmt->bind_param("ss", $universidad, $pais);

// set parameters and execute
$universidad = $_POST["universidad"];
$pais = $_POST["pais"];

$stmt->execute();

$stmt->close();
$conn->close();

header ("Location: universidad.php");
?>
