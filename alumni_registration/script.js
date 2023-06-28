// function showAdditionalFields() {
//             var role = document.getElementById("role").value;
//             var additionalFieldsContainer = document.getElementById("additionalFieldsContainer");
//             additionalFieldsContainer.innerHTML = ""; // Clear existing fields

//             if (role === "admin") {

//                 var divElement = document.createElement("div");
//                 divElement.classList.add("text");

//                 // Create the input element
//                 var inputElement = document.createElement("input");
//                 inputElement.type = "text";
//                 inputElement.name = "department";

//                 // Create the span element
//                 var spanElement = document.createElement("span");

//                 // Create the label element
//                 var labelElement = document.createElement("label");
//                 labelElement.innerHTML = " Department ";


//                 // Append the input, span, and label elements to the div element
//                 divElement.appendChild(inputElement);
//                 divElement.appendChild(spanElement);
//                 divElement.appendChild(labelElement);

//                 // Append the div element to the document body or any other desired parent element
//                 additionalFieldsContainer.appendChild(divElement);

//             }
//             else if (role === "student") {


//                 var divElement = document.createElement("div");
//                 divElement.classList.add("text");

//                 // Create the input element
//                 var inputElement = document.createElement("input");
//                 inputElement.type = "text";
//                 inputElement.name = "faculty";

//                 // Create the span element
//                 var spanElement = document.createElement("span");

//                 // Create the label element
//                 var labelElement = document.createElement("label");
//                 labelElement.innerHTML = " Faculty ";


//                 // Append the input, span, and label elements to the div element
//                 divElement.appendChild(inputElement);
//                 divElement.appendChild(spanElement);
//                 divElement.appendChild(labelElement);

//                 // Append the div element to the document body or any other desired parent element
//                 additionalFieldsContainer.appendChild(divElement);


//                 var divElement = document.createElement("div");
//                 divElement.classList.add("text");

//                 // Create the input element
//                 var inputElement = document.createElement("input");
//                 inputElement.type = "text";
//                 inputElement.name = "batch";

//                 // Create the span element
//                 var spanElement = document.createElement("span");

//                 // Create the label element
//                 var labelElement = document.createElement("label");
//                 labelElement.innerHTML = " Batch ";


//                 // Append the input, span, and label elements to the div element
//                 divElement.appendChild(inputElement);
//                 divElement.appendChild(spanElement);
//                 divElement.appendChild(labelElement);

//                 // Append the div element to the document body or any other desired parent element
//                 additionalFieldsContainer.appendChild(divElement);

//                 // Create the select element
//                 var divElement = document.createElement("div");
//                 divElement.classList.add("select");

//                 // var labelElement = document.createElement("label");
//                 // labelElement.innerHTML = "Course ";
//                 var selectElement = document.createElement("select");
//                 selectElement.name = "course";
//                 selectElement.id = "mySelect";
//                 selectElement.classList.add("display-button");

//                 // Create an array of options
//                 var options = ["Select Course", "BCA", "CSIT", "BBM"];

//                 // Loop through the options and create option elements
//                 for (var i = 0; i < options.length; i++) {
//                     var optionElement = document.createElement("option");
//                     optionElement.value = i;
//                     optionElement.text = options[i];
//                     selectElement.appendChild(optionElement);
//                 }

//                 // Append the select element to the container
//                 // divElement.appendChild(labelElement);
//                 divElement.appendChild(selectElement);
//                 additionalFieldsContainer.appendChild(divElement);
//             }
//         }



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
