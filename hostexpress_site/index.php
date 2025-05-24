<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HostExpress</title>
    <link rel="shortcut icon" type="image/x-icon" href="./assets/caminhaobranco.ico" alt="icone">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
</head>
<body>

    <header class="navbar navbar-expand-lg bd-navbar sticky-top p-0 w-100">
    <nav class="navbar bg-primary w-100" >
        <div class="d-flex justify-content-between align-items-center w-100">
            <div class="d-flex align-items-center">
                <img class="mx-2" src="./assets/caminhaobranco.png" id="HostVrum" alt="Logo" width="120" height="auto">
                <img class="logo-container2 img-fluid w-25" src="./assets/hosttexto.png" alt="Texto HostExpress">
            </div>

            <div class="d-flex align-items-center">
                <div class="d-flex justify-content-start" style="margin-right: 400px;">
                    <!-- Menu do dropdown -->
                    <div class="dropdown d-flex justify-content-start">
                        <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="./assets/menu.png" alt="Menu" width="30" height="30" class="mx-2">
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </div>

                    <div class="search-bar me-6">
                        <input type="text" class="form-control" style="width: 400px;" placeholder="Buscar produtos ou lojas...">
                    </div>
                    
                    <a class="mx-2">🔍</a>
                </div>

                <!-- Botão de Login -->
                <div class="text-center ms-3 d-flex justify-content-center align-items-center">
                    <a href="./php/login.html" class="btn btn-outline-light mx-2 d-inline-flex align-items-center">
                        <img src="./assets/profile.png" alt="Usuário" width="40" height="20" class="me-2">
                        Entrar
                    </a>
                    
                    <span class="text-light mx-2">ou</span>


                    <!-- Botão de cadastrar -->
                    <a href="cadastrarusuario.html" class="btn btn-outline-light mx-2 d-inline-flex align-items-center" style="height: 40px; width: 120px;">
                        Cadastrar-se
                    </a>
                </div>

                <div> <!-- Os Carrinhos estão aqui em baixo -->
                    <a class="mx-2">🛒</a>
                </div>
            </div>
        </div>
    </nav>
