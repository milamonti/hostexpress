<div class="d-flex justify-content-between align-items-start">
    <div class="container mt-3 d-flex flex-column align-items-center">
        <h1 class="text-primary">Carrinho de Compras</h1>
        <p class="text-secondary">Confira os produtos selecionados e finalize sua compra.</p>
        <div id="products" class="row w-100">
            <!-- Products will be dynamically inserted here -->
        </div>
    </div>
    <div class="card shadow-sm p-3 mb-5 bg-body rounded col-md-6 mt-3">
        <h5 class="mb-3 fw-bold text-primary">Resumo da Cotação</h5>
        <div class="mb-2 d-flex justify-content-between">
            <span>Valor dos produtos</span>
            <span class="fw-semibold"></span>
        </div>
        <div class="mb-2 d-flex justify-content-between">
            <span>Total do Frete</span>
            <span class="fw-semibold text-success"></span>
        </div>
        <div class="mb-2 d-flex justify-content-between">
            <span>Prazo de entrega</span>
            <span class="fw-semibold"></span>
        </div>
        <hr>
        <div class="mb-2 d-flex justify-content-between">
            <strong>Valor Total</strong>
            <strong class="text-success" id="fullPrice"></strong>
        </div>
        <button type="button" class="btn btn-success">Finalizar compra</button>
    </div>
</div>

<script type="module" src="./js/client/cart.js?a=<?php echo microtime(true) ?>"></script>