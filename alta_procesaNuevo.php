<?php

include 'conn.php';

// prepare and bind
$stmt = $conn->prepare("INSERT INTO egresado (Nombre, Apellidos, FechaNacimiento, Genero, Info,correo) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $nombre, $apellido, $bday, $genero,$eventos, $correo);

$stmtNuevo=$conn->prepare("INSERT INTO login (user, password) VALUES (?, ?)");
$stmtNuevo->bind_param("ss", $correo,$password);

// set parameters and execute
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$bday = $_POST["bday"];
$genero = $_POST["genero"];
$correo = $_POST["correo"];
$password=$_POST["password"];
if(!empty($_POST["si"])){
    $eventos = "Si";
}else{
    $eventos = "No";
}
$stmt->execute();
$stmtNuevo->execute();

$consulta3="select cve_egresado from egresado where Nombre like '".$nombre."' and Apellidos like '".$apellido."'";
$result=$conn->query($consulta3);
while($row = $result->fetch_row()) {
        $cve_egresado=$row[0];
    }



$stmt2 = $conn->prepare("INSERT INTO educacion (Gen_inicio, Gen_fin, cve_egresado, cve_carrera) VALUES (?, ?, ?,?)");
$stmt2->bind_param("ssss", $generacion_de, $generacion_a,$cve_egresado,$carrera);
$generacion_de = $_POST["year"];
$generacion_a = $_POST["year2"];
$carrera = $_POST["carrera"];

$stmt2->execute();
$stmt2->close();

$stmt3 = $conn->prepare("INSERT INTO empresa (nombre,cve_pais) VALUES (?, ?)");
$stmt3->bind_param("ss", $empresa,$pais );
$empresa = $_POST["empresa"];
$pais = $_POST["pais"];

$stmt3->execute();
$stmt3->close();

$consulta3="select cve_empresa from empresa where nombre like '".$empresa."' and cve_pais= ".$pais;
$result=$conn->query($consulta3);
while($row = $result->fetch_row()) {
        $cve_empresa=$row[0];
    }

$stmt4 = $conn->prepare("INSERT INTO puesto (cve_empresa,nombre, descripcion, cve_egresado) VALUES (?, ?, ?,?)");
$stmt4->bind_param("ssss", $cve_empresa, $puesto,$descripcion,$cve_egresado);
$puesto = $_POST["puesto"];
$descripcion = $_POST["descripcion"];

$stmt4->execute();

header ("Location: index.html");


$stmt4->close();
$conn->close();

?>
