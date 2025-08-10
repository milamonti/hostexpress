<?php

require_once dirname(__DIR__, 1) . '/config/config.php';
include_once modules . '/responseManager.php';
include_once root . '/conexao.php';
$conexao = Conexao::conectar();

if($_SERVER['REQUEST_METHOD'] !== "GET"){
  Response::methodNotAllowed();
}

try{
  $QUERY = <<<SQL
    SELECT DESCRICAO, PRECO_UN, PRODUTO_ID, FOTO_PRODUTO
    FROM he_produtos
  SQL;
  $stm = $conexao->prepare($QUERY);
  $stm->execute();
  $products = $stm->fetchAll(PDO::FETCH_ASSOC);
  Response::success($products);
}
catch(\Exception $e){
  Response::handleException($e);
}
