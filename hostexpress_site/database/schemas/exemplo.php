<?php

// Lê o schema SQL com placeholders
$sql = file_get_contents(__DIR__ . '/schemas/insert_produto.sql');

// Prepara o statement
$stmt = $pdo->prepare($sql);

// Dados do produto
$dados = [
  'nome' => 'Jaqueta Jeans',
  'descricao' => 'Jaqueta jeans forrada unissex',
  'preco' => 159.90,
  'estoque' => 8
];

// Executa com os dados
$stmt->execute($dados);

?>