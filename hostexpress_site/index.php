<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HostExpress</title>
    <link rel="shortcut icon" type="image/x-icon" href="/assets/caminhaobranco.ico" alt="icone">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php 
    include_once('/php/navbar.php');
    ?>
    <!-- Produto -->
    <div class="container mt-4">
        <div class="card" style="width: 18rem;">
            <img src="jeans3.jpg" class="card-img-top" alt="Produto">
            <div class="card-body">
                <h5 class="card-title">Nome Prod</h5>
                <p class="card-text">Descrição do Produto</p>
                <p class="preco">R$19,99</p>
                <a href="#" class="btn btn-primary">Adicionar ao carrinho</a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