</header>


    
    
    
    

    <div class="container mt-4">
        <div class="row">
            <!-- Card 1 -->
            <div class="col-md-3 mb-4">
                <div class="card" style="width: 18rem;">
                    <img src="jeans3.jpg" class="card-img-top" alt="Produto 1">
                    <div class="card-body">
                        <h5 class="card-title">Nome Produto 1</h5>
                        <p class="card-text">Descrição do Produto 1</p>
                        <p class="preco">R$19,99</p>
                        <a href="produto1.html" class="btn btn-secondary mb-2">Ver Produto</a>
                        <a href="#" class="btn btn-primary">Adicionar ao carrinho</a>
                    </div>
                </div>
            </div>
            
            <!-- Card 2 -->
            <div class="col-md-3 mb-4">
                <div class="card" style="width: 18rem;">
                    <img src="produto2.jpg" class="card-img-top" alt="Produto 2">
                    <div class="card-body">
                        <h5 class="card-title">Nome Produto 2</h5>
                        <p class="card-text">Descrição do Produto 2</p>
                        <p class="preco">R$29,99</p>
                        <a href="produto2.html" class="btn btn-secondary mb-2">Ver Produto</a>
                        <a href="#" class="btn btn-primary">Adicionar ao carrinho</a>
                    </div>
                </div>
            </div>
    
            <!-- Card 3 -->
            <div class="col-md-3 mb-4">
                <div class="card" style="width: 18rem;">
                    <img src="produto3.jpg" class="card-img-top" alt="Produto 3">
                    <div class="card-body">
                        <h5 class="card-title">Nome Produto 3</h5>
                        <p class="card-text">Descrição do Produto 3</p>
                        <p class="preco">R$39,99</p>
                        <a href="produto3.html" class="btn btn-secondary mb-2">Ver Produto</a>
                        <a href="#" class="btn btn-primary">Adicionar ao carrinho</a>
                    </div>
                </div>
            </div>
    
            <!-- Card 4 -->
            <div class="col-md-3 mb-4">
                <div class="card" style="width: 18rem;">
                    <img src="produto4.jpg" class="card-img-top" alt="Produto 4">
                    <div class="card-body">
                        <h5 class="card-title">Nome Produto 4</h5>
                        <p class="card-text">Descrição do Produto 4</p>
                        <p class="preco">R$49,99</p>
                        <a href="produto4.html" class="btn btn-secondary mb-2">Ver Produto</a>
                        <a href="#" class="btn btn-primary">Adicionar ao carrinho</a>
                    </div>
                </div>
            </div>
    
            <!-- Card 5 -->
            <div class="col-md-3 mb-4">
                <div class="card" style="width: 18rem;">
                    <img src="produto5.jpg" class="card-img-top" alt="Produto 5">
                    <div class="card-body">
                        <h5 class="card-title">Nome Produto 5</h5>
                        <p class="card-text">Descrição do Produto 5</p>
                        <p class="preco">R$59,99</p>
                        <a href="produto5.html" class="btn btn-secondary mb-2">Ver Produto</a>
                        <a href="#" class="btn btn-primary">Adicionar ao carrinho</a>
                    </div>
                </div>
            </div>
    
            <!-- Card 6 -->
            <div class="col-md-3 mb-4">
                <div class="card" style="width: 18rem;">
                    <img src="produto6.jpg" class="card-img-top" alt="Produto 6">
                    <div class="card-body">
                        <h5 class="card-title">Nome Produto 6</h5>
                        <p class="card-text">Descrição do Produto 6</p>
                        <p class="preco">R$69,99</p>
                        <a href="produto6.html" class="btn btn-secondary mb-2">Ver Produto</a>
                        <a href="#" class="btn btn-primary">Adicionar ao carrinho</a>
                    </div>
                </div>
            </div>
    
            <!-- Card 7 -->
            <div class="col-md-3 mb-4">
                <div class="card" style="width: 18rem;">
                    <img src="produto7.jpg" class="card-img-top" alt="Produto 7">
                    <div class="card-body">
                        <h5 class="card-title">Nome Produto 7</h5>
                        <p class="card-text">Descrição do Produto 7</p>
                        <p class="preco">R$79,99</p>
                        <a href="produto7.html" class="btn btn-secondary mb-2">Ver Produto</a>
                        <a href="#" class="btn btn-primary">Adicionar ao carrinho</a>
                    </div>
                </div>
            </div>
    
            <!-- Card 8 -->
            <div class="col-md-3 mb-4">
                <div class="card" style="width: 18rem;">
                    <img src="produto8.jpg" class="card-img-top" alt="Produto 8">
                    <div class="card-body">
                        <h5 class="card-title">Nome Produto 8</h5>
                        <p class="card-text">Descrição do Produto 8</p>
                        <p class="preco">R$89,99</p>
                        <a href="produto8.html" class="btn btn-secondary mb-2">Ver Produto</a>
                        <a href="#" class="btn btn-primary">Adicionar ao carrinho</a>
                    </div>
                </div>
            </div>
    
            <!-- Card 9 -->
            <div class="col-md-3 mb-4">
                <div class="card" style="width: 18rem;">
                    <img src="produto9.jpg" class="card-img-top" alt="Produto 9">
                    <div class="card-body">
                        <h5 class="card-title">Nome Produto 9</h5>
                        <p class="card-text">Descrição do Produto 9</p>
                        <p class="preco">R$99,99</p>
                        <a href="produto9.html" class="btn btn-secondary mb-2">Ver Produto</a>
                        <a href="#" class="btn btn-primary">Adicionar ao carrinho</a>
                    </div>
                </div>
            </div>
    
            <!-- Card 10 -->
            <div class="col-md-3 mb-4">
                <div class="card" style="width: 18rem;">
                    <img src="produto10.jpg" class="card-img-top" alt="Produto 10">
                    <div class="card-body">
                        <h5 class="card-title">Nome Produto 10</h5>
                        <p class="card-text">Descrição do Produto 10</p>
                        <p class="preco">R$109,99</p>
                        <a href="produto10.html" class="btn btn-secondary mb-2">Ver Produto</a>
                        <a href="#" class="btn btn-primary">Adicionar ao carrinho</a>
                    </div>
                </div>
            </div>
    
            <!-- Card 11 -->
            <div class="col-md-3 mb-4">
                <div class="card" style="width: 18rem;">
                    <img src="produto11.jpg" class="card-img-top" alt="Produto 11">
                    <div class="card-body">
                        <h5 class="card-title">Nome Produto 11</h5>
                        <p class="card-text">Descrição do Produto 11</p>
                        <p class="preco">R$119,99</p>
                        <a href="produto11.html" class="btn btn-secondary mb-2">Ver Produto</a>
                        <a href="#" class="btn btn-primary">Adicionar ao carrinho</a>
                    </div>
                </div>
            </div>
    
            <!-- Card 12 -->
            <div class="col-md-3 mb-4">
                <div class="card" style="width: 18rem;">
                    <img src="produto12.jpg" class="card-img-top" alt="Produto 12">
                    <div class="card-body">
                        <h5 class="card-title">Nome Produto 12</h5>
                        <p class="card-text">Descrição do Produto 12</p>
                        <p class="preco">R$129,99</p>
                        <a href="produto12.html" class="btn btn-secondary mb-2">Ver Produto</a>
                        <a href="#" class="btn btn-primary">Adicionar ao carrinho</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="bd-footer py-2 pt-md-1 mt-2 bg-body-secondary w-100" style="position: fixed; bottom: 0; left: 0; opacity: 0.8; background-color: #333;">
    <div class="container py-2 py-md-2 px-2 px-md-1 text-body-secondary">
        <div class="row">
            <div class="col-lg-3 mb-3">
                <a class="d-inline-flex align-items-center mb-2 text-body-emphasis text-decoration-none">
                    <span class="fs-5">HostExpress</span>
                </a>
            </div>
            <div class="col-6 col-lg-2 offset-lg-1 mb-3"></div>
            <div class="col-6 col-lg-2 mb-3"></div>
            <div class="col-6 col-lg-2 mb-3"></div>
            <div class="col-6 col-lg-2 mb-3"></div>
        </div>
    </div>
</footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./js/index.js"></script>
    
</body>
</html>

