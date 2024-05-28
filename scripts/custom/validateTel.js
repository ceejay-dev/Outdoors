$(document).ready(function () {
    // Function to validate the phone number
    function validatePhoneNumber() {
      // Get the input value
      var inputValue = $('#telefone').val();

      // Regular expression to validate phone number format
      var phoneRegex = /^\d{10}$/;

      // Get the validation message element
      var validationMessageElement = $('#validationMessage');

      // Check if the input value matches the phone regex
      if (phoneRegex.test(inputValue)) {
        // Input is a valid phone number
        validationMessageElement.text('Valid phone number');
        validationMessageElement.css('color', 'green');
      } else {
        // Input is not a valid phone number
        validationMessageElement.text('Invalid phone number');
        validationMessageElement.css('color', 'red');
      }
    }

    // Add input event listener to the input field
    $('#inputPhone').on('input', validatePhoneNumber);
  });