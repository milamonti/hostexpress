import { showAlert } from "./utils";

async function Login(e) {
    e.preventDefault();
    if (!$("#email").val() || !$("#senha").val()){
        showAlert('error', 'Insira seu usuário e senha!');
    }
    let formData = new FormData();
    formData.append("EMAIL", $("#email").val());
    formData.append("SENHA", $("#senha").val());

    let response = await fetch(`./banco/login.php`, {
        body: formData,
        method: "POST"
    });
    let data = await response.json();
    
    if(data.status !== false){
      window.location.replace('http://127.0.0.1/hostexpress_site/');
    }
    else{
      showAlert('error', 'Usuário ou senha incorretos!');
    }
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
    