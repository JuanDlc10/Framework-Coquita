<?php
namespace config;
use Dotenv\Dotenv;
use PDO;
use PDOException;

$dotenv = Dotenv::createImmutable('./');
$dotenv->load();
define('SERVER', $_ENV['HOST']);
define('USER', $_ENV['USER']);
define('PASSWORD', $_ENV['PASSWORD']);
define('DB', $_ENV['DB']);
define('PORT', $_ENV['PORT']);
class Conexion
{
    private static $conexion;
    private static function abrir_conexion()
    {
        if (!isset(self::$conexion)) {
            try {
                self::$conexion = new PDO('mysql:host=' . SERVER . ';dbname=' . DB, USER, PASSWORD);
                self::$conexion->exec('SET CHARACTER SET utf8');
                return self::$conexion;
            } catch (PDOException $e) {
                echo 'Error en la conexion de base de datos: ' . $e;
                die();
            }
        } else {
            return self::$conexion;
        }
    }
    public static function obtener_conexion()
    {
        $conexion = self::abrir_conexion();
        return $conexion;
    }
    public static function cerrar_conexion()
    {
        self::$conexion = null;
    }
}
?>