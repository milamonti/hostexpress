import Cart from "./modules/Cart.js";
import * as carousel from "./modules/Carousel.js";
import handleUserLocation from "./modules/Location.js";

$(document).ready(() => {
  // Inicia o carrossel de produtos
  carousel.loadCarousel().then(carousel.roll);

  // Busca a localização do usuário
  handleUserLocation();

  // Event Listeners
  $("#modalProduct").on("show.bs.modal", carousel.stopRolling);
  $("#modalProduct").on("hide.bs.modal", carousel.roll);
  $("#modalCart").on("show.bs.modal", () => {
    cart.openCart();
    $("#btn-reset").on("click", cart.resetCart.bind(cart));
  });
  $("#search").on("change", () => {
    loadPage('store/searchProduct', { id: $("#search").val()});
  });
});

// Instancia a classe Cart
const cart = new Cart();
cart.updateCartBadge();

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
