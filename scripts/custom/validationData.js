function validarData() {
    var startDate = document.getElementById('dataI').value;
    var endDate = document.getElementById('dataF').value;
    var currentDate = new Date().toISOString().split('T')[0];

    if (startDate < currentDate) {
        alert("Erro: Data de início de aluguer inválida. A data de início não pode ser anterior à data atual. Por favor, selecione uma data futura para prosseguir com o aluguer.");
        return false;
    }

    if (endDate < currentDate) {
        alert("Erro: Data de término de aluguer inválida. A data de término não pode ser anterior à data atual. Por favor, selecione uma data futura para concluir o aluguer com sucesso.");
        return false;
    }

    if (endDate < startDate) {
        alert("Erro: Data de término de aluguer inválida. A data de término não pode ser anterior à data de início de aluguer. Por favor, selecione uma data posterior à data de início para concluir o aluguer com sucesso.");
        return false;
    }

    return true;
}
