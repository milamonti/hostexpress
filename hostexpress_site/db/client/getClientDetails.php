<?php 

include_once '../../conexao.php';
require_once '../modules/responseManager.php';
require_once '../modules/clientManager.php';

$Conexao = Conexao::conectar();

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

try {
    if (!isset($_SESSION['EMAIL'])) {
        Response::unauthorized('Usuário não autenticado');
        exit;
    }

    Client::getClientByEmail($_SESSION['EMAIL']);
} catch (PDOException $e) {
    Response::sqlError($e);
} catch (Exception $e) {
    Response::sendJson($e->getCode(), 'Erro ao buscar detalhes do cliente: ' . $e->getMessage());
}

?>