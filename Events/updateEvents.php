<?php
session_start();
include('../connect.php');
if (isset($_POST['id'])) {
    $event_id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['image_old'];
    $date = $_POST['date'];

    if ($new_image != '') {
        $update_filename = $_FILES['image']['name'];
    } else {
        $update_filename = $old_image;
    }

    // Perform the database update query
    $sql = "UPDATE events SET title='$title', description='$description', image='$update_filename', date='$date' WHERE id='$event_id'";
    if (mysqli_query($conn, $sql)) {
        if ($_FILES['image']['name'] != '') {
            move_uploaded_file($_FILES['image']['tmp_name'], "../images/events/" . $_FILES['image']['name']);
            unlink("../images/profile/" . $old_image);
        }

        $message = "Event updated successfully.";
        if ($_SESSION['role'] == 'admin') {
            $_SESSION["eventupdated"] = $message;
            header('Location:../DB_Admin/Dashboard_events.php');
            exit();
        } elseif ($_SESSION['role'] == 'super_admin') {
            $_SESSION["eventupdated"] = $message;
            header('Location:../DB_Superadmin/Dashboard_events.php');
            exit();
        } else {
            echo "No page to Redirect.";
            exit();
        }
    } else {
        $error = "Error updating event: " . mysqli_error($conn);
    }
}
?>