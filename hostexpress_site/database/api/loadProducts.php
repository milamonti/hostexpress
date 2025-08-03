<?php

require_once '../config/config.php';
include_once MODULES . '/responseManager.php';
include_once ROOT . '/conexao.php';
$conexao = Conexao::conectar();

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
catch(PDOException $e){
  Response::internalError($e->getMessage());
} catch(Exception $e) {
  Response::sendJson($e->getCode(), $e->getMessage());
}
