<?php
include('../connect.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Alumni Registration</title>
</head>

<body>

    <div class="container">
        <div class="center">
            <h1>Register New Alumni</h1>
            <form action="insert.php" method="post">
                <div class="text">
                    <input type="text" name="name" required />
                    <span> </span>
                    <label>Name</label>
                </div>
                <div class="text">
                    <input type="email" name="email" required />
                    <span> </span>
                    <label>Email</label>
                </div>
                <div class="text">
                    <input type="text" name="password" required />
                    <span> </span>
                    <label>Password</label>
                </div>
                <div class="text1">
                    <input type="file" name="image" />
                    <span> </span>
                    <!-- <label>Choose Avatar photo</label> -->
                </div>
                <input type="submit" value="Register" />
                <button class="display-button"> <a href="../DASHBOARD/Dashboard_alumni.php">Display Records</a>
                </button>
                <?php
                if (isset($_SESSION["error"])) {
                    $error = $_SESSION["error"];
                    echo "<span>$error</span>";
                }
                ?>
            </form>
        </div>
    </div>
</body>

</html>