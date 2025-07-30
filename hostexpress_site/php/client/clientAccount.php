<div class="d-flex justify-content-center align-items-center">
  	<form class="w-100 d-flex flex-column align-items-center">
      	<h5 class="fw-bold mt-3">Minha Conta</h5>

    	<!-- Botões de Navegação -->
		<div class="button-container"> 
			<button type="button" class="btn btn-primary btn-custom" data-bs-toggle="collapse" data-bs-target="#orders" > Histórico de Pedidos </button> 
			<button type="button" class="btn btn-primary btn-custom" data-bs-toggle="collapse" data-bs-target="#address"> Meus Endereços </button> 
			<button type="button" class="btn btn-primary btn-custom" data-bs-toggle="collapse" data-bs-target="#details"> Detalhes da Conta </button> 
			<button type="button" class="btn btn-primary btn-custom" data-bs-toggle="collapse" data-bs-target="#communication"> Preferências de Notificação </button> 
		</div>
  	</form>
</div>

<!-- Seções de Informação -->
<div class="container mt-3">
  	<div class="collapse" id="orders">
    	<div class="card p-3">
      		<h5 class="mb-2 fw-bold text-primary">Histórico de Pedidos</h5>
      		<p>Você ainda não fez nenhum pedido.</p>
    	</div>
  	</div>

  <div class="collapse" id="address">
    <div class="card p-3">
		  <h5 class="mb-2 fw-bold text-primary">Meu Endereço</h5>
      <span class="fw-semibold" id="endereco"></span>
      <span class="fw-semibold" id="complements"></span>
    </div>
  </div>

  <div class="collapse" id="details">
    <div class="card p-3">
      <h5 class="mb-2 fw-bold text-primary">Detalhes da Conta</h5>
      <div class="mb-2 d-flex justify-content-between">
        <span><i class="bi bi-person-circle"></i> Nome:</span>
        <span id="name" class="fw-semibold"></span>
      </div>
      <div class="mb-2 d-flex justify-content-between">
        <span><i class="bi bi-envelope"></i> E-mail:</span>
        <span id="email" class="fw-semibold"></span>
      </div>
      <div class="mb-2 d-flex justify-content-between">
        <span><i class="bi bi-phone"></i> Telefone:</span>
        <span id="telefone" class="fw-semibold"></span>
      </div>
    </div>
  </div>

  <div class="collapse" id="communication">
    <div class="card p-3">
      <h5 class="mb-2 fw-bold text-primary">Preferências de Notificação</h5>
      <p>Aqui você pode ajustar suas preferências de comunicação, como e-mails, notificações, etc.</p>
    </div>
  </div>
</div>

<script type="module" src="./js/client/clientAccount.js?a=<?php echo microtime() ?>"></script>

