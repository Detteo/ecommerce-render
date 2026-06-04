<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookStore Premium</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

<header class="header" id="header">
    <div class="logo">
        <a href="/index.php">
            <span class="logo-icon">📚</span>
            <span class="logo-text">BookStore</span>
        </a>
    </div>

    <nav class="navbar">
        <a href="/index.php">Inicio</a>
        <a href="/pages/catalogo.php">Catálogo</a>
        <a href="/pages/carrito.php" class="nav-cart">
            <i class="fa-solid fa-cart-shopping"></i>
            Carrito
            <?php
            $total_carrito = 0;
            if (isset($_SESSION['usuario_id'])) {
                include_once dirname(__FILE__) . '/conexion.php';
                $uid = intval($_SESSION['usuario_id']);
                $r = mysqli_query($conn, "SELECT COUNT(*) as cnt FROM carrito WHERE usuario_id=$uid");
                $total_carrito = mysqli_fetch_array($r)['cnt'];
            }
            if ($total_carrito > 0): ?>
            <span class="cart-badge"><?php echo $total_carrito; ?></span>
            <?php endif; ?>
        </a>

        <?php if (isset($_SESSION['usuario'])): ?>
            <a href="/pages/logout.php" class="btn-logout-nav">
                <i class="fa-solid fa-right-from-bracket"></i> Cerrar sesión
            </a>
        <?php else: ?>
            <a href="/pages/login.php" class="btn-nav-login">
                <i class="fa-solid fa-user"></i> Ingresar
            </a>
        <?php endif; ?>
    </nav>

    <?php if (isset($_SESSION['usuario'])): ?>
    <div class="user-name">
        <i class="fa-solid fa-circle-user"></i>
        <?php echo htmlspecialchars(explode('@', $_SESSION['usuario'])[0]); ?>
    </div>
    <?php endif; ?>

    <form action="/pages/search.php" method="GET" class="search-box">
        <input type="text" name="buscar" placeholder="Buscar libro o autor..." autocomplete="off">
        <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
    </form>

    <button class="menu-toggle" id="menuToggle" aria-label="Menú">
        <i class="fa-solid fa-bars"></i>
    </button>
</header>
