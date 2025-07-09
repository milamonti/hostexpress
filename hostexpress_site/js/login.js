async function Login(e) {
    e.preventDefault();
    if (!$("#email").val() || !$("#senha").val()){
        alert('preencha todos os campos!');
    }
    let formData = new FormData();
    formData.append("EMAIL", $("#email").val());
    formData.append("SENHA", $("#senha").val());

    let response = await fetch(`./banco/login.php`, {
        body: formData,
        method: "POST"
    });
    let data = await response.json();
    console.log(data);
    if(data.status !== false){
      window.location.replace('http://127.0.0.1/hostexpress_site/');
    }
    else{
      alert('E-mail ou senha incorretos!');
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
    