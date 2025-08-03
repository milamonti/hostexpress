<?php

require_once '../../config/config.php';
include_once MODULES . '/responseManager.php';
include_once MODULES . '/shopManager.php';

try {
  if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    Response::methodNotAllowed();
  }

  if(!isset($_GET['PRODUTO']) || empty($_GET['PRODUTO'])) {
    Response::badRequest('ID do produto não informado');
  }

  Shop::getProductById($_GET['PRODUTO']);
} catch (PDOException $e) {
  Response::internalError($e->getMessage());
} catch(Exception $e) {
  Response::sendJson($e->getCode(), 'Erro ao obter informações do produto: ' . $e->getMessage());
}

?>