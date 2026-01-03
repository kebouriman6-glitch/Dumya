<?php
$host = "127.0.0.1";
$user = "admin";
$pass = "1234";
$db   = "dumya";

$conexion = new mysqli($host, $user, $pass, $db);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>
