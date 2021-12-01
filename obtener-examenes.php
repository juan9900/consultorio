<?php
include('db.php');

$cedula = $_GET['cedula'];
$query = "SELECT * FROM examenes WHERE cedula = $cedula";
$stmt = $conn->prepare($query);
if($stmt->execute()){
    $result = $stmt->get_result(); // get the mysqli result
    if(!mysqli_num_rows($result) == 0){
        
        while($row = $result->fetch_array()){
            $json[] = array(
                'id' => $row['id'],
                'cedula' => $row['cedula'],
                'examen' => $row['examen'],
                'contenido' => $row['contenido'],
                
            );
        }
        $jsonString = json_encode($json);
        echo $jsonString;
        exit();
    }else{
        echo (false);
        exit();
    }
    
}else{
 die ('Error recuperando examenes ' . mysqli_error($connection));
}
?>