<?php
session_start(); // 🔹 Inicia sesión al principio

$conexion = new mysqli("127.0.0.1", "admin", "1234", "dumya");

$errores = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $correo = $_POST["correo"];
    $contraseña = $_POST["contraseña"];

    // Consulta segura
    $stmt = $conexion->prepare("SELECT id, nombre, contraseña FROM usuarios WHERE correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($fila = $resultado->fetch_assoc()) {

        if (password_verify($contraseña, $fila["contraseña"])) {

            // 🔹 Guardar datos del usuario en sesión
            $_SESSION["usuario_id"] = $fila["id"];
            $_SESSION["usuario_nombre"] = $fila["nombre"];

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
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión | DUMYA</title>
    <link rel="stylesheet" href="css/iniciar_sesion.css">
</head>
<body>

<h1 class="titulo">Iniciar sesión</h1>

<form action="" method="POST">
    <input type="text" name="correo" placeholder="Correo" required>
    <?php if(isset($errores["correo"])): ?>
        <p class="error"><?= $errores["correo"] ?></p>
    <?php endif; ?>

    <input type="password" name="contraseña" placeholder="Contraseña" required>
    <?php if(isset($errores["contraseña"])): ?>
        <p class="error"><?= $errores["contraseña"] ?></p>
    <?php endif; ?>

    <button type="submit">Iniciar sesión</button>
</form>

</body>
</html>
