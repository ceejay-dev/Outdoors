function alertaAlterar(){
    alert("Deve trocar a sua palavra passe no primeiro login. Será redirecionado para a página em que o fará.");
}

function alertaPassword(){
    alert("As passwords devem coincidir.");
}

function alertaEmail(){
    alert("Os emails devem coincidir.");
}

function alertaSucesso(){
    alert("Operação realizada com sucesso!");
}

function alertaAluguer(){
    alert("Aluguer solicitado com sucesso ! Será redirecionado para as suas solicitações para concluir o processo.");
}

function alertaAluguerFail(){
    alert("Erro na solicitação de outdoor! Tente novamente.");
}

function alertaFalha(){
    alert("Erro na operação!! Tente novamente");
}

function alertaContaCriada(){
    alert("Conta criada com sucesso!");
}

function alertaContaFail(){
    alert("Erro na criação da conta, tente novamente!");
}

function alertaDados(){
    alert("Já temos um usuário registrado com dados semelhantes");
}

function alertaCredencias(){
    alert("Credenciais inválidas.");    
}

function alertaContaInativa(){
    alert("A conta precisa ser ativada pelo administrador.");
}

function alertaGestor(){
    alert("Bem vindo gestor!");
}

function alertaOutdoorCriado(){
    alert("Outdoor criado com sucesso!");
}

function alertaOutdoorFail(){
    alert("Erro ao criar outdoor.");
}

function verificarCheckbox(checkbox) {
  var inputTexto1 = document.getElementById("inputTexto1");
  var inputTexto2 = document.getElementById("inputTexto2");

  if (checkbox.id === "checkboxSim") {
    inputTexto1.disabled = checkbox.checked;
  } else if (checkbox.id === "checkboxNao") {
    inputTexto2.disabled = checkbox.checked;
  }
}

/*
 * 
 * <input type="checkbox" id="checkboxSim" onclick="verificarCheckbox(this)">
<label for="checkboxSim">Sim</label>

<input type="checkbox" id="checkboxNao" onclick="verificarCheckbox(this)">
<label for="checkboxNao">Não</label>

<input type="text" id="inputTexto1" placeholder="digite o seu CPF">

<input type="text" id="inputTexto2" placeholder="Digite o seu NIF">
    
 */