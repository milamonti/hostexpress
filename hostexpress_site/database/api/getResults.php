<?php 

require_once '../config/config.php';
require_once MODULES . '/responseManager.php';
include_once ROOT . '/conexao.php';
$Conexao = Conexao::conectar();

try {
  $busca = '%' . $_GET['busca'] . '%';
  
  $QUERY = <<<SQL
    SELECT PRODUTO_ID AS id, DESCRICAO AS nome
    FROM he_produtos
    WHERE DESCRICAO LIKE ?
    UNION
    SELECT EMPRESA_ID AS id, NOME_FANTASIA AS nome
    FROM he_empresas
    WHERE NOME_FANTASIA LIKE ?;
  SQL;
  $stm = $Conexao->prepare($QUERY);
  $stm->execute([$busca, $busca]);
  $response = $stm->fetchAll(PDO::FETCH_ASSOC);
  Response::success($response);
} catch (\Exception $e) {
  Response::handleException($e);
}
