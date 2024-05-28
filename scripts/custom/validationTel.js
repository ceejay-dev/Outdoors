var telefoneInput = document.getElementById('telefone');

telefoneInput.addEventListener('input', function() {
  validarTelefone();
});

function validarTelefone() {
  var telefone = telefoneInput.value;
  var pattern = /^\d+$/; // Expressão regular que aceita apenas dígitos

  if (!pattern.test(telefone)) {
    telefoneInput.setCustomValidity("O número de telefone deve conter apenas dígitos.");
  } else {
    telefoneInput.setCustomValidity("");
  }
}
