<?php
session_start();
$role = $_SESSION['role'];

include('../connect.php');

if (!isset($_GET['id'])) {
    if ($role === 'super_admin') {
        header('Location: ../DB_Superadmin/Dashboard_events.php');
    } elseif ($role === 'admin') {
        header('Location: ../DB_Admin/Dashboard_events.php');
    } else {
        echo "error";
    }
} else {
    $id = $_GET['id'];
    $sql = "SELECT * FROM events where events.id= '$id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $i = 0;
        // Looping through the results
        while ($row = mysqli_fetch_assoc($result)) {
            $record = array(
                "id" => $row['id'],
                "title" => $row['title'],
                "description" => $row['description'],
                "image" => $row['image'],
                "date" => $row['date'],
            );

        }
    } else {
        echo "No records found!!";
        exit();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>
        Update Events
    </title>
    <link rel="stylesheet" href="../DB_Superadmin/Dashboard.css">
</head>

<body>
    <div class="container_event">
        <div class="center_event">
            <h1>Update Events Details</h1>
            <form action="../Events/updateEvents.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $record['id'] ?>" />
                <div class="text">
                    <input type="text" name="title" value="<?= $record['title'] ?>" required />
                    <span> </span>
                    <label>Title</label>
                </div>
                <div class="text">
                    <input type="text" name="description" value="<?= $record['description'] ?>" required />
                    <span> </span>
                    <label>Description</label>
                </div>

                <div class="textt">

                    <input type="file" id="image" name="image">
                    <input type="hidden" id="image" name="image_old" value="<?php echo $record['image']; ?>">
                </div>

                <div class="text">
                    <input type="date" name="date" value="<?= $record['date'] ?>" />
                    <span> </span>
                    <label>Date</label>
                </div>

                <div class="button">
                    <input type="submit" value="update" class="display-button" />

                    <?php
                    if ($role === 'super_admin') { ?>
                        <button class="display-button"><a href="../DB_Superadmin/Dashboard_events.php"> Go back </a>
                        </button>
                    <?php } else { ?>
                        <button class="display-button"><a href="../DB_Admin/Dashboard_events.php"> Go back </a> </button>
                    <?php }
                    ?>
                </div>

            </form>