<?php 

require_once '../config/config.php';
include_once ROOT . '/conexao.php';
$Conexao = Conexao::conectar();

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
exit(json_encode($response));
header('Content-Type:application/json;charset=utf-8');
