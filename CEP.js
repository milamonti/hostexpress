function buscaCep(){ 
    if(!$("#cep").val()){
        //dar um alert 'digite um cep!'
    }
    let cep = $("#cep").val().replace("-","").replace(".","");
    if(cep !== ""){
        let url = "https://brasilapi.com.br/api/cep/v1/" + cep;

        let req = new XMLHttpRequest();
        req.open("GET", url);
        req.send();

        req.onload = function(){
            if(req.status === 200){
                let endereco = JSON.parse(req.response);
                document.getElementById("rua").value = endereco.street;
                document.getElementById("bairro").value = endereco.neighborhood;
                document.getElementById("cidade").value = endereco.city;
                document.getElementById("estado").value = endereco.state;
            }
            else if(req.status === 404){
                alert("Cep inválido");
            }
            else {
                console.log("Erro ao fazer requisição");
            }
        }
    }
}