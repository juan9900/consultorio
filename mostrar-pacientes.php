<?php 
include ('db.php');

$query = "SELECT * FROM pacientes";
$stmt = $conn->prepare($query);
if($stmt->execute()){
    $result = $stmt->get_result(); // get the mysqli result
    while($row = $result->fetch_array()){
        $json[] = array(
            'cedula' => $row['cedula'],
            'nombres' => $row['nombres'],
            'apellidos' => $row['apellidos'],
            'sexo' => $row['sexo'],
            'edad' => $row['edad'],
            'telefono' => $row['telefono'],
            'correo' => $row['correo']
        );
    }
    $jsonString = json_encode($json);
    echo $jsonString;
 exit();
}else{
 die ('Error recuperando pacientes ' . mysqli_error($connection));
}
?>