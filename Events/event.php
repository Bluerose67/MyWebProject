<?php
session_start();
include '../connect.php';

// Get the event ID from the URL or any other means
$eventId = $_GET['id'];
$eventTitle = $_GET['title'];

// Get the current user ID
$userId = $_SESSION['user_id'];

// Handle the interest/cancelation of a user for an event
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['show_interest'])) {
        // Add user's interest in the event
        $sql = "INSERT INTO interested_users (user_id, id) VALUES ('$userId', '$eventId')";
        mysqli_query($conn, $sql);
        $_SESSION['interested'] = "You Showed Interest In The " . $eventTitle . "";
        header("Location: ../DB_Alumni/Dashboard_events.php");
        exit();
    } elseif (isset($_POST['cancel_interest'])) {
        // Remove user's interest from the event
        $sql = "DELETE FROM interested_users WHERE user_id = '$userId' AND id = '$eventId'";
        mysqli_query($conn, $sql);
        $_SESSION['interested'] = "You canceled Interest In The " . $eventTitle . "";
        header("Location: ../DB_Alumni/Dashboard_events.php");
        exit();
    }
}
?>