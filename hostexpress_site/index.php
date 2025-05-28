<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HostExpress</title>
    <link rel="shortcut icon" type="image/x-icon" href="./assets/caminhaobranco.ico" alt="icone">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <style>
    .search-container {
      width: 250px;
    }

    .search-container i {
      left: 10px;
      top: 50%;
      transform: translateY(-50%);
    }

    .search-container input {
      width: 100%;
      padding: 10px 10px 10px 35px;
      box-sizing: border-box;
    }
  </style>

    
</head>
<body>

    <header class="navbar navbar-expand-lg bd-navbar sticky-top p-0 w-100">
    <nav class="navbar bg-primary shadow-lg w-100">
        <div class="d-flex justify-content-around align-items-center w-100">
            <div class="d-flex flex-column align-items-center justify-content-start" style="width: 200px;">
                <img class="mx-2" src="./assets/caminhaobranco.png" id="HostVrum" alt="Logo" width="120" height="auto">
                <img class="img-fluid w-75" src="./assets/hosttexto.png" alt="Texto HostExpress">
            </div>

            <div class="d-flex justify-content-start" style="width:40%;">
                <div class="search-container position-relative border border-1 border-dark rounded me-6 w-100">
                    <i class="bi bi-search me-2 position-absolute"></i>
                    <input type="text" class="form-control" placeholder="Buscar produtos ou lojas...">
                </div>
            </div>
            <div class="d-flex flex-row justify-content-start align-items-center">
                <div class="icon-link d-flex justify-content-center align-items-center">
                    <i class="bi bi-geo-alt-fill text-white"></i>
                    <input type="hidden" id="coordenadas" value=""/>
                    <h5 class="text-white mt-2 mx-2" id="cidade"></h5>
                </div>
            </div>
            <div class="d-flex flex-row justify-content-start align-items-center">
                <div class="d-flex flex-row-reverse align-items-center">
                    <p class="text-white mt-3"><?php include('./acesso.php');
                        if(!$_SESSION['USUARIO']){
                            echo '
                            <!-- Botão de Login -->
                            <div class="text-center mx-3 d-flex flex-column justify-content-center align-items-center">
                                <a href="./php/login.php" class="btn btn-outline-light mx-2 d-inline-flex align-items-center" style="border:none;">
                                    <i class="bi bi-person-circle me-2"></i>
                                    Entrar
                                </a>
                                
                                <span class="text-white">ou</span>

                                <!-- Botão de cadastrar -->
                                <a href="./php/cadastrar.php" class="btn btn-outline-light d-inline-flex align-items-center mx-3" style="border:none;">
                                    <i class="bi bi-person-plus me-2"></i>Cadastrar
                                </a>
                            </div></div>
                            ';
                        }
                        else{
                            echo '</p><i class="bi bi-person-circle text-white me-2 fs-3"></i></div>';
                        } ?>
            </div>
                <!-- Os Carrinhos estão aqui em baixo -->
                <div class="mx-6">
                  <a href="#" class="btn btn-primary position-relative" onclick="abrirCarrinho()" data-bs-toggle="modal" data-bs-target="#modal_carrinho">
                    <i class="bi bi-cart me-2"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="carrinho">0</span>
                  </a>
                </div>
        </div>
    </nav>
    </header>

    <div class="container mt-4">
        <div class="row" id="row">
            <!--CARDS-->
        </div>
    </div>

    <footer class="bd-footer py-2 pt-md-1 mt-2 bg-body-secondary w-100" style="position: relative; bottom: 0; left: 0; opacity: 0.8; background-color: #333;">
    <div class="container py-2 py-md-2 px-2 px-md-1 text-body-secondary">
        <div class="row">
            <div class="col-lg-3 mb-3">
                <a class="d-inline-flex align-items-center mb-2 text-body-emphasis text-decoration-none">
                    <span class="fs-5"><a href="#"></a><i class="bi bi-c-circle me-2"></i>HostExpress</span>
                </a>
            </div>
            <div class="col-6 col-lg-2 offset-lg-1 mb-3"><i class="bi bi-facebook me-2"></i></div>
            <div class="col-6 col-lg-2 mb-3"><i class="bi bi-whatsapp me-2"></i></div>
            <div class="col-6 col-lg-2 mb-3"><i class="bi bi-instagram me-2"></i></div>
            <div class="col-6 col-lg-2 mb-3"><i class="bi bi-bootstrap me-2"></i></div>
        </div>
    </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./js/index.js"></script>
    
</body>
    <!-- Modal -->
<div class="modal fade" id="modalProduto" tabindex="-1" aria-labelledby="modalProduto" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body">
      </div>
    </div>
  </div>
</div>

<!--MODAL CARRINHO-->
<div class="modal fade" id="modal_carrinho" tabindex="-1" aria-labelledby="modalCarrinhoLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCarrinhoLabel">Carrinho de Compras</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body" id="conteudoCarrinho">

    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" onclick="resetarCarrinho()">Esvaziar Carrinho</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary">Finalizar Compra</button>
      </div>
    </div>
  </div>
</div>
</html>

