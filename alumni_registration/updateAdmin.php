<?php
session_start();
include '../connect.php';

if ($_POST) {
    $user_id = $_POST['user_id'];
    $admin_id = $_POST['admin_id'];
    $role_id = $_POST['role_id'];
    $user_name = $_POST['user_name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $DOB = $_POST['DOB'];
    $phone_no = $_POST['phone_no'];
    $role = $_POST['role'];
    $department = $_POST['department'];
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
    } else {

        $sql1 = "UPDATE users SET user_name ='$user_name', email = '$email', address ='$address', DOB = '$DOB', phone_no = '$phone_no' 
                        WHERE user_id = '$user_id'";
        if (mysqli_query($conn, $sql1)) {

            if ($_FILES['image']['name'] != '') {
                move_uploaded_file($_FILES['image']['tmp_name'], "../images/profile/" . $_FILES['image']['name']);
                unlink("../images/profile/" . $old_image);
            }
            $sql2 = "UPDATE role SET role ='$role' where role_id='$role_id'";
            if (mysqli_query($conn, $sql2)) {
                $sql3 = "UPDATE admins SET department ='$department' where admin_id ='$admin_id'";

                if (mysqli_query($conn, $sql3)) {
                    if ($_SESSION['role'] == 'admin') {

                        header("location: ../DB_Admin/Dashboard.php");
                    } elseif ($_SESSION['role'] == 'super_admin') {
                        header("location: ../DB_Superadmin/Dashboard.php");
                    } else {
                        header("location: ../DB_Alumni/Dashboard.php");
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


}

?>