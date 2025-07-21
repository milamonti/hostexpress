<div class="container my-4">
    <h2 class="mb-1 text-center text-dark fs-1 fw-bold" style="font-family: 'Montserrat', sans-serif;">Crie sua conta</h2>
	<div class="d-flex justify-content-center gap-3 mt-3">
		<div class="form-check">
			<input class="form-check-input" type="radio" name="account-type" id="client" checked>
			<label class="form-check-label" for="client">
				Cliente
			</label>
		</div>	
		<div class="form-check">
			<input class="form-check-input" type="radio" name="account-type" id="shop">
			<label class="form-check-label" for="shop">
				Fornecedor
			</label>
		</div>
	</div>
	<div class="d-flex flex-column display">
		<form id="clientForm" class="d-flex">
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
				<div class="form-floating position-relative">
					<input type="password" class="form-control pe-5" id="senha" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" required>
					<label for="senha">Senha</label>
					<i class="bi bi-eye position-absolute top-50 end-0 translate-middle-y me-3" 
						id="icone" style="cursor: pointer;">
					</i>
				</div>
		  	</div>
		  	<div class="d-flex flex-column w-50 p-4">
				<h2 class="mb-4 text-center text-primary fs-4  fw-bold" style="font-family: 'Montserrat', sans-serif;">Informações Pessoais</h2>
				<hr>
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="telefone" placeholder="Digite seu telefone" required>
					<label for="celular">Telefone</label>
				</div>
				<div class="form-floating position-relative mb-3">
					<input type="text" class="form-control pe-5" id="cep" placeholder="Digite seu CEP" required>
					<label for="cep">CEP</label>
					<i id="searchcep" class="bi bi-search position-absolute top-50 end-0 translate-middle-y me-3" 
						style="cursor: pointer;">
					</i>
				</div>
				<input type="hidden" id="endereco" required>
				<input type="hidden" id="bairro" required>
				<input type="hidden" id="cidade" required>
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="endereco_num" placeholder="Digite o número do endereço" required>
					<label for="endereco_num">Número</label>
				</div>
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="complemento" placeholder="Digite os complementos caso necessário">
					<label for="complemento">Complemento</label>
				</div>
				<div class="d-none" id="shopInfo">
					<div class="form-floating mb-3">
						<input type="text" class="form-control" id="cnpj" placeholder="Digite seu CNPJ">
						<label for="cnpj">CNPJ</label>
					</div>
					<div class="form-floating mb-3">
						<input type="text" class="form-control" id="razao-social" placeholder="Digite sua razão social">
						<label for="razao-social">Razão Social</label>
					</div>
					<div class="form-floating">
						<select class="form-select" id="especialidade" aria-label="especialidade">
							<option value="4">Léo</option>
							<option value="1">Léo</option>
							<option value="2">Léo</option>
							<option value="3">Léo</option>
						</select>
						<label for="especialidade">Especialidade</label>
					</div>
				</div>
		  	</div>
		</form>
		<button type="button" id="register" class="btn btn-primary align-self-center px-4">Criar Conta</button>
	</div>
</div>

<script type="module" src="./js/register.js?a=<?php echo microtime(); ?>"></script>