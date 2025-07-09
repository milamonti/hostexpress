import { addCleave, removeMask, showAlert } from "./utils.js";

async function buscaCep() {
    $("#cep").removeAttr('style');
    if (!$("#cep").val() || $("#cep").val().length < 8) {
        showAlert('warning', 'Digite um CEP válido!');
        return;
    }

    let cep = removeMask($("#cep").val());
    let response = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
    let data = await response.json();

    if(data.erro === "true" || !response.ok){
        showAlert('error', 'CEP inválido!');
        $("#cep").css({
            'border-width': '2px',
            'border-style': 'solid',
            'border-color': 'red'
        });
        return;
    }

    $("#rua").val(data.logradouro);
    $("#bairro").val(data.bairro);
    $("#cidade").val(data.localidade);
    $("#estado").val(data.estado);
    $("#cep").css({
        'border-width': '2px',
        'border-style': 'solid',
        'border-color': 'green'
    });
}

$("#cadastrar").on('click', (event)=> {
    event.preventDefault(); 

    if (
        !$("#nome").val() || 
        $("#celular").val().length < 14 || 
        !$("#email").val() ||
        !$("#senha").val() || 
        $("#cep").val().length < 5 || 
        !$("#rua").val() ||
        !$("#bairro").val() || 
        !$("#cidade").val() || 
        !$("#estado").val() || 
        !$("#num").val()
    ) {
        showAlert('warning', 'Por favor preencha todos os campos!');
        return;
    }

    const dados = {
        nome: $("#nome").val(),
        celular: removeMask($("#celular").val()),
        email: $("#email").val(),
        senha: $("#senha").val(),
        cep: removeMask($("#cep").val()),
        rua: $("#rua").val(),
        bairro: $("#bairro").val(),
        cidade: $("#cidade").val(),
        estado: $("#estado").val(),
        num: $("#num").val(),
        complemento: $("#complemento").val(),
        etapa: 'enviar_codigo'
    };

    $.ajax({
        url: './banco/cadastrar_usuario.php', 
        type: 'POST',
        dataType: 'json',
        data: dados,
        success: res => {
            if (res.success) {
                document.getElementById("codigoModal").style.display = "block";
            } else {
                showAlert('error', 'Erro ao enviar e-mail', 'Entre em contato com o suporte', 2000);
            }
        },
        error: xhr => {
            showAlert(
                'error', 
                'Erro ao se comunicar com o servidor', 
                'Entre em contato com o suporte para mais detalhes', 
                2000
            );
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
                showAlert('success', 'Cadastro realizado!')
                .then(
                    window.location.href = "login.php"
                );
            } else {
                document.getElementById("erroCodigo").innerText = res.erro || res.message || "Código incorreto.";
            }
        },
        error: function (xhr, status, error) {
            showAlert('error', 'Erro ao se comunicar com o servidor!', 'Entre em contato com o suporte para mais detalhes', 2000);
            console.error(xhr.responseText);
        }
    });
}

$("#buscarcep").on('click', async()=> buscaCep());

addCleave('celular', "phone");
addCleave('cep', 'cep');

window.fecharModal = fecharModal;
window.enviarCodigo = enviarCodigo;
