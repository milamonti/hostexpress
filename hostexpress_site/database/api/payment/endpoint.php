<?php

header('Content-Type: application/json');
require_once dirname(__DIR__, 2) . '/config/config.php';
require_once root . '/vendor/autoload.php';

$key = $_ENV['publicKey'];

$response = [
  "public_key" => $key,
  "created_at" => time()
];

echo json_encode($response);

?>
