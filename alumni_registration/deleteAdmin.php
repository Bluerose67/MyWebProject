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
} elseif (isset($_GET['admin_id'])) {

    $user_id = $_GET['user_id'];
    $admin_id = $_GET['admin_id'];
    $role_id = $_GET['role_id'];
    $image = $_GET['image'];


    $sql1 = "DELETE FROM admins WHERE admin_id = '$admin_id'";
    if (mysqli_query($conn, $sql1)) {

        $sql2 = "DELETE FROM role where role_id='$role_id'";
        if (mysqli_query($conn, $sql2)) {
            $sql3 = "DELETE FROM users where user_id='$user_id'";

            if (mysqli_query($conn, $sql3)) {
                unlink("../images/profile/" . $image);


                $_SESSION['adminDeleted'] = "Admin Deleted Successfully";

                header('Location: ../DB_Superadmin/Dashboard.php');
            } else {
                echo "Delete Failed in query 3" . $sql3 . "<br>" . mysqli_error($conn);
            }

        } else {
            echo "Delete Failed in query 2" . $sql2 . "<br>" . mysqli_error($conn);
        }

    } else {
        echo "Delete failed in query 1" . $sql1 . "<br>" . mysqli_error($conn);
    }
}
//connection close
mysqli_close($conn);
?>