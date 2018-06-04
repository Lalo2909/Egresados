<?php

include 'conn.php';

// prepare and bind
$stmt = $conn->prepare("UPDATE egresado SET nombre=?, apellido=?, bday=?, genero=?, eventos=?, facultad=?, carrera=?, generacion_de=?, generacion_a=?, empresa=?, puesto=?, descripcion=? WHERE correo=?");
$stmt->bind_param("sssssssssssss", $nombre, $apellido, $bday, $genero, $eventos, $facultad, $carrera, $generacion_de, $generacion_a, $empresa, $puesto, $descripcion, $correo);

// set parameters and execute
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$bday = $_POST["bday"];
$genero = $_POST["genero"];
$correo = $_POST["correo"];
/*if(!empty($_POST["eventos"])){
    $eventos = "Si";
}else{
    $eventos = "No";
}*/
$eventos = $_POST["eventos"];
$facultad = $_POST["facultad"];
$carrera = $_POST["carrera"];
$generacion_de = $_POST["year"];
$generacion_a = $_POST["year2"];
$empresa = $_POST["empresa"];
$puesto = $_POST["puesto"];
$descripcion = $_POST["descripcion"];

echo $result = $stmt->execute();

$stmt->close();
$conn->close();

?>