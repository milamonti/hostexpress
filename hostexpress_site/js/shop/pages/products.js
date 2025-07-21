$(document).ready(async () => {
    $('#products').DataTable({
        data: await loadProducts(),
        columns: [
            { data: 'PRODUTO_ID' },
            { data: 'DESCRICAO' },
            { data: 'CATEGORIA' },
            { data: 'PRECO_UN' }
        ]
    } );
});

async function loadProducts() {
    await fetch(`./db/shop/getShopProducts.php`)
    .then((res) => res.json())
    .then((data) => {
        return data;
    })
    .catch((error) => console.error(error.message));
}