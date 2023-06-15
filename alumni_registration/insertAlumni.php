<?php
session_start();
include('../connect.php');

if ($_POST) {
    $user_name = $_POST['user_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $DOB = $_POST['DOB'];
    $phone_no = $_POST['phone_no'];
    $role = $_POST['role'];
    $faculty_name = $_POST['faculty_name'];
    $batch_no = $_POST['batch_no'];
    $course_name = $_POST['course_name'];

    // Insert into 'users' table
    $sql1 = "INSERT INTO users (user_name, email, password, address, DOB, Phone_no)
                VALUES ('$user_name', '$email', '$password', '$address', '$DOB', '$phone_no')";
    if (mysqli_query($conn, $sql1)) {
        $user_id = mysqli_insert_id($conn);

        // Insert into 'faculties' table
        $sql2 = "INSERT INTO faculties (faculty_name)
                    VALUES ('$faculty_name')";
        if (mysqli_query($conn, $sql2)) {
            $faculty_id = mysqli_insert_id($conn);

            // Insert into 'role' table
            $sql3 = "INSERT INTO role (role, user_id)
                         VALUES ('$role', '$user_id')";
            if (mysqli_query($conn, $sql3)) {

                // Insert into 'courses' table
                $sql4 = "INSERT INTO courses (course_name)
                        VALUES ('$course_name')";
                if (mysqli_query($conn, $sql4)) {
                    $course_id = mysqli_insert_id($conn);

                    //Insert into batch table
                    $sql5 = "INSERT INTO batch (batch_no)
                        VALUES ('$batch_no')";
                    if (mysqli_query($conn, $sql5)) {
                        $batch_id = mysqli_insert_id($conn);

                        //Insert into students table
                        $sql6 = "INSERT INTO students (faculty_id, course_id, batch_id, user_id)
                        VALUES ('$faculty_id', '$course_id', '$batch_id', '$user_id')";
                        if (mysqli_query($conn, $sql6)) {
                            $std_id = mysqli_insert_id($conn);
                            if ($_SESSION['role'] == 'admin') {

                                header("location: ../DB_Admin/Dashboard.php");
                            } elseif ($_SESSION['role'] == 'super_admin') {
                                header("location: ../DB_Superadmin/Dashboard.php");
                            } else {
                                header("location: ../DB_Alumni/Dashboard.php");
                            }

                        } else {
                            echo "Error: " . $sql6 . "<br>" . mysqli_error($conn);

                        }
                    } else {
                        echo "Error: " . $sql5 . "<br>" . mysqli_error($conn);
                    }

                } else {
                    echo "Error: " . $sql4 . "<br>" . mysqli_error($conn);
                }
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