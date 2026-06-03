<?php
session_start();

if (isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit;
}

include("../includes/conexion.php");

$error = '';
$success = '';

if (isset($_POST['registrar'])) {
    $correo = trim($_POST['correo']);
    $password = $_POST['password'];
    $confirmar = $_POST['confirmar'];

    if (empty($correo) || empty($password) || empty($confirmar)) {
        $error = 'Por favor completa todos los campos.';
    } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $error = 'El correo no tiene un formato válido.';
    } elseif (strlen($password) < 6) {
        $error = 'La contraseña debe tener al menos 6 caracteres.';
    } elseif ($password !== $confirmar) {
        $error = 'Las contraseñas no coinciden.';
    } else {
        $safe = mysqli_real_escape_string($conn, $correo);
        $check = mysqli_query($conn, "SELECT id FROM usuarios WHERE correo='$safe'");
        if (mysqli_num_rows($check) > 0) {
            $error = 'Este correo ya está registrado.';
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            mysqli_query($conn, "INSERT INTO usuarios (correo, password) VALUES ('$safe', '$hash')");
            $success = '¡Cuenta creada! Ahora puedes iniciar sesión.';
        }
    }
}

include("../includes/header.php");
?>

<section class="auth-section">
    <div class="auth-card">
        <div class="auth-header">
            <span class="auth-icon">✨</span>
            <h2>Crear Cuenta</h2>
            <p>Únete a la comunidad de BookStore</p>
        </div>

        <?php if ($error): ?>
        <div class="alert alert-error">
            <i class="fa-solid fa-circle-exclamation"></i> <?php echo $error; ?>
        </div>
        <?php endif; ?>

        <?php if ($success): ?>
        <div class="alert alert-success">
            <i class="fa-solid fa-circle-check"></i> <?php echo $success; ?>
            <a href="login.php">Ir a iniciar sesión →</a>
        </div>
        <?php endif; ?>

        <form class="auth-form" method="POST" novalidate>
            <div class="form-group">
                <label for="correo">Correo electrónico</label>
                <input type="email" id="correo" name="correo" placeholder="tu@correo.com" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" placeholder="Mínimo 6 caracteres" required>
            </div>
            <div class="form-group">
                <label for="confirmar">Confirmar contraseña</label>
                <input type="password" id="confirmar" name="confirmar" placeholder="Repite la contraseña" required>
            </div>
            <button type="submit" name="registrar" class="btn-auth">
                Crear cuenta <i class="fa-solid fa-arrow-right"></i>
            </button>
        </form>

        <p class="auth-link">
            ¿Ya tienes cuenta? <a href="login.php">Iniciar sesión</a>
        </p>
    </div>
</section>

<?php include("../includes/footer.php"); ?>