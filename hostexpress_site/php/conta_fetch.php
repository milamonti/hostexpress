<div class="d-flex justify-content-center align-items-center">
  	<form class="w-100 d-flex flex-column align-items-center">
      	<h5 class="fw-bold mt-3">Minha Conta</h5>

    	<!-- Botões de Navegação -->
		<div class="button-container"> 
			<button type="button" class="btn btn-primary btn-custom" data-bs-toggle="collapse" data-bs-target="#pedidosHistorico" onclick="toggleCollapse('pedidosHistorico')"> Histórico de Pedidos </button> 
			<button type="button" class="btn btn-primary btn-custom" data-bs-toggle="collapse" data-bs-target="#enderecosCadastro" onclick="toggleCollapse('enderecosCadastro')"> Meus Endereços </button> 
			<button type="button" class="btn btn-primary btn-custom" data-bs-toggle="collapse" data-bs-target="#detalhesConta" onclick="toggleCollapse('detalhesConta')"> Detalhes da Conta </button> 
			<button type="button" class="btn btn-primary btn-custom" data-bs-toggle="collapse" data-bs-target="#comunicacaoPreferencias" onclick="toggleCollapse('comunicacaoPreferencias')"> Preferências de Notificação </button> 
		</div>
  	</form>
</div>

<!-- Seções de Informação -->
<div class="container mt-3">
  	<div class="collapse" id="pedidos">
    	<div class="card p-3">
      		<h5 class="mb-2 fw-bold text-primary">Histórico de Pedidos</h5>
      		<p>Você ainda não fez nenhum pedido.</p>
    	</div>
  	</div>

  <div class="collapse" id="endereco">
    <div class="card p-3">
		<h5 class="mb-2 fw-bold text-primary">Meu Endereço</h5>
		<p>Você ainda não cadastrou nenhum endereço.</p>
    </div>
  </div>

  <div class="collapse" id="detalhes">
    <div class="card p-3">
      <h5 class="mb-2 fw-bold text-primary">Detalhes da Conta</h5>
      <div class="mb-2 d-flex justify-content-between">
        <span><i class="bi bi-person-circle"></i> Nome:</span>
        <span class="fw-semibold">null</span>
      </div>
      <div class="mb-2 d-flex justify-content-between">
        <span><i class="bi bi-envelope"></i> E-mail:</span>
        <span class="fw-semibold">null</span>
      </div>
      <div class="mb-2 d-flex justify-content-between">
        <span><i class="bi bi-phone"></i> Telefone:</span>
        <span class="fw-semibold">null</span>
      </div>
    </div>
  </div>

  <div class="collapse" id="comunicacaoPreferencias">
    <div class="card p-3">
      <h5 class="mb-2 fw-bold text-primary">Preferências de Notificação</h5>
      <p>Aqui você pode ajustar suas preferências de comunicação, como e-mails, notificações, etc.</p>
    </div>
  </div>
</div>

<script type="module" src="./js/conta.js?a=<?php echo microtime() ?>"></script>

