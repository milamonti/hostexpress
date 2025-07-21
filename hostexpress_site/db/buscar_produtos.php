<?php 

ini_set('display_errors',1);
error_reporting(E_ALL);

include_once('../conexao.php');

$Conexao = Conexao::conectar();

$BUSCA = $_GET['NOME'];

$QUERY = <<<SQL
    SELECT DESCRICAO 
    FROM he_produtos
    WHERE DESCRICAO LIKE :BUSCA;
SQL;

$BUSCA = '%' . $BUSCA . '%';
$stm = $db->prepare($QUERY);
$stm->bindParam(':BUSCA',$BUSCA, PDO::PARAM_STR);
$stm->execute();
$response = $stm->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($response);

header('Content-Type: application/json;charset=utf-8');