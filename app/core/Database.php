<?php
class Database {
    private static $instance = null;
    
    private function __construct() {}
    
    public static function getConnection() {
        if (self::$instance === null) {
            $configFile = __DIR__ . '/../../config.php';
            if (file_exists($configFile)) {
                require_once $configFile;
                $host = DB_HOST;
                $db_name = DB_NAME;
                $username = DB_USER;
                $password = DB_PASSWORD;
            } else {
                $host = getenv('DB_HOST') ?: 'localhost';
                $db_name = getenv('DB_NAME') ?: 'autoportaldoc';
                $username = getenv('DB_USER') ?: 'root';
                $password = getenv('DB_PASSWORD') ?: 'root';
            }

            try {
                self::$instance = new PDO(
                    "mysql:host=" . $host . ";dbname=" . $db_name, 
                    $username, 
                    $password,
                    array(
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
                    )
                );
            } catch(PDOException $exception) {
                echo "Connection error: " . $exception->getMessage();
            }
        }
        return self::$instance;
    }
}
?>
