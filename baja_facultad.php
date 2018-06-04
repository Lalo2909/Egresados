<?php

include 'conn.php';

// prepare and bind
$stmt = $conn->prepare("DELETE FROM facultad WHERE Nombre=?");
$stmt->bind_param("s", $facultad);

// set parameters and execute

$facultad = $_GET["facultad"];

$result = $stmt->execute();

header ("Location: facultad.php");

$stmt->close();
$conn->close();

?>
