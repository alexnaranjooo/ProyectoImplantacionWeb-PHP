<?php
require_once 'includes/config.php';
require_once 'includes/auth.php';

$error = '';

// Si ya está logueado, redirigir
if (Auth::check()) {
    header('Location: dashboard.php');
    exit();
}

// Procesar formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if (empty($username) || empty($password)) {
        $error = 'Usuario y contraseña requeridos';
    } elseif (Auth::login($username, $password)) {
        header('Location: dashboard.php');
        exit();
    } else {
        $error = 'Credenciales incorrectas';
    }
}
?>

<?php include 'includes/header.php'; ?>

<div class="login-container">
    <h2>🔐 Iniciar Sesión</h2>
    
    <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    
    <form method="POST" action="">
        <div class="mb-3">
            <label for="username" class="form-label">Usuario</label>
            <input type="text" class="form-control" id="username" name="username" 
                   required autofocus value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>">
        </div>
        
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        
        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-login text-white">Acceder</button>
        </div>
        
        <div class="text-center mt-3">
            <small class="text-muted">
                Usuario demo: <strong>admin</strong> / Contraseña: <strong>admin123</strong>
            </small>
        </div>
    </form>
    
    <!-- Info técnica para ASIR -->
    <div class="mt-4 pt-3 border-top">
        <details class="small">
            <summary>🔧 Información técnica</summary>
            <p class="mt-2 mb-1"><strong>Base de datos:</strong> <?php echo DB_NAME; ?></p>
            <p class="mb-1"><strong>Servidor:</strong> <?php echo DB_HOST; ?></p>
            <p class="mb-0"><strong>Hash usado:</strong> password_hash() con PASSWORD_DEFAULT</p>
        </details>
    </div>
</div>

<?php include 'includes/footer.php'; ?>