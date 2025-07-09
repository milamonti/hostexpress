<header class="navbar navbar-expand-lg bd-navbar sticky-top p-0 w-100">
    <nav class="navbar bg-primary shadow-lg w-100">
        <div class="d-flex justify-content-around align-items-center w-100">
            <div class="d-flex flex-row align-items-center justify-content-start me-5" style="width: 200px;">
                <img class="mx-2" src="./assets/caminhaobranco.png" id="HostVrum" alt="Logo" width="120" height="auto">
                <img class="img-fluid w-75" src="./assets/hosttexto.png" alt="Texto HostExpress">
            </div>

            <div class="d-flex justify-content-start" style="width:40%;">
                <div class="search-container position-relative me-6 w-100">
                    <i class="bi bi-search me-2 position-absolute"></i>
                    <select class="form-control js-basic-single border border-1 border-primary rounded" placeholder="Pesquise por produtos ou lojas..">
                      <option></option>
                    </select>
                </div>
            </div>
            <div class="d-flex flex-row justify-content-start align-items-center">
                <a class="icon-link d-flex justify-content-center align-items-center" href="#">
                    <i class="bi bi-geo-alt-fill text-white fs-5"></i>
                    <input type="hidden" id="coordenadas" value=""/>
                    <h6 class="text-white mt-2 mx-2" id="cidade"></h6>
                </a>
            </div>
            <div class="d-flex flex-row justify-content-start align-items-center">
                <div class="d-flex flex-row align-items-center">
                    <?php session_start(); ?>
                    
                    <?php if (isset($_SESSION['USUARIO'])): ?>
                      <a class="icon-link d-flex flex-row justify-content-center align-items-center" href="./php/login.php">
                        <i class="bi bi-person-circle fs-4 text-white me-2"></i>
                        <p class="text-white text-center mt-3">
                            <?= htmlspecialchars($_SESSION['USUARIO']) ?>
                        </p>
                      </a>
                    <?php else: ?>
                        <div class="text-center mx-3 d-flex flex-column justify-content-center align-items-center">
                            <a href="./php/login.php" class="btn btn-outline-light mx-2 d-inline-flex align-items-center" style="border:none;">
                                <i class="bi bi-person-circle me-2"></i>Entrar
                            </a>
                            <span class="text-white">ou</span>
                            <a href="./php/cadastrar.php" class="btn btn-outline-light d-inline-flex align-items-center mx-3" style="border:none;">
                                <i class="bi bi-person-plus me-2"></i>Cadastrar
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <!-- Os Carrinhos estão aqui em baixo -->
            <div class="mx-6">
              <a href="#" class="text-white btn position-relative" onclick="abrirCarrinho()" data-bs-toggle="modal" data-bs-target="#modal_carrinho">
                <i class="bi bi-cart me-2 fs-4"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="carrinho"></span>
              </a>
            </div>
        </div>
    </nav>
    </header>