<?php
include "../connect.php";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE from alumni_registration where id = $id";
    if (mysqli_query($conn, $sql)) {
        echo "Record deleted successfully.";
        echo "<br /> <a href='../DASHBOARD/Dashboard_alumni.php'>Go back</a>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
} else {
    echo "Invalid request";
}
//connection close
mysqli_close($conn);
?>