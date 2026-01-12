<?php
session_start();
if (!isset($_SESSION["carrito"])) {
    $_SESSION["carrito"] = [];
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $imagen = $_POST['imagen'];

    // Verificar si el producto ya está en el carrito
    $encontrado = false;
    foreach ($_SESSION["carrito"] as &$item) {
        if ($item['id'] == $id) {
            $item['cantidad']++;
            $encontrado = true;
            break;
        }
    }
    if (!$encontrado) {
        $_SESSION["carrito"][] = [
            'id' => $id,
            'nombre' => $nombre,
            'precio' => $precio,
            'imagen' => $imagen,
            'cantidad' => 1
        ];
    }
}

header("Location: carrito.php");
exit;
