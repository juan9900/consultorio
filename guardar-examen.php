<?php 

include ('db.php');

$id = $_POST['id'];
$contenido = $_POST['text-contenido'];


$query = "UPDATE examenes SET contenido = ? WHERE id = ?";
$stmt = $conn->prepare($query); 

    if ( false===$stmt ) {
        // and since all the following operations need a valid/ready statement object
        // it doesn't make sense to go on
        // you might want to use a more sophisticated mechanism than die()
        // but's it's only an example
        die('prepare() failed: ' . htmlspecialchars($conn->error));
    }
    $bind = $stmt->bind_param('si', $contenido, $id);
    // Check if bind_param() failed.
    // bind_param() can fail because the number of parameter doesn't match the placeholders
    // in the statement, or there's a type conflict, or ....
    
    if ( false === $bind ) {
        error_log('bind_param() failed:');
        exit();
    }

    if ($exec = $stmt->execute()){
        echo true;
    }
    
    // Check if execute() failed. 
    // execute() can fail for various reasons. And may it be as stupid as someone tripping over the network cable
 
    if ( false === $exec ) {
        error_log('mysqli execute() failed: ');
        error_log( print_r( htmlspecialchars($stmt->error), true ) );
    }

?>