<?php

require_once dirname(__DIR__, 2) . '/middleware/authMiddleware.php';
require_once dirname(__DIR__, 2) . '/config/config.php';
include_once modules . '/responseManager.php';
include_once modules . '/shopManager.php';

try {
  if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    Response::methodNotAllowed();
  }

  if(!isset($_GET['PRODUTO'])) {
    Response::badRequest('ID do produto não informado');
  }

  $id = $_GET['PRODUTO'];

  $query = "SELECT * FROM he_produtos WHERE PRODUTO_ID = :id";
  $stmt = $Connection->prepare($query);
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->execute();

  if ($stmt->rowCount() > 0) {
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    Response::success($product, 'Produto encontrado');
  } else {
    Response::notFound('Produto não encontrado');
  }
} catch(\Exception $e) {
  Response::handleException($e);
}

?>
