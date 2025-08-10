<?php

require_once dirname(__DIR__, 1) . '/middleware/authMiddleware.php';
require_once dirname(__DIR__, 1) . '/config/config.php';
require_once modules . '/uploadManager.php';
require_once modules . '/responseManager.php';

if($_SERVER['REQUEST_METHOD'] !== "POST"){
  Response::methodNotAllowed();
}

if(!$_POST['id']){
  Response::badRequest('ID do produto não informado');
}

try{
  authMiddleware();
  Upload::uploadPhoto($_POST['id']);
} catch (\Exception $e) {
  Response::sendJson($e->getCode(), 'Erro ao fazer o upload do arquivo:' . $e->getMessage());
}

?>
