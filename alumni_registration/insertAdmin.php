<?php
session_start();
include('../connect.php');
if ($_POST) {
    $name = $_POST['user_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $DOB = $_POST['DOB'];
    $phone = $_POST['phone_no'];
    $image = $_FILES['image']['name'];
    $role = $_POST['role'];
    $department = $_POST['department'];
    // var_dump($_FILES['image']['name']);

    $allowed_extension = array('gif', 'jpg', 'png', 'jpeg');
    $filename = $_FILES['image']['name'];
    $file_extension = pathinfo($filename, PATHINFO_EXTENSION);
    if (!in_array($file_extension, $allowed_extension)) {
        $_SESSION['status'] = "You are only allowed with jpg, png, jpeg, gif";
        header('Location: AdminRegistration.php');
    } else {


        if (file_exists("../images/profile/" . $_FILES['image']['name'])) {
            $filename = $_FILES['image']['name'];
            $_SESSION['status'] = "Please Rename your image and resubmit the form" . $filename;
            header('Location: AdminRegistration.php');
        } else {
            // Insert into 'users' table
            $sql1 = "INSERT INTO users (user_name, email, password, address, DOB, Phone_no, image) VALUES ('$name', '$email', '$password', '$address', '$DOB', '$phone', '$image')";
            if (mysqli_query($conn, $sql1)) {
                $user_id = mysqli_insert_id($conn);

                $image = $_FILES['image']['name']; // Get the name of the uploaded file

                // Specify the destination directory where you want to save the uploaded file
                $targetDirectory = "../images/profile/";

                // Generate a unique file name to avoid conflicts
                $targetFileName = uniqid() . "_" . basename($image);

                // The full path to the uploaded file on the server
                $targetFilePath = $targetDirectory . $targetFileName;

                // Move the uploaded file to the desired location
                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
                    // File uploaded successfully

                    // Update the value of $image with the new file name
                    $image = $targetFileName;

                    // Update the database record with the new file name 
                    $updateSql = "UPDATE users SET image = '$image' WHERE user_id = '$user_id'";
                    if (mysqli_query($conn, $updateSql)) {
                        // Image file name updated in the database successfully
                    } else {
                        echo "Error updating image file name in the database: " . mysqli_error($conn);
                    }
                } else {
                    // File upload failed
                    echo "Sorry, there was an error uploading your file.";
                }


                // Insert into 'admins' table
                $sql2 = "INSERT INTO admins (department, user_id)
                            VALUES ('$department', '$user_id')";
                if (mysqli_query($conn, $sql2)) {
                    // Insert into 'role' table
                    $sql3 = "INSERT INTO role (role, user_id)
                                VALUES ('$role', '$user_id')";
                    if (mysqli_query($conn, $sql3)) {

                        if ($_SESSION['role'] == 'admin') {

                            $_SESSION['adminAdded'] = "Admin Added Successfully";

                            header("location: ../DB_Admin/Dashboard.php");

                        } elseif ($_SESSION['role'] == 'super_admin') {

                            $_SESSION['adminAdded'] = "Admin Added Successfully";

                            header("location: ../DB_Superadmin/Dashboard.php");
                        } else {
                            header("location: ../DB_Alumni/Dashboard.php");
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
    }
}
mysqli_close($conn);
?>