<?php
session_start();
include('../connect.php');

if ($_POST) {
    $user_name = $_POST['user_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $address = $_POST['address'];
    $DOB = $_POST['DOB'];
    $phone_no = $_POST['phone_no'];
    $role = $_POST['role'];
    $faculty_name = $_POST['faculty_name'];
    $batch_no = $_POST['batch_no'];
    $course_name = $_POST['course_name'];
    $image = $_FILES['image']['name'];


    $allowed_extension = array('gif', 'jpg', 'png', 'jpeg');
    $filename = $_FILES['image']['name'];
    $file_extension = pathinfo($filename, PATHINFO_EXTENSION);
    if (!in_array($file_extension, $allowed_extension)) {
        $_SESSION['status'] = "You are only allowed with jpg, png, jpeg, gif";
        header('Location: AdminRegistration.php');
    } else {


        if (file_exists("../images/profile/" . $_FILES['image']['name'])) {
            $filename = $_FILES['image']['name'];
            $_SESSION['status'] = "Please Rename your image and re-upload" . $filename;
            header('Location: AdminRegistration.php');
        } else {

            $select = "SELECT * FROM users WHERE user_name= '$user_name'";
            $result = mysqli_query($conn, $select);

            if (mysqli_num_rows($result) > 0) {
                $_SESSION['dublicate_name'] = "User Name already taken. Choose another Username.";
                header("Location: signup.php");
            } else {

                // Insert user record into the "users" table
                $insertUserQuery = "INSERT INTO users (user_name, email, password, address, DOB, Phone_no, bio, status) 
                        VALUES ('$user_name', '$email', '$hashedPassword', '$address', '$DOB', '$phone_no','Write abour yourself', 'pending')";
                if ($conn->query($insertUserQuery) === TRUE) {

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
                        // File uploaded successfully,
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



                    // Check if the role already exists
                    $checkRoleQuery = "SELECT role_id FROM role WHERE role = '$role'";
                    $checkRoleResult = $conn->query($checkRoleQuery);

                    if ($checkRoleResult->num_rows > 0) {
                        // Role already exists, retrieve its ID
                        $roleRow = $checkRoleResult->fetch_assoc();
                        $roleId = $roleRow['role_id'];
                    } else {
                        // Role doesn't exist, insert into "role" table
                        $insertRoleQuery = "INSERT INTO role (role) VALUES ('$role')";
                        if ($conn->query($insertRoleQuery) === TRUE) {
                            $roleId = mysqli_insert_id($conn); // Get the generated role ID
                        } else {
                            echo "Error inserting into role table: " . mysqli_error($conn);
                            $conn->close();
                            exit;
                        }
                    }

                    // Check if the faculty already exists
                    $checkFacultyQuery = "SELECT faculty_id FROM faculties WHERE faculty_name = '$faculty_name'";
                    $checkFacultyResult = $conn->query($checkFacultyQuery);

                    if ($checkFacultyResult->num_rows > 0) {
                        // Faculty already exists, retrieve its ID
                        $facultyRow = $checkFacultyResult->fetch_assoc();
                        $facultyId = $facultyRow['faculty_id'];
                    } else {
                        // Faculty doesn't exist, insert into "faculties" table
                        $insertFacultyQuery = "INSERT INTO faculties (faculty_name) VALUES ('$faculty_name')";
                        if ($conn->query($insertFacultyQuery) === TRUE) {
                            $facultyId = mysqli_insert_id($conn); // Get the generated faculty ID
                        } else {
                            echo "Error inserting into faculties table: " . mysqli_error($conn);
                            $conn->close();
                            exit;
                        }
                    }

                    // Check if the course already exists
                    $checkCourseQuery = "SELECT course_id FROM courses WHERE course_name = '$course_name'";
                    $checkCourseResult = $conn->query($checkCourseQuery);

                    if ($checkCourseResult->num_rows > 0) {
                        // Course already exists, retrieve its ID
                        $courseRow = $checkCourseResult->fetch_assoc();
                        $courseId = $courseRow['course_id'];
                    } else {
                        // Course doesn't exist, insert into "courses" table
                        $insertCourseQuery = "INSERT INTO courses (course_name) VALUES ('$course_name')";
                        if ($conn->query($insertCourseQuery) === TRUE) {
                            $courseId = mysqli_insert_id($conn); // Get the generated course ID
                        } else {
                            echo "Error inserting into courses table: " . mysqli_error($conn);
                            $conn->close();
                            exit;
                        }
                    }

                    // Check if the batch already exists
                    $checkBatchQuery = "SELECT batch_id FROM batch WHERE batch_no = '$batch_no'";
                    $checkBatchResult = $conn->query($checkBatchQuery);

                    if ($checkBatchResult->num_rows > 0) {
                        // Batch already exists, retrieve its ID
                        $batchRow = $checkBatchResult->fetch_assoc();
                        $batchId = $batchRow['batch_id'];
                    } else {
                        // Batch doesn't exist, insert into "batch" table
                        $insertBatchQuery = "INSERT INTO batch (batch_no) VALUES ('$batch_no')";
                        if ($conn->query($insertBatchQuery) === TRUE) {
                            $batchId = mysqli_insert_id($conn); // Get the generated batch ID
                        } else {
                            echo "Error inserting into batch table: " . mysqli_error($conn);
                            $conn->close();
                            exit;
                        }
                    }

                    // Insert role-junction record into the "role_junction" table
                    $insertRoleJunctionQuery = "INSERT INTO role_junction (role_id, user_id) VALUES ('$roleId', '$user_id')";
                    if ($conn->query($insertRoleJunctionQuery) === TRUE) {
                        // Insert student record into the "students" table
                        $insertStudentQuery = "INSERT INTO students (user_id, faculty_id, course_id, batch_id) 
                               VALUES ('$user_id', '$facultyId', '$courseId', '$batchId')";
                        if ($conn->query($insertStudentQuery) === TRUE) {
                            if ($_SESSION['role'] == 'admin') {

                                $_SESSION['adminAdded'] = "Admin Added Successfully";

                                header("location: ../DB_Admin/Dashboard.php");
                            } elseif ($_SESSION['role'] == 'super_admin') {

                                $_SESSION['adminAdded'] = "Admin Added Successfully";

                                header("location: ../DB_Superadmin/Dashboard.php");
                            } else {
                                header("location: ../Landing_pages/index.php");
                            }
                        } else {
                            echo "Error inserting into students table: " . mysqli_error($conn);
                        }
                    } else {
                        echo "Error inserting into role_junction table: " . mysqli_error($conn);
                    }
                } else {
                    echo "Error inserting into users table: " . mysqli_error($conn);
                }
            }
        }
    }
}

// Close the database connection
$conn->close();
?>