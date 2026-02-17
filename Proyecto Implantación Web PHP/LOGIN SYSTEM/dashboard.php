<?php
require_once 'includes/config.php';
require_once 'includes/auth.php';

// Solo usuarios logueados
Auth::requireLogin();

// Obtener más datos del usuario
$db = Database::conectar();
$stmt = $db->prepare("SELECT email, fecha_creacion FROM usuarios WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user_data = $stmt->fetch();
?>

<?php include 'includes/header.php'; ?>

<div class="row">
    <div class="col-md-8">
        <h1>Bienvenido, <?php echo htmlspecialchars($_SESSION['nombre']); ?></h1>
        <p class="lead">Sistema de gestión interno</p>
    </div>
    <div class="col-md-4 text-end">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Tu información</h6>
                <p class="mb-1"><small>Usuario:</small> <strong><?php echo $_SESSION['username']; ?></strong></p>
                <p class="mb-1"><small>Rol:</small> <span class="badge bg-primary"><?php echo $_SESSION['rol']; ?></span></p>
                <p class="mb-0"><small>Miembro desde:</small> <?php echo date('d/m/Y', strtotime($user_data['fecha_creacion'])); ?></p>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-4">
        <div class="card text-white bg-primary mb-3">
            <div class="card-body">
                <h5 class="card-title">Perfil</h5>
                <p class="card-text">Email: <?php echo htmlspecialchars($user_data['email']); ?></p>
                <a href="#" class="btn btn-light">Editar perfil</a>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card text-white bg-success mb-3">
            <div class="card-body">
                <h5 class="card-title">Accesos</h5>
                <p class="card-text">Sesión iniciada correctamente</p>
                <a href="logout.php" class="btn btn-light">Cerrar sesión</a>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card text-white bg-info mb-3">
            <div class="card-body">
                <h5 class="card-title">Sistema</h5>
                <p class="card-text">
                    PHP: <?php echo PHP_VERSION; ?><br>
                    Servidor: <?php echo $_SERVER['SERVER_SOFTWARE']; ?>
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Panel para administradores -->
<?php if ($_SESSION['rol'] == 'admin'): ?>
<div class="card mt-4 border-warning">
    <div class="card-header bg-warning">
        <h5 class="mb-0">🛠 Panel de Administración</h5>
    </div>
    <div class="card-body">
        <h6>Usuarios del sistema:</h6>
        <?php
        $stmt = $db->query("SELECT username, nombre, rol, fecha_creacion FROM usuarios ORDER BY fecha_creacion DESC");
        $usuarios = $stmt->fetchAll();
        ?>
        <div class="table-responsive">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Nombre</th>
                        <th>Rol</th>
                        <th>Fecha creación</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($usuario['username']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['nombre']); ?></td>
                        <td><span class="badge bg-secondary"><?php echo $usuario['rol']; ?></span></td>
                        <td><?php echo date('d/m/Y', strtotime($usuario['fecha_creacion'])); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>