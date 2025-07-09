$(document).ready(function() {    

    localStorage.getItem('endereco') 
        ? $("#cidade").text(localStorage.getItem('endereco')) 
        : PegarCidade();

    function retomar() {
        rolagem = setInterval(()=> {
        $('#cardCarousel').carousel('next');
        }, 8000);
    }
    retomar();

    $("#modalProduto").on("show.bs.modal", ()=> {
        clearInterval(rolagem);
    });

    $("#modalProduto").on("hide.bs.modal", ()=> {
        retomar();
    });

    const city = document.getElementById('btn-city');
    const popover = new bootstrap.Popover(city);
    hist_popover = localStorage.getItem('popovermostrado');

    if(!hist_popover){
        popover.show();
        localStorage.setItem('popovermostrado', true);
    }

    $("#btn-login").on('click', ()=> {
        CarregarPagina('login_fetch');
    });

    $("#btn-cadastrar").on('click', ()=> {
        CarregarPagina('cadastrar_fetch');
    });
    
    const search = document.getElementById('search');

    let pesquisa = '';

    search.addEventListener('keydown', async (e)=> {
        if(!$("#search").val() || $("#search").val().length == 0){
            $("#resultados").empty();
            return;
        }

        if(/^[a-zA-Z]$/.test(e.key) || e.key === ' '){
            pesquisa += e.key;
        }
        else if(e.key === 'Backspace'){
            pesquisa = $("#search").val();
        }
        let result = await BuscarProdutos(pesquisa);
        
        if(!result){
            $(".dropdown-menu").prepend(`<p class="fw-semibold">Nenhum resultado para busca</p>`);
            return;
        }

        $("#resultados").empty();
        
        result.forEach((produto) => {
            $("#resultados").append(`
                <h6>${produto.DESCRICAO}</h6>
            `);
        });
    });

    search.addEventListener('click', async (e)=> {
        $("#resultados").empty();
    });
});

async function CarregarProdutos() {
    let response = await fetch(`./banco/carregar_produtos.php`);
    let produtos = await response.json();
    
    return produtos;
}

async function BuscarProdutos(pesquisa) {
    let response = await fetch(`./banco/buscar_produtos.php?NOME=${pesquisa}`);
    let data = await response.json();

    return data;
}

function cardsProdutos(produto) {
    return `
        <div class="card shadow-lg mb-4 text-dark">
            <img src="./assets/hosttexto.png" class="card-img-top" alt="${produto.DESCRICAO}">
            <div class="card-body">
                <h5 class="card-title">${produto.DESCRICAO}</h5>
                <p class="preco">R$${produto.PRECO_UN}</p>
                <a data-bs-toggle="modal" data-bs-target="#modalProduto" 
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
    console.error('Error loading content:', erro);
  }
}

iniciarCarrossel();


async function carregarModal(id){
    $("#modalProduto .modal-title, #modalProduto .modal-body").empty();

    let response = await fetch(`./banco/busca_info_produto.php?PRODUTO=${id}`);
    let data = await response.json();
    if(!response.ok){   
        $(".modal-body").append(`
            <div class="border border-1 border-danger">
                <h3 class="fs-4 text-center text-danger">Erro ao carregar informações do produto!</h3>
            </div>
        `);
    }

    $(".modal-title").append(`<h3 class="text-primary fs-3 fw-semibold">${data.DESCRICAO}`);

    $(".modal-body").append(`
        <div class="d-flex flex-column">
            <div class="w-100 mt-2">
                <p class="text-center">${data.DESCRICAO}</p>
            </div>
            <div class="w-100 d-flex flex-row justify-content-between mt-2">
                <p>R$${data.PRECO_UN}</p>
                <p>${data.QTD} ${data.UNIDADE}(s)</p>
            </div>
            <button
                class="btn btn-outline-primary align-self-end" 
                onclick="adicionarAoCarrinho(${data.PRODUTO_ID}, '${data.DESCRICAO}', 1, ${data.PRECO_UN})">
                Adicionar ao Carrinho
            </button>
        </div>    
    `);
}

function pegarCoordenadasUsuario() {
  return new Promise((resolve, reject) => {
    if ("geolocation" in navigator) {
      navigator.geolocation.getCurrentPosition(
        function (posicao) {
          const latitude = posicao.coords.latitude;
          const longitude = posicao.coords.longitude;

          $("#coordenadas").val(latitude + "/" + longitude);
          resolve({ latitude, longitude });
        },
        function (erro) {
          console.error("Erro ao obter localização:", erro.message);
          reject(erro);
        }
      );
    } else {
      reject(new Error("Geolocalização não é suportada neste navegador."));
    }
  });
}

async function PegarCidade() {
  try {
    const { latitude, longitude } = await pegarCoordenadasUsuario();

    let response = await fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${latitude}&lon=${longitude}`);
    let data = await response.json();

    $("#cidade").text(
        data.address.quarter ? data.address.quarter + " - " + data.address.city : data.address.city
    );
    localStorage.setItem("endereco", data.address.quarter + "-" + data.address.city);
  } catch (e) {
    console.log(e.message);
  }
}


