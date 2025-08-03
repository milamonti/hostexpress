import { fetchConfig, showAlert, toggleInput } from "./utils.js";

$(document).ready(() => {
  // Adiciona o event listener de visualizar a senha
  toggleInput("icone");
});

// Expõe globalmente a função de Login
window.Login = async (e) => {
  e.preventDefault();
  if (!$("#email").val() || !$("#senha").val()) {
    showAlert("error", "Insira seu usuário e senha!");
    return;
  }
  const formData = new FormData();
  formData.append("EMAIL", $("#email").val());
  formData.append("SENHA", $("#senha").val());

  await fetch("./database/api/login.php", fetchConfig("POST", formData))
  .then((response) => response.json())
  .then((result) => {
    if(!result.success) {
      showAlert("error", result.message);
      return;
    }
    reloadPage();
  });
}
