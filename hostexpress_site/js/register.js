import { addCleave, fetchConfig, handleResponse, removeMask, showAlert, toggleInput } from "./utils.js";
import validator from "./modules/Validator.js";

$(document).ready(function() {
  //Adiciona as cleaves
  addCleave("telefone", "phone");
  addCleave("cep", "cep");
  addCleave("cnpj", "cnpj");

  //Event Listeners
  toggleInput("icone");
  $("#searchcep").on("click", getCep);
  
  $('input[name="account-type"]').on("change", () => {
    $("#shopInfo").toggleClass("d-none");
    if ($("#shop").is(":checked")) {
      $('label[for="nome"]').text("Nome Fantasia");
    }
  });
  
  // Realiza automaticamente a busca pelo CEP quando o length for 9
  $("#cep").on("input", () => {
    if ($("#cep").val().length === 9) getCep();
  });

  $(document).on("submit", "#clientForm", function (e) {
    e.preventDefault();

    const form = this;
    if (validator.validateFields(form)) {
      const formData = new FormData(form);
      verifyCode(formData);
    }
  });
});

/**
 * Função que faz uma requisição na API do viacep,
 * buscando o endereço completo do CEP fornecido.
 */
async function getCep() {
  $("#cep").removeAttr("style");
  const cep = removeMask($("#cep").val());
  if (cep.length !== 8) {
    showAlert("warning", "Digite um CEP válido!");
    return;
  }

  try {
    const address = await fetch(`https://viacep.com.br/ws/${cep}/json/`)
    .then((res) => res.json());

    if (address.erro === "true") {
      showAlert("error", "CEP inválido!");
      $("#cep").css({
        "border-width": "2px",
        "border-style": "solid",
        "border-color": "red",
      });
      return;
    }
    $("#endereco").val(address.logradouro);
    $("#bairro").val(address.bairro);
    $("#cidade").val(address.localidade);
    $("#cep").css({
      "border-width": "2px",
      "border-style": "solid",
      "border-color": "green",
    });
  } catch (e) {
    console.error(e.message);
  }
}

async function registerShop(formData) {
  const response = await fetch(
    `./database/api/shop/registerShop.php`, fetchConfig("POST", formData)
  )
  .then((res) => res.json());

  handleResponse(response);
}
async function registerClient(formData) {
  const response = await fetch(
    `./database/api/client/registerClient.php`, fetchConfig("POST", formData)
  )
  .then((res) => res.json());

  handleResponse(response);
}

/**
 * Função que envia um código via e-mail para o usuário
 * e valida ele com um SweetAlert
 * @param {FormData} body Corpo/Formulário do cadastro 
 * @returns 
 */
async function verifyCode(body) {
  const code = Math.floor(100000 + Math.random() * 900000);
  console.log(code);

  const formData = new FormData();
  formData.append("CODE", code);
  formData.append("EMAIL", body.get("email"));

  const response = await fetch(
    `./database/api/verifyCode.php`, fetchConfig("POST", formData)
  ).then((res) => res.json());

  if (!response.success) {
    showAlert(
      "error",
      "Erro ao confirmar a conta!",
      "Entre em contato com o suporte!",
      2000
    );
    return;
  }

  const { value: verification } = await Swal.fire({
    title: "Insira o código enviado ao seu e-mail",
    input: "text",
    inputLabel: "Código de 6 digitos",
    inputPlaceholder: "Insira o código",
    inputValidator: value => {
      if (!value) return "Digite o código!";
      if (value.length !== 6) return "O código enviado é de 6 dígitos!"
      if (value && Number(value) !== code) return "Código incorreto!";
    }
  });
  if (verification) {
    if ($("#shopInfo").hasClass("d-none")) {
      registerClient(body);
    } else {
      registerShop(body);
    }
  }
}
