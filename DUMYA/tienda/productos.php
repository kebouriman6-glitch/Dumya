<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include("conexion.php");

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

<h2 class="titulo-productos">Nuestros Bolsos</h2>

<section class="productos">

<?php 
if ($resultado->num_rows > 0) {
    while ($producto = $resultado->fetch_assoc()) { ?>
        <div class="producto">
            <div class="tarjeta">
                <img src="image/<?php echo $producto['imagen']; ?>" 
                     alt="<?php echo $producto['nombre']; ?>">
                <h3><?php echo $producto['nombre']; ?></h3>
                <p class="precio"><?php echo $producto['precio']; ?> €</p>
                <a href="#" class="btn">Ver producto</a>
            </div>
        </div>
<?php 
    }
} else {
    echo "<p>No hay productos disponibles.</p>";
}
?>

</section>

</body>
</html>
