<?php 
include ('db.php');

if(isset($_POST['examen']) && isset($_POST['cedula'])){
    $cedula = $_POST['cedula'];
    $examen = $_POST['examen'];
    $contenido = "";
    
        $query = "INSERT INTO examenes (examen, cedula, contenido) VALUES (?,?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sis", $examen, $cedula, $contenido);
        if($stmt->execute()){
            echo 'Exito';
        exit();
        }else{
        die ('Error registrando examen ' . mysqli_error($conn));
        }
    

    unset($examen,$cedula);


}





?>