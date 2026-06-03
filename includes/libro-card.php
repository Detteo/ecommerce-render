<?php ?>
<div class="book-card">
    <div class="book-img-wrap">
        <img src="/bookstore/assets/img/<?php echo htmlspecialchars($row['imagen']); ?>"
             alt="<?php echo htmlspecialchars($row['titulo']); ?>"
             onerror="this.src='/bookstore/assets/img/placeholder.svg'">
        <span class="genre-tag"><?php echo htmlspecialchars($row['genero']); ?></span>
        <?php if ($row['stock'] <= 0): ?>
        <span class="stock-badge sin-stock">Sin stock</span>
        <?php elseif ($row['stock'] == 1): ?>
        <span class="stock-badge ultimo">¡Último!</span>
        <?php else: ?>
        <span class="stock-badge disponible">Stock: <?php echo $row['stock']; ?></span>
        <?php endif; ?>
    </div>
    <div class="book-info">
        <h3><?php echo htmlspecialchars($row['titulo']); ?></h3>
        <p class="author"><i class="fa-solid fa-pen-nib"></i> <?php echo htmlspecialchars($row['autor']); ?></p>
        <p class="description"><?php echo htmlspecialchars(mb_substr($row['descripcion'], 0, 90)) . '...'; ?></p>
        <div class="book-footer">
            <span class="price">$<?php echo number_format($row['precio'], 0, ',', '.'); ?></span>
            <?php if ($row['stock'] > 0): ?>
            <a href="/bookstore/pages/agregar-carrito.php?id=<?php echo $row['id']; ?>" class="btn-cart">
                <i class="fa-solid fa-cart-plus"></i> Agregar
            </a>
            <?php else: ?>
            <button class="btn-cart btn-agotado" disabled>
                <i class="fa-solid fa-ban"></i> Agotado
            </button>
            <?php endif; ?>
        </div>
    </div>
</div>