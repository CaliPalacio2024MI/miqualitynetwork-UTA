function fetchAndLoadProcessCharts(processId, el) {
    fetch(`/bsc/processes/${processId}/subprocesses`)
        .then(res => res.json())
        .then(data => loadProcessCharts(el, data));
}
function fetchAndLoadPropiedadCharts(propiedadId, el) {
    fetch(`/propiedades/${propiedadId}/processes`)
        .then(res => res.json())
        .then(data => loadPropiedadCharts(el, data));
}