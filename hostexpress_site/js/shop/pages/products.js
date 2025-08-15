import { fetchConfig, handleResponse, showAlert } from "../../utils.js";

// Carrega o datatable
$(document).ready(loadDatatable);

async function loadProducts() {
  return await fetch(`./database/api/shop/getShopProducts.php`)
  .then((res) => res.json())
  .then((result) =>  result.data || []);
}

window.addProduct = async () => {
  if(
    !$("#descr").val() ||
    !$("#price").val() ||
    !$("#qtd").val() ||
    !$("#unity").val() ||
    !$("#photo").val() ||
    !$("#category").val()
  ) return showAlert("error", "Preencha todas as informações!");
  
  const formData = new FormData();
  formData.append("DESCR", $("#descr").val());
  formData.append("PRICE", $("#price").val());
  formData.append("QTD", $("#qtd").val());
  formData.append("UNITY", $("#unity").val());
  formData.append("CATEGORY", $("#category").val());
  await fetch("./database/api/shop/addProduct.php", fetchConfig("POST", formData))
  .then((response) => response.json())
  .then((result) => {
    if(!result.success) {
      showAlert("error", "Erro ao cadastrar o produto!", result.message);
      return;
    }
    uploadPhoto(result.data.productId);
  })
}

async function uploadPhoto(id) {
  const input = document.getElementById('photo');
  const photo = input.files[0];

  const formData = new FormData();
  formData.append("photo", photo);
  formData.append("id", id);

  const response = await fetch(
    "./database/api/upload.php" , fetchConfig("POST", formData))
  .then((res) => res.json())

  handleResponse(response);

  $("#modalAddProduct").modal('hide');
  loadDatatable();
}

async function loadDatatable() {
  $.fn.dataTable.ext.errMode = 'none';
  if($.fn.dataTable.isDataTable("#products")){
    $("#products").DataTable().clear().destroy();
  }
  const products = await loadProducts() || [];
  const datatable = $("#products").DataTable({
    data: products,
    columns: [
      { title: "ID", data: "PRODUTO_ID" },
      { title: "Descrição", data: "DESCRICAO" },
      { title: "Categoria", data: "CATEGORIA" },
      { title: "Unidade", data: "UNIDADE" },
      { title: "Quantidade", data: "QTD" },
      { title: "Preço (R$)", data: "PRECO_UN",
        render: (data, type, row) => {
          return Number(row.PRECO_UN).toFixed(2);
        }
      },
      { title: "", data: null,
        orderable: false,
        searchable: false,
        render: (data, type, row, meta) => {
          return `
            <button class='btn btn-sm btn-outline-primary me-1' title='Editar' onclick='openModal(${meta.row})'>
              <i class='bi bi-pencil'></i>
            </button>
            <button class='btn btn-sm btn-outline-danger' title='Excluir' onclick='handleDeleteProduct(${row.PRODUTO_ID})'>
              <i class='bi bi-trash'></i>
            </button>
          `;
        }
      }
    ],
    responsive: true,
    language: {
      url: "assets/lang/pt-BR.json"
    }
  });
  
  return datatable;
}

window.openModal = index => {
  const rowData = $("#products").DataTable().row(index).data();
  $("#modalEditProduct").modal('show');
  $(".modal-title").text(`Editar ${rowData.DESCRICAO}`);
  
  $("#productId").val(rowData.PRODUTO_ID);
  $("#editDescr").val(rowData.DESCRICAO);
  $("#editCategory").val(rowData.CATEGORIA);
  $("#editUnity").val(rowData.UNIDADE);
  // $("#editPhoto").val(rowData.FOTO_ARQUIVO);
  $("#editPrice").val(rowData.PRECO_UN);
  $("#editQtd").val(rowData.QTD);
};

window.editProduct = async () => {
  if(
    !$("#editDescr").val() ||
    !$("#editCategory").val() ||
    !$("#editUnity").val() ||
    !$("#editPrice").val() ||
    !$("#editQtd").val()
  ) {
    showAlert("error", "Preencha todos os campos!");
    return;
  }
  const formData = new FormData();
  formData.append("ID", $("#productId").val());
  formData.append("DESCR", $("#editDescr").val());
  formData.append("CATEGORY", $("#editCategory").val());
  formData.append("UNITY", $("#editUnity").val());
  formData.append("PRICE", $("#editPrice").val());
  formData.append("QTD", $("#editQtd").val());

  const response = await fetch(
    "./database/api/shop/editProduct.php", fetchConfig("POST", formData))
  .then((res) => res.json())
  
  handleResponse(response);
  if(result.success) {
    $("#modalEditProduct").modal("hide");
    loadDatatable();
  }
};

window.handleDeleteProduct = id => {
  Swal.fire({
    title: "Você tem certeza que deseja excluir este item?",
    icon: 'question',
    showCancelButton: true,
    confirmButtonText: "Sim",
    cancelButtonText: "Não"
  }).then((result) => {
    if (result.isConfirmed) deleteProduct(id);
  });
};

window.deleteProduct = async id => {
  const formData = new FormData();
  formData.append("ID", id);

  const response = await fetch(
    "./database/api/shop/deleteProduct.php", {
    method: "DELETE",
    body: JSON.stringify({ id: id })
  })
  .then((res) => res.json());
  
  handleResponse(response);
  if(response.success) loadDatatable();
};
 