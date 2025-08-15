<?php 

require_once dirname(__DIR__, 1 ) . '/config/config.php';
require_once modules . '/responseManager.php';
include_once root . '/conexao.php';
$Connection = Connection::connect();

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
  $stm = $Connection->prepare($QUERY);
  $stm->execute([$busca, $busca]);
  $response = $stm->fetchAll(PDO::FETCH_ASSOC);
  Response::success($response);
} catch (\Exception $e) {
  Response::handleException($e);
}
