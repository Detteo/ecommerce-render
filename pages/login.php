<?php
session_start();

if (isset($_SESSION['usuario'])) {
    header("Location: /bookstore/index.php");
    exit;
}

include("../includes/conexion.php");

$error = '';

if (isset($_POST['login'])) {
    $correo = trim($_POST['correo']);
    $password = $_POST['password'];

    $safe = mysqli_real_escape_string($conn, $correo);
    $query = mysqli_query($conn, "SELECT * FROM usuarios WHERE correo='$safe'");
    $user = mysqli_fetch_array($query);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['usuario'] = $correo;
        $_SESSION['usuario_id'] = $user['id'];
        header("Location: /bookstore/index.php");
        exit;
    } else {
        $error = 'Correo o contraseña incorrectos.';
    }
}

$desde_carrito = isset($_GET['redirect']);
include("../includes/header.php");
?>

<section class="auth-section">
    <div class="auth-card">
        <div class="auth-header">
            <?php if ($desde_carrito): ?>
            <span class="auth-icon">🛒</span>
            <h2>Inicia sesión para continuar</h2>
            <p>Necesitas una cuenta para agregar libros al carrito</p>
            <?php else: ?>
            <span class="auth-icon">👤</span>
            <h2>Iniciar Sesión</h2>
            <p>Bienvenido de vuelta a BookStore</p>
            <?php endif; ?>
        </div>

        <?php if ($desde_carrito): ?>
        <div class="alert alert-info">
            <i class="fa-solid fa-circle-info"></i>
            Crea una cuenta gratis o inicia sesión para agregar libros al carrito.
        </div>
        <?php endif; ?>

        <?php if ($error): ?>
        <div class="alert alert-error">
            <i class="fa-solid fa-circle-exclamation"></i> <?php echo $error; ?>
        </div>
        <?php endif; ?>

        <form class="auth-form" method="POST" novalidate>
            <div class="form-group">
                <label for="correo">Correo electrónico</label>
                <input type="email" id="correo" name="correo" placeholder="tu@correo.com" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" placeholder="••••••••" required>
            </div>
            <button type="submit" name="login" class="btn-auth">
                Ingresar <i class="fa-solid fa-arrow-right"></i>
            </button>
        </form>

        <p class="auth-link">
            ¿No tienes cuenta? <a href="registro.php<?php echo $desde_carrito ? '?redirect=1' : ''; ?>">Crear cuenta gratis</a>
        </p>
    </div>
</section>

<?php include("../includes/footer.php"); ?>
