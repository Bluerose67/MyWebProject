/* validation script--------------------------------------------------------------- */

// Get form element
const form = document.querySelector('form');

// Add submit event listener to the form
form.addEventListener('submit', function (event) {
  // Prevent form submission
  event.preventDefault();

  // Perform validation
  if (validateForm()) {
    // If the form is valid, submit it
    form.submit();
  }
});

// Function to validate the form
function validateForm() {
  // Get form fields
  const username = document.getElementById('username').value;
  const email = document.getElementById('email').value;
  const password = document.getElementById('password').value;
  const address = document.getElementById('address').value;
  const dob = document.getElementById('DOB').value;
  const phone = document.getElementById('phone').value;
  const role = document.getElementById('role').value;

  // Validate each field
  if (!username || !email || !password || !address || !dob || !phone || !role) {
    alert('Please fill in all fields.');
    return false;
  }

  if (username.includes('@') || username.includes('#') || username.includes('$') || username.includes('%')) {
    alert('Username should not contain special characters.');
    return false;
  }

  if (password.length < 8) {
    alert('Password should be 8 or more characters.');
    return false;
  }

  // Return true if all validations pass
  return true;
}

/* validation script ends--------------------------------------------------------------- */

