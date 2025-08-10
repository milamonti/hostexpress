<?php 

require_once dirname(__DIR__, 2) . '/middleware/authMiddleware.php';
require_once dirname(__DIR__, 2) . '/config/config.php';
require_once modules . '/responseManager.php';
require_once modules . '/shopManager.php';

try {
  if($_SERVER['REQUEST_METHOD'] !== 'POST') {
    Response::methodNotAllowed();
  }

  if (!isset($_POST) || empty($_POST)) {
    Response::badRequest('Dados não informados');
  }

  authMiddleware();
  Shop::registerShop($_POST);
} catch (\PDOException $e) {
  Response::internalError($e->getMessage());
} catch (\Exception $e) {
  Response::sendJson($e->getCode(), 'Erro ao registrar loja: ' . $e->getMessage());
}

?>