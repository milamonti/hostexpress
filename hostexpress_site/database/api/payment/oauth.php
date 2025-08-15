<?php
require_once 'config.php';

// Passo 1 – Redirecionar vendedor para autorizar
$authUrl = "https://connect.pagseguro.com/oauth2/authorize?" . http_build_query([
  'response_type' => 'code',
  'client_id' => pagseguro_app_id,
  'redirect_uri' => 'https://hostexpress.ct.ws./oauth.php'
]);

if (!isset($_GET['code'])) {
  header("Location: $authUrl");
  exit;
}

// Passo 2 – Trocar code por access token
$code = $_GET['code'];

$ch = curl_init("https://connect.pagseguro.com/oauth2/token");
curl_setopt_array($ch, [
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_POST => true,
  CURLOPT_HTTPHEADER => ['Content-Type: application/x-www-form-urlencoded'],
  CURLOPT_POSTFIELDS => http_build_query([
    'grant_type' => 'authorization_code',
    'code' => $code,
    'redirect_uri' => 'https://SEUSITE.com/oauth.php',
    'client_id' => pagseguro_app_id,
    'client_secret' => pagseguro_app_key
  ])
]);
$response = json_decode(curl_exec($ch), true);
curl_close($ch);

// Salvar access_token do vendedor no banco
$enterpriseToken = $response['access_token'];
$enterpriseId = $response['account_id'];

?>
