<?php
include '../connect.php';

if ($_POST) {
    $user_id = $_POST['user_id'];
    $admin_id = $_POST['admin_id'];
    $name = $_POST['user_name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $DOB = $_POST['DOB'];
    $phone_no = $_POST['phone_no'];
    $department = $_POST['department'];

    $conn->begin_transaction();

    try {
        $sql1 = "UPDATE users SET admin_id = '$admin_id', user_name = '$name', email = '$email', address = '$address', DOB='$DOB',
        phone_no='$phone_no'  WHERE user_id = '$user_id'";
        $conn->query($sql1);

        $sql2 = "UPDATE admins SET department = '$department' WHERE user_id = '$user_id'";
        $conn->query($sql2);


    } catch (Exception $e) {

        $conn->rollback();
        echo "update failed:" . $e->getMessage();
    }

    $conn->close();


    // if (mysqli_query($conn, $sql)) {
    //     mysqli_close($conn);



    header('Location: ../DB_Admin/Dashboard_alumni.php');
}
?>