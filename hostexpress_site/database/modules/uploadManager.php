<?php

require_once __DIR__ . '/../config/config.php';
include_once root . '/database/modules/responseManager.php';
include_once root . '/database/modules/shopManager.php';


class Upload {
  private $uploadDir;

  public function __construct($uploadDir = 'uploads') {
    $this->uploadDir = rtrim($uploadDir, '/');
    if (!is_dir($this->uploadDir)) {
      mkdir($this->uploadDir, 0755, true);
    }
  }

  public static function uploadPhoto($id) {
    try {
      if (!isset($_FILES['photo']) && $_FILES['photo']['error'] !== 0) {
        Response::badRequest('Nenhum arquivo foi enviado.');
      } 

      $arquivo_tmp = $_FILES['photo']['tmp_name'];
      $folder = root . "/images/products/";
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
        Response::internalError('Erro ao enviar o arquivo.');
      }
    } catch (PDOException $e) {
      Response::internalError($e->getMessage());
    } catch(Exception $e){
      Response::sendJson($e->getCode(), $e->getMessage());
    }
  }

  public function getPhotos($productId) {
      $productDir = "{$this->uploadDir}/{$productId}";

      if (!is_dir($productDir)) {
          return [];
      }

      $files = array_diff(scandir($productDir), ['.', '..']);
      $paths = [];

      foreach ($files as $file) {
          $paths[] = "{$productDir}/{$file}";
      }

      return $paths;
  }

  public function deletePhoto($productId, $filename) {
      $filePath = "{$this->uploadDir}/{$productId}/{$filename}";
      if (file_exists($filePath)) {
          return unlink($filePath);
      }
      return false;
  }
}
