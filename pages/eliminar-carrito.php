<?php
session_start();
include("../includes/conexion.php");

if (isset($_GET['id']) && is_numeric($_GET['id']) && isset($_SESSION['usuario_id'])) {
    $id = intval($_GET['id']);
    $usuario_id = intval($_SESSION['usuario_id']);
    mysqli_query($conn, "DELETE FROM carrito WHERE usuario_id=$usuario_id AND libro_id=$id LIMIT 1");
}

header("Location: /pages/carrito.php");
exit;
