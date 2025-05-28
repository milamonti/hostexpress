<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fazer Login</title>
    <link rel="website icon" type="imagex/png" href="../assets/caminhaobranco.ico" alt="icone">

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    
    <style>
        html, body {
          margin: 0;
          padding: 0;
          box-sizing: border-box;
          height: 100vh;
        }
      
        header {
          position: fixed;
          left: 0;
          z-index: 1000;
        }
      
        body {
          background-image: url('../assets/441ce742-99d3-4a5b-9c45-d64c5a915c5a.png');
          background-size: cover;
          background-position: center;
          background-repeat: no-repeat;
          background-attachment: fixed;
        }
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
        @media (max-width: 600px) {
            #form {
                max-width: 80%,
            }
        }
      </style>
</head>

<body class="d-flex flex-column align-items-center p-0"></body>
    <header class="navbar navbar-expand-lg bd-navbar sticky-top p-0 w-100">
    <nav class="navbar bg-primary shadow-lg w-100">
        <div class="d-flex justify-content-around align-items-center w-100">
            <div class="d-flex flex-column align-items-center justify-content-start" style="width: 200px;">
                <img class="mx-2" src="../assets/caminhaobranco.png" id="HostVrum" alt="Logo" width="120" height="auto">
                <img class="img-fluid w-75" src="../assets/hosttexto.png" alt="Texto HostExpress">
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
                    <a href="#" class="btn btn-outline-light mx-2 d-inline-flex align-items-center" style="border:none;">
                        <i class="bi bi-person-circle me-2"></i>
                        Entrar
                    </a>
                    
                    <span class="text-white">ou</span>

                    <!-- Botão de cadastrar -->
                    <a href="./cadastrar.php" class="btn btn-outline-light d-inline-flex align-items-center mx-2" style="border:none;">
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
    <div id="form" class="d-flex flex-row border border-dark rounded bg-light shadow-lg justify-content-center w-25 mt-5">
        <form class="w-100 p-3 d-flex flex-column align-items-center">
            <div class="mb-3 w-100 badge text-bg-light">
                <img class="img-fluid" src="../assets/logo.ico" height="auto" width="100px" alt="Logo">
                <h5 class="card-title fw-bold p-0">Login</h5>
            </div>
            <div class="mb-3 w-100">
                <label for="email" class="form-label fw-bold">Email</label>
                <input type="email" class="form-control" id="email" placeholder="name@example.com" required>
            </div>
            <div class="mb-3 w-100">
                <label for="senha" class="form-label fw-bold">Senha</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="senha" placeholder="&#xb7&#xb7&#xb7&#xb7&#xb7&#xb7" required>
                    <button class="btn btn-light" type="button" id="ver_senha">
                        <i class="bi bi-eye" id="icone"></i>
                    </button>
                </div>
            </div>
            <button type="button" class="btn btn-primary w-25 mt-1" id="login" onclick="Login()">Entrar</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/login.js"></script>
    
</body>
    <footer class="bd-footer py-2 pt-md-1 mt-2 bg-body-secondary w-100" style="position: fixed; bottom: 0; left: 0; opacity: 0.8; background-color: #333;">
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
</html>
