<?php
include("../includes/conexion.php");
include("../includes/header.php");

$genero = isset($_GET['g']) ? $_GET['g'] : '';
$safe = mysqli_real_escape_string($conn, $genero);
$query = mysqli_query($conn, "SELECT * FROM libros WHERE genero='$safe' ORDER BY titulo ASC");
?>

<section class="catalog-section">
    <div class="catalog-header">
        <h1 class="title">📂 <?php echo htmlspecialchars($genero); ?></h1>
        <a href="/pages/catalogo.php" class="btn-outline">← Ver todos los géneros</a>
    </div>

    <?php if (isset($_GET['sin_stock'])): ?>
    <div class="alert alert-error" style="margin-bottom:24px;max-width:600px;margin-inline:auto;">
        <i class="fa-solid fa-triangle-exclamation"></i>
        <strong>"<?php echo htmlspecialchars($_GET['libro'] ?? ''); ?>"</strong> no tiene más stock disponible.
    </div>
    <?php endif; ?>

    <?php if (isset($_GET['agregado'])): ?>
    <div class="alert alert-success" style="margin-bottom:24px;max-width:600px;margin-inline:auto;">
        <i class="fa-solid fa-circle-check"></i> ¡Libro agregado al carrito!
        <a href="/pages/carrito.php">Ver carrito →</a>
    </div>
    <?php endif; ?>

    <div class="books-grid">
        <?php
        $count = 0;
        while ($row = mysqli_fetch_array($query)):
            $count++;
            include("../includes/libro-card.php");
        endwhile;

        if ($count === 0): ?>
        <div class="empty-state">
            <p>😕 No se encontraron libros en este género.</p>
            <a href="/pages/catalogo.php" class="btn-outline">Ver todos los libros</a>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php include("../includes/footer.php"); ?>