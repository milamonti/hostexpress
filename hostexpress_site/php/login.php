<div class="w-100 d-flex gap-4">
    <div class="w-100 p-3 d-flex flex-column align-items-center">
        <h5 class="fs-1 fw-bold p-0">Login</h5>
        <hr>
        <div class="form-floating mb-3 w-75">
            <input type="email" class="form-control" id="email" placeholder="name@example.com" required>
            <label for="email">E-mail</label>
        </div>
        <div class="form-floating position-relative w-75">
            <input type="password" class="form-control pe-5" id="senha" placeholder="&#xb7&#xb7&#xb7&#xb7&#xb7&#xb7&#xb7" required>
            <label for="senha">Senha</label>
            <i class="bi bi-eye position-absolute top-50 end-0 translate-middle-y me-3" 
                id="icone" style="cursor: pointer;">
            </i>
        </div>
        <button type="button" class="btn btn-primary align-self-center my-3 px-4" onclick="Login(event)">Entrar</button>
    </div>
    <div class="w-100 d-flex flex-column p-3">
        <h5 class="fs-1 fw-bold p-0 text-center">Ainda não se cadastrou?</h5>
        <hr>
        <p class="text-muted text-center">Crie sua conta para aproveitar todas as promoções, realizar e acompanhar seus pedidos!</p>
        <button class="btn btn-outline-primary align-self-center" onclick="loadPage('register')">Cadastre-se</button>
    </div>
</div>

<style>
    hr {
        height: 1rem;
        width: 100%;
        color: #000;
    }
</style>

<script type="module" src="./js/login.js?a=<?php echo microtime(); ?>"></script>

