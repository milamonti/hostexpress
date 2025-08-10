<?php 

require_once dirname(__DIR__, 2) . '/middleware/authMiddleware.php';
require_once dirname(__DIR__, 2) . '/config/config.php';
include_once modules . '/responseManager.php';
include_once modules . '/shopManager.php';

if($_SERVER['REQUEST_METHOD'] !== "DELETE"){
  Response::methodNotAllowed();
}

$req = json_decode(file_get_contents("php://input"), true);

if(!$req['id']) {
  Response::badRequest('ID do produto não fornecido');
}

try {
  authMiddleware();
  Shop::deleteProduct($req['id']);
} catch (\Exception $e) {
  Response::handleException($e);
}

?>
