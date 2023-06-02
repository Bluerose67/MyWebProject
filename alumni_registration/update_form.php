<?php
include '../connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM alumni_registration WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $i = 0;
        // Looping through the results
        while ($row = mysqli_fetch_assoc($result)) {
            $record = array(
                "id" => $row['id'],
                "name" => $row['name'],
                "email" => $row['email'],
                // "password" => $row['password'],
                "image" => $row['image'],
            );
        }
    } else {
        echo "No records found!!";
        exit;
    }
}
mysqli_close($conn);
?>
<!DOCTYPE html>
<html>

<head>
    <title>
        Update alumni data
    </title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <div class="center">
            <h1>Update Alumni Details</h1>
            <form action="update.php" method="post">
                <input type="hidden" name="id" value="<?php echo $record['id'] ?>" />
                <div class="text">
                    <input type="text" name="name" value="<?= $record['name'] ?>" required />
                    <span> </span>
                    <label>Name</label>
                </div>
                <div class="text">
                    <input type="email" name="email" value="<?= $record['email'] ?>" required />
                    <span> </span>
                    <label>Email</label>
                </div>
                <div class="text1">
                    <!-- <label>Image</label> -->
                    <input type="file" name="image" value="<?= $record['image'] ?>" />
                    <span> </span>
                </div>
                <input type="submit" value="Update" class="login-button" />
                <!-- <span> </span> -->
                <button class="display-button"><a href="../DB_Admin/Dashboard_alumni.php"> Go back </a> </button>
            </form>
        </div>
    </div>
</body>

</html>