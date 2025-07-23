<?php 

require_once '../modules/responseManager.php';
require_once '../modules/clientManager.php';

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
    Response::internalError($e->getMessage());
} catch (Exception $e) {
    Response::sendJson($e->getCode(), 'Erro ao buscar detalhes do cliente: ' . $e->getMessage());
}

?>