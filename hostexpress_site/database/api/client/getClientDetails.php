<?php 

require_once '../../config/config.php';
require_once MODULES . '/responseManager.php';
require_once MODULES . '/clientManager.php';
include_once MODULES . '/authManager.php';
$auth = new Auth();

try {
  if (!$auth->isLoggedIn()) {
    Response::unauthorized('Usuário não autenticado');
  }

  Client::getClientByEmail($auth->user('email'));
} catch (PDOException $e) {
  Response::internalError($e->getMessage());
} catch (Exception $e) {
  Response::sendJson($e->getCode(), 'Erro ao buscar detalhes do cliente: ' . $e->getMessage());
}

?>