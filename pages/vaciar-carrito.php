<?php
session_start();
include("../includes/conexion.php");

if (isset($_SESSION['usuario_id'])) {
    $usuario_id = intval($_SESSION['usuario_id']);
    mysqli_query($conn, "DELETE FROM carrito WHERE usuario_id=$usuario_id");
}

header("Location: /pages/carrito.php");
exit;
