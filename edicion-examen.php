<?php
$id = $_GET['id'];

if(empty($id) || $id == ''){
    header("Location: examenes.html");
    die();
}


 include ('obtener-info.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultas Medicas</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300&display=swap" rel="stylesheet">
<script src="https://kit.fontawesome.com/dd425220c4.js" crossorigin="anonymous"></script>
</head>
</head>
<body>
    <div class="bienvenida">
        <h1 class="text-center text-uppercase m-4"><?php echo $examen ?></h1>
    </div>
    <a href="examenes.html" class="btn btn-primary btn-inicio" ><i class="fas fa-long-arrow-alt-left"></i>Volver a los examenes</a>

    <div class="d-flex flex-row contenido-examen justify-content-center">
        <div>
            <h4>Nombres: </h4>
            <p><?php echo $nombres ?></p>
        </div>

        <div>
            <h4>Apellidos: </h4>
            <p><?php echo $apellidos ?></p>
        </div>

        <div>
            <h4>Cedula: </h4>
            <p><?php echo $cedula ?></p>
        </div>

        <div>
            <h4>Sexo: </h4>
            <p><?php echo $sexo ?></p>
        </div>

        <div>
            <h4>Edad: </h4>
            <p><?php echo $edad ?></p>
        </div>
        
    </div>

    <form id='form-examen' class="container">
        <input type="hidden" name="id" value="<?php echo $id ?>" id='examen-id'>
        <div class="form-floating">
            <textarea id='text-contenido' name="text-contenido" class="form-control" form="form-examen"placeholder="Indique los resultados del examen" ><?php echo $contenido?></textarea>
            <label for="floatingTextarea">Resultado:</label>
        </div>
        <input id="guardar-examen" type="submit" class="btn btn-warning mt-4" value="Guardar">
    </form>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="app.js"></script>
</body>
</html>

