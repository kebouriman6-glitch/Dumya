<?php
session_start();
include("conexion.php");

if (!isset($_SESSION["usuario_id"]) || empty($_SESSION["carrito"])) {
    header("Location: productos.php");
    exit;
}

$usuario_id = $_SESSION["usuario_id"];
$total = 0;

foreach ($_SESSION["carrito"] as $producto) {
    $total += $producto["precio"] * $producto["cantidad"];
}

/* Guardar pedido */
$stmt = $conexion->prepare(
    "INSERT INTO pedidos (usuario_id, total) VALUES (?, ?)"
);
$stmt->bind_param("id", $usuario_id, $total);
$stmt->execute();

$pedido_id = $stmt->insert_id;

/* Guardar detalle */
$stmtDetalle = $conexion->prepare(
    "INSERT INTO pedido_detalle (pedido_id, producto_id, cantidad, precio)
     VALUES (?, ?, ?, ?)"
);

foreach ($_SESSION["carrito"] as $id => $producto) {
    $stmtDetalle->bind_param(
        "iiid",
        $pedido_id,
        $id,
        $producto["cantidad"],
        $producto["precio"]
    );
    $stmtDetalle->execute();
}

/* Vaciar carrito */
unset($_SESSION["carrito"]);

header("Location: pedido_exitoso.php");
exit;
