<?php 
require_once dirname(__DIR__, 1) . '/database/modules/userManager.php';
$user = new User();
?>

<header id="navbar" class="navbar navbar-expand-lg bd-navbar sticky-top p-0 w-100">
  <nav class="navbar bg-primary shadow-lg w-100">
    <div class="d-flex justify-content-between flex-wrap align-items-center w-100">
    <!--Logo-->
      <div class="d-flex justify-content-start">
        <a onclick="reloadPage()" class="d-flex flex-row align-items-center justify-content-start me-5" style="width: 200px;">
          <img class="mx-2" src="./assets/caminhaobranco.png" alt="Logo" width="120" height="auto">
          <img class="img-fluid w-75" src="./assets/hosttexto.png" alt="Texto HostExpress">
        </a>
      </div>
      <!--Search input-->
      <div class="d-flex justify-content-start search-container">
        <select id="search" class="ps-5 w-100"></select>
      </div>
      <!--Location-->
      <div class="d-flex flex-row align-items-center">
        <a class="d-flex justify-content-center align-items-center">
          <i class="bi bi-geo-alt-fill text-white fs-5"></i>
          <h6 class="text-white mt-2 mx-2" id="location"></h6>
        </a>
      </div>
      <!--User-->
      <div class="d-flex flex-row justify-content-start align-items-center">
        <div class="d-flex flex-row align-items-center">
          <?php if (isset($_COOKIE['token'])): ?>
          <div class="dropdown" style="cursor: pointer;">
            <div class="dropdown-toggle text-white" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-person-circle fs-4 me-2"></i><?php echo htmlspecialchars($user->getTokenField("name")) ?>
            </div>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" onclick="loadPage('client/clientAccount')">
                Minha Conta
              </a></li>
              <li><a class="dropdown-item" onclick="Logout()">Sair</a></li>
            </ul>
          </div>
          <?php else: ?>
          <div class="text-center mx-3 d-flex flex-column justify-content-center align-items-center">
            <button type="button" id="btn-login" onclick='loadPage("login")' class="btn btn-outline-light mx-2 d-inline-flex align-items-center" style="border:none;">
              <i class="bi bi-person-circle me-2"></i>Entrar
            </button>
            <span class="text-white">ou</span>
            <button type="button" id="btn-cadastrar" onclick='loadPage("register")' class="btn btn-outline-light d-inline-flex align-items-center mx-3" style="border:none;">
              <i class="bi bi-person-plus me-2"></i>Cadastrar
            </button>
          </div>
          <?php endif; ?>
        </div>
      </div>
            
      <!--Cart-->
      <div class="d-flex justify-content-start me-2">
        <a class="text-white btn position-relative mx-2" data-bs-toggle="modal" data-bs-target="#modalCart">
          <i class="bi bi-cart me-2 fs-4"></i>
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="carrinho"></span>
        </a>
      </div>
        
    </div>
  </nav>
</header>
