<?php
// Configuración global
session_start();

define('SITIO_NOMBRE', 'Sistema Login');
define('DB_HOST', 'localhost');
define('DB_NAME', 'sistema_login');
define('DB_USER', 'root');
define('DB_PASS', ''); // XAMPP por defecto vacía

// Configurar zona horaria
date_default_timezone_set('Europe/Madrid');

// Control de errores (solo desarrollo)
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>