<?php 
require_once dirname(__DIR__, 3) . '/database/config/config.php';
include_once ROOT . '/database/modules/authManager.php';
$auth = new Auth();
?>
<nav class="navbar bg-primary shadow-lg w-100 justify-content-center p-0">
    <div class="d-flex justify-content-between flex-wrap align-items-center w-100 p-1">
        <!-- Logo -->
        <a onclick="reloadPage()" class="navbar-brand d-flex align-items-center justify-content-start me-5" style="width: 200px; max-height: 50px;">
            <img class="img-fluid w-75" src="./assets/hosttexto.png" alt="Texto HostExpress">
        </a>
        <!-- Usuário -->
        <div class="dropdown dropstart me-4" style="cursor: pointer;">
            <div class="dropdown-toggle text-white" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-circle fs-4 me-2"></i>
                <?php echo htmlspecialchars($auth->user('name')) ?>
            </div>
            <ul class="dropdown-menu me-2">
                <li>
                    <a class="dropdown-item" onclick="loadPage('shop/shopAccount')">
                        Minha Conta
                    </a>
                </li>
                <li><a class="dropdown-item" onclick="Logout()">Sair</a></li>
            </ul>
        </div>
    </div>

    <ul class="nav nav-pills nav-fill flex-sm-row">
        <button class="flex-sm-fill text-sm-center text-white nav-link" page="shop/assets/shopContainer">Início</button>
        <button class="flex-sm-fill text-sm-center text-white nav-link" page="shop/pages/orders">Pedidos</button>
        <button class="flex-sm-fill text-sm-center text-white nav-link" page="shop/pages/products">Produtos</button>
        <button class="flex-sm-fill text-sm-center text-white nav-link" page="shop/pages/users">Usuários</button>
        <button class="flex-sm-fill text-sm-center text-white nav-link" page="shop/pages/admin">Administração</button>
    </ul>
</nav>

