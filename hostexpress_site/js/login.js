import { fetchConfig, showAlert } from "./utils.js";

async function Login(e) {
  e.preventDefault();
  if (!$("#email").val() || !$("#senha").val()) {
    return showAlert("error", "Insira seu usuário e senha!");
  }
  let formData = new FormData();
  formData.append("EMAIL", $("#email").val());
  formData.append("SENHA", $("#senha").val());

  await fetch("./database/api/login.php", fetchConfig("POST", formData))
  .then((response) => response.json())
  .then((result) => {
    if(!result.success) return showAlert("error", result.message);
    reloadPage();
  });
}

const senhaInput = document.getElementById("senha");
const icone = document.getElementById("icone");

icone.addEventListener("click", () => {
  const isPassword = senhaInput.type === "password";
  senhaInput.type = isPassword ? "text" : "password";

  icone.classList.toggle("bi-eye");
  icone.classList.toggle("bi-eye-slash");
});

window.Login = Login;
