function showAdditionalFields() {
            var role = document.getElementById("role").value;
            var additionalFieldsContainer = document.getElementById("additionalFieldsContainer");
            additionalFieldsContainer.innerHTML = ""; // Clear existing fields

            if (role === "admin") {

                var divElement = document.createElement("div");
                divElement.classList.add("text");

                // Create the input element
                var inputElement = document.createElement("input");
                inputElement.type = "text";
                inputElement.name = "department";

                // Create the span element
                var spanElement = document.createElement("span");

                // Create the label element
                var labelElement = document.createElement("label");
                labelElement.innerHTML = " Department ";


                // Append the input, span, and label elements to the div element
                divElement.appendChild(inputElement);
                divElement.appendChild(spanElement);
                divElement.appendChild(labelElement);

                // Append the div element to the document body or any other desired parent element
                additionalFieldsContainer.appendChild(divElement);

            }
            else if (role === "student") {


                var divElement = document.createElement("div");
                divElement.classList.add("text");

                // Create the input element
                var inputElement = document.createElement("input");
                inputElement.type = "text";
                inputElement.name = "faculty";

                // Create the span element
                var spanElement = document.createElement("span");

                // Create the label element
                var labelElement = document.createElement("label");
                labelElement.innerHTML = " Faculty ";


                // Append the input, span, and label elements to the div element
                divElement.appendChild(inputElement);
                divElement.appendChild(spanElement);
                divElement.appendChild(labelElement);

                // Append the div element to the document body or any other desired parent element
                additionalFieldsContainer.appendChild(divElement);


                var divElement = document.createElement("div");
                divElement.classList.add("text");

                // Create the input element
                var inputElement = document.createElement("input");
                inputElement.type = "text";
                inputElement.name = "batch";

                // Create the span element
                var spanElement = document.createElement("span");

                // Create the label element
                var labelElement = document.createElement("label");
                labelElement.innerHTML = " Batch ";


                // Append the input, span, and label elements to the div element
                divElement.appendChild(inputElement);
                divElement.appendChild(spanElement);
                divElement.appendChild(labelElement);

                // Append the div element to the document body or any other desired parent element
                additionalFieldsContainer.appendChild(divElement);

                // Create the select element
                var divElement = document.createElement("div");
                divElement.classList.add("select");

                // var labelElement = document.createElement("label");
                // labelElement.innerHTML = "Course ";
                var selectElement = document.createElement("select");
                selectElement.name = "course";
                selectElement.id = "mySelect";
                selectElement.classList.add("display-button");

                // Create an array of options
                var options = ["Select Course", "BCA", "CSIT", "BBM"];

                // Loop through the options and create option elements
                for (var i = 0; i < options.length; i++) {
                    var optionElement = document.createElement("option");
                    optionElement.value = i;
                    optionElement.text = options[i];
                    selectElement.appendChild(optionElement);
                }

                // Append the select element to the container
                // divElement.appendChild(labelElement);
                divElement.appendChild(selectElement);
                additionalFieldsContainer.appendChild(divElement);
            }
        }