import Client from "../modules/Client.js";

const client = new Client();
client.getClientDetails();

$(".collapse").on("shown.bs.collapse", async function() {
    const id = $(this).attr('id');

    switch(id) {
        case('orders'):
        break;
        case('details'):
            $("#name").text(client.name);
            $("#email").text(client.email);
            $("#telefone").text(client.phone);
        break;
        case('address'):
            $("#endereco").text(
                `${client.address.street}, ${client.address.number} - ${client.address.neighborhood}`
            );
            $("#complements").text(
                `${client.address.cep}, ${client.address.city} - SP`
            );
        break;
        default:
            $(`#${id}.collapse p`).text(`
                Erro ao buscar as informações cadastrais!    
            `);
        break;
    }
});