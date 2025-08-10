<?php 

require_once dirname(__DIR__, 2) . '/config/config.php';
require_once modules . '/responseManager.php';
require_once modules . '/clientManager.php';

try {
  if (!isset($_POST)){
    Response::badRequest('Dados não informados');
  }

  if($_SERVER['REQUEST_METHOD'] !== 'POST') {
    Response::methodNotAllowed();
  }

  Client::registerClient($_POST);
} catch (\Exception $e) {
  Response::handleException($e);
} 

?>