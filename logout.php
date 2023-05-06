<?php
session_start();
include('connect.php');

if (isset($_SESSION['username'])) {
    session_unset();
    session_destroy();
    header("Location: Landing_pages/login.php");
    // echo "Session Destroyed";
} else {
    echo "not destroyed";
}
// echo "My name is rushab";
?>