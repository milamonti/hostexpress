<div class="card shadow-sm mb-3">
    <div class="card-header bg-primary text-white">
        <h5 class="card-title">Produtos</h5>
    </div>
    <div class="card-body">
        <div class="row" id="product-card">
            <table class="display" id="products">
                <thead>
                    <tr>
                        <th>Descrição</th>
                        <th>Categoria</th>
                        <th>Unidade</th>
                        <th>Preço</th>
                        <th></th>
                    </tr>
                </thead>
            </table>
            <!-- Product items will be dynamically loaded here -->
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#products').DataTable({
            ajax: {
                url: './db/getProducts.php',
                dataSrc: ''
            },
            columns: [
                { data: 'DESCRICAO', render: function(data) { return `<img src="${data}" alt="Product Image" width="50">`; } },
                { data: 'CATEGORIA' },
                { data: 'description' },
                { data: 'price', render: $.fn.dataTable.render.number(',', '.', 2, 'R$ ') },
                { data: null, defaultContent: '<button class="btn btn-primary add-to-cart">Adicionar ao Carrinho</button>' }
            ]
        });

        $('#products tbody').on('click', '.add-to-cart', function() {
            var data = $('#products').DataTable().row($(this).parents('tr')).data();
            addToCart(data);
        });
    });

    function addToCart(product) {
        // Logic to add product to cart
        console.log('Produto adicionado ao carrinho:', product);
    }