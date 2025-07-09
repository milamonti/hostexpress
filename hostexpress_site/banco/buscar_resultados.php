<?php 
ini_set('display_errors',1);
error_reporting(E_ALL);

include_once '../conexao.php';
$Conexao = new Conexao();
$pdo = $Conexao->conectar();

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
$stm = $pdo->prepare($QUERY);
$stm->execute([$busca, $busca]);
$response = $stm->fetchAll(PDO::FETCH_ASSOC);
exit(json_encode($response));
header('Content-Type:application/json;charset=utf-8');