CarregarProdutos();
PegarCidade();
atualizarBadgeCarrinho();

function adicionarAoCarrinho(id, descricao, quantidade, preco) {
    let carrinho = JSON.parse(localStorage.getItem("carrinho")) || [];

    let existente = carrinho.find(item => item.PRODUTO_ID === id);

    if (existente) {
        existente.quantidade += 1;
        carrinho.length = 0;
        carrinho.push(
            {
                PRODUTO_ID: existente.PRODUTO_ID,
                DESCRICAO: existente.DESCRICAO,
                PRECO_UN: existente.PRECO_UN,
                quantidade: existente.quantidade
            }
        )
    } 
    else {
        carrinho.push(
            {
                PRODUTO_ID: id,
                DESCRICAO: descricao,
                PRECO_UN: parseFloat(preco),
                quantidade: quantidade || 1
            }
        );
    }
    localStorage.removeItem("carrinho");
    localStorage.setItem("carrinho", JSON.stringify([]));
    localStorage.setItem("carrinho", JSON.stringify(carrinho));
    atualizarBadgeCarrinho();
}


function atualizarBadgeCarrinho() {
    $("#carrinho").addClass("d-none");
    let carrinho = JSON.parse(localStorage.getItem("carrinho")) || [];
    let total = carrinho.reduce((sum, item) => sum + item.quantidade, 0);
    
    if( total > 0) {
        $("#carrinho").removeClass("d-none");
    }

    $("#carrinho").text(total > 0 ? total > 99 ? '99+' : total : $("#carrinho").addClass("d-none"));
}

function abrirCarrinho() {
    const carrinho = JSON.parse(localStorage.getItem("carrinho")) || [];
    $("#modal_carrinho .modal-body, #modal_carrinho .modal-title").empty();
    $("#modal_carrinho .modal-title").text("Carrinho de Compras");
    if (carrinho.length === 0) {
        $(".modal-body").html(`<p class='text-center'>O carrinho está vazio.</p>`);
        return;
    }

    let totalGeral = 0;
    carrinho.forEach((item) => {
        const quantidade = item.quantidade || 1;
        const precoUnitario = parseFloat(item.PRECO_UN) || 0;
        const totalItem = precoUnitario * quantidade;
        totalGeral += totalItem;

        $(".modal-body").append(`
            <div class="border-bottom py-2 d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="mb-0">${item.DESCRICAO}</h6>
                    <small>${quantidade} x R$${precoUnitario.toFixed(2)} = R$${totalItem.toFixed(2)}</small>
                </div>
                <button class="btn btn-sm btn-outline-danger" onclick="removerItem(${item.PRODUTO_ID})">Remover</button>
            </div>
        `);
    });

    $(".modal-body").append(`
        <div class="pt-3 text-end">
            <h5>Total: R$ ${totalGeral.toFixed(2)}</h5>
        </div>
    `);
}


function removerItem(id) {
    let carrinho = JSON.parse(localStorage.getItem("carrinho")) || [];
    carrinho = carrinho.filter(item => item.PRODUTO_ID !== id);
    localStorage.setItem("carrinho", JSON.stringify(carrinho));
    atualizarBadgeCarrinho();
    abrirCarrinho();
}

function resetarCarrinho() {
    localStorage.removeItem("carrinho");
    atualizarBadgeCarrinho();

    $(".modal-body").html(`<p class='text-center'>O carrinho está vazio.</p>`);
}


function CarregarPagina(name){
    $(".modal").modal('hide');
    $("#container").innerHTML = '';
    $('#container').load('./php/' + name + '.php', function(response, status, xhr) {
        if (status != 'success') {
            console.error('Error on loading content:', xhr.statusText);
        }
    });
}

$('#search').select2({
    placeholder: "Pesquise por produtos ou lojas ...",
    minimumInputLength: 2,
    ajax: {
        url: './banco/buscar_resultados.php',
        dataType: 'json',
        delay: 250,
        data: function (params) {
            return {
                busca: params.term
            };
        },
        processResults: function (data) {
            return {
                results: data.map((object) => ({
                    id: object.id,
                    text: object.nome
                }))
            };
        },
        cache: true
    }
});