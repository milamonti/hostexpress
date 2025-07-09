<div id="form" class="d-flex flex-row rounded shadow-lg justify-content-center my-5 ms-5" style="width: 600px;">
    <form class="w-100 p-3 d-flex flex-column align-items-center">
        <div class="mb-3 w-100 badge text-bg-light">
            <img class="img-fluid" src="./assets/logo.ico" height="auto" width="100" alt="Logo">
            <h5 class="card-title fw-bold p-0">Login</h5>
        </div>
        <div class="form-floating mb-3 w-100">
            <input type="email" class="form-control" id="email" placeholder="name@example.com">
            <label for="email">E-mail</label>
        </div>
        <div class="form-floating w-100">
            <div class="position-relative">
                <input type="password" class="form-control pe-5" id="senha" required>
                <i class="bi bi-eye position-absolute top-50 end-0 translate-middle-y me-3" id="icone" style="cursor: pointer;"></i>
            </div>
            <label for="senha">Senha</label>
        </div>
        <button type="sumbit" class="btn btn-primary w-25 my-3" id="login" onclick="Login(event)">Entrar</button>
    </form>
</div>

<script src="./js/login.js?a=<?php echo time(); ?>"></script>

