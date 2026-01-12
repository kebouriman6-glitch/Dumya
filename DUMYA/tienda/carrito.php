<?php
session_start();
if (!isset($_SESSION["usuario_id"])) {
    header("Location: iniciar_sesion.php");
    exit;
}

if (!isset($_SESSION["carrito"])) {
    $_SESSION["carrito"] = [];
}

$total = 0;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito | DUMYA</title>
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/carrito.css">
</head>
<body>

<h2 class="titulo-carrito">Mi Carrito</h2>

<?php if (count($_SESSION["carrito"]) > 0): ?>
    <div class="tabla-carrito">
        <?php foreach ($_SESSION["carrito"] as $item): 
            $subtotal = $item["precio"] * $item["cantidad"];
            $total += $subtotal;
        ?>
        <div class="producto-carrito">
            <img src="image/<?= $item['imagen'] ?>" alt="<?= $item['nombre'] ?>">
            <div class="info-producto">
                <h3><?= $item["nombre"] ?></h3>
                <p>Precio: <?= $item["precio"] ?> €</p>
                <p>Cantidad: <?= $item["cantidad"] ?></p>
                <p>Subtotal: <?= $subtotal ?> €</p>

                <form action="eliminar_carrito.php" method="POST">
                    <input type="hidden" name="id" value="<?= $item['id'] ?>">
                    <button type="submit" class="btn-eliminar">Eliminar</button>
                </form>
            </div>
        </div>
        <?php endforeach; ?>

        <div class="total-carrito">
            <strong>Total: <?= $total ?> €</strong>
        </div>

        <div class="acciones-carrito">
            <a href="productos.php" class="btn-volver">Seguir comprando</a>
            <a href="vaciar_carrito.php" class="btn-vaciar">Vaciar carrito</a>
        </div>
    </div>
<?php else: ?>
    <p class="carrito-vacio">El carrito está vacío.</p>
    <a href="productos.php" class="btn-volver">Ir a productos</a>
<?php endif; ?>

</body>
</html>
