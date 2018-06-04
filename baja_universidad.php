<?php

include 'conn.php';

// prepare and bind
$stmt = $conn->prepare("DELETE FROM institucion WHERE Nombre=?");
$stmt->bind_param("s", $uni);

// set parameters and execute

$uni = $_GET["uni"];

$result = $stmt->execute();

header ("Location: universidad.php");

$stmt->close();
$conn->close();

?>
