<?php
session_start();
include("../includes/conexion.php");

if (isset($_SESSION['usuario_id'])) {
    $usuario_id = intval($_SESSION['usuario_id']);
    // Vaciar sin tocar stock (el stock solo cambia al finalizar compra)
    mysqli_query($conn, "DELETE FROM carrito WHERE usuario_id=$usuario_id");
}

header("Location: /bookstore/pages/carrito.php");
exit;