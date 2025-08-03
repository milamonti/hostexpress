<?php

require_once 'database/config/config.php';
include_once 'database/modules/authManager.php';
$auth = new Auth();

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HostExpress</title>
    <link rel="shortcut icon" type="image/x-icon" href="./assets/caminhaobranco-removebg-preview.ico">

	  <!--Helpers-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.min.css">

	  <!--Icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <style>
      .search-container {
        width: 600px;
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
      .overlay {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.2);
        pointer-events: all;
        z-index: 2;
        transition: 0.3s;
        animation: pulseOverlay 3s infinite ease-in-out;
      }
      @keyframes pulseOverlay {
        0%, 100% {
          background-color: rgba(0, 0, 0, 0.2);
        }
        50% {
          background-color: rgba(0, 0, 0, 0.4);
        }
      }
      .error-msg {
        color: red;
        font-weight: 300;
        font-size: medium;
      }
  	</style>

</head>
<body class="d-flex flex-column align-items-center w-100">
  
  <!--Navbar -->
  <?php 
    if(($auth->isLoggedIn() && !$auth->hasRole('SHOP')) || !$auth->isLoggedIn()) {
      include_once 'php/navbar.php'; 
    } else {
      include_once 'php/shop/assets/shopNavbar.php';
    }
	?>
  <!--/Navbar-->

	<!--Container --> 
  <div id="container" class="container">
    <?php 
      if(($auth->isLoggedIn() && !$auth->hasRole('SHOP')) || !$auth->isLoggedIn()) {
        include_once 'php/container.php';
      } else {
        include_once 'php/shop/assets/shopContainer.php';
      }
    ?>
  </div>
	<!--/Container-->


  <!--Footer --> 
  <?php include_once 'php/footer.php'; ?>
  <!--/Footer-->

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0/dist/cleave.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/multiform-validator@2.6.1/dist/index.min.js"></script>

	<script>
        
    function loadPage(path, params = {}){
      $(".modal").modal('hide');
			$("#container").html('');
      
      const queryString = new URLSearchParams(params).toString();
      const url = `./php/${path}.php${queryString ? '?' + queryString : ''}`;

			$('#container').load(url, (response, status, xhr) => {
        if (status != 'success') {
          console.error('Error on loading content:', xhr.statusText);
          return;
				}
			});
		}
		
		function reloadPage(){
      location.reload();
		}
		
  </script>

  <?php 
    if(($auth->isLoggedIn() && !$auth->hasRole('SHOP')) || !$auth->isLoggedIn()) {
      echo '<script type="module" src="./js/main.js?a=<?php echo microtime(true); ?>"></script>';
    } else {
      echo '<script src="./js/shop/main.js?a=<?php echo microtime(true); ?>"></script>';
    }
  ?>
	
</body>

<!-- Product Modal -->
<div class="modal fade" id="modalProduct" tabindex="-1" aria-labelledby="modalProduct" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body"></div>
    </div>
  </div>
</div>

<!-- Cart Modal -->
<div class="modal fade" id="modalCart" tabindex="-1" aria-labelledby="modalCart" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-primary"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-danger" id="btn-reset">Esvaziar Carrinho</button>
          <button type="button" class="btn btn-primary" onclick="loadPage('client/cart')">Finalizar Compra</button>
        </div>
    </div>
  </div>
</div>

</html>
