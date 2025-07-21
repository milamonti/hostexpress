<?php

define('DB_HOST', "localhost");
define('DB_USER', "root");
define('DB_PASSWORD', "");
define('DB_NAME', "hostexpress");
define('DB_DRIVER', "mysql");

class Conexao {

    private static $connection;

    private function __construct() {}

    public static function conectar() {

        $pdoConfig = DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8";

        try {
            if(!isset(self::$connection)){
                self::$connection = new PDO($pdoConfig, DB_USER, DB_PASSWORD);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }

            return self::$connection;
        } 
        catch (PDOException $e) {
            $mensagem = "Drivers disponíveis: " . implode(",", PDO::getAvailableDrivers());
            $mensagem .= "\nErro: " . $e->getMessage();
            throw new Exception($mensagem);
        }
    }
}
?>
