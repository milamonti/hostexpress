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
                    <h5 class="text-white mt-2 mx-2">Jundiaí-SP</h5>
                </div>
            </div>
            <div class="d-flex justify-content-start align-items-center">
                <!-- Botão de Login -->
                <div class="text-center mx-3 d-flex flex-column justify-content-center align-items-center">
                    <a href="./php/login.php" class="btn btn-outline-light mx-2 d-inline-flex align-items-center" style="border:none;">
                        <i class="bi bi-person-circle me-2"></i>
                        Entrar
                    </a>
                    
                    <span class="text-white">ou</span>

                    <!-- Botão de cadastrar -->
                    <a href="./php/cadastrar.php" class="btn btn-outline-light d-inline-flex align-items-center mx-2" style="border:none;">
                        <i class="bi bi-person-plus me-2"></i>Cadastrar
                    </a>
                </div>
            </div>
                <!-- Os Carrinhos estão aqui em baixo -->
                 <div class="mx-6">
                     <button type="button" class="btn btn-primary position-relative mx-6">
                        <i class="bi bi-cart me-2"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="carrinho">
                            99+
                        </span>
                    </button>
                </div>
        </div>
    </nav>
    </header>