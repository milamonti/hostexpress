import Cart from "../modules/Cart.js";

$(document).ready(() => {
  const cart = Cart.getCartItems();
  if(cart.length === 0 ) {
    $("#product-list").html(`
      <li class='list-group-item text-center text-muted'>Nenhum produto no momento.</li>
    `);
    return;
  }
  let total = 0;
  cart.forEach(addItem);
  $("#total-produtos, #resumo-valor-produtos, #fullPrice").html(
    `Total: R$${total.toFixed(2).replace(".", ",")}`
  );
});

function addItem(item) {
  const quantidade = item.quantidade || 1;
  const price = parseFloat(item.PRECO_UN) || 0;
  const subtotal = quantidade * price;
  total += subtotal;
  $(`<li class='list-group-item d-flex justify-content-between align-items-center'>
    ${item.DESCRICAO}
    <span class="badge bg-primary rounde-pill">
      ${quantidade} x R$ ${price.toFixed(2).replace(".", ",")}
    </span>
  `).appendTo("#product-list");
};
