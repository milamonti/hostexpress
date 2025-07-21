<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

include_once '../conexao.php';
require_once './modules/responseManager.php';
require_once './modules/clientManager.php';

$Conexao = Conexao::conectar();

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

$EMAIL = strtolower($_POST['EMAIL']);
$SENHA = trim($_POST['SENHA']);

$QUERY = <<<SQL
    SELECT NAME, PASSWORD, TYPE
    FROM he_users
    WHERE USER = :EMAIL
SQL;
$stm = $Conexao->prepare($QUERY);
$stm->bindParam(':EMAIL', $EMAIL, PDO::PARAM_STR);
$stm->execute();
$response = $stm->fetch(PDO::FETCH_ASSOC);

if(!$response){
    exit(json_encode([
        'status' => false, 
        'error' => 'Usuário não encontrado!'
    ]));
}

if(password_verify($SENHA,$response['PASSWORD'])){
    echo json_encode([
        'status' => true,
        'type' => $response['TYPE']
    ]);
    $_SESSION['USUARIO'] = $response['NAME'];
    $_SESSION['EMAIL'] = $EMAIL;
    $_SESSION['TYPE'] = $response['TYPE'];

}
else{
    echo json_encode(['status' => false]);
}

header('Content-Type: application/json;charset=utf-8');
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
