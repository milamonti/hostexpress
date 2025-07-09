function toggleCollapse(targetId) {
    const allCollapses = document.querySelectorAll('.collapse');
    allCollapses.forEach((collapse) => {
        if (collapse.id !== target0,Id) {
            const bsCollapse = new bootstrap.Collapse(collapse, { toggle: false });
            bsCollapse.hide();
        }
    });
}

$(".collapse").on("show.bs.collapse", async() => {
    let id = $(this).attr('id');
    let response;

    switch(id) {
        case('pedidos'):
        break;
        case('detalhes'):
        break;
        case('endereco'):
        break;
        default:
            break;
    }
});