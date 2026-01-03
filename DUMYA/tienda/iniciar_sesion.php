<?php
$conexion = new mysqli("127.0.0.1", "admin", "1234", "dumya");

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $correo = $_POST["correo"];
    $contraseña = $_POST["contraseña"];
    $errores = [];

    $busqueda = $conexion->query("SELECT correo,nombre,contraseña FROM usuarios WHERE correo = '$correo'");

    if ($fila = $busqueda->fetch_assoc()) {

        if (password_verify($contraseña, $fila["contraseña"])) {

            
            header("Location: productos.php");
            exit;

        } else {
            $errores["contraseña"] = "Contraseña incorrecta";
        }

    } else {
        $errores["correo"] = "Correo no existente";  
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <h1 class="titulo">Iniciar sesión</h1>    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="css/iniciar_sesion.css">


</head>
<body>
    <form action="?" method="POST">
        <input type="text" name="correo" placeholder="Correo">
        <?php if(isset($errores["correo"])): ?>
            <p><?= $errores["correo"] ?></p>
        <?php endif; ?>

        <input type="password" name="contraseña" placeholder="Contraseña">
        <?php if(isset($errores["contraseña"])): ?>
            <p><?= $errores["contraseña"] ?></p>
        <?php endif; ?>

        <button type="submit">Iniciar sesión</button>
        <a href="productos.php"></a>
        
    </form>
</body>
</html>
