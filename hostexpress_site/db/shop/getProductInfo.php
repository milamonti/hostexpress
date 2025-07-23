<?php

require_once '../modules/responseManager.php';
require_once '../modules/shopManager.php';

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
        Response::methodNotAllowed();
    }

    if(!isset($_GET['product_id']) || empty($_GET['product_id'])) {
        Response::badRequest('ID do produto não informado');
    }

    Shop::getProductInfo($_GET['PRODUTO']);
} catch (PDOException $e) {
    Response::internalError($e->getMessage());
} catch(Exception $e) {
    Response::sendJson($e->getCode(), 'Erro ao obter informações do produto: ' . $e->getMessage());
}

?>