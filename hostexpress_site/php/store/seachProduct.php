<?php

require_once dirname(__DIR__, 2) . '/config/config.php';
require_once ROOT . '/database/modules/responseManager.php';
include_once ROOT . '/conexao.php';
$Conexao = Conexao::conectar();

if($_SERVER['REQUEST_METHOD'] != "GET"){
  Response::methodNotAllowed();
}

if(!$_GET || !$_GET['id']) {
  Response::badRequest('Parâmetros não enviados');
}

$id = $_GET['id'] ?? null;

try {
  if (empty($id) || is_null($id)) {
    Response::badRequest('ID do produto não informado');
  }
   
  $query = "SELECT * FROM he_produtos WHERE PRODUTO_ID = :id";
  $stmt = $Conexao->prepare($query);
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->execute();

  if ($stmt->rowCount() > 0) {
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
  } else {
    Response::notFound([], 'Produto não encontrado');
  }
} catch (PDOException $e) {
  Response::internalError($e->getMessage());
} catch (Exception $e) {
  Response::sendJson($e->getCode(), $e->getMessage());
}

?>


