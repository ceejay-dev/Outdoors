function habilitarDesabilitarInput() {
    var select = document.getElementById('tipo');
    var input = document.getElementById('atividade');

    if (select.value === 'particular') {
        input.disabled = true; // Desabilitar o input
    } else if (select.value === 'empresarial'){
        input.disabled = false; // Habilitar o input
    }
}