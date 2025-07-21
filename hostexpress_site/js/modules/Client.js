import { showAlert } from "../utils.js";

export default class Client {
    async getClientDetails() {
        try {
            const response = await fetch(`./db/client/getClientDetails.php`);
            const result = await response.json();
    
            if(!response.ok || !result.success){
                throw new Error(result.message || "Erro ao buscar os dados do cliente!");
            }
        
            this.name = result.data.NOME;
            this.email = result.data.EMAIL;
            this.phone = result.data.TELEFONE;
            this.address = {
                street: result.data.ENDERECO,
                number: result.data.ENDERECO_NUM,
                neighborhood: result.data.BAIRRO,
                city: result.data.CIDADE,
                cep: result.data.CEP,
                complement: result.data.COMPLEMENTO
            };
        } catch (e) {
            showAlert(
                "error", 
                "Erro ao buscar dados cadastrais!", 
                e.message || "Tente novamente mais tarde ou entre em contato com o suporte"
            );
        }
    };
}