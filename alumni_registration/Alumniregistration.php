<?php
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
            <form action="insertAlumni.php" method="post">
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

                <div class="text1">

                    <select id="role" name="role" class="display-button">
                        <option value="">Select Role</option>
                        <option value="admin">Admin</option>
                        <option value="student">Student</option>
                        <!-- Add more role options as needed -->
                    </select>

                </div>

                <div class="text">

                    <input type="text" id="faculty_name" name="faculty_name" required>
                    <span> </span>
                    <label for="Faculty">Faculty</label>
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
                        <option value="CSIT">BBM</option>
                        <!-- Add more role options as needed -->
                    </select>

                </div>

                <!-- <div id="additionalFieldsContainer"></div> -->

                <input type="submit" value="Register" />
                <button class="display-button"> <a href="../DB_Admin/Dashboard_alumni.php">Display Records</a>
                </button>
            </form>
        </div>
    </div>
</body>

</html>