import { fetchConfig, showAlert, toggleInput } from "./utils.js";

$(document).ready(() => {
  toggleInput("icone");
});

window.Login = async (e) => {
  e.preventDefault();
  if (!$("#email").val() || !$("#senha").val()) {
    return showAlert("error", "Insira seu usuário e senha!");
  }
  const formData = new FormData();
  formData.append("EMAIL", $("#email").val());
  formData.append("SENHA", $("#senha").val());

  await fetch("./database/api/login.php", fetchConfig("POST", formData))
  .then((response) => response.json())
  .then((result) => {
    if(!result.success) return showAlert("error", result.message);
    reloadPage();
  });
}
