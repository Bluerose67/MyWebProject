<?php

include('connect.php');
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "select * from login where name = '$username' and password = '$password'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count == 1) {
        session_start();
        $_SESSION['username'] = $row['name'];
        $_SESSION['password'] = $row['password'];
    }
    header("Location: DASHBOARD/Dashboard.php");
} else {
    echo ("Invalid username or password!!");
    header("Location: Landing_pages/login.php?error=Login failed. Invalid username or password!!");
}

?>