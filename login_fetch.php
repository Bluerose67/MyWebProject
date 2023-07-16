<?php
session_start();
include('connect.php');
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $error = "Invalid Username or Password";


    $sql = "SELECT * FROM users 
            JOIN role_junction on users.user_id=role_junction.user_id 
            JOIN role on role.role_id = role_junction.role_id
            where user_name = '$username' and password = '$password'";

    $result = mysqli_query($conn, $sql);


    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $status = $row['status'];

        // Check the status and set session variables accordingly
        if ($status == 'approved') {
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['username'] = $row['user_name'];
            $_SESSION['role'] = $row['role'];

            if ($_SESSION['role'] == 'admin') {
                header("Location: DB_Admin/Dashboard.php");
                exit();
            } else if ($_SESSION['role'] == 'super_admin') {
                header("Location: DB_Superadmin/Dashboard.php");
                exit();
            } elseif ($_SESSION['role'] == 'student') {
                header("Location: DB_Alumni/Dashboard_profile.php");
                exit();
            } else {
                $_SESSION["role_error"] = "Invalid Role";
                header("Location: Landing_pages/login.php");
                exit();
            }

        } elseif ($status == 'pending') {
            $_SESSION['pending'] = "Your account is pending approval. Please wait for admin verification.";
            header('Location: Landing_pages/login.php');
            exit();
        } elseif ($status == 'denied') {
            $_SESSION['denied'] = "Your account has been denied. Please contact the administrator for more information.";
            header('Location: Landing_pages/login.php');
            exit();
        }
    } else {
        $_SESSION["error"] = $error;
        header("Location: Landing_pages/login.php");
        exit();
    }

    mysqli_close($conn);
}
?>