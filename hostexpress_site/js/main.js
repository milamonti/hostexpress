import Cart from "./modules/Cart.js";
import getUserLocation from "./modules/Location.js";
import * as carousel from "./modules/Carousel.js";

$(document).ready(() => {
  // Inicia o carrossel
  carousel.loadCarousel().then(carousel.roll);

  // Event Listeners
  $("#modalProduct").on("show.bs.modal", carousel.stopRolling);
  $("#modalProduct").on("hide.bs.modal", carousel.roll);
  $("#modalCart").on("show.bs.modal", () => {
    cart.openCart();
    $("#btn-reset").on("click", cart.resetCart.bind(cart));
  });
});

// Instancia a classe Cart
const cart = new Cart();
cart.updateCartBadge();

localStorage.getItem("address")
  ? $("#cidade").text(localStorage.getItem("address"))
  : getUserLocation()
    .then((result) => {
      $("#cidade").text(
        result.address.neighbourhood
          ? `${result.address.neighbourhood} - ${result.address.city}`
          : `${result.address.city}`
      );
      localStorage.setItem("address", $("#cidade").text());
    }).catch((e) => {
      console.error("Error getting user location:", e);
    });


window.carregarModal = async id => {
  $("#modalProduct .modal-title, #modalProduct .modal-body").empty();

  const response = await fetch(
    `./database/api/shop/getProductInfo.php?PRODUTO=${id}`
  ).catch((e) => console.log(e));

  const result = await response.json();
  const { PRODUTO_ID, DESCRICAO, PRECO_UN, UNIDADE, QTD } = result.data;
  
  if (!response.ok || !result.success) {
    $(".modal-body").append(`
        <div class="border border-1 border-danger">
        <h3 class="fs-4 text-center text-danger">Erro ao carregar informações do produto!</h3>
      </div>
    `);
  }

  $(".modal-title").append(
    `<h3 class="text-primary fs-3 fw-semibold">${DESCRICAO}`
  );

  $(".modal-body").append(`
    <div class="d-flex flex-column">
      <div class="w-100 mt-2">
        <p class="text-center">${DESCRICAO}</p>
      </div>
      <div class="w-100 d-flex flex-row justify-content-between mt-2">
        <p>R$${PRECO_UN}</p>
        <p>${QTD} ${UNIDADE}(s)</p>
      </div>
      <button id="addToCart"
        class="btn btn-outline-primary align-self-end">
        Adicionar ao Carrinho
      </button>
    </div>    
  `);
  $("#addToCart").on("click", () => {
    cart.addToCart(PRODUTO_ID, DESCRICAO, PRECO_UN);
  });
}

// Instancia a barra de pesquisa
$("#search").select2({
  placeholder: "Pesquise por produtos ou lojas ...",
  minimumInputLength: 2,
  ajax: {
    url: "./database/api/buscar_resultados.php",
    dataType: "json",
    delay: 250,
    data: (params) => {
      return {
        busca: params.term,
      };
    },
    processResults: (data) => {
      return {
        results: data.map((object) => ({
          id: object.id,
          text: object.nome,
        })),
      };
    },
    cache: true,
  },
});

window.Logout = async () => {
  await fetch(`./database/api/logout.php`)
  .then((response) => response.json())
  .then((result) => {
    if(!result.success) return showAlert("error", "Erro!", result.message);
    reloadPage();
  });
}
