<?php
session_start();
include('../connect.php');
if (isset($_GET['delete_event'])) {
    $event_id = $_GET['delete_event'];

    // Perform the database delete query
    $sql = "DELETE FROM events WHERE id='$event_id'";
    if (mysqli_query($conn, $sql)) {
        $message = "Event deleted successfully.";
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
        $error = "Error deleting event: " . mysqli_error($conn);
    }
}
?>