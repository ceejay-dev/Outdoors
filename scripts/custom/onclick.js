function botaoFinalizar() {
    // Envia uma requisição para o servidor PHP quando o botão é pressionado
    fetch('minhasSolicitacoesC.php', {
        method: 'POST',
        body: JSON.stringify({botao1Pressionado: true}),
    });
}

function botaoVoltar() {
    // Envia uma requisição para o servidor PHP quando o botão é pressionado
    fetch('minhasSolicitacoesC.php', {
        method: 'POST',
        body: JSON.stringify({botao2Pressionado: true}),
    });
}
