<?php
session_start();
if (!isset($_SESSION["usuario_id"])) {
    header("Location: iniciar_sesion.php");
    exit;
}

ini_set('display_errors', 1);
error_reporting(E_ALL);

include("conexion.php");

/* Inicializar carrito si no existe */
if (!isset($_SESSION["carrito"])) {
    $_SESSION["carrito"] = [];
}

/* Obtener productos de la base de datos */
$sql = "SELECT * FROM productos";
$resultado = $conexion->query($sql);

if (!$resultado) {
    die("Error en la consulta: " . $conexion->error);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Productos | DUMYA</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>



<div class="user-bar">
    <span class="bienvenido">Hola, <?= $_SESSION["usuario_nombre"] ?></span>
    <div class="user-actions">
        <a href="carrito.php">🛒 Carrito (<?= count($_SESSION["carrito"]) ?>)</a>
        <a href="cerrar_sesion.php">Salir</a>
    </div>
</div>

</header>
<h2 class="titulo-productos">Nuestros Bolsos</h2>

<section class="productos">

<?php 
if ($resultado->num_rows > 0):
    while ($producto = $resultado->fetch_assoc()): ?>
        <div class="producto">
            <div class="tarjeta">
                <img src="image/<?= $producto['imagen'] ?>" alt="<?= $producto['nombre'] ?>">
                <h3><?= $producto['nombre'] ?></h3>
                <p class="precio"><?= $producto['precio'] ?> €</p>

                <!-- Formulario para añadir al carrito -->
                <form action="agregar_carrito.php" method="POST">
    <input type="hidden" name="id" value="<?= $producto['id'] ?>">
    <input type="hidden" name="nombre" value="<?= $producto['nombre'] ?>">
    <input type="hidden" name="precio" value="<?= $producto['precio'] ?>">
    <input type="hidden" name="imagen" value="<?= $producto['imagen'] ?>">
    <button type="submit" class="carrito">Añadir al carrito</button>
</form>
            </div>
        </div>
<?php 
    endwhile;
else:
    echo "<p>No hay productos disponibles.</p>";
endif;
?>

</section>

</body>
</html>
