<?php
session_start();
include "../connect.php";
if (isset($_GET['std_id'])) {
    $user_id = $_GET['user_id'];
    $std_id = $_GET['std_id'];
    $faculty_id = $_GET['faculty_id'];
    $course_id = $_GET['course_id'];
    $batch_id = $_GET['batch_id'];
    $role_id = $_GET['role_id'];
    $image = $_GET['image'];
    // var_dump($_GET['faculty_id']);

    $sql1 = "DELETE FROM students WHERE std_id = '$std_id'";
    if (mysqli_query($conn, $sql1)) {

        $sql2 = "DELETE FROM courses WHERE course_id = '$course_id'";
        if (mysqli_query($conn, $sql2)) {

            $sql3 = "DELETE FROM batch WHERE batch_id = '$batch_id'";
            if (mysqli_query($conn, $sql3)) {

                $sql4 = "DELETE FROM faculties WHERE faculty_id = '$faculty_id'";
                if (mysqli_query($conn, $sql4)) {

                    $sql5 = "DELETE FROM role WHERE role_id = '$role_id'";
                    if (mysqli_query($conn, $sql5)) {

                        $sql6 = "DELETE FROM users WHERE user_id = '$user_id'";
                        if (mysqli_query($conn, $sql6)) {

                            unlink("../images/profile/" . $image);
                            if ($_SESSION['role'] == 'admin') {

                                $_SESSION['alumniDeleted'] = "Alumni Deleted Successfully";

                                header("location: ../DB_Admin/Dashboard.php");

                            } elseif ($_SESSION['role'] == 'super_admin') {

                                $_SESSION['alumniDeleted'] = "Alumni Deleted Successfully";

                                header("location: ../DB_Superadmin/Dashboard.php");
                            } else {
                                echo "Invalid role";
                            }

                        } else {
                            echo "Delete failed in query 5" . $sql6 . "<br>" . mysqli_error($conn);
                        }

                    } else {
                        echo "Delete failed in query 5" . $sql5 . "<br>" . mysqli_error($conn);
                    }

                } else {
                    echo "Delete failed in Query 4" . $sql4 . "<br>" . mysqli_error($conn);
                }

            } else {
                echo "Delete Failed in query 3" . $sql3 . "<br>" . mysqli_error($conn);
            }

        } else {
            echo "Delete Failed in query 2" . $sql2 . "<br>" . mysqli_error($conn);
        }

    } else {
        echo "Delete failed in query 1" . $sql1 . "<br>" . mysqli_error($conn);
    }
} elseif (isset($_GET['d_id'])) {

    $user_id = $_GET['user_id'];
    $d_id = $_GET['d_id'];
    $image = $_GET['image'];


    // Delete admin record from the "admins" table
    $deleteAdminQuery = "DELETE FROM admins WHERE user_id = '$user_id'";
    if ($conn->query($deleteAdminQuery) === TRUE) {
        // Delete role-junction record from the "role_junction" table
        $deleteRoleJunctionQuery = "DELETE FROM role_junction WHERE user_id = '$user_id'";
        if ($conn->query($deleteRoleJunctionQuery) === TRUE) {
            // Check if the department is orphaned
            $checkDepartmentQuery = "SELECT d_id FROM departments WHERE d_id NOT IN (SELECT d_id FROM admins)";
            $orphanedDepartmentsResult = $conn->query($checkDepartmentQuery);

            if ($orphanedDepartmentsResult->num_rows > 0) {
                // Delete orphaned department(s)
                while ($row = $orphanedDepartmentsResult->fetch_assoc()) {
                    $departmentId = $row['d_id'];
                    $deleteDepartmentQuery = "DELETE FROM departments WHERE d_id = '$departmentId'";
                    $conn->query($deleteDepartmentQuery);
                }
            }

            // Check if the role is orphaned
            $checkRoleQuery = "SELECT role_id FROM role WHERE role_id NOT IN (SELECT role_id FROM role_junction)";
            $orphanedRolesResult = $conn->query($checkRoleQuery);

            if ($orphanedRolesResult->num_rows > 0) {
                // Delete orphaned role(s)
                while ($row = $orphanedRolesResult->fetch_assoc()) {
                    $roleId = $row['role_id'];
                    $deleteRoleQuery = "DELETE FROM role WHERE role_id = '$roleId'";
                    $conn->query($deleteRoleQuery);
                }
            }

            // Delete user record from the "users" table
            $deleteUserQuery = "DELETE FROM users WHERE user_id = '$user_id'";
            if ($conn->query($deleteUserQuery) === TRUE) {

                unlink("../images/profile/" . $image);

                $_SESSION['adminDeleted'] = "Admin Deleted Successfully";

                header('Location: ../DB_Superadmin/Dashboard.php');
            } else {
                echo "Error deleting user record: " . mysqli_error($conn);
            }
        } else {
            echo "Error deleting user's role-junction record: " . mysqli_error($conn);
        }
    } else {
        echo "Error deleting user's admin record: " . mysqli_error($conn);
    }
}

// Close the database connection
$conn->close();
?>