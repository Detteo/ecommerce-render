<?php include("includes/header.php"); ?>

<section class="hero">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <span class="hero-badge">✨ Libros de los mejores autores del mundo</span>
        <h1>Descubre mundos<br><em>increíbles</em></h1>
        <p>Fantasía, suspenso, romance, aventura y mucho más.<br>Tu próxima historia favorita está aquí.</p>
        <div class="hero-actions">
            <a href="pages/catalogo.php" class="btn-hero">
                Explorar catálogo <i class="fa-solid fa-arrow-right"></i>
            </a>
            <?php if (!isset($_SESSION['usuario'])): ?>
            <a href="pages/registro.php" class="btn-hero-outline">Crear cuenta gratis</a>
            <?php endif; ?>
        </div>
    </div>
    <div class="hero-scroll-hint">
        <i class="fa-solid fa-chevron-down"></i>
    </div>
</section>

<section class="genres">
    <div class="section-header">
        <h2>Explorar por Género</h2>
        <p>Encuentra exactamente lo que buscas</p>
    </div>
    <div class="genre-container">
        <a href="pages/genero.php?g=Suspenso" class="genre suspense">
            <span class="genre-icon">🔍</span>
            <span class="genre-name">Suspenso</span>
            <span class="genre-count">3 libros</span>
        </a>
        <a href="pages/genero.php?g=Fantasia" class="genre fantasy">
            <span class="genre-icon">🧙</span>
            <span class="genre-name">Fantasía</span>
            <span class="genre-count">3 libros</span>
        </a>
        <a href="pages/genero.php?g=Romance" class="genre romance">
            <span class="genre-icon">💕</span>
            <span class="genre-name">Romance</span>
            <span class="genre-count">3 libros</span>
        </a>
        <a href="pages/genero.php?g=Accion y Aventura" class="genre adventure">
            <span class="genre-icon">⚔️</span>
            <span class="genre-name">Acción y Aventura</span>
            <span class="genre-count">3 libros</span>
        </a>
        <a href="pages/genero.php?g=Novela" class="genre novel">
            <span class="genre-icon">📖</span>
            <span class="genre-name">Novela</span>
            <span class="genre-count">3 libros</span>
        </a>
    </div>
</section>

<?php
include("includes/conexion.php");
$featured = mysqli_query($conn, "SELECT * FROM libros ORDER BY precio DESC LIMIT 4");
$agregar_url = "/bookstore/pages/agregar-carrito.php";
?>

<section class="featured">
    <div class="section-header">
        <h2>🔥 Libros Destacados</h2>
        <p>Los favoritos de nuestra comunidad de lectores</p>
    </div>
    <div class="books-grid">
        <?php while ($row = mysqli_fetch_array($featured)):
            include("includes/libro-card.php");
        endwhile; ?>
    </div>
    <div class="section-cta">
        <a href="pages/catalogo.php" class="btn-outline">Ver catálogo completo →</a>
    </div>
</section>

<section class="promo">
    <div class="promo-box">
        <div class="promo-text">
            <?php if (!isset($_SESSION['usuario'])): ?>
            <h2>📬 ¿Eres nuevo aquí?</h2>
            <p>Crea tu cuenta gratis y lleva el control de tus compras y lista de deseos.</p>
            <a href="pages/registro.php" class="btn-hero">Registrarme ahora</a>
            <?php else: ?>
            <h2>👋 Bienvenido de vuelta</h2>
            <p>Explora el catálogo y encuentra tu próxima gran lectura.</p>
            <a href="pages/catalogo.php" class="btn-hero">Ver catálogo</a>
            <?php endif; ?>
        </div>
        <div class="promo-stats">
            <div class="stat"><strong>15</strong><span>Títulos</span></div>
            <div class="stat"><strong>5</strong><span>Géneros</span></div>
            <div class="stat"><strong>100%</strong><span>Online</span></div>
        </div>
    </div>
</section>

<?php include("includes/footer.php"); ?>

