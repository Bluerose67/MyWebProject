<?php
session_start();
include "../connect.php";
if (isset($_GET['std_id'])) {
    $user_id = $_GET['user_id'];
    $std_id = $_GET['std_id'];
    $image = $_GET['image'];

    // Delete record from the "role_junction" table
    $deleteRoleJunctionQuery = "DELETE FROM role_junction WHERE user_id = '$user_id'";
    if ($conn->query($deleteRoleJunctionQuery) === TRUE) {
        // Delete record from the "students" table
        $deleteStudentQuery = "DELETE FROM students WHERE user_id = '$user_id'";
        if ($conn->query($deleteStudentQuery) === TRUE) {

            // Check if the role becomes orphaned
            $checkOrphanedRoleQuery = "SELECT role_id FROM role WHERE role_id NOT IN (SELECT role_id FROM role_junction)";
            $orphanedRoleResult = $conn->query($checkOrphanedRoleQuery);
            if ($orphanedRoleResult->num_rows > 0) {
                // Delete orphaned roles from the "role" table
                $deleteOrphanedRoleQuery = "DELETE FROM role WHERE role_id IN (SELECT role_id FROM role_junction)";
                if ($conn->query($deleteOrphanedRoleQuery) === TRUE) {
                    $_SESSION['deleteSuccess'] = "User record and orphaned roles deleted successfully.";
                } else {
                    echo "Error deleting orphaned roles from role table: " . mysqli_error($conn);
                }
            }

            // Check if the faculties become orphaned
            $checkOrphanedFacultyQuery = "SELECT faculty_id FROM faculties WHERE faculty_id NOT IN (SELECT faculty_id FROM students)";
            $orphanedFacultyResult = $conn->query($checkOrphanedFacultyQuery);
            if ($orphanedFacultyResult->num_rows > 0) {
                // Delete orphaned faculties from the "faculties" table
                $deleteOrphanedFacultyQuery = "DELETE FROM faculties WHERE faculty_id IN (SELECT faculty_id FROM students)";
                if ($conn->query($deleteOrphanedFacultyQuery) === TRUE) {
                    $_SESSION['deleteSuccess'] = "User record, orphaned roles, and orphaned faculties deleted successfully.";
                } else {
                    echo "Error deleting orphaned faculties from faculties table: " . mysqli_error($conn);
                }
            }

            // Check if the courses become orphaned
            $checkOrphanedCourseQuery = "SELECT course_id FROM courses WHERE course_id NOT IN (SELECT course_id FROM students)";
            $orphanedCourseResult = $conn->query($checkOrphanedCourseQuery);
            if ($orphanedCourseResult->num_rows > 0) {
                // Delete orphaned courses from the "courses" table
                $deleteOrphanedCourseQuery = "DELETE FROM courses WHERE course_id IN (SELECT course_id FROM students)";
                if ($conn->query($deleteOrphanedCourseQuery) === TRUE) {
                    $_SESSION['deleteSuccess'] = "User record, orphaned roles, orphaned faculties, and orphaned courses deleted successfully.";
                } else {
                    echo "Error deleting orphaned courses from courses table: " . mysqli_error($conn);
                }
            }

            // Check if the batch become orphaned
            $checkOrphanedBatchQuery = "SELECT batch_id FROM batch WHERE batch_id NOT IN (SELECT batch_id FROM students)";
            $orphanedBatchResult = $conn->query($checkOrphanedBatchQuery);
            if ($orphanedBatchResult->num_rows > 0) {
                // Delete orphaned batches from the "batch" table
                $deleteOrphanedBatchQuery = "DELETE FROM batch WHERE batch_id IN (SELECT batch_id FROM students)";
                if ($conn->query($deleteOrphanedBatchQuery) === TRUE) {
                    $_SESSION['deleteSuccess'] = "User record, orphaned roles, orphaned faculties, orphaned courses, and orphaned batches deleted successfully.";
                } else {
                    echo "Error deleting orphaned batches from batch table: " . mysqli_error($conn);
                }
            }

            // Delete the user record from the "users" table
            $deleteUserQuery = "DELETE FROM users WHERE user_id = '$user_id'";
            if ($conn->query($deleteUserQuery) === TRUE) {
                unlink("../images/profile/" . $image);

                if ($_SESSION['role'] == 'admin') {

                    $_SESSION['alumniDeleted'] = "Alumni Deleted Successfully";

                    header("location: ../DB_Admin/alumni_list.php");
                } elseif ($_SESSION['role'] == 'super_admin') {

                    $_SESSION['alumniDeleted'] = "Alumni Deleted Successfully";

                    header("location: ../DB_Superadmin/alumni_list.php");
                } else {
                    echo "Invalid Role";
                }
            } else {
                echo "Error deleting from users table: " . mysqli_error($conn);
            }
        } else {
            echo "Error deleting from students table: " . mysqli_error($conn);
        }
    } else {
        echo "Error deleting from role_junction table: " . mysqli_error($conn);
    }
}

// Close the database connection
$conn->close();
?>