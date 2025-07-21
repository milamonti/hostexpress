<?php 

include_once $_SERVER['DOCUMENT_ROOT'] . '/hostexpress_site/conexao.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/hostexpress_site/db/modules/responseManager.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/hostexpress_site/db/modules/clientManager.php';
$Conexao = Conexao::conectar();

try {
    if (!isset($_POST)){
        Response::badRequest('Dados não informados');
        exit;
    }

    Client::registerClient($_POST);
} catch (\PDOException $e) {
    Response::sqlError($e);
} catch (\Exception $e) {
    Response::sendJson($e->getCode(), 'Erro ao registrar cliente: ' . $e->getMessage());
}

?>