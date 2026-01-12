<?php
session_start();
if (isset($_POST['id']) && isset($_SESSION["carrito"])) {
    $id = $_POST['id'];
    foreach ($_SESSION["carrito"] as $key => $item) {
        if ($item['id'] == $id) {
            unset($_SESSION["carrito"][$key]);
            break;
        }
    }
    $_SESSION["carrito"] = array_values($_SESSION["carrito"]);
}
header("Location: carrito.php");
exit;
