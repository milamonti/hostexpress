<?php 

include_once $_SERVER['DOCUMENT_ROOT'] . '/hostexpress_site/conexao.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/hostexpress_site/db/modules/responseManager.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/hostexpress_site/db/modules/clientManager.php';
$Conexao = Conexao::conectar();

try {
    if (!isset($_POST)){
        Response::badRequest('Dados não informados');
    }

    if($_SERVER['REQUEST_METHOD'] !== 'POST') {
        Response::methodNotAllowed();
    }

    Client::registerClient($_POST);
} catch (\PDOException $e) {
    Response::internalError($e->getMessage());
} catch (\Exception $e) {
    Response::sendJson($e->getCode(), 'Erro ao registrar cliente: ' . $e->getMessage());
}

?>