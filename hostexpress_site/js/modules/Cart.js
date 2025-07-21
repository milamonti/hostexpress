export default class Cart {
    openCart() {
        const carrinho = JSON.parse(localStorage.getItem("carrinho")) || [];
        $("#modalCart .modal-body, #modalCart .modal-title").empty();
        $("#modalCart .modal-title").text("Carrinho de Compras");
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
                    <button id="remove_${item.PRODUTO_ID}" class="btn btn-sm btn-outline-danger">Remover</button>
                </div>
            `);
            $(`#remove_${item.PRODUTO_ID}`).on('click', () => {
                this.removeItem(item.PRODUTO_ID);
            });
        });

        $(".modal-body").append(`
            <div class="pt-3 text-end">
                <h5>Total: R$ ${totalGeral.toFixed(2)}</h5>
            </div>
        `);
    };

    removeItem(id) {
        let carrinho = JSON.parse(localStorage.getItem("carrinho")) || [];
        carrinho = carrinho.filter(item => item.PRODUTO_ID !== id);
        localStorage.setItem("carrinho", JSON.stringify(carrinho));
        this.updateCartBadge();
        this.openCart();
    };

    resetCart() {
        localStorage.removeItem("carrinho");
        this.updateCartBadge();

        $(".modal-body").html(`<p class='text-center'>O carrinho está vazio.</p>`);
    };
    
    updateCartBadge() {
        $("#carrinho").addClass("d-none");
        let carrinho = JSON.parse(localStorage.getItem("carrinho")) || [];
        let total = carrinho.reduce((sum, item) => sum + item.quantidade, 0);
    
        if( total > 0) {
            $("#carrinho").removeClass("d-none");
        }

        $("#carrinho").text(total > 0 ? total > 99 ? '99+' : total : $("#carrinho").addClass("d-none"));
    };

    addToCart(id, descricao, quantidade, preco) {
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
        this.updateCartBadge();
    }
}