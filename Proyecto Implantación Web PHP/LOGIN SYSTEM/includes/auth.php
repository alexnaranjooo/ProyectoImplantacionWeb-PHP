<?php
require_once 'database.php';

class Auth {
    // Verificar login
    public static function login($username, $password) {
        $db = Database::conectar();
        $stmt = $db->prepare("SELECT id, username, password_hash, nombre, rol FROM usuarios WHERE username = ? AND activo = 1");
        $stmt->execute([$username]);
        $user = $stmt->fetch();
        
        if ($user && password_verify($password, $user['password_hash'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['nombre'] = $user['nombre'];
            $_SESSION['rol'] = $user['rol'];
            $_SESSION['logged_in'] = true;
            
            // Actualizar último login
            $update = $db->prepare("UPDATE usuarios SET ultimo_login = NOW() WHERE id = ?");
            $update->execute([$user['id']]);
            
            return true;
        }
        return false;
    }
    
    // Verificar si está autenticado
    public static function check() {
        return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
    }
    
    // Redirigir si no está logueado
    public static function requireLogin() {
        if (!self::check()) {
            header('Location: login.php');
            exit();
        }
    }
    
    // Cerrar sesión
    public static function logout() {
        session_destroy();
        header('Location: login.php');
        exit();
    }
}
?>