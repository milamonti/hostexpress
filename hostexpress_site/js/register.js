import { addCleave, fetchConfig, removeMask, showAlert } from "./utils.js";

addCleave("telefone", "phone");
addCleave("cep", "cep");
addCleave("cnpj", "cnpj");

const senhaInput = document.getElementById("senha");
const icone = document.getElementById("icone");

icone.addEventListener("click", () => {
  const isPassword = senhaInput.type === "password";
  senhaInput.type = isPassword ? "text" : "password";

  icone.classList.toggle("bi-eye");
  icone.classList.toggle("bi-eye-slash");
});

$('input[name="account-type"]').on("change", () => {
  if ($("#shop").is(":checked")) {
    $("#shopInfo").removeClass("d-none");
    $('label[for="nome"]').text("Nome Fantasia");
  } else $("#shopInfo").addClass("d-none");
});

$("#cep").on("input", () => {
  if ($("#cep").val().length === 9) buscaCep();
});

$("#searchcep").on("click", buscaCep);

async function buscaCep() {
  $("#cep").removeAttr("style");
  if (!$("#cep").val() || $("#cep").val().length < 9) {
    showAlert("warning", "Digite um CEP válido!");
    return;
  }
  let cep = removeMask($("#cep").val());

  try {
    let response = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
    let data = await response.json();

    if (data.erro === "true" || !response.ok) {
      showAlert("error", "CEP inválido!");
      $("#cep").css({
        "border-width": "2px",
        "border-style": "solid",
        "border-color": "red",
      });
      return;
    }
    $("#endereco").val(data.logradouro);
    $("#bairro").val(data.bairro);
    $("#cidade").val(data.localidade);
    $("#cep").css({
      "border-width": "2px",
      "border-style": "solid",
      "border-color": "green",
    });
  } catch (e) {
    console.error(data || response.statusText);
  }
}

$("#register").on("click", () => {
  if (
    !$("#nome").val() ||
    $("#telefone").val().length < 14 ||
    !$("#email").val() ||
    !$("#senha").val() ||
    $("#cep").val().length < 9 ||
    !$("#endereco").val() ||
    !$("#bairro").val() ||
    !$("#cidade").val() ||
    !$("#endereco_num").val()
  ) {
    showAlert("error", "Preencha todas as informações!");
    return;
  }
  let formData = new FormData();
  formData.append("NOME", $("#nome").val());
  formData.append("TELEFONE", removeMask($("#telefone").val()));
  formData.append("EMAIL", $("#email").val());
  formData.append("SENHA", $("#senha").val());
  formData.append("CEP", removeMask($("#cep").val()));
  formData.append("ENDERECO", $("#endereco").val());
  formData.append("ENDERECO_NUM", $("#endereco_num").val());
  formData.append("BAIRRO", $("#bairro").val());
  formData.append("CIDADE", $("#cidade").val());
  formData.append("COMPLEMENTO", $("#complemento").val());

  verifyCode($("#email").val(), formData);
});

async function registerShop(formData) {
  if (
    $("#cnpj").val().length < 18 ||
    !$("#razao-social").val() ||
    !$("#especialidade").val()
  ) {
    showAlert("warning", "Por favor preencha todos os campos!");
    return;
  }

  formData.append("CNPJ", removeMask($("#cnpj").val()));
  formData.append("ESPECIALIDADE", $("#especialidade").val());
  formData.append("RAZAO_SOCIAL", $("#razao-social").val());

  let response = await fetch(`./database/api/shop/registerShop.php`, fetchConfig);

  if (!response.ok) {
    console.error(response.statusText);
  }
  showAlert(
    response.ok ? "success" : "error",
    response.ok ? "Loja cadastrada!" : "Erro ao cadastrar loja!",
    !response.ok
      ? "Tente novamente mais tarde ou entre em contato com o suporte para mais detalhes"
      : "",
    !response.ok ? 2000 : 1500
  );
}
async function registerClient(formData) {
  let response = await fetch(`./database/api/client/registerClient.php`, fetchConfig);

  if (!response.ok) {
    console.error(response.statusText);
  }

  showAlert(
    response.ok ? "success" : "error",
    response.ok ? "Cadastro realizado!" : "Erro ao se cadastrar!",
    !response.ok
      ? "Tente novamente mais tarde ou entre em contato com o suporte para mais detalhes"
      : ""
  );
}

async function verifyCode(email, body) {
  const code = Math.floor(100000 + Math.random() * 900000);

  let formData = new FormData();
  formData.append("CODE", code);
  formData.append("EMAIL", email);

  let response = await fetch(`./database/api/verifyCode.php`, fetchConfig);
  let data = await response.json();

  if (!data.status) {
    showAlert(
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
      if (value && Number(value) !== code) return "Código incorreto!";
    },
  });
  if (verification) {
    if ($("#shopInfo").hasClass("d-none")) registerClient(body);
    else registerShop(body);
  }
}
