<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./cadastrarusuario.html">
    <title>Cadastrar Novo Usuário</title>
    <link rel="shortcut icon" type="image/x-icon" href="/assets/caminhaobranco.ico" alt="icone">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="/js/cadastrausuario.js"></script>
</head>
<body>
    <header>
        <div class="logo-container">
            <img src="/assets/caminhaobranco.png" id="HostVrum">
        </div>
        <div>
            <img class ="logo-container2" src="/assets/hosttexto.png"> 
        </div>  

        <nav>
            <div class="titulocima">
                <h1>Bem vindo</h1>
            </div>
            <div class="separator"></div>
            <div>
                <img class="profileco" src="/assets/profile.png">
            </div>  
            <a href="./login.html" class="underline">Entrar</a>
            <a>Sua casa está em: </a>
            <div class="loc">
                <script>
                    window.onload = function() {
                        const bairro = localStorage.getItem('bairro');
                        const locDiv = document.querySelector('.loc');
                        if (bairro) {
                            locDiv.textContent = `${bairro}`;
                        } else {
                            locDiv.textContent = 'Não cadastrado';
                        }
                    }
                </script>
            </div>
        </nav>
    </header>

    <div class="login-container">
        <h2>Cadastrar Novo Usuário</h2> 
        <form method="post" action="/php/cadastrousuario.php" id="formCadastro" class="form">
            <div  class="inputs">
                <label for = "nome" class="labels">Nome Completo:</label>
                <input type="text" class="input" id="nome" name="nome" title="Nome: " required>
            </div>
            <div  class="inputs">
                <label for = "celular" class="labels">Celular:</label>
                <input type="text" class="input" id="celular" name="celular" title="Celular: " required>
            </div>
            <div  class="inputs">
                <label for = "email" class="labels">Email:</label>
                <input type="text" class="input" id="email" name="email" title="Email: " required>
            </div>
            <div  class="inputs">
                <label for = "senha" class="labels">Senha:</label>
                <input type="password" class="input" id="senha" name="senha" title="Senha: " required>
            </div>
            <div class="inputs">
                <label for="cep" class="labels">CEP:</label>
                <div class="sim">
                    <input style="width: 45%;"type="text" class="input" id="cep" name="cep" pattern="\d{5}-?\d{3}" title="Digite um CEP válido (ex: 12090-490)" required>
                    <button type="button" id="buscarCep" onclick="buscaCep()">🔍</button>
                </div>
            </div>
            <div  class="inputs">
                <label for = "rua" class="labels">Endereço:</label>
                <input type="text" class="input" id="rua" name="rua" title="Rua: " required>
            </div>
            <div  class="inputs">
                <label for = "bairro" class="labels">Bairro:</label>
                <input type="text" class="input" id="bairro" name="bairro" title="bairro: " required>
            </div>
            <div class="inputs">
                <label for = "cidade" class="labels">Cidade:</label>
                <input type="text" class="input" id="cidade" name="cidade" title="Cidade: " required>
            </div>
            <div class="inputs">
                <label for = "estado" class="labels">Estado:</label>
                <input type="text" class="input" id="estado" name="estado" title="Estado: " required>
            </div>
            <div  class="inputs">
                <label for = "num" class="labels">Número de residência:</label>
                <input type="text" class="input" id="num" name="num" title="num: " required>
            </div>
            <div class="inputs">
                <label for = "complemento" class="labels">Complemento:</label>
                <input type="text" class="input" id="complemento" name="complemento" title="Complemento: ">
            </div>
            <div class="centra">
                <button style="width:20%;" type="submit" class="botao" id="btn-cadastrar">Cadastrar</button>
            </div>
        </form>
    </div>
</body>
</html>