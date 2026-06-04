<?php
session_start();
include("../includes/conexion.php");
include("../includes/header.php");

$total = 0;
$items = [];

if (isset($_SESSION['usuario_id'])) {
    $usuario_id = intval($_SESSION['usuario_id']);
    $res = mysqli_query($conn,
        "SELECT l.*, COUNT(*) as cantidad, l.precio * COUNT(*) as subtotal
         FROM carrito c
         JOIN libros l ON l.id = c.libro_id
         WHERE c.usuario_id = $usuario_id
         GROUP BY c.libro_id"
    );
    while ($row = mysqli_fetch_array($res)) {
        $total += $row['subtotal'];
        $items[] = $row;
    }
}

if (isset($_POST['finalizar']) && count($items) > 0) {
    foreach ($items as $item) {
        $libro_id = intval($item['id']);
        $cantidad = intval($item['cantidad']);
        mysqli_query($conn, "UPDATE libros SET stock = stock - $cantidad WHERE id=$libro_id");
    }
    $usuario_id = intval($_SESSION['usuario_id']);
    mysqli_query($conn, "DELETE FROM carrito WHERE usuario_id=$usuario_id");
    header("Location: /pages/carrito.php?compra_exitosa=1");
    exit;
}
?>

<section class="catalog-section">
    <h1 class="title">🛒 Mi Carrito</h1>

    <?php if (isset($_GET['compra_exitosa'])): ?>
    <div class="alert alert-success" style="max-width:600px;margin:0 auto 30px;display:flex;">
        <i class="fa-solid fa-circle-check"></i>
        ¡Compra realizada con éxito! Gracias por tu pedido. 🎉
    </div>
    <?php endif; ?>

    <?php if (count($items) > 0): ?>
    <div class="cart-layout">
        <div class="cart-items">
            <?php foreach ($items as $row): ?>
            <div class="cart-card">
                <img src="/assets/img/<?php echo htmlspecialchars($row['imagen']); ?>"
                     alt="<?php echo htmlspecialchars($row['titulo']); ?>"
                     onerror="this.src='/assets/img/placeholder.svg'">
                <div class="cart-info">
                    <span class="genre-tag"><?php echo htmlspecialchars($row['genero']); ?></span>
                    <h3><?php echo htmlspecialchars($row['titulo']); ?></h3>
                    <p><?php echo htmlspecialchars($row['autor']); ?></p>
                    <div class="cart-meta">
                        <span class="price">$<?php echo number_format($row['precio'], 0, ',', '.'); ?></span>
                        <span class="qty">× <?php echo $row['cantidad']; ?></span>
                        <span class="subtotal">= $<?php echo number_format($row['subtotal'], 0, ',', '.'); ?></span>
                    </div>
                </div>
                <a href="eliminar-carrito.php?id=<?php echo $row['id']; ?>" class="btn-remove" title="Eliminar">
                    <i class="fa-solid fa-trash"></i>
                </a>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="cart-summary">
            <h3>Resumen del pedido</h3>
            <div class="summary-row">
                <span>Subtotal (<?php echo count($items); ?> título<?php echo count($items) > 1 ? 's' : ''; ?>)</span>
                <span>$<?php echo number_format($total, 0, ',', '.'); ?></span>
            </div>
            <div class="summary-row">
                <span>Envío digital</span>
                <span class="free">Gratis</span>
            </div>
            <div class="summary-total">
                <strong>Total</strong>
                <strong>$<?php echo number_format($total, 0, ',', '.'); ?></strong>
            </div>
            <form method="POST">
                <button type="submit" name="finalizar" class="btn-checkout">
                    <i class="fa-solid fa-lock"></i> Finalizar compra
                </button>
            </form>
            <a href="/pages/catalogo.php" class="btn-outline" style="display:block;text-align:center;margin-top:12px;">
                ← Seguir comprando
            </a>
            <a href="vaciar-carrito.php" class="btn-clear">Vaciar carrito</a>
        </div>
    </div>

    <?php else: ?>
    <div class="empty-state large">
        <div class="empty-icon">🛒</div>
        <h2>Tu carrito está vacío</h2>
        <p>Explora nuestro catálogo y agrega los libros que te gusten.</p>
        <a href="/pages/catalogo.php" class="btn-hero">Explorar catálogo</a>
    </div>
    <?php endif; ?>
</section>

<?php include("../includes/footer.php"); ?>
