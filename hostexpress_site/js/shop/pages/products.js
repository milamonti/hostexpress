import { fetchConfig, mostrarLoading, ocultarLoading, showAlert } from "../../utils.js";

// Carrega o datatable
$(document).ready(loadDatatable);

async function loadProducts() {
  try {
    const res = await fetch(`./database/api/shop/getShopProducts.php`);
    const result = await res.json();
    return result.data || [];
  } catch (error) {
    console.error(error.message);
    return [];
  }
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
      return showAlert("error", "Erro ao cadastrar o produto!", result.message);
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

  await fetch("./database/api/upload.php" , fetchConfig("POST", formData))
  .then((response) => response.json())
  .then((result) => {
    showAlert(
      result.success ? "success" : "error",
      result.success 
        ? "Produto cadastrado!"
        : "Erro ao cadastrar a foto do produto!",
        result.success ? '' : result.message,
        2000
    );
    $("#modalAddProduct").modal('hide');
    loadDatatable();
  });
}

async function loadDatatable() {
  ocultarLoading('#products');
  if($.fn.dataTable.isDataTable("#products")){
    $("#products").DataTable().clear().destroy();
  }
  const products = await loadProducts() || [];
  mostrarLoading('#products');
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
    return showAlert("error", "Preencha todos os campos!");
  }
  const formData = new FormData();
  formData.append("ID", $("#productId").val());
  formData.append("DESCR", $("#editDescr").val());
  formData.append("CATEGORY", $("#editCategory").val());
  formData.append("UNITY", $("#editUnity").val());
  formData.append("PRICE", $("#editPrice").val());
  formData.append("QTD", $("#editQtd").val());

  await fetch("./database/api/shop/editProduct.php", fetchConfig("POST", formData))
  .then((res) => res.json())
  .then((result) => {
    showAlert(
      result.success ? "success" : "error", 
      result.success ? "Cadastro alterado!" : "Erro ao alterar cadastro do produto!",
      result.success ? '' : result.message,
      2000
    );
    if(result.success) {
      $("#modalEditProduct").modal("hide");
      loadDatatable();
    }
  }).catch((e) => console.error(e.message));
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

  await fetch("./database/api/shop/deleteProduct.php", fetchConfig("POST", formData))
  .then((res) => res.json())
  .then((result) => {
    showAlert(
      result.success ? "success" : "error", 
      result.success ? "Produto excluído!" : "Erro ao excluir produto!",
      result.success ? '' : result.message,
      2000
    );
    if(result.success) loadDatatable();
  });
};
