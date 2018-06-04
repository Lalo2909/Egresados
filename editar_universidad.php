<?php

include 'conn.php';

// prepare and bind
$stmt = $conn->prepare("UPDATE institucion SET Nombre=?, cve_pais=? WHERE cve_institucion=?");
$stmt->bind_param("sss", $universidad, $pais,$id);

// set parameters and execute
$universidad = $_POST["inputEditarUniversidad"];
$pais = $_POST["inputEditarPais"];
$id = $_POST["uniId"];

$stmt->execute();

$stmt->close();
$conn->close();

header ("Location: universidad.php");
?>
