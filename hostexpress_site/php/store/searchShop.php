<?php

require_once dirname(__DIR__, 2) . '/config/config.php';
require_once modules . '/responseManager.php';
require_once modules . '/shopManager.php';

if($_SERVER['REQUEST_METHOD'] != "GET"){
  Response::methodNotAllowed();
}

if(!$_GET || !$_GET['id']) {
  Response::badRequest('Parâmetros não enviados');
}

$id = $_GET['id'] ?? null;

try {
  if(!isset($id)) {
    Response::badRequest('ID da loja não informado');
  }
   
  $query = "SELECT * FROM he_empresa WHERE EMPRESA_ID = :id";
  $stmt = $Conexao->prepare($query);
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->execute();

  if ($stmt->rowCount() > 0) {
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
  } else {
    Response::notFound('Empresa não encontrada');
  }
} catch (\Exception $e) {
  Response::handleException($e);
}

?>