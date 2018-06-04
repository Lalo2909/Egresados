<?php

include 'conn.php';

// prepare and bind
$stmt = $conn->prepare("DELETE FROM egresado WHERE correo=?");
$stmt->bind_param("s", $correo);

$stmt1 = $conn->prepare("DELETE FROM login WHERE user=?");
$stmt1->bind_param("s", $correo);

// set parameters and execute

$correo = $_POST["CorreoUpdate"];

$result = $stmt->execute();

$result1 = $stmt1->execute();

header ("Location: tabla.php");

$stmt->close();
$stmt1->close();
$conn->close();

?>
