import { showAlert } from "../utils.js";
import Cart from "../modules/Cart.js";

// Instância da classe Cart
const cart = new Cart();

// Variável usada no setInterval do carrossel
let rollId;

// Inicia o setInterval do carrossel de produtos
export const roll = () => {
  rollId = setInterval(() => {
    $("#cardCarousel").carousel("next");
  }, 8000);
};

// Para o carousel de produtos
export const stopRolling = () => clearInterval(rollId);

// Carrega os cards de produtos no carrossel 
export const loadCarousel = async () => {
  await loadProducts().then((products) => {
    $("#carousel-content").html(createSlides(products));
  });
}

// Carrega os produtos para os cards do carrossel
const loadProducts = async () => {
  try {
    const response = await fetch("./database/api/loadProducts.php")
    .then((res) => res.json());

    if(!response.ok || !result.success) {
      return showAlert("error", "Erro!", "Erro ao buscar os produtos!");
    }
    return result.data;
  } catch (e) {
    console.error(e.message);
    return [];
  }
};

// Estrutura dos cards do carrossel
function productCard(product) {
  return `
    <div class="card shadow-lg mb-4 text-dark">
      <img src="./images/products/${product.FOTO_PRODUTO}" class="card-img-top" alt="${product.DESCRICAO}">
      <div class="card-body">
        <h5 class="card-title">${product.DESCRICAO}</h5>
        <p class="preco">R$${Number(product.PRECO_UN).toFixed(2)}</p>
        <a data-bs-toggle="modal" data-bs-target="#modalProduct" 
          onclick="carregarModal(${product.PRODUTO_ID})"
          class="btn btn-secondary mb-2">
          Visualizar Produto
        </a>
        </div>
    </div>
    `;
}

// Cria os slides
function createSlides(products, groupSize = 3) {
  const slides = [];
  for (let i = 0; i < products.length; i += groupSize) {
    const group = products.slice(i, i + groupSize);
    const htmlCards = group.map(productCard).join("");
    const active = i === 0 ? "active" : "";
    const htmlSlide = `
      <div class="carousel-item ${active} p-1">
        <div class="row justify-content-center p-3" style="margin-top: -10px;">
          ${htmlCards}
        </div>
      </div>
    `;
    slides.push(htmlSlide);
  }
  return slides.join("");
}

// Função global de carregar o modal do produto
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
