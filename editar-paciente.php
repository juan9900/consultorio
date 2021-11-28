<?php 

include ('db.php');

    if(isset($_POST['cedula'])){
        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $cedula = $_POST['cedula'];
        $sexo = $_POST['sexo'];
        $edad = $_POST['edad'];
        $telefono = $_POST['telefono'];
        $correo = $_POST['correo'];



        $query = "UPDATE pacientes SET nombres=?, apellidos=?, sexo=?, edad=?, telefono=?, correo=? WHERE cedula=?";
        $stmt = $conn->prepare($query);

        if(!$stmt){
            die('Error preparando query de editar una nota' . htmlspecialchars($connection->error));
        }

        $bind = $stmt->bind_param('sssissi',$nombres, $apellidos, $sexo, $edad, $telefono, $correo, $cedula);

        if(!$bind){
            error_log('bind_param() failed:');
            error_log( print_r( htmlspecialchars($stmt->error), true ) );
            exit();
        }

        $exec = $stmt->execute();
        if($stmt->execute()){
            echo 'Exito';
            exit();
        }else{
            echo ('error recibiendo el paciente para editar (execute)');
        }

        if($exec === false){
            error_log('bind_param() failed:');
            error_log( print_r( htmlspecialchars($stmt->error), true ) );
            exit();
        }


    }

?>