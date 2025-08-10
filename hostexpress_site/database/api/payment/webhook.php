<?php

require_once root . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(root);
$dotenv->load();

// Recebe os dados enviados pelo Mercado Pago
$input = file_get_contents("php://input");
$data = json_decode($input, true);

// Verifica o tipo de notificação (pagamento)
if ($data["type"] === "payment") {
  $payment_id = $data["data"]["id"];

  // Consulta detalhes do pagamento
  $access_token = getenv('accessToken');
  $url = "https://api.mercadopago.com/v1/payments/$payment_id";

  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer $access_token"
  ]);
  $response = curl_exec($ch);
  curl_close($ch);

  $payment_info = json_decode($response, true);

  $status = $payment_info["status"]; // approved, rejected, pending, etc.
  $email = $payment_info["payer"]["email"];
  $amount = $payment_info["transaction_amount"];

}

?>