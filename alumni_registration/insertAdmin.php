<?php
session_start();
include('../connect.php');
if ($_POST) {
    $name = $_POST['user_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
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
        $_SESSION['image_status'] = "You are only allowed with jpg, png, jpeg, gif";
        header('Location: AdminRegistration.php');
    } else {


        if (file_exists("../images/profile/" . $_FILES['image']['name'])) {
            $filename = $_FILES['image']['name'];
            $_SESSION['image_status'] = "Please Rename your image and resubmit the form" . $filename;
            header('Location: AdminRegistration.php');
        } else {
            $select = "SELECT * FROM users WHERE user_name= '$name'";
            $result = mysqli_query($conn, $select);

            if (mysqli_num_rows($result) > 0) {
                echo "<script type = 'text/javascript'> ";
                echo "alert('User Name already Exists !!')";
                echo "window.Location.href = 'signup.php'";
                echo "</script>";
            } else {

                // Check if the role already exists in the "role" table
                $roleExistsQuery = "SELECT role_id FROM role WHERE role = '$role'";
                $Result = mysqli_query($conn, $roleExistsQuery);

                if ($Result->num_rows > 0) {
                    // Role already exists, retrieve its ID
                    $roleRow = mysqli_fetch_assoc($Result);
                    $roleId = $roleRow['role_id'];
                } else {
                    // Role doesn't exist, insert into "role" table
                    $insertRoleQuery = "INSERT INTO role (role) VALUES ('$role')";
                    if (mysqli_query($conn, $insertRoleQuery) === TRUE) {
                        $roleId = mysqli_insert_id($conn); // Get the generated role ID
                    } else {
                        echo "Error inserting into role table: " . mysqli_error($conn);
                        mysqli_close($conn);
                        exit();
                    }
                }

                // Check if the department already exists in the "departments" table
                $departmentExistsQuery = "SELECT d_id FROM departments WHERE department = '$department'";
                $departmentExistsResult = mysqli_query($conn, $departmentExistsQuery);

                if ($departmentExistsResult->num_rows > 0) {
                    // Department already exists, retrieve its ID
                    $departmentRow = mysqli_fetch_assoc($departmentExistsResult);
                    $departmentId = $departmentRow['d_id'];
                } else {
                    // Department doesn't exist, insert into "departments" table
                    $insertDepartmentQuery = "INSERT INTO departments (department) VALUES ('$department')";
                    if (mysqli_query($conn, $insertDepartmentQuery) === TRUE) {
                        $departmentId = mysqli_insert_id($conn); // Get the generated department ID
                    } else {
                        echo "Error inserting into departments table: " . mysqli_error($conn);
                        $conn->close();
                        exit;
                    }
                }


                // Insert into 'users' table
                $sql1 = "INSERT INTO users (user_name, email, password, address, DOB, Phone_no, image, status) VALUES ('$name', '$email', '$hashedPassword', '$address', '$DOB', '$phone', '$image', 'pending')";
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


                    // Insert admin relationship into the "admins" table
                    $insertAdminQuery = "INSERT INTO admins (d_id, user_id) VALUES ('$departmentId', '$user_id')";
                    if ($conn->query($insertAdminQuery) === TRUE) {
                        // Insert role-junction relationship into the "role_junction" table
                        $insertRoleJunctionQuery = "INSERT INTO role_junction (role_id, user_id) VALUES ('$roleId', '$user_id')";
                        if ($conn->query($insertRoleJunctionQuery) === TRUE) {
                            // echo "Data inserted successfully.";
                            if ($_SESSION['role'] == 'admin') {

                                $_SESSION['adminAdded'] = "Admin Added Successfully";

                                header("location: ../DB_Admin/Dashboard.php");
                            } elseif ($_SESSION['role'] == 'super_admin') {

                                $_SESSION['adminAdded'] = "Admin Added Successfully";

                                header("location: ../DB_Superadmin/Dashboard.php");
                            } else {
                                header("location: ../DB_Alumni/Dashboard_profile.php");
                            }
                        } else {
                            echo "Error inserting into role_junction table: " . mysqli_error($conn);
                        }
                    } else {
                        echo "Error inserting into admins table: " . mysqli_error($conn);
                    }
                } else {
                    echo "Error inserting into users table: " . mysqli_error($conn);
                }

                // Close the database connection
                $conn->close();
            }
        }
    }
}
?>