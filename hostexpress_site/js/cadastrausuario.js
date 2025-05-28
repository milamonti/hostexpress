function buscaCep() {
    if (!$("#cep").val()) {
        alert('Por favor, digite um CEP!');
        return;
    }

    let cep = $("#cep").val().replace("-", "").replace(".", "");
    if (cep !== "") {
        let url = "https://brasilapi.com.br/api/cep/v1/" + cep;
        let req = new XMLHttpRequest();
        req.open("GET", url);
        req.send();

        req.onload = function() {
            if (req.status === 200) {
                let endereco = JSON.parse(req.response);
                document.getElementById("rua").value = endereco.street;
                document.getElementById("bairro").value = endereco.neighborhood;
                document.getElementById("cidade").value = endereco.city;
                document.getElementById("estado").value = endereco.state;
            } else if (req.status === 404) {
                alert("CEP inválido");
            } else {
                console.log("Erro ao fazer requisição");
            }
        };
    }
}

$("#btn-cadastrar").on('click', async function(e) {
    e.preventDefault();

    if (!$("#nome").val() || 
        !$("#celular").val() || 
        !$("#email").val() || 
        !$("#senha").val() || 
        !$("#cep").val() || 
        !$("#rua").val() || 
        !$("#bairro").val() || 
        !$("#cidade").val() || 
        !$("#estado").val() || 
        !$("#num").val()) {
        
        alert('Por favor, preencha todos os campos obrigatórios!');
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
    url: 'cadastrousuario.php',
    type: 'POST',
    data: dados,
    success: function (res) {
        console.log("Resposta convertida:", res); 
        if (res.success) {
            document.getElementById("codigoModal").style.display = "block";
        } else {
            alert("Erro ao enviar e-mail: " + res.message);
        }
    }
    });
});

function fecharModal() {
    document.getElementById("codigoModal").style.display = "none"; 
}

function enviarCodigo() {
    var codigo = document.getElementById("codigoInput").value;

    $.ajax({
        url: 'cadastrousuario.php',
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
                window.location.replace = "../php/login.php"; 
            } else {
                document.getElementById("erroCodigo").innerText = res.message || "Código incorreto.";
            }
        },
        error: function (xhr, status, error) {
            alert("Erro ao comunicar com o servidor: " + error);
            console.error(xhr.responseText);
        }
    });
}
