<?php
header('Content-Type: application/json; charset=utf-8');
ini_set('display_errors', 1);
error_reporting(E_ALL);

include_once('../conexao.php');

try {
    $Conexao = new Conexao();
    $pdo = $Conexao->conectar(); 

    if (!isset($_REQUEST['PRODUTO']) || !is_numeric($_REQUEST['PRODUTO'])) {
        http_response_code(400);
        echo json_encode(['erro' => 'Parâmetro PRODUTO inválido ou não fornecido.']);
        exit;
    }

    $PRODUTO = (int) $_REQUEST['PRODUTO'];

    $QUERY = <<<SQL
        SELECT DESCRICAO, CATEGORIA,
               UNIDADE, QTD, PRECO_UN, PRODUTO_ID
        FROM he_produtos
        WHERE PRODUTO_ID = :PRODUTO
    SQL;

    $stm = $pdo->prepare($QUERY);
    $stm->bindParam(':PRODUTO', $PRODUTO, PDO::PARAM_STR);
    $stm->execute();
    $response = $stm->fetch(PDO::FETCH_ASSOC);
    echo json_encode($response);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['erro' => $e->getMessage()]);
    exit;
}
