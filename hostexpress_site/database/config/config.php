<?php
// Caminho absoluto da raiz do projeto
define('ROOT', dirname(__DIR__, 2));

// Timezone padrão
date_default_timezone_set('America/Sao_Paulo');

// Modo para conectar no banco de dados
define('MODE', "xampp"); //xampp ou host

// Configurações do banco de dados
define('DB_HOST', MODE == "xampp" ? "localhost" : "sql213.infinityfree.com");
define('DB_USER', MODE == "xampp" ? "root" : "if0_38874089");
define('DB_PASSWORD', MODE == "xampp" ? "" : "hostexpress2025");
define('DB_NAME', MODE == "xampp" ? "hostexpress" : "if0_38874089_hostexpress");
define('DB_DRIVER', "mysql");
define('CHARSET', MODE == "xampp" ? "utf8" : "utf8mb4");

// URL base
define('BASE_URL', 'https://hostexpress.ct.ws');

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
  ini_set('error_log', ROOT . '/database/logs/php_errors.log'); // Arquivo de log
}

?>