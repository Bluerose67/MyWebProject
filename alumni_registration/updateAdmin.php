<?php
session_start();
include '../connect.php';

if ($_POST) {
    $user_id = $_POST['user_id'];
    $d_id = $_POST['d_id'];
    $role_id = $_POST['role_id'];
    $user_name = $_POST['user_name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $DOB = $_POST['DOB'];
    $phone_no = $_POST['phone_no'];
    $bio = $_POST['bio'];
    $status = $_POST['status'];
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
            $_SESSION['status'] = "Image already exists: " . $filename;
            header('Location: update_form.php');
            exit();
        }
    }

    // Check if the user already exists
    $checkUserQuery = "SELECT user_id FROM users WHERE user_name = '$user_name' AND user_id != '$user_id'";
    $checkUserResult = $conn->query($checkUserQuery);

    if ($checkUserResult->num_rows > 0) {
        echo "User already exists. Please try again with a different username.";
    } else {

        // Update user record in the "users" table
        $sql1 = "UPDATE users SET user_name ='$user_name', email = '$email', address ='$address', DOB = '$DOB', phone_no = '$phone_no', bio='$bio',
     image='$update_filename', status= '$status' WHERE user_id = '$user_id'";
        if (mysqli_query($conn, $sql1)) {
            if ($_FILES['image']['name'] != '') {
                move_uploaded_file($_FILES['image']['tmp_name'], "../images/profile/" . $_FILES['image']['name']);
                unlink("../images/profile/" . $old_image);
            }

            // Check if the new department already exists
            $departmentExistsQuery = "SELECT d_id FROM departments WHERE department = '$department'";
            $departmentExistsResult = $conn->query($departmentExistsQuery);

            if ($departmentExistsResult->num_rows > 0) {
                // Department already exists, retrieve its ID
                $departmentRow = $departmentExistsResult->fetch_assoc();
                $departmentId = $departmentRow['d_id'];
            } else {
                // Department doesn't exist, insert into "departments" table
                $insertDepartmentQuery = "INSERT INTO departments (department) VALUES ('$department')";
                if ($conn->query($insertDepartmentQuery) === TRUE) {
                    $departmentId = mysqli_insert_id($conn); // Get the generated department ID
                } else {
                    echo "Error inserting into departments table: " . mysqli_error($conn);
                    $conn->close();
                    exit;
                }
            }

            // Update department in the "admins" table
            $updateAdminQuery = "UPDATE admins SET d_id = '$departmentId' WHERE user_id = '$user_id'";
            if ($conn->query($updateAdminQuery) === TRUE) {
                // echo "User record updated successfully.";
                if ($_SESSION['role'] == 'admin') {

                    $_SESSION['adminUpdated'] = "Admin Updated Successfully";

                    header("location: ../DB_Admin/Dashboard_profile.php");

                    exit();
                } elseif ($_SESSION['role'] == 'super_admin') {

                    $_SESSION['adminUpdated'] = "Admin Updated Successfully";

                    header("location: ../DB_Superadmin/admin_list.php");

                    exit();
                } else {
                    header("location: ../DB_Alumni/Dashboard_profile.php");
                    exit();
                }
            } else {
                echo "Error updating admins table: " . mysqli_error($conn);
            }
        } else {
            echo "Error updating user record: " . mysqli_error($conn);
        }
    }
}

// Close the database connection
$conn->close();
?>