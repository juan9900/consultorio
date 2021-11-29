<?php 
include ('db.php');

$id = $_GET['id'];

$query = "SELECT * FROM examenes WHERE id = '$id'";
$result = mysqli_query($conn, $query);
$row1 = mysqli_fetch_assoc($result);
$cedula = $row1['cedula'];



$query = "SELECT * FROM pacientes WHERE cedula = '$cedula'";
$result = mysqli_query($conn, $query);
$row2 = mysqli_fetch_assoc($result);


$json[] = array(
    'examen' => $row1['examen'],
    'contenido' => $row1['contenido'],
    'correo' => $row2['correo']
);

$jsonString = json_encode($json);
echo $jsonString;


?>