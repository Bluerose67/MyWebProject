<?php
session_start();
include('../connect.php');
if (isset($_POST['update_event'])) {
    $event_id = $_POST['event_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image = $_FILES['image']['name'];
    $date = $_POST['date'];

    // Move the uploaded photo to a desired location
    $target_dir = "../event_photos/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    // Perform the database update query
    $sql = "UPDATE events SET title='$title', description='$description', image='$image', date='$date' WHERE id='$event_id'";
    if (mysqli_query($conn, $sql)) {
        $message = "Event updated successfully.";
        if ($_SESSION['role'] == 'admin') {
            header('Location:../DB_Admin/Dashboard_events.php');
            exit();
        } elseif ($_SESSION['role'] == 'super_admin') {
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