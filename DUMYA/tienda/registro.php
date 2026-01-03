<?php

    $conexion = new mysqli("127.0.0.1", "admin", "1234", "dumya");

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $nombre = $_POST["nombre"];
        $correo = $_POST["correo"];
        $contraseña = $_POST["contraseña"];
        $contraseña_hash = password_hash($contraseña,PASSWORD_DEFAULT);
        //Aqui insertamos los valores porque estan listos
        $sql = "INSERT INTO usuarios (correo,contraseña,nombre) VALUES('$correo','$contraseña_hash','$nombre');";
        $ejecucion = $conexion->query($sql);
        if($ejecucion){
            header("Location: iniciar_sesion.php");
            exit;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DUMYA</title>
    <h1 class="titulo">Registro</h1>

    <link rel="stylesheet" href="css/registro.css">
</head>
<body>
    <form action="?" method="POST">
        <input type="text" placeholder="Nombre" name="nombre" required>
        <input type="text" placeholder="correo" name="correo" required>
        <input type="password" placeholder="Contraseña" name="contraseña" required>
        <button type="submit">Crear</button>
    </form>
</body>
</html>