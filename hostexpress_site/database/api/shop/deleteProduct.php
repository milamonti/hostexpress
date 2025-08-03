<?php 

require_once '../../config/config.php';
include_once MODULES . '/responseManager.php';
include_once MODULES . '/shopManager.php';

if(!$_POST['ID']) {
  Response::badRequest('ID do produto não fornecido');
}

try {
  Shop::deleteProduct($_POST['ID']);
} catch (PDOException $e) {
  Response::internalError($e->getMessage());
} catch (Exception $e) {
  Response::sendJson($e->getCode(), $e->getMessage());
}

?>
