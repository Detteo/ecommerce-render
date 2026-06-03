<?php
include("../includes/conexion.php");
include("../includes/header.php");

$genero_filtro = isset($_GET['g']) ? $_GET['g'] : '';

if ($genero_filtro !== '') {
    $safe = mysqli_real_escape_string($conn, $genero_filtro);
    $query = mysqli_query($conn, "SELECT * FROM libros WHERE genero='$safe' ORDER BY titulo ASC");
} else {
    $query = mysqli_query($conn, "SELECT * FROM libros ORDER BY genero, titulo ASC");
}

$generos = ['Suspenso', 'Fantasia', 'Romance', 'Accion y Aventura', 'Novela'];
$agregar_url = "agregar-carrito.php";
?>

<section class="catalog-section">
    <div class="catalog-header">
        <h1 class="title">
            <?php echo $genero_filtro ? '📂 ' . htmlspecialchars($genero_filtro) : '📚 Catálogo Premium'; ?>
        </h1>
        <div class="filter-bar">
            <a href="catalogo.php" class="filter-btn <?php echo $genero_filtro === '' ? 'active' : ''; ?>">Todos</a>
            <?php foreach ($generos as $g): ?>
            <a href="catalogo.php?g=<?php echo urlencode($g); ?>"
               class="filter-btn <?php echo $genero_filtro === $g ? 'active' : ''; ?>">
                <?php echo htmlspecialchars($g); ?>
            </a>
            <?php endforeach; ?>
        </div>
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
        <a href="carrito.php">Ver carrito →</a>
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
            <a href="catalogo.php" class="btn-outline">Ver todos los libros</a>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php include("../includes/footer.php"); ?>
