<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HostExpress</title>
    <link rel="shortcut icon" type="image/x-icon" href="./assets/caminhaobranco-removebg-preview.ico" alt="icone">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">


    <style>
    .search-container {
      width: 600px;
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
    .carousel-item > .row {
      display: flex;
    }

    html, body {
      height: 100%;
      margin: 0;
    }

    body {
      min-height: 100vh;
    }
    .card {
      margin: 0 10px;
      flex: 1;
      min-width: 200px;
    }

    .carousel-inner {
      padding: 20px 0;
    }
    #container {
      flex: 1;
    }
  </style>

</head>
<body class="d-flex flex-column align-items-center w-100">
    <header class="navbar navbar-expand-lg bd-navbar sticky-top p-0 w-100">
      <nav class="navbar bg-primary shadow-lg w-100">
        <div class="d-flex justify-content-between flex-wrap align-items-center w-100">
            <!--LOGO-->
            <div class="d-flex justify-content-start">
              <a href="index.php" class="d-flex flex-row align-items-center justify-content-start me-5" style="width: 200px;">
                  <img class="mx-2" src="./assets/caminhaobranco.png" id="HostVrum" alt="Logo" width="120" height="auto">
                  <img class="img-fluid w-75" src="./assets/hosttexto.png" alt="Texto HostExpress">
              </a>
            </div>
            <!--SEARCH INPUT-->
            <div class="d-flex justify-content-start search-container">
              <div class="dropdown w-100 position-relative">
                <input type="text" id="search" class="form-control dropdown-toggle ps-5" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside" placeholder="Pesquise por produtos ou lojas.." />
                <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3"></i>
                <form class="dropdown-menu p-4 w-100">
                  <p class="fw-bold">Pesquise por um monte de coisa, Tipo:</p>
                  <div class="d-flex justify-content-between">
                    <div class="w-50 d-flex flex-column">
                      <h6>leo</h6>
                      <h6>leo</h6>
                      <h6>leo</h6>
                      <h6>leo</h6>
                    </div>
                    <div class="w-50 d-flex flex-column" id="resultados">
                      <h6>leo</h6>
                      <h6>leo</h6>
                      <h6>leo</h6>
                      <h6>leo</h6>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <!--LOCALIZACAO-->
            <div class="d-flex flex-row align-items-center">
                <a class="icon-link d-flex justify-content-center align-items-center" href="#"
                    data-bs-toggle="popover"
                    title="Bem Vindo!" id="btn-city"
                    data-bs-content="bla bla bla ble ble ble"
                    data-bs-placement="bottom">
                    <i class="bi bi-geo-alt-fill text-white fs-5"></i>
                    <input type="hidden" id="coordenadas" value=""/>
                    <h6 class="text-white mt-2 mx-2" id="cidade"></h6>
                </a>
            </div>
            <!--USUARIO-->
            <div class="d-flex flex-row justify-content-start align-items-center">
                <div class="d-flex flex-row align-items-center">
                    <?php if (isset($_SESSION['USUARIO'])): ?>
                      <a class="d-flex flex-row justify-content-center align-items-center" onclick="CarregarPagina('conta_fetch')">
                        <i class="bi bi-person-circle fs-4 text-white me-2"></i>
                        <p class="text-white text-center mt-3">
                            <?= htmlspecialchars($_SESSION['USUARIO']) ?>
                        </p>
                      </a>
                    <?php else: ?>
                        <div class="text-center mx-3 d-flex flex-column justify-content-center align-items-center">
                            <button type="button" id="btn-login" class="btn btn-outline-light mx-2 d-inline-flex align-items-center" style="border:none;">
                                <i class="bi bi-person-circle me-2"></i>Entrar
                            </button>
                            <span class="text-white">ou</span>
                            <button type="button" id="btn-cadastrar" class="btn btn-outline-light d-inline-flex align-items-center mx-3" style="border:none;">
                                <i class="bi bi-person-plus me-2"></i>Cadastrar
                            </button>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <!--CARRINHO-->
            <div class="d-flex justify-content-start me-2">
              <a class="text-white btn position-relative mx-2" onclick="abrirCarrinho()" data-bs-toggle="modal" data-bs-target="#modal_carrinho">
                <i class="bi bi-cart me-2 fs-4"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="carrinho"></span>
              </a>
            </div>
        </div>
      </nav>
    </header>
    <div id="container" class="w-100">
      <div class="container-fluid bg-white text-primary">
        <div class="row mt-2">
          <div class="col-md-12 text-center">
            <h1>Bem-vindo ao HostExpress</h1>
            <p class="text-muted text-dark">Encontre os melhores produtos para o seu lar!</p>
          </div>
          <div class="col-md-12 text-center mt-3 fw-semibold">
            <div class="d-flex flex-row justify-content-center pt-0">
              <p class="text-dark"><i class="bi bi-truck me-2 fs-2"></i>Entregas rápidas e seguras</p>
              <p class="text-dark mx-4"><i class="bi bi-credit-card me-2 fs-2"></i>Pagamentos facilitados</p>
              <p class="text-dark"><i class="bi bi-shield-check me-2 fs-2"></i>Compra segura e confiável</p>
              <p class="text-dark mx-4"><i class="bi bi-cash-coin me-2 fs-2"></i>Ofertas imperdíveis</p>
            </div>
          </div>
        </div>              
      </div>
      
      <!--CARROSSEL CARDS-->
      
      <div class="container-fluid">
        <div id="cardCarousel" class="carousel slide" >
          <div class="carousel-inner p-3" id="carousel-content">
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#cardCarousel" data-bs-slide="prev" style="width: 10px;">
              <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#cardCarousel" data-bs-slide="next" style="width: 10px;">
              <span class="carousel-control-next-icon"></span>
            </button>
          </div>
        </div>
        
        <!--CARROSSEL IMAGES-->
        
      <div id="carouselImages" class="carousel slide w-100" data-bs-ride="carousel" style="height: 200px;">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="./assets/logo.png" class="d-block w-100" alt="..." height="100">
          </div>
          <div class="carousel-item">
            <img src="./assets/logo.png" class="d-block w-100" alt="..." height="100">
          </div>
          <div class="carousel-item">
            <img src="./assets/logo.png" class="d-block w-100" alt="..." height="100">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselImages" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"><i class="bi bi-arrow-left text-dark mx-0" style="font-size:30px;"></i></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselImages" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"><i class="bi bi-arrow-right text-dark mx-0" style="font-size:30px;"></i></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
  <footer class="bd-footer py-2 pt-md-1 mt-2 bg-body-secondary w-100" style="bottom: 0; left: 0; opacity: 0.8; background-color: #333;">
    <div class="container py-2 py-md-2 px-2 px-md-1 text-body-secondary">
        <div class="row">
            <div class="col-lg-3 mb-3">
                <a class="d-inline-flex align-items-center mb-2 text-body-emphasis text-decoration-none">
                    <span class="fs-5"><a href="https://www.instagram.com/lleofavaro/">&copy; 2025 - HostExpress</span>
                </a>
            </div>
            <div class="col-6 col-lg-2 offset-lg-1 mb-3"><i class="bi bi-facebook me-2"></i></div>
            <div class="col-6 col-lg-2 mb-3"><i class="bi bi-whatsapp me-2"></i></div>
            <div class="col-6 col-lg-2 mb-3"><i class="bi bi-instagram me-2"></i></div>
            <div class="col-6 col-lg-2 mb-3"><i class="bi bi-bootstrap me-2"></i></div>
        </div>
    </div>
  </footer>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="./js/index.js?a=<?php echo time(); ?>"></script>
    
</body>
    <!-- MODAL PRODUTO -->
<div class="modal fade" id="modalProduto" tabindex="-1" aria-labelledby="modalProduto" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
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
<div class="modal fade" id="modal_carrinho" tabindex="-1" aria-labelledby="modal_carrinho" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-primary"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger" onclick="resetarCarrinho()">Esvaziar Carrinho</button>
        <button type="button" class="btn btn-primary" onclick="CarregarPagina('carrinho_fetch')">Finalizar Compra</button>
      </div>
    </div>
    </div>
  </div>
</div>
</html>
