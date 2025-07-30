import { showAlert } from "../utils.js";

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
    const response = await fetch("./database/api/loadProducts.php");
    const result = await response.json();

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