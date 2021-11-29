<?php 
include ('db.php');

if(isset($_POST['examen']) && isset($_POST['cedula'])){
    $cedula = $_POST['cedula'];
    $examen = $_POST['examen'];
    //VERIFICAR QUE EL PACIENTE NO ESTE AGREGADO YA
        $query = "INSERT INTO examenes (examen, cedula) VALUES (?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("si", $examen, $cedula);
        if($stmt->execute()){
            echo 'Exito';
        exit();
        }else{
        die ('Error registrando examen ' . mysqli_error($conn));
        }
    

    unset($examen,$cedula);


}





?>