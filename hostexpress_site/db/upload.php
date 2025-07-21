<?php

include_once '../conexao.php';
require_once './modules/productManager.php';
require_once './modules/shopManager.php';
require_once './modules/responseManager.php';

$Conexao = Conexao::conectar();

try {
    if (!isset($_FILES['image']) && $_FILES['image']['error'] !== 0) {
        Response::badRequest('Nenhum arquivo foi enviado.');
    } 

    $arquivo_tmp = $_FILES['image']['tmp_name'];
    $name = basename($_FILES['image']['name']);
    $folder = "images/";

    // Verifica se é uma imagem válida
    $extension = strtolower(pathinfo($name, PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png', 'webp'];

    if (!in_array($extensao, $permitidas)) {
        Response::badRequest('Formato de arquivo não permitido. Use JPG, JPEG, PNG ou WEPB.');    
    }

    $destiny = $folder . $name;
    
    if (move_uploaded_file($arquivo_tmp, $destiny)) {
        Response::success();
    } else {
        Response::internalError('Erro ao enviar o arquivo');
    }
} catch (\PDOException $e) {
    Response::sqlError($e);
} catch(Exception $e){
    Response::sendJson($e->getCode(), $e->getMessage());
}
?>