<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Ordem de Pedidos</title>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body class="bg-light">

<div class="container my-4">
  <div class="card shadow-sm">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Pedidos</h5>
      <button id="refreshOrders" class="btn btn-light btn-sm">
        <i class="bi bi-arrow-repeat"></i> Atualizar
      </button>
    </div>
    <div class="card-body">
      <table class="table table-striped w-100" id="ordersTable">
        <thead>
          <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Itens</th>
            <th>Total (R$)</th>
            <th>Status</th>
            <th>Criado em</th>
            <th>Ações</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>

<!-- Modal para exibir itens -->
<div class="modal fade" id="modalOrderItems" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Itens do Pedido</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body" id="orderItemsContainer">
        <!-- Conteúdo dinâmico -->
      </div>
    </div>
  </div>
</div>

<script type="module" src="./js/shop/pages/orders.js?a=<?php echo microtime(); ?>"></script>