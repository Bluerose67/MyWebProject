<?php
session_start();
include('connect.php');
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $error = "Invalid Username or Password";

    $sql = "select * from users where user_name = '$username' and password = '$password'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count == 1) {

        $_SESSION['username'] = $row['user_name'];
        $_SESSION['password'] = $row['password'];
    }
    header("Location: DB_Admin/Dashboard.php");
} else {
    $_SESSION["error"] = $error;
    header("Location: Landing_pages/login.php");
}

?>