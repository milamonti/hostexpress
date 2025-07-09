import { showAlert } from "./utils.js";

function toggleCollapse(targetId) {
    const allCollapses = document.querySelectorAll('.collapse');
    allCollapses.forEach(collapse => {
        if (collapse.id !== targetId) {
            const bsCollapse = new bootstrap.Collapse(collapse, { toggle: false });
            bsCollapse.hide();
        }
    });
}

$(".collapse").on("show.bs.collapse", async() => {
    let id = $(this).attr('id');
    let response, data;

    switch(id) {
        case('pedidos'):
            response = await fetch(`./banco/searchClientOrders.php`);
            data = await response.json();

            if(!response.ok || !data){
                showAlert('info', 'Erro ao carregar o conteúdo!', 'Entre em contato com o suporte para mais informações!');
                console.error(response.statusText);
                return;
            }
        break;
        case('detalhes'):
            response = await fetch(`./banco/searchClientDetails.php`);
            data = await response.json();

            if(!response.ok || !data){
                showAlert('info', 'Erro ao carregar o conteúdo!', 'Entre em contato com o suporte para mais informações!');
                console.error(response.statusText);
                return;
            }
        break;
        case('endereco'):
            response = await fetch(`./banco/searchClientAddress.php`);
            data = await response.json();

            if(!response.ok || !data){
                showAlert('info', 'Erro ao carregar o conteúdo!', 'Entre em contato com o suporte para mais informações!');
                console.error(response.statusText);
                return;
            }
        break;
        default:
            showAlert('info', 'Erro ao carregar o conteúdo!', 'Entre em contato com o suporte para mais informações!');
        break;
    }
});

window.toggleCollapse = toggleCollapse;