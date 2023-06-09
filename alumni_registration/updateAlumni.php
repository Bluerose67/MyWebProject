<?php
session_start();
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
    $bio = $_POST['bio'];
    $role = $_POST['role'];
    $faculty_name = $_POST['faculty_name'];
    $course_name = $_POST['course_name'];
    $batch_no = $_POST['batch_no'];
    // var_dump($std_id);
    // var_dump($role_id);
    // var_dump($email);
    // var_dump($address);
    // var_dump($DOB);
    // var_dump($phone_no);
    // var_dump($role);
    // var_dump($faculty_name);
    // var_dump($course_name);
    // var_dump($batch_no);

    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['image_old'];

    if ($new_image != '') {
        $update_filename = $_FILES['image']['name'];
    } else {
        $update_filename = $old_image;
    }

    if ($_FILES['image']['name'] != '') {
        if (file_exists("../images/profile/" . $_FILES['image']['name'])) {
            $filename = $_FILES['image']['name'];
            $_SESSION['status'] = "Image exists already" . $filename;
            header('Location: update_form.php');

        }
    }

    $sql1 = "UPDATE users SET user_name ='$user_name', email = '$email', address ='$address', DOB = '$DOB', phone_no =
            '$phone_no',bio='$bio', image='$update_filename' WHERE user_id = '$user_id'";
    if (mysqli_query($conn, $sql1)) {

        if ($_FILES['image']['name'] != '') {
            move_uploaded_file($_FILES['image']['tmp_name'], "../images/profile/" . $_FILES['image']['name']);
            unlink("../images/profile/" . $old_image);
        }

        $sql2 = "UPDATE role SET role ='$role' where role_id='$role_id'";
        if (mysqli_query($conn, $sql2)) {

            $sql3 = "UPDATE faculties SET faculty_name ='$faculty_name' where faculty_id ='$faculty_id'";
            if (mysqli_query($conn, $sql3)) {

                $sql4 = "UPDATE courses SET course_name ='$course_name' where course_id ='$course_id'";
                if (mysqli_query($conn, $sql4)) {

                    $sql5 = "UPDATE batch SET batch_no ='$batch_no' where batch_id ='$batch_id'";
                    if (mysqli_query($conn, $sql5)) {

                        if ($_SESSION['role'] == 'admin') {

                            $_SESSION['alumniUpdated'] = "Alumni Updated Successfully";

                            header("location: ../DB_Admin/Dashboard.php");
                        } elseif ($_SESSION['role'] == 'super_admin') {

                            $_SESSION['alumniUpdated'] = "Alumni Updated Successfully";

                            header("location: ../DB_Superadmin/Dashboard.php");
                        } else {
                            header("location: ../DB_Alumni/Dashboard.php");
                        }

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