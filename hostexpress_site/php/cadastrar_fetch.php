<div class="container my-4">
    <h2 class="mb-1 text-center text-dark fs-1 fw-bold" style="font-family: 'Montserrat', sans-serif;">Crie sua conta</h2>  
    <hr>
    <form id="formCadastro" class="d-flex">
      <div class="d-flex flex-column w-50 p-4">
        <h2 class="mb-4 text-center text-primary fs-4  fw-bold" style="font-family: 'Montserrat', sans-serif;">Informações Pessoais</h2>
        <div class="mb-3">
          <label for="nome" class="form-label">Nome Completo</label>
          <input type="text" class="form-control" id="nome" name="nome" required>
        </div>
        <div class="mb-3">
          <label for="celular" class="form-label">Celular</label>
          <input type="text" class="form-control" id="celular" name="celular" required>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
          <label for="senha" class="form-label">Senha</label>
          <input type="password" class="form-control" id="senha" name="senha" required>
        </div>
      </div>
      <div class="d-flex flex-column w-50 p-4">
        <h2 class="mb-4 text-center text-primary fs-4  fw-bold" style="font-family: 'Montserrat', sans-serif;">Informações de Endereço</h2>
        <div class="mb-3">
          <label for="cep" class="form-label">Cep</label>
          <div class="position-relative">
            <input type="text" class="form-control pe-5" id="cep" name="cep" required>
            <i class="bi bi-search position-absolute top-50 end-0 translate-middle-y me-3" id="buscarcep" style="cursor: pointer;"></i>
          </div>
        </div>
        <div class="mb-3">
          <label for="rua" class="form-label">Endereço</label>
          <input type="text" class="form-control" id="rua" name="rua" required>
        </div>
        <div class="mb-3">
          <label for="bairro" class="form-label">Bairro</label>
          <input type="text" class="form-control" id="bairro" name="bairro" required>
        </div>
        <div class="mb-3">
          <label for="cidade" class="form-label">Cidade</label>
          <input type="text" class="form-control" id="cidade" name="cidade" required>
        </div>
        <div class="mb-3">
          <label for="estado" class="form-label">Estado</label>
          <input type="text" class="form-control" id="estado" name="estado" required>
        </div>
        <div class="mb-3">
          <label for="num" class="form-label">Número de residência</label>
          <input type="text" class="form-control" id="num" name="num" required>
        </div>
        <div class="mb-3">
          <label for="complemento" class="form-label">Complemento</label>
          <input type="text" class="form-control" id="complemento" name="complemento">
        </div>
      </div>
      <div>
        <button type="button" id="btn-cadastrar" class="btn btn-primary align-self-center " style="width: 15em;">Criar Conta</button>
      </div>
    </form>
</div>

  <div id="codigoModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="fecharModal()">&times;</span>
      <h2>Verificação de E-mail</h2>
      <p>Digite o código de confirmação enviado para seu e-mail:</p>
      <input type="text" id="codigoInput" class="form-control text-center" placeholder="Ex: 123456" />
      <div id="erroCodigo" style="color:red; margin-top: 10px;"></div>
      <br />
      <button onclick="enviarCodigo()" class="btn btn-primary">Confirmar Código</button>
    </div>
  </div>

<script src="./js/cadastrausuario.js?a=<?php echo time(); ?>"></script>