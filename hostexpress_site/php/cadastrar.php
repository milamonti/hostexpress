<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Cadastrar Novo Usuário</title>
  <link rel="shortcut icon" type="image/x-icon" href="../assets/caminhaobranco.ico" />

  <!--CSS-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet">

  <style>
    html, body {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      height: 100%;
    }

    body {
      
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      background-attachment: fixed;
    }

    .form-container {
      background-color: rgba(255, 255, 255, 0.95);
      padding: 2rem;
      border-radius: 10px;
      max-width: 700px;
      margin: 100px auto 30px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }

    header {
      position: fixed;
      top: 0;
      left: 0;
      z-index: 1000;
    }
  </style>
</head>

<body>
  <header class="navbar navbar-expand-lg navbar-light bg-body-secondary shadow-lg bg-white shadow-sm border-bottom py-2 w-100">
  <div class="container-fluid align-items-center justify-content-between">
    
    <a href="/" class="d-flex align-items-center">
      <img src="../assets/logo.png" alt="Hostexpress" width="200">
    </a>

    
    <form class="d-flex flex-grow-1 mx-4" style="max-width: 600px;">
      <input class="form-control rounded-start" type="search" placeholder="Procure por produto ou marca">
      <button class="btn btn-outline-secondary rounded-end" type="submit">
        🔍
      </button>
    </form>

    
    <div class="d-flex align-items-center text-end gap-3">
      <div>
        <small class="d-block">Bem-vindo,</small>
        <a href="login.php" class="fw-bold text-decoration-none text-secondary">Entre ou cadastre-se</a>
      </div>
      <div>
        <small class="d-block">21 Lojas encontradas</small>
        <span class="fw-bold text-warning">Sorocaba - SP ▼</span>
      </div>
      <a href="carrinho.php" class="text-warning fs-4 text-decoration-none">🛒</a>
    </div>
  </div>
</header>


  <div class="container" style="max-width: 650px;">
    <div class="form-container">
      <h2 class="mb-1 text-center fs-1 fw-bold" style="color: rgb(41, 39, 39); font-family: 'Montserrat', sans-serif;">Crie sua conta</h2>  
      <h2 class="mb-4 text-center fs-4  fw-bold" style="color:rgb(17, 0, 255); font-family: 'Montserrat', sans-serif;">Cadastro Pessoa Física</h2>
      <hr>
      <form id="formCadastro">
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
        <div class="mb-3 row">
          <div class="col-md-9">
            <label for="cep" class="form-label">CEP</label>
            <input type="text" class="form-control" id="cep" name="cep" pattern="\d{5}-?\d{3}" required>
          </div>
          <div class="col-md-3 d-flex align-items-end">
            <button type="button" class="btn btn-outline-secondary w-100" style="color:rgb(17, 0, 255); border-color:rgb(17, 0, 255) ;" onclick="buscaCep()">Buscar CEP</button>
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
        <div class="text-center">
          <button type="button" id="btn-cadastrar" class="btn btn-primary w-50" style="background-color:rgb(17, 0, 255);">Criar conta</button>
        </div>
      </form>
    </div>
  </div>

  <div id="codigoModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="fecharModal()">&times;</span>
            <h2>Verificação de E-mail</h2>
            <p>Digite o código de confirmação enviado para seu e-mail:</p>
            <input type="text" id="codigoInput" class="input" style="width: 40%;" placeholder="Ex: 123456">
            <div id="erroCodigo" style="color:red; margin-top: 10px;"></div>
            <br>
            <button onclick="enviarCodigo()" class="botao">Confirmar Código</button>
        </div>
    </div>

  <!--SCRIPTS-->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/cadastrausuario.js"></script>

</body>
</html>
