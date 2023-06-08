<?php
session_start();
include('connect.php');
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $error = "Invalid Username or Password";


    $sql = "SELECT * FROM users 
            -- JOIN admins on admins.user_id= users.user_id
            JOIN role on users.user_id=role.user_id 
            where user_name = '$username' and password = '$password'";
    $result = mysqli_query($conn, $sql);


    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    // var_dump($row);
    if ($count == 1) {

        $_SESSION['username'] = $row['user_name'];
        $_SESSION['password'] = $row['password'];
        $_SESSION['role'] = $row['role'];
        // var_dump($_SESSION['role']);
        if ($_SESSION['role'] == 'admin') {
            header("Location: DB_Admin/Dashboard.php");
        } else {
            header("Location: DB_Alumni/Dashboard.php");
        }
    } else {
        $_SESSION["error"] = $error;
        header("Location: Landing_pages/login.php");
    }
}

?>