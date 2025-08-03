<?php 

require_once dirname(__DIR__, 2) . '/config/config.php';
require_once MODULES . '/responseManager.php';
require_once MODULES . '/shopManager.php';

if($_SERVER['REQUEST_METHOD'] !== "POST") {
  Response::methodNotAllowed();
}

if(!$_POST){
  Response::badRequest('Parâmetros não enviados!');
}

try {
  Shop::updateProduct($_POST);
} catch (PDOException $e) {
  Response::internalError($e->getMessage());
} catch (Exception $e) {
  Response::sendJson($e->getCode(), $e->getMessage());
}