<?php
require 'config.php';

// Exemplo: um cliente compra de 2 vendedores
$itens = [
  [
    "reference_id" => "item1",
    "name" => "Produto Vendedor 1",
    "quantity" => 1,
    "unit_amount" => 5000 // em centavos
  ],
  [
    "reference_id" => "item2",
    "name" => "Produto Vendedor 2",
    "quantity" => 2,
    "unit_amount" => 3000
  ]
];

$split = [
  [
    "receiver" => "ID_VENDEDOR_1",
    "amount" => [
      "value" => 5000,
      "currency" => "BRL"
    ]
  ],
  [
    "receiver" => "ID_VENDEDOR_2",
    "amount" => [
      "value" => 6000,
      "currency" => "BRL"
    ]
  ],
  [
    "receiver" => "ID_MARKETPLACE",
    "amount" => [
      "value" => 2000,
      "currency" => "BRL"
    ]
  ]
];

$data = [
  "reference_id" => "pedido123",
  "customer" => [
    "name" => "Cliente Teste",
    "email" => "comprador@sandbox.pagseguro.com.br"
  ],
  "items" => $itens,
  "charges" => [[
    "reference_id" => "cob1",
    "description" => "Pagamento Marketplace",
    "amount" => [
      "value" => 13000,
      "currency" => "BRL"
    ],
    "payment_method" => [
      "type" => "CREDIT_CARD",
      "installments" => 1,
      "capture" => true,
      "card" => [
        "number" => "4111111111111111",
        "exp_month" => "12",
        "exp_year" => "2030",
        "security_code" => "123",
        "holder" => [
          "name" => "Cliente Teste"
        ]
      ]
    ],
    "split" => $split
  ]]
];

$ch = curl_init("$PAGSEGURO_API_BASE/orders");
curl_setopt_array($ch, [
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_POST => true,
  CURLOPT_HTTPHEADER => [
    "Content-Type: application/json",
    "Authorization: Bearer SEU_ACCESS_TOKEN_MARKETPLACE"
  ],
  CURLOPT_POSTFIELDS => json_encode($data)
]);

$response = json_decode(curl_exec($ch), true);
curl_close($ch);

print_r($response);

?>
