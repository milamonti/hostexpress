<?php 

require __DIR__ . '/../config/config.php';
require_once ROOT . '/database/modules/responseManager.php';
require_once ROOT . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(ROOT);
$dotenv->load();

class Payment {
  private string $accessToken;
  
  public function __construct() {
    $this->$accessToken = getenv('accessToken');
  }

  private function paymentConfig(string $method, string $body) :array
  {
    if(!$method) return [];

    if($method === "card") {
      return [
        "transaction_amount" => 100,
        "token" => $body["token"],
        "description" => "Pagamento com Cartão",
        "installments" => $body["installments"],
        "payment_method_id" => $body["payment_method_id"],
        "issuer_id" => $body["issuer_id"],
        "payer" => [
          "email" => $body["payer"]["email"]
        ]
      ];
    } else if($method === "pix") {
      return [
        "transaction_amount" => 100,
        "payment_method_id" => "pix",
        "description" => "Pagamento com Pix",
        "payer" => [
          "email" => $body["payer"]["email"]
        ]
      ];
    }
  }

  public function processPayment(string $body, string $method) :void
  {
    if(!$body){
      Response::badRequest('Corpo do pagamento não fornecido!');
    }

    try {
      $ch = curl_init("https://api.mercadopago.com/v1/payments");
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($this->paymentConfig($method, $body)));
      curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer $this->$accessToken",
        "Content-Type: application/json"
      ]);
  
      $response = curl_exec($ch);
      $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
      curl_close($ch);
  
      Response::sendJson($http_code, 'Informações do pagamento geradas com sucesso', $response);
    } catch (\Exception $e) {
      Response::handleException($e);
    }
  }
}