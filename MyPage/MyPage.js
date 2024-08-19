


function formatPhoneNumber(input) {
    const inputValue = input.value.replace(/\D/g, ''); // Remove non-numeric characters
    const match = inputValue.match(/(\d{3})(\d{7})/);
  
    if (match) {
      input.value = `${match[1]}-${match[2]}`;
    } else {
      input.value = inputValue;
    }
  }

  // Function to validate email
  function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}