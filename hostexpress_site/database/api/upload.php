<?php

require_once '../config/config.php';
require_once ROOT . '/database/modules/shopManager.php';
require_once ROOT . '/database/modules/responseManager.php';

try {
  $id = $_POST['id'];
  if (!isset($_FILES['photo']) && $_FILES['photo']['error'] !== 0) {
    Response::badRequest('Nenhum arquivo foi enviado.');
  } 

  $arquivo_tmp = $_FILES['photo']['tmp_name'];
  $folder = ROOT . "/images/products/";
  //pega a extensão do arquivo
  $extension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);

  // Verifica se é uma imagem válida
  $allowed = ['jpg', 'jpeg', 'png', 'webp'];

  if (!in_array($extension, $allowed)) {
    Response::badRequest('Formato de arquivo não permitido. Use JPG, JPEG, PNG ou WEPB.');    
  }

  // Gera o nome novo com base no id do produto
  $newName = 'photo' . '_' . $id . '.' . strtolower($extension);
  $destiny = $folder . $newName;
    
  if (move_uploaded_file($arquivo_tmp, $destiny)) {
    Shop::updateProductPhoto($newName, $id);
    Response::success([], 'Upload realizado com successo');
  } else {
    Response::internalError('Erro ao enviar o arquivo: ' . $e->getMessage());
  }
} catch (PDOException $e) {
  Response::internalError($e->getMessage());
} catch(Exception $e){
  Response::sendJson($e->getCode(), $e->getMessage());
}
?>