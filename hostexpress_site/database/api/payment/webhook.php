<?php

require_once root . '/vendor/autoload.php';

// Recebe notificações do PagSeguro
$payload = file_get_contents('php://input');
$data = json_decode($payload, true);

// Atualiza o status do pedido no banco
file_put_contents('notificacoes.log', date('Y-m-d H:i:s') . " - " . $payload . PHP_EOL, FILE_APPEND);

// Retorna 200 OK
http_response_code(200);

?>