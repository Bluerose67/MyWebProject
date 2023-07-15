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
            where user_name = '$username' and password = '$password' and status = 'approved'";
    $result = mysqli_query($conn, $sql);


    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    // var_dump($row);
    if ($count == 1) {

        $_SESSION['username'] = $row['user_name'];
        $_SESSION['password'] = $row['password'];
        $_SESSION['role'] = $row['role'];
        $_SESSION['user_id'] = $row['user_id'];
        // var_dump($_SESSION['user_id']);
        if ($_SESSION['role'] == 'admin') {
            header("Location: DB_Admin/Dashboard.php");
        } else if ($_SESSION['role'] == 'super_admin') {
            header("Location: DB_Superadmin/Dashboard.php");
        } elseif ($_SESSION['role'] == 'student') {
            header("Location: DB_Alumni/Dashboard_profile.php");
        } else {
            $_SESSION["role_error"] = "Invalid Role";
            header("Location: Landing_pages/login.php");
        }
    } else {
        $_SESSION["error"] = $error;
        header("Location: Landing_pages/login.php");
    }
}

?>