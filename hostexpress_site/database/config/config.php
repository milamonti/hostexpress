<?php
// Caminho absoluto da raiz do projeto
define('root', dirname(__DIR__, 2));
// Caminho para os módulos do banco de dados 
define('modules', root . '/database/modules');

require_once root . '/vendor/autoload.php';

// Carrega as informações do arquivo .env 
$dotenv = Dotenv\Dotenv::createImmutable(root);
$dotenv->load();

// Define as variáveis do banco
$dbHost = $_ENV('host');
$dbUser = $_ENV('user');
$dbPass = $_ENV('password');
$dbName = $_ENV('dbname');

// Timezone padrão
date_default_timezone_set('America/Sao_Paulo');

// Modo para conectar no banco de dados
define('XAMPP', true); // true ou false

// Configurações do banco de dados
define('DB_HOST', XAMPP ? "localhost" : $dbHost);
define('DB_USER', XAMPP ? "root" : $dbUser);
define('DB_PASSWORD', XAMPP ? "" : $dbPass);
define('DB_NAME', XAMPP ? "hostexpress" : $dbName);
define('DB_DRIVER', "mysql");
define('CHARSET', XAMPP ? "utf8" : "utf8mb4");

// URL base
define('BASE_URL', XAMPP ? 'http://localhost' : 'https://hostexpress.ct.ws');

// Teste ou produção (true ou false)
define('DEBUG', true);

// Configurações de exibição de erros
if (DEBUG) {
  error_reporting(E_ALL);                  // Mostrar todos os tipos de erro
  ini_set('display_errors', 1);            // Exibir erros na tela
  ini_set('display_startup_errors', 1);    // Exibir erros de inicialização
} else {
  error_reporting(0);                      // Oculta todos os erros
  ini_set('display_errors', 0);
  ini_set('display_startup_errors', 0);
  ini_set('log_errors', 1);                // Logar erros em produção
  ini_set('error_log', root . '/database/logs/php_errors.log'); // Arquivo de log
}

?>