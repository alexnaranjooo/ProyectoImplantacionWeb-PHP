<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITIO_NOMBRE; ?></title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php"><?php echo SITIO_NOMBRE; ?></a>
            <?php if (isset($_SESSION['logged_in'])): ?>
                <span class="navbar-text text-white ms-auto me-3">
                    Hola, <?php echo htmlspecialchars($_SESSION['nombre']); ?>
                </span>
                <a href="logout.php" class="btn btn-outline-light btn-sm">Cerrar sesión</a>
            <?php endif; ?>
        </div>
    </nav>
    <div class="container mt-4">