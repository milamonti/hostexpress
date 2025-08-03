<?php 

require_once '../../config/config.php';
require_once MODULES . '/responseManager.php';
require_once MODULES . '/shopManager.php';
require_once MODULES . '/authManager.php';
$auth = new Auth();

if(!$auth->isLoggedIn()) {
  Response::unauthorized();
}

try {
  Shop::getAllProducts();
} catch (\PDOException $e) {
  Response::internalError($e->getMessage());
} catch (\Exception $e) {
  Response::sendJson($e->getCode(), 'Erro ao obter os produtos da loja: ' . $e->getMessage());
}

?>
