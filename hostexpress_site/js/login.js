import { showAlert } from "./utils.js";

async function Login(e) {
    e.preventDefault();
    if (!$("#email").val() || !$("#senha").val()){
        showAlert('error', 'Insira seu usuário e senha!');
    }
    let formData = new FormData();
    formData.append("EMAIL", $("#email").val());
    formData.append("SENHA", $("#senha").val());

    const response = await fetch(`./db/login.php`, {
        body: formData,
        method: "POST"
    });
    const data = await response.json();
    
    if(data.status && data.type === "SHOP"){
        $("#container").innerHTML = '';
        $("#container").load('./php/shop/assets/shopContainer.php', (response, status, xhr) => {
            if(status !== "success") console.log('Error on loading content: ', xhr.responseText);
        })
        $("#navbar").innerHTML = '';
        $("#navbar").load('./php/shop/assets/shopNavbar.php', (response, status, xhr) => {
            if (status !== "success") console.log('Error on loading content: ', xhr.responseText);
        });
    }
    else if (data.status && data.type === "CLIENT") {
        window.location.replace('http://127.0.0.1/hostexpress_site/');
    }
    else showAlert('error', 'Usuário ou senha incorretos!');
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
    