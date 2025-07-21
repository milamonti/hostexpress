import { showAlert } from "./utils.js";
import Cart from "./modules/Cart.js";
import getUserLocation from "./modules/Location.js";

$(document).ready(() => {   
    let rolling = null;
    
    function carouselRoll(){
        rolling = setInterval(()=> {
            $('#cardCarousel').carousel('next');
        }, 8000);
    }

    function stopRolling() {
        clearInterval(rolling);
    }
    
    carouselRoll();

    //Event Listeners
    $("#modalProduct").on("show.bs.modal", ()=> stopRolling());
    $("#modalProduct").on("hide.bs.modal", ()=> carouselRoll());
    $("#btn-login").on('click', ()=> LoadPage('login'));
    $("#btn-cadastrar").on('click', ()=> LoadPage('register'));
	$("#modalCart").on('show.bs.modal', () => {
        cart.openCart();
        $("#btn-reset").on('click', () => cart.resetCart());
    }); 
});

const cart = new Cart();
cart.updateCartBadge();



async function CarregarProdutos() {
    const response = await fetch(`./db/carregar_produtos.php`).catch(e => {
        console.log(e);
    })
    return await response.json();
}

async function BuscarProdutos(pesquisa) {
    const response = await fetch(`./db/buscar_produtos.php?NOME=${pesquisa}`).catch(e => {
        console.log(e);
    });
    return await response.json();
}

function cardsProdutos(produto) {
    return `
        <div class="card shadow-lg mb-4 text-dark">
            <img src="./assets/hosttexto.png" class="card-img-top" alt="${produto.DESCRICAO}">
            <div class="card-body">
                <h5 class="card-title">${produto.DESCRICAO}</h5>
                <p class="preco">R$${produto.PRECO_UN}</p>
                <a data-bs-toggle="modal" data-bs-target="#modalProduct" 
                    onclick="carregarModal(${produto.PRODUTO_ID})"
                    class="btn btn-secondary mb-2">
                    Visualizar Produto
                </a>
            </div>
        </div>
    `;
}

function criarSlides(produtos, tamanhoGrupo = 3) {
  const slides = [];
  for (let i = 0; i < produtos.length; i += tamanhoGrupo) {
    const grupo = produtos.slice(i, i + tamanhoGrupo);
    const cardsHTML = grupo.map(cardsProdutos).join('');
    const ativo = i === 0 ? 'active' : '';
    const slideHTML = `
      <div class="carousel-item ${ativo} p-1">
        <div class="row justify-content-center p-3" style="margin-top: -10px;">
          ${cardsHTML}
        </div>
      </div>
    `;
    slides.push(slideHTML);
  }
  return slides.join('');
}

async function iniciarCarrossel() {
  try {
    const produtos = await CarregarProdutos();
    const carouselContent = document.getElementById('carousel-content');
    carouselContent.innerHTML = criarSlides(produtos);
  } catch (erro) {
    console.error('Error on loading content:', erro);
  }
}

iniciarCarrossel();
localStorage.getItem('address')
    ? $("#cidade").text(localStorage.getItem('address'))
    : getUserLocation().then((result) => {
        $("#cidade").text(
            result.address.neighbourhood ?
                `${result.address.neighbourhood} - ${result.address.city}`
                : `${result.address.city}`
        );
        localStorage.setItem('address', $("#cidade").text());
    })
    .catch((e) => {
        console.error('Error getting user location:', e);
    });

async function carregarModal(id){
    $("#modalProduct .modal-title, #modalProduct .modal-body").empty();

    const response = await fetch(`./db/shop/getProductInfo.php?PRODUTO=${id}`).catch(e => {
        console.log(e);
    });
    const result = await response.json();
    if(!response.ok || !result.success){   
        $(".modal-body").append(`
            <div class="border border-1 border-danger">
                <h3 class="fs-4 text-center text-danger">Erro ao carregar informações do produto!</h3>
            </div>
        `);
    }

    $(".modal-title").append(`<h3 class="text-primary fs-3 fw-semibold">${result.data.DESCRICAO}`);

    $(".modal-body").append(`
        <div class="d-flex flex-column">
            <div class="w-100 mt-2">
                <p class="text-center">${result.data.DESCRICAO}</p>
            </div>
            <div class="w-100 d-flex flex-row justify-content-between mt-2">
                <p>R$${result.data.PRECO_UN}</p>
                <p>${result.data.QTD} ${result.data.UNIDADE}(s)</p>
            </div>
            <button id="addToCart"
                class="btn btn-outline-primary align-self-end">
                Adicionar ao Carrinho
            </button>
        </div>    
    `);
    $("#addToCart").on('click', () => {
        cart.addToCart(result.data.PRODUTO_ID, result.data.DESCRICAO, result.data.QUANTIDADE, result.data.PRECO_UN);
    });
}

$('#search').select2({
    placeholder: "Pesquise por produtos ou lojas ...",
    minimumInputLength: 2,
    ajax: {
        url: './db/buscar_resultados.php',
        dataType: 'json',
        delay: 250,
        data: params => {
            return {
                busca: params.term
            };
        },
        processResults: data => {
            return {
                results: data.map(object => ({
                    id: object.id,
                    text: object.nome
                }))
            };
        },
        cache: true
    }
});

async function Logout(){
    await fetch(`./db/logout.php`).then(() => reloadPage())    
    .catch((e) => {
        showAlert('error', 'Erro ao sair da conta', 'Feche a aba para encerrar a sessão!');
        console.error(e.message);
    });
}

window.Logout = Logout;
window.carregarModal = carregarModal;
window.BuscarProdutos = BuscarProdutos;
