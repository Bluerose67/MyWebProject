<?php
session_start();
include('../connect.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title> Registration Form</title>
</head>

<body>
    <div class="container">
        <div class="center">
            <?php
            if (isset($_SESSION["status"])) {
                $status = $_SESSION["status"];
                echo "<span>$status</span>";
            }
            ?>
            <h1>Register New Admin </h1>
            <form action="insertAdmin.php" method="post" enctype="multipart/form-data">
                <div class="text">

                    <input type="text" id="username" name="user_name" required>
                    <span> </span>
                    <label for="username">Username</label>
                </div>

                <div class="text">

                    <input type="email" id="email" name="email" required>
                    <span> </span>
                    <label for="email">Email</label>
                </div>

                <div class="text">

                    <input type="text" id="password" name="password" required>
                    <span> </span>
                    <label for="address">Password</label>
                </div>
                <div class="text">

                    <input type="text" id="address" name="address" required>
                    <span> </span>
                    <label for="address">Address</label>
                </div>

                <div class="text">

                    <input type="date" id="DOB" name="DOB" required>
                    <span> </span>
                    <label for="DOB">Date of Birth</label>
                </div>

                <div class="text">

                    <input type="tel" id="phone" name="phone_no" required>
                    <span> </span>
                    <label for="phone">Phone</label>
                </div>
                <div class="textt">

                    <input type="file" id="image" name="image" required>

                </div>

                <div class="text1">

                    <select id="role" name="role" class="display-button">
                        <option value="">Select Role</option>
                        <option value="admin">Admin</option>
                        <option value="student">Student</option>
                        <!-- Add more role options as needed -->
                    </select>

                </div>

                <div class="text">

                    <input type="text" id="department" name="department" required>
                    <span> </span>
                    <label for="Faculty">Department</label>
                </div>

                <!-- <div id="additionalFieldsContainer"></div> -->

                <input type="submit" value="Register" />
                <button class="display-button"> <a href="../DB_Superadmin/Dashboard.php">Display Records</a>
                </button>
            </form>
        </div>
    </div>
    <script>
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
    </script>
</body>

</html>