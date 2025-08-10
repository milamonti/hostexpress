<?php

require_once dirname(__DIR__, 2) . '/middleware/authMiddleware.php';
require_once dirname(__DIR__, 2) . '/config/config.php';
include_once modules . '/responseManager.php';
include_once modules . '/shopManager.php';

try {
  if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    Response::methodNotAllowed();
  }

  if(!isset($_GET['PRODUTO']) || empty($_GET['PRODUTO'])) {
    Response::badRequest('ID do produto não informado');
  }
  
  // authMiddleware();
  Shop::getProductById($_GET['PRODUTO']);
} catch (PDOException $e) {
  Response::internalError($e->getMessage());
} catch(Exception $e) {
  Response::sendJson($e->getCode(), 'Erro ao obter informações do produto: ' . $e->getMessage());
}

?>