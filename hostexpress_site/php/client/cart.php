<div class="d-flex justify-content-between align-items-start container mt-4">
  <div class="w-100 me-4">
    <h1 class="text-primary text-center">Carrinho de Compras</h1>
    <p class="text-secondary text-center">Confira os produtos selecionados e finalize sua compra.</p>
    <!-- Produtos -->
    <div class="card p-4 shadow-sm mb-4">
      <h4 class="mb-3 text-primary">Produtos Selecionados</h4>
      <ul class="list-group mb-3" id="product-list"></ul>
      <div class="text-end pe-2">
        <h5 class="text-dark fw-bold" id="total-produtos">Total: R$ 0,00</h5>
        <p class="text-muted mb-0">Frete: <strong>Indefinido</strong></p>
      </div>
    </div>

    <!-- Formulário de entrega -->
    <div class="card p-4 shadow-sm">
      <h4 class="mb-4 text-primary">Informações de Entrega</h4>
      <form>
        <div class="row g-3">
          <div class="col-md-6">
            <div class="form-floating">
              <input type="text" class="form-control" id="nome" placeholder="Nome completo" required>
              <label for="nome">Nome completo</label>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-floating">
              <input type="tel" class="form-control" id="telefone" placeholder="(00) 00000-0000" required>
              <label for="telefone">Telefone</label>
            </div>
          </div>
          <div class="col-md-8">
            <div class="form-floating">
              <input type="text" class="form-control" id="endereco" placeholder="Endereço ou CEP" required>
              <label for="endereco">Endereço ou CEP</label>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-floating">
              <input type="text" class="form-control" id="numero" placeholder="Número" required>
              <label for="numero">Número</label>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-check ps-2">
              <input class="form-check-input" type="checkbox" id="sem_numero">
              <label class="form-check-label" for="sem_numero">
                Endereço sem número
              </label>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-floating">
              <input type="text" class="form-control" id="complemento" placeholder="Complemento">
              <label for="complemento">Complemento</label>
            </div>
          </div>
        </div>
        <div class="text-end mt-4">
          <button type="submit" class="btn btn-success px-4">Finalizar Pedido</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Resumo da Cotação -->
  <div class="card shadow-sm p-3 mb-5 bg-body rounded col-md-4">
    <h5 class="mb-3 fw-bold text-primary">Resumo da Cotação</h5>
    <div class="mb-2 d-flex justify-content-between">
      <span>Valor dos produtos</span>
      <span class="fw-semibold" id="resumo-valor-produtos">R$ 0,00</span>
    </div>
    <div class="mb-2 d-flex justify-content-between">
      <span>Total do Frete</span>
      <span class="fw-semibold text-success">Indefinido</span>
    </div>
    <div class="mb-2 d-flex justify-content-between">
      <span>Prazo de entrega</span>
      <span class="fw-semibold">---</span>
    </div>
    <hr>
    <div class="mb-2 d-flex justify-content-between">
      <strong>Valor Total</strong>
      <strong class="text-success" id="fullPrice">R$ 0,00</strong>
    </div>
    <button type="submit" class="btn btn-success w-100 mt-2">Finalizar compra</button>
  </div>

</div>

<script type="module" src="./js/client/cart.js?a=<?php echo microtime(true) ?>"></script>