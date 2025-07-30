<?php

class Upload {
  private $uploadDir;

  public function __construct($uploadDir = 'uploads') {
      $this->uploadDir = rtrim($uploadDir, '/');
      if (!is_dir($this->uploadDir)) {
          mkdir($this->uploadDir, 0755, true);
      }
  }

  public function uploadPhoto($productId, $file) {
      // Verifica se foi feito upload
      if (!isset($file['tmp_name']) || !is_uploaded_file($file['tmp_name'])) {
          throw new Exception("Arquivo inválido.");
      }

      $productDir = "{$this->uploadDir}/{$productId}";
      if (!is_dir($productDir)) {
          mkdir($productDir, 0755, true);
      }

      $filename = basename($file['name']);
      $targetPath = "{$productDir}/{$filename}";

      if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
          throw new Exception("Falha ao mover o arquivo.");
      }

      return $targetPath;
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
