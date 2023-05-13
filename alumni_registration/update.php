<?php
include '../connect.php';

if ($_POST) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $sql = "UPDATE alumni_registration SET id = '$id', name = '$name', email = '$email' WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        // echo "Record updated successfully.";
        mysqli_close($conn);
        header('Location: ../DASHBOARD/Dashboard_alumni.php');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>