<?php
class Request {
    public static function getMethod() {
        return $_SERVER['REQUEST_METHOD'];
    }

    public static function getUri() {
        $uri = $_SERVER['REQUEST_URI'];
        // Remove query string
        $uri = explode('?', $uri)[0];
        // Retirar possivel barra final
        $uri = rtrim($uri, '/');
        // Se a raiz, volta a barra
        if ($uri === '') {
            $uri = '/';
        }
        return $uri;
    }

    public static function getJsonData() {
        $json = file_get_contents('php://input');
        return json_decode($json, true) ?: [];
    }
}
?>
