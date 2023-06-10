<?php
include '../connect.php';

if ($_POST) {

    $user_id = $_POST['user_id'];
    $std_id = $_POST['std_id'];
    $role_id = $_POST['role_id'];
    $faculty_id = $_POST['faculty_id'];
    $course_id = $_POST['course_id'];
    $batch_id = $_POST['batch_id'];
    $user_name = $_POST['user_name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $DOB = $_POST['DOB'];
    $phone_no = $_POST['phone_no'];
    $role = $_POST['role'];
    $faculty_name = $_POST['faculty_name'];
    $course_name = $_POST['course_name'];
    $batch_no = $_POST['batch_no'];
    // var_dump($std_id);


    $sql1 = "UPDATE users SET user_name ='$user_name', email = '$email', address ='$address', DOB = '$DOB', phone_no =
'$phone_no'
WHERE user_id = '$user_id'";
    if (mysqli_query($conn, $sql1)) {

        $sql2 = "UPDATE role SET role ='$role' where role_id='$role_id'";
        if (mysqli_query($conn, $sql2)) {

            $sql3 = "UPDATE faculties SET faculty_name ='$faculty_name' where faculty_id ='$faculty_id'";
            if (mysqli_query($conn, $sql3)) {

                $sql4 = "UPDATE courses SET course_name ='$course_name' where course_id ='$course_id'";
                if (mysqli_query($conn, $sql4)) {

                    $sql5 = "UPDATE batch SET batch_no ='$batch_no' where batch_id ='$batch_id'";
                    if (mysqli_query($conn, $sql5)) {

                        header('Location: ../DB_Admin/Dashboard.php');

                    } else {
                        echo "Update failed in query 5" . $sql5 . "<br>" . mysqli_error($conn);
                    }

                } else {
                    echo "Update failed in Query 4" . $sql4 . "<br>" . mysqli_error($conn);
                }

            } else {
                echo "Update Failed in query 3" . $sql3 . "<br>" . mysqli_error($conn);
            }

        } else {
            echo "Update Failed in query 2" . $sql2 . "<br>" . mysqli_error($conn);
        }

    } else {
        echo "update failed in query 1" . $sql1 . "<br>" . mysqli_error($conn);
    }

}
?>