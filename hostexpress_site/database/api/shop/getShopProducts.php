<?php 

require_once dirname(__DIR__, 2) . '/middleware/authMiddleware.php';
require_once dirname(__DIR__, 2) . '/config/config.php';
require_once modules . '/responseManager.php';
require_once modules . '/shopManager.php';
require_once modules . '/authManager.php';

try {
  authMiddleware();
  Shop::getAllProducts();
} catch (\PDOException $e) {
  Response::internalError($e->getMessage());
} catch (\Exception $e) {
  Response::sendJson($e->getCode(), 'Erro ao obter os produtos da loja: ' . $e->getMessage());
}

?>
