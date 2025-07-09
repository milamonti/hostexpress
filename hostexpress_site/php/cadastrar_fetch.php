<div class="container my-4">
    <h2 class="mb-1 text-center text-dark fs-1 fw-bold" style="font-family: 'Montserrat', sans-serif;">Crie sua conta</h2>  
	<div class="d-flex flex-column">
		<form id="formCadastro" class="d-flex">
		  <div class="d-flex flex-column w-50 p-4">
			<h2 class="mb-4 text-center text-primary fs-4  fw-bold" style="font-family: 'Montserrat', sans-serif;">Informações para Acesso</h2>
			<hr>
			<div class="form-floating mb-3">
				<input type="text" class="form-control" id="nome" placeholder="Digite seu nome completo.."required>
			  	<label for="nome">Nome Completo</label>
			</div>
			<div class="form-floating mb-3">
				<input type="email" class="form-control" id="email" placeholder="Digite seu e-mail.." required>
			  	<label for="email">Email</label>
			</div>
			<div class="form-floating mb-3">
				<input type="password" class="form-control" id="senha" placeholder="&#xb7&#xb7&#xb7&#xb7&#xb7" required>
			  	<label for="senha">Senha</label>
			</div>
		  </div>
		  <div class="d-flex flex-column w-50 p-4">
			<h2 class="mb-4 text-center text-primary fs-4  fw-bold" style="font-family: 'Montserrat', sans-serif;">Informações Pessoais</h2>
			<hr>
			<div class="form-floating mb-3">
				<input type="text" class="form-control" id="celular" placeholder="Digite seu número de telefone.." required>
				<label for="celular">Celular</label>
			</div>
			<div class="form-floating position-relative mb-3">
				<input type="text" class="form-control pe-5" id="cep" placeholder="Digite o seu CEP.." required>
				<label for="cep">CEP</label>
				<i class="bi bi-search position-absolute top-50 end-0 translate-middle-y me-3" 
					style="cursor: pointer;">
				</i>
			</div>
			<input type="hidden" id="rua" required>
			<input type="hidden" id="bairro" required>
			<input type="hidden" id="cidade" required>
			<input type="hidden" id="estado" required>
			<div class="form-floating mb-3">
				<input type="text" class="form-control" id="num" placeholder="Digite o número da residência.." required>
				<label for="num">Número de Residência</label>
			</div>
			<div class="form-floating mb-3">
				<input type="text" class="form-control" id="complemento" placeholder="Digite quaisquer completmentos necessários..">
			  	<label for="complemento">Complemento</label>
			</div>
		  </div>
		  <div>
		</div>
		</form>
		<button type="button" id="cadastrar" class="btn btn-primary align-self-center px-4">Criar Conta</button>
	</div>
</div>

<div id="codigoModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="fecharModal()">&times;</span>
    <h2>Verificação de E-mail</h2>
    <p>Digite o código de confirmação enviado para seu e-mail:</p>
    <input type="text" id="codigoInput" class="form-control text-center" placeholder="Ex: 123456" />
    <div id="erroCodigo" style="color:red; margin-top: 10px;"></div>
    <br/>
    <button onclick="enviarCodigo()" class="btn btn-primary">Confirmar Código</button>
  </div>
</div>

<script type="module" src="./js/cadastrausuario.js?a=<?php echo microtime(); ?>"></script>