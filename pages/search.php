<?php
include("../includes/conexion.php");
include("../includes/header.php");

$buscar = isset($_GET['buscar']) ? trim($_GET['buscar']) : '';
$safe = mysqli_real_escape_string($conn, $buscar);
$query = mysqli_query($conn,
    "SELECT * FROM libros WHERE titulo LIKE '%$safe%' OR autor LIKE '%$safe%' OR genero LIKE '%$safe%' ORDER BY titulo ASC"
);
?>

<section class="catalog-section">
    <div class="catalog-header">
        <h1 class="title">🔍 Resultados para: <em>"<?php echo htmlspecialchars($buscar); ?>"</em></h1>
    </div>

    <div class="books-grid">
        <?php
        $count = 0;
        while ($row = mysqli_fetch_array($query)):
            $count++;
            include("../includes/libro-card.php");
        endwhile;

        if ($count === 0): ?>
        <div class="empty-state">
            <p>😕 No se encontraron resultados para "<?php echo htmlspecialchars($buscar); ?>".</p>
            <a href="/pages/catalogo.php" class="btn-outline">Ver catálogo completo</a>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php include("../includes/footer.php"); ?>
