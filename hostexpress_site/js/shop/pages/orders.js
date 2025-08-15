import { showAlert } from "../../utils.js";

$(document).ready(() => {
  // Carregar datatable
  loadDatatable();
  // Event Listener ao clicar
  $("#refreshOrders").on("click", loadDatatable);
});

//pedidos
let pedidos = [
  {
    id: 1,
    cliente: "Ronaldo",
    itens: [
      { descr: "Cimento", qtd: 1, preco: 45.9 },
      { descr: "Geso 2L", qtd: 1, preco: 10.0 },
    ],
    total: 55.9,
    status: "PENDENTE",
    criado: "2025-08-12 09:30",
  },
  {
    id: 2,
    cliente: "Fio Jasmin",
    itens: [
      { descr: "grr", qtd: 2, preco: 18.5 },
      { descr: "Cano PVC", qtd: 2, preco: 7.0 },
    ],
    total: 51.0,
    status: "A_CAMINHO",
    criado: "2025-08-12 09:45",
  },
];

// status
function statusBadge(status) {
  const map = {
    PENDENTE: "bg-secondary",
    A_CAMINHO: "bg-warning text-dark",
    ENTREGUE: "bg-success",
    CANCELADO: "bg-danger",
  };
  return `<span class="badge ${
    map[status] || "bg-light text-dark"
  }">${status.replace("_", " ")}</span>`;
}

// tabela
async function loadDatatable() {
  $.fn.dataTable.ext.errMode = "none";
  if ($.fn.DataTable.isDataTable("#ordersTable")) {
    $("#ordersTable").DataTable().destroy();
  }

  $("#ordersTable").DataTable({
    data: pedidos, // await getOrders()
    columns: [
      { data: "id" },
      { data: "cliente" },
      {
        data: null,
        render: (row) =>
          row.itens.map((i) => `${i.descr} x${i.qtd}`).join("<br>"),
      },
      { data: "total", render: (t) => t.toFixed(2) },
      { data: "status", render: statusBadge },
      { data: "criado" },
      {
        data: null,
        orderable: false,
        render: (row) => `
          <div class="btn-group">
            <button class="btn btn-sm btn-outline-primary" onclick="showItems(${row.id})">
              <i class="bi bi-list"></i>
            </button>
            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown"></button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#" onclick="changeStatus(${row.id}, 'PENDENTE')">Pendente</a></li>
              <li><a class="dropdown-item" href="#" onclick="changeStatus(${row.id}, 'A_CAMINHO')">A caminho</a></li>
              <li><a class="dropdown-item" href="#" onclick="changeStatus(${row.id}, 'ENTREGUE')">Entregue</a></li>
              <li><a class="dropdown-item text-danger" href="#" onclick="changeStatus(${row.id}, 'CANCELADO')">Cancelar</a></li>
            </ul>
          </div>
        `,
      },
    ],
  });
}

// mudança de status
window.changeStatus = (id, status) => {
  Swal.fire({
    title: "Alterar status?",
    text: `Deseja alterar para "${status.replace("_", " ")}"?`,
    icon: "question",
    showCancelButton: true,
    confirmButtonText: "Sim",
    cancelButtonText: "Não",
  }).then((res) => {
    if (res.isConfirmed) {
      const pedido = pedidos.find((p) => p.id === id);
      if (pedido) pedido.status = status;
      loadDatatable();
      showAlert("success", "Status alterado!");
    }
  });
};

// Ver itens no modal
window.showItems = (id) => {
  const pedido = pedidos.find((p) => p.id === id);
  if (!pedido) return;

  const html = pedido.itens.map((i) => `
    <div><strong>${i.descr}</strong> — Qt: ${i.qtd} — 
      R$ ${i.preco.toFixed(2)}
    </div>
  `).join("");

  $("#orderItemsContainer").html(html);
  $("#modalOrderItems").modal("show");
};

async function getOrders() {
  const response = await fetch("./database/api/shop/getOrders.php")
  .then((res) => res.json());

  return response.data || [];
}
