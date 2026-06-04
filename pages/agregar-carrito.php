<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: /pages/login.php?redirect=1");
    exit;
}

include("../includes/conexion.php");

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: /pages/catalogo.php");
    exit;
}

$id = intval($_GET['id']);
$usuario_id = intval($_SESSION['usuario_id']);

$res = mysqli_query($conn, "SELECT stock, titulo FROM libros WHERE id=$id");
$libro = mysqli_fetch_array($res);

if (!$libro) {
    header("Location: /pages/catalogo.php");
    exit;
}

// Cuántos de este libro ya tiene en el carrito
$res2 = mysqli_query($conn, "SELECT COUNT(*) as cnt FROM carrito WHERE usuario_id=$usuario_id AND libro_id=$id");
$en_carrito = mysqli_fetch_array($res2)['cnt'];

// Construir URL de regreso conservando ?g= si viene de genero.php
$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/pages/catalogo.php';
$referer_limpio = strtok($referer, '?');
$genero_param = '';
if (strpos($referer, 'genero.php') !== false) {
    parse_str(parse_url($referer, PHP_URL_QUERY), $params);
    if (!empty($params['g'])) {
        $genero_param = '&g=' . urlencode($params['g']);
    }
}

if ($libro['stock'] <= 0 || $en_carrito >= $libro['stock']) {
    header("Location: {$referer_limpio}?sin_stock=1&libro=" . urlencode($libro['titulo']) . $genero_param);
    exit;
}

// Agregar a BD — NO descontar stock todavía
mysqli_query($conn, "INSERT INTO carrito (usuario_id, libro_id) VALUES ($usuario_id, $id)");

header("Location: {$referer_limpio}?agregado=1" . $genero_param);
exit;
