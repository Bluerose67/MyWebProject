<?php
session_start();
include('connect.php');
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "select * from login where name = '$username' and password = '$password'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        header("Location: index.php");
    } else {
        echo ("Invalid username or password!!");
        header("Location: login.php?error=Login failed. Invalid username or password!!");
    }

    $_SESSION['username'] = $row['username'];

    $_SESSION['password'] = $row['password'];

}
?>