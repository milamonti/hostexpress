<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

include_once $_SERVER['DOCUMENT_ROOT'] . '/conexao.php';
$Conexao = Conexao::conectar();

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

$EMAIL = $_POST['EMAIL'];
$SENHA = $_POST['SENHA'];

$QUERY = "
    SELECT SENHA, NOME
    FROM HE_CLIENTES
    WHERE EMAIL = :EMAIL
";
$stm = $Conexao->prepare($QUERY);
$stm->bindParam(':EMAIL', $SENHA, PDO::PARAM_STR);
$stm->execute();
$response = $stm->fetch(PDO::FETCH_ASSOC);

if(!$response){
    echo 'Usuário não encontrado!';
}

if(password_verify($SENHA,$response['SENHA'])){
    echo json_encode(['status' => true]);
    $_SESSION['USUARIO'] = $response['NOME'];
}
else{
    echo json_encode(['status' => false]);
}

header('Content-Type: application/json;charset=utf-8');