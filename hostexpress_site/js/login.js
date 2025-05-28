async function Login() {
    if (!$("#email").val() || !$("#senha").val()){
        alert('preencha todos os campos!');
    }
    let formData = new FormData();
    formData.append("EMAIL", $("#email").val());
    formData.append("SENHA", $("#senha").val());

    let response = await fetch(`../banco/login.php`, {
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

$(document).ready(function () {
    $('#ver_senha').click(function () {
        const input = $('#senha');
        const icone = $('#icone');

        if (input.attr('type') === 'password') {
          input.attr('type', 'text');
          icone.removeClass('bi-eye').addClass('bi-eye-slash');
        } else {
          input.attr('type', 'password');
          icone.removeClass('bi-eye-slash').addClass('bi-eye');
        }
    });
});