<?php
include('../connect.php');
if ($_POST) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $image = $_POST['image'];
    $sql = "INSERT into alumni_registration(name,email, password, image)
        VALUES ('$name', '$email','$password','$image')";
    if (mysqli_query($conn, $sql)) {
        header("location: ../DASHBOARD/Dashboard_alumni.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
mysqli_close($conn);
?>