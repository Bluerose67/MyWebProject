<?php

include('../connect.php');
if ($_POST) {
    $name = $_POST['user_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $DOB = $_POST['DOB'];
    $phone = $_POST['phone'];
    $role = $_POST['role'];
    $department = $_POST['department'];
    $faculty = $_POST['faculty'];
    $batch = $_POST['batch'];
    $course = $_POST['course'];

    // Insert into 'users' table
    $sql1 = "INSERT INTO users (user_name, email, password, address, DOB, Phone_no)
                 VALUES ('$name', '$email', '$password', '$address', '$DOB', '$phone')";
    if (mysqli_query($conn, $sql1)) {
        $user_id = mysqli_insert_id($conn);

        // Insert into 'admins' table
        $sql2 = "INSERT INTO admins (department, user_id)
                     VALUES ('$department', '$user_id')";
        if (mysqli_query($conn, $sql2)) {
            // Insert into 'role' table
            $sql3 = "INSERT INTO role (role, user_id)
                         VALUES ('$role', '$user_id')";
            if (mysqli_query($conn, $sql3)) {
                header("location: ../DB_Admin/Dashboard.php");
            } else {
                echo "Error: " . $sql3 . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
    }
}
mysqli_close($conn);
?>