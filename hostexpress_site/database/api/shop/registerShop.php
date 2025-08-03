<?php 

require_once '../../config/config.php';
require_once MODULES . '/responseManager.php';
require_once MODULES . '/shopManager.php';

try {
  if($_SERVER['REQUEST_METHOD'] !== 'POST') {
    Response::methodNotAllowed();
  }

  if (!isset($_POST) || empty($_POST)) {
    Response::badRequest('Dados não informados');
  }

  Shop::registerShop($_POST);
} catch (\PDOException $e) {
  Response::internalError($e->getMessage());
} catch (\Exception $e) {
  Response::sendJson($e->getCode(), 'Erro ao registrar loja: ' . $e->getMessage());
}

?>