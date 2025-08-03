<?php 

require_once '../../config/config.php';
require_once MODULES . '/responseManager.php';
require_once MODULES . '/clientManager.php';

try {
  if (!isset($_POST)){
    Response::badRequest('Dados não informados');
  }

  if($_SERVER['REQUEST_METHOD'] !== 'POST') {
    Response::methodNotAllowed();
  }

  Client::registerClient($_POST);
} catch (\PDOException $e) {
  Response::internalError($e->getMessage());
} catch (\Exception $e) {
  Response::sendJson($e->getCode(), 'Erro ao registrar cliente: ' . $e->getMessage());
}

?>