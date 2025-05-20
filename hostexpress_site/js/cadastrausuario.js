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

$("#formCadastro").on('submit', async function(e) {
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

    let formData = new FormData(this);

    let response = await fetch('./cadastrousuario.php', {
        method: 'POST',
        body: formData
    });

    let data = await response.json();

    if (data.success) {
        alert('Usuário cadastrado com sucesso!');
        window.location.href = 'index.html';
    } else {
        alert('Erro ao cadastrar usuário: ' + (data.Message || 'Tente novamente mais tarde.'));
    }
});

window.onload = function() {
    fetch('cadastrar.php')
        .then(response => response.json())
        .then(data => {
            const bairro = data.bairro;

            const locDiv = document.querySelector('.loc');
            if (bairro && bairro !== 'Bairro não encontrado') {
                locDiv.textContent = `Seu bairro: ${bairro}`;
            } else {
                locDiv.textContent = 'Bairro não encontrado ou erro no sistema';
            }
        })
        .catch(error => {
            console.log('Erro ao buscar bairro:', error);
            const locDiv = document.querySelector('.loc');
            locDiv.textContent = 'Erro ao carregar o bairro';
        });
};
