<?php 

include ('db.php');

if(isset($_POST['nombres']) && isset($_POST['apellidos']) && isset($_POST['cedula']) && isset($_POST['telefono']) && 
isset($_POST['correo']) && isset($_POST['edad']) && isset($_POST['sexo'])){



    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $cedula = $_POST['cedula'];
    $sexo = $_POST['sexo'];
    $edad = $_POST['edad'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];



    //VERIFICAR QUE EL PACIENTE NO ESTE AGREGADO YA
    $query = "SELECT cedula FROM pacientes WHERE cedula = $cedula";
    $result = mysqli_query($conn, $query);
    
    if($result){
        $query = "INSERT INTO pacientes (cedula, nombres, apellidos, sexo, edad, telefono, correo) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("isssiss", $cedula, $nombres, $apellidos, $sexo, $edad, $telefono, $correo);
        if($stmt->execute()){
            echo 'Exito';
         exit();
        }else{
         die ('Error registrando nota ' . mysqli_error($conn));
        }
    }else{
        echo 'El paciente ya esta registrado';
    }

    unset($cedula, $nombres, $apellidos, $edad, $sexo, $telefono, $correo);

    
}
?>