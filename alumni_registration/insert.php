<?php
include('../connect.php');
if ($_POST) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $image = $_POST['image'];
    $sql = "INSERT into alumni_registration(id,Name,email, password, image)
        VALUES ('$id','$name', '$email','$password','$image')";
    if (mysqli_query($conn, $sql)) {
        header("location: ../DASHBOARD/Dashboard_alumni.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
mysqli_close($conn);
?>