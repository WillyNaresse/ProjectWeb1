<?php
class Session {
    public static function start() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function set($key, $value) {
        self::start();
        $_SESSION[$key] = $value;
    }

    public static function get($key) {
        self::start();
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    public static function destroy() {
        self::start();
        session_unset();
        session_destroy();
    }

    public static function isAuthenticated() {
        return self::get('user_id') !== null;
    }

    public static function requireAuth() {
        if (!self::isAuthenticated()) {
            Response::json(['success' => false, 'message' => 'Não autenticado.'], 401);
        }
    }

    public static function requirePageAuth() {
        if (!self::isAuthenticated()) {
            header('Location: login.php');
            exit;
        }
    }
}
?>
