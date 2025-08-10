import { showAlert } from "../utils.js";

export default class Client {
  async getClientDetails() {
    const response = await fetch(`./database/api/client/getClientDetails.php`)
    .then((res) => res.json());

    if (!response.success) {
      showAlert("error", "Erro!", "Erro ao buscar seus dados cadastrais!");
      return;
    }

    if(response.data.length === 0){
      showAlert(
        "warning", 
        "Atenção!", 
        "Nenhuma informação sobre seu cadastro foi encontrada", 
        2000
      );
      return;
    }

    this.name = response.data.NOME;
    this.email = response.data.EMAIL;
    this.phone = response.data.TELEFONE;
    this.address = {
      street: response.data.ENDERECO,
      number: response.data.ENDERECO_NUM,
      neighborhood: response.data.BAIRRO,
      city: response.data.CIDADE,
      cep: response.data.CEP,
      complement: response.data.COMPLEMENTO,
    };
  }
}
