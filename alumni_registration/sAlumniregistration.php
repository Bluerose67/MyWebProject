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
            <h1>Register New Alumni</h1>
            <form action="insertAlumni.php" method="post" enctype="multipart/form-data">
                <h4>
                    <?php
                    if (isset($_SESSION['dublicate_name'])) {
                        echo $_SESSION['dublicate_name'];
                        unset($_SESSION['dublicate_name']);
                    } ?>

                </h4>
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

                <div class="text-display">
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
                </div>
                <div class="textt">

                    <input type="file" id="image" name="image" required>

                </div>

                <div class="text1">

                    <select id="role" name="role" class="display-button">
                        <option value="">Select Role</option>
                        <option value="student">Student</option>
                        <!-- Add more role options as needed -->
                    </select>

                </div>

                <div class="text1">

                    <select id="faculty_name" name="faculty_name" class="display-button">
                        <option value="">Select Faculty</option>
                        <option value="Humanities">Humanities</option>
                        <option value="Science">Science</option>
                        <option value="Management">Management</option>
                        <!-- Add more faculty options as needed -->
                    </select>

                </div>

                <div class="text">

                    <input type="text" id="batch_no" name="batch_no" required>
                    <span> </span>
                    <label for="Batch">Batch</label>
                </div>

                <div class="text1">

                    <select id="course" name="course_name" class="display-button">
                        <option value="">Select Course</option>
                        <option value="BCA">BCA</option>
                        <option value="CSIT">CSIT</option>
                        <option value="BBM">BBM</option>
                        <!-- Add more role options as needed -->
                    </select>

                </div>

                <!-- <div id="additionalFieldsContainer"></div> -->

                <?php
                if (!isset($_SESSION['username'])) { ?>

                    <input type="submit" value="Register" />
                    <button class="display-button"> <a href="../Landing_pages/index.php">Go Back</a>
                    </button>

                <?php } else {

                    if ($_SESSION['role'] == 'super_admin') { ?>

                        <input type="submit" value="Register" />
                        <button class="display-button"> <a href="../DB_Superadmin/alumni_list.php">Display Records</a>
                        </button>

                    <?php } elseif ($_SESSION['role'] == 'admin') { ?>

                        <input type="submit" value="Register" />
                        <button class="display-button"> <a href="../DB_Admin/alumni_list.php">Display Records</a>
                        </button>

                    <?php } else { ?>

                        <input type="submit" value="Register" />

                    <?php }

                } ?>
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
            const facultyName = document.getElementById('faculty_name').value;
            const batchNo = document.getElementById('batch_no').value;
            const course = document.getElementById('course').value;

            // Validate each field
            if (!username || !email || !password || !address || !dob || !phone || !role || !facultyName || !batchNo || !course) {
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