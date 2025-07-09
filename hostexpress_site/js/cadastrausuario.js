async function buscaCep() {
    if (!$("#cep").val()) {
        alert('Digite um CEP!');
        return;
    }

    let cep = $("#cep").val().replace("-", "").replace(".", "");
    let response = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
    let data = await response.json();

    if(!data || !response.ok){
        alert('CEP inválido');
        return;
    }

    $("#rua").val(data.logradouro);
    $("#bairro").val(data.bairro);
    $("#cidade").val(data.localidade);
    $("#estado").val(data.estado);
}

$("#btn-cadastrar").on('click', function (event) {
    event.preventDefault(); 

    if (!$("#nome").val() || !$("#celular").val() || !$("#email").val() ||
        !$("#senha").val() || !$("#cep").val() || !$("#rua").val() ||
        !$("#bairro").val() || !$("#cidade").val() || !$("#estado").val() || !$("#num").val()) {
        alert("Por favor, preencha todos os campos.");
        return;
    }

    const dados = {
        nome: $("#nome").val(),
        celular: $("#celular").val(),
        email: $("#email").val(),
        senha: $("#senha").val(),
        cep: $("#cep").val(),
        rua: $("#rua").val(),
        bairro: $("#bairro").val(),
        cidade: $("#cidade").val(),
        estado: $("#estado").val(),
        num: $("#num").val(),
        complemento: $("#complemento").val(),
        etapa: 'enviar_codigo'
    };

    $.ajax({
        url: '../banco/cadastrar_usuario.php', 
        type: 'POST',
        dataType: 'json',
        data: dados,
        success: function (res) {
            if (res.success) {
                document.getElementById("codigoModal").style.display = "block";
            } else {
                alert("Erro ao enviar e-mail: " + (res.message || "Erro desconhecido"));
            }
        },
        error: function (xhr, status, error) {
            alert("Erro ao comunicar com o servidor 404: " + error);
            console.error(xhr.responseText);
        }
    });
});

function fecharModal() {
    document.getElementById("codigoModal").style.display = "none";
}

function enviarCodigo() {
    var codigo = document.getElementById("codigoInput").value;

    $.ajax({
        url: '../banco/cadastrar_usuario.php',
        type: 'POST',
        dataType: 'json',
        data: {
            codigo: codigo,
            etapa: 'verificar_codigo'
        },
        success: function (res) {
            console.log("Resposta do servidor:", res);
            if (res.success) {
                alert("Cadastro realizado com sucesso!");
                window.location.href = "login.php";
            } else {
                document.getElementById("erroCodigo").innerText = res.erro || res.message || "Código incorreto.";
            }
        },
        error: function (xhr, status, error) {
            alert("Erro ao comunicar com o servidor 303: " + error);
            console.error(xhr.responseText);
        }
    });
}

$("#buscarcep").on('click', async()=> {
    console.log('cliquei')
    buscaCep();
})