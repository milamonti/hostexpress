import { addCleave, fetchConfig, handleResponse, removeMask, showAlert, toggleInput } from "./utils.js";
import validator from "./modules/Validator.js";

$(document).ready(function() {
  //Adiciona as cleaves
  addCleave("telefone", "phone");
  addCleave("cep", "cep");
  addCleave("cnpj", "cnpj");

  //Event Listeners
  toggleInput("icone");
  $("#searchcep").on("click", buscaCep);
  
  $('input[name="account-type"]').on("change", () => {
    if ($("#shop").is(":checked")) {
      $("#shopInfo").removeClass("d-none");
      $('label[for="nome"]').text("Nome Fantasia");
      $("#cnpj").prop("disabled", false);
      $("#razao-fantasia").prop("disabled", false);
      $("#especialidade").prop("disabled", false);
    } else {
      $("#shopInfo").addClass("d-none");
      $("#cnpj").prop("disabled", true);
      $("#razao-fantasia").prop("disabled", true);
      $("#especialidade").prop("disabled", true);
    }
  });
  
  $("#cep").on("input", () => {
    if ($("#cep").val().length === 9) buscaCep();
  });
});

async function buscaCep() {
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

$("#clientForm").on("submit", function(e) {
  e.preventDefault();
  
  const form = this;
  const formData = new FormData(form);
  
  if(validator.validateFields(formData)) {
    verifyCode(formData.get("EMAIL"), formData);
  }
});

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

async function verifyCode(email, body) {
  const code = Math.floor(100000 + Math.random() * 900000);

  const formData = new FormData();
  formData.append("CODE", code);
  formData.append("EMAIL", email);

  const response = await fetch(
    `./database/api/verifyCode.php`, fetchConfig("POST", formData)
  ).then((res) => res.json());

  if (!response.success) {
    return showAlert(
      "error",
      "Erro ao confirmar a conta!",
      "Entre em contato com o suporte!",
      2000
    );
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
