<?php
require_once 'database/config/config.php';

class Conexao {

  private static $connection;

  private function __construct() {}

  public static function conectar() {

    $pdoConfig = DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . CHARSET;

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
