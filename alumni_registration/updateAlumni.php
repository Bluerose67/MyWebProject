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
    $status = $_POST['status'];
    $role = $_POST['role'];
    $faculty_name = $_POST['faculty_name'];
    $course_name = $_POST['course_name'];
    $batch_no = $_POST['batch_no'];


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
    // Check if the user already exists
    $checkUserQuery = "SELECT user_id FROM users WHERE user_name = '$user_name' AND user_id != '$user_id'";
    $checkUserResult = $conn->query($checkUserQuery);

    if ($checkUserResult->num_rows > 0) {
        echo " Please try again with a different username.";
    } else {

        // Update user record in the "users" table
        $updateUserQuery = "UPDATE users SET user_name ='$user_name', email = '$email', address ='$address', DOB = '$DOB', phone_no =
            '$phone_no', status= '$status',bio='$bio', image='$update_filename' WHERE user_id = '$user_id'";
        if (mysqli_query($conn, $updateUserQuery)) {

            if ($_FILES['image']['name'] != '') {
                move_uploaded_file($_FILES['image']['tmp_name'], "../images/profile/" . $_FILES['image']['name']);
                unlink("../images/profile/" . $old_image);
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

            // Update role-junction record in the "role_junction" table
            $updateRoleJunctionQuery = "UPDATE role_junction SET role_id = '$roleId' WHERE user_id = '$user_id'";
            if ($conn->query($updateRoleJunctionQuery) === TRUE) {
                // Update student record in the "students" table
                $updateStudentQuery = "UPDATE students SET faculty_id = '$facultyId', course_id = '$courseId', batch_id = '$batchId' WHERE user_id = '$user_id'";
                if ($conn->query($updateStudentQuery) === TRUE) {
                    if ($_SESSION['role'] == 'admin') {

                        $_SESSION['alumniUpdated'] = "Alumni Updated Successfully";

                        header("location: ../DB_Admin/alumni_list.php");
                    } elseif ($_SESSION['role'] == 'super_admin') {

                        $_SESSION['alumniUpdated'] = "Alumni Updated Successfully";

                        header("location: ../DB_Superadmin/alumni_list.php");
                    } else {

                        $_SESSION['alumniUpdated'] = "Profile Updated Successfully";
                        header("location: ../DB_Alumni/Dashboard_profile.php");
                    }
                } else {
                    echo "Error updating students table: " . mysqli_error($conn);
                }
            } else {
                echo "Error updating role_junction table: " . mysqli_error($conn);
            }
        } else {
            echo "Error updating users table: " . mysqli_error($conn);
        }
    }
}

// Close the database connection
$conn->close();
?>