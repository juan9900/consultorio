<?php 
include ('db.php');

$id = $_GET['id'];

$query = "SELECT * FROM examenes WHERE id = '$id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$examen = $row['examen'];
$contenido = $row['contenido'];
$cedula = $row['cedula'];



$query = "SELECT * FROM pacientes WHERE cedula = '$cedula'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$nombres = $row['nombres'];
$apellidos = $row['apellidos'];
$sexo = $row['sexo'];
$edad = $row['edad'];


?>