async function CarregarProdutos() {
    let response = await fetch(`./banco/carregar_produtos.php`);
    let data = await response.json();

    data.forEach(produto => {
        $("#row").append(`
            <div class="col-md-3 mb-4">
                <div class="card shadow-lg" style="width: 18rem;">
                    <img src="./assets/hosttexto.png" class="card-img-top" alt="Produto 1">
                    <div class="card-body">
                        <h5 class="card-title">${produto.DESCRICAO}</h5>
                        <p class="preco">R$${produto.PRECO_UN}</p>
                        <a data-bs-toggle="modal" data-bs-target="#modalProduto" onclick="carregarModal(${produto.PRODUTO_ID})"class="btn btn-secondary mb-2">oi Produto</a>
                        <a href="#" class="btn btn-primary btn-add-carrinho" data-produto='${JSON.stringify(produto)}'>Adicionar ao carrinho</a>
                    </div>
                </div>
            </div>    
        `);
    });
    $(".btn-add-carrinho").on("click", function (e) {
        e.preventDefault();
        
        let produto = JSON.parse($(this).attr("data-produto"));
        adicionarAoCarrinho(produto);
        $("#modal_carrinho").modal("show");
    });
}

async function carregarModal(id) {
    $("#modalProduto .modal-title, #modalProduto .modal-body").empty();

    let response = await fetch(`./banco/busca_info_produto.php?PRODUTO=${id}`);
    let data = await response.json();

    if (!response.ok || !data) {
        $(".modal-body").append(`
            <div class="border border-1 border-danger">
                <h3 class="fs-4 text-center text-danger">Erro ao carregar informações do produto!</h3>
            </div>
        `);
        return;
    }

    $(".modal-title").append(`<h3 class="text-primary fs-3 fw-semibold">${data.DESCRICAO}</h3>`);

    $(".modal-body").append(`
        <div class="d-flex flex-column">
            <div class="w-100 mt-2">
                <p class="text-center">${data.DESCRICAO}</p>
            </div>
            <div class="w-100 d-flex flex-row justify-content-between mt-2">
                <p>R$${data.PRECO_UN}</p>
                <p>${data.QTD} ${data.UNIDADE} por unidade</p>
            </div>
            <a href="#" class="btn btn-primary" onclick='adicionarAoCarrinho(${JSON.stringify(data)})'>Adicionar ao carrinho</a>
        </div>    
    `);
}



function adicionarAoCarrinho(produto) {
    let carrinho = JSON.parse(localStorage.getItem("carrinho")) || [];

    let existente = carrinho.find(item => item.PRODUTO_ID === produto.PRODUTO_ID);

    if (existente) {
        existente.quantidade += 1;
    } else {
        carrinho.push({ ...produto, quantidade: 1 });
    }

    localStorage.setItem("carrinho", JSON.stringify(carrinho));
    atualizarBadgeCarrinho();
}


function atualizarBadgeCarrinho() {
    let carrinho = JSON.parse(localStorage.getItem("carrinho")) || [];
    let total = carrinho.reduce((sum, item) => sum + item.quantidade, 0);

    let badge = document.getElementById("carrinho");
    badge.innerText = total > 99 ? "99+" : total;
}

function abrirCarrinho() {
    const carrinho = JSON.parse(localStorage.getItem("carrinho")) || [];
    const container = document.getElementById("conteudoCarrinho");
    container.innerHTML = "";

    if (carrinho.length === 0) {
        container.innerHTML = "<p class='text-center'>O carrinho está vazio.</p>";
        return;
    }

    let totalGeral = 0;

    carrinho.forEach(item => {
        const quantidade = item.quantidade || 1;
        const precoUnitario = parseFloat(item.PRECO_UN) || 0;
        const totalItem = precoUnitario * quantidade;
        totalGeral += totalItem;

        container.innerHTML += `
            <div class="border-bottom py-2 d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="mb-0">${item.DESCRICAO}</h6>
                    <small>${quantidade} x R$${precoUnitario.toFixed(2)} = R$${totalItem.toFixed(2)}</small>
                </div>
                <button class="btn btn-sm btn-outline-danger" onclick="removerItem(${item.PRODUTO_ID})">Remover</button>
            </div>
        `;
    });

    container.innerHTML += `
        <div class="pt-3 text-end">
            <h5>Total: R$ ${totalGeral.toFixed(2)}</h5>
        </div>
    `;
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

    const container = document.getElementById("conteudoCarrinho");
    container.innerHTML = "<p class='text-center'>O carrinho está vazio.</p>";
}



atualizarBadgeCarrinho();
CarregarProdutos();
