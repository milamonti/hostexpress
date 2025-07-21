<?php
header('Content-Type:application/json;charset=utf-8');

ini_set('display_errors',1);
error_reporting(E_ALL);

include_once('../conexao.php');

$conexao = Conexao::conectar();

try{
    $QUERY = <<<SQL
        SELECT DESCRICAO, PRECO_UN, PRODUTO_ID
        FROM he_produtos
    SQL;
    
    $stm = $conexao->prepare($QUERY);
    $stm->execute();
    $response = $stm->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($response);
}
catch(\Exception $e){
    echo json_encode(['status' => false, 'message' => $e->getMessage()]);
}
