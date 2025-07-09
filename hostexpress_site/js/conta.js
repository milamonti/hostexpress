function toggleCollapse(targetId) {
    const allCollapses = document.querySelectorAll('.collapse');
    allCollapses.forEach((collapse) => {
    if (collapse.id !== target0,Id) {
        const bsCollapse = new bootstrap.Collapse(collapse, { toggle: false });
        bsCollapse.hide();
    }
    });
}