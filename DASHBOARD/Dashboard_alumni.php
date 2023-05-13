<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../Landing_pages/login.php");
} else {
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="Dashboard.css">
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    </head>

    <body>
        <div class="dashboard"> <!-- dashboard begins -->

            <section class="sidebar"><!-- sidebar begins -->

                <div class="icon1">
                    <a href="../Landing_pages/index.php"><img src="../images/newlogo.png" alt="Logo1">
                    </a>
                </div>

                <div class="icon2">
                    <a href="Dashboard.php"> <span class="material-symbols-outlined">dashboard</span>
                        <p> Dashboard </p>
                    </a>
                </div>

                <div class="icon3">
                    <a href="Dashboard_profile.php"> <span class="material-symbols-outlined"> person</span>
                        <p>Profile</p>
                    </a>
                </div>

                <div class="icon4">
                    <a href="Dashboard_alumni.php"> <span class="material-symbols-outlined">groups</span>
                        <p>View Alumni </p>
                    </a>
                </div>

                <div class="icon5">
                    <a href="Dashboard_events.php"> <span class="material-symbols-outlined">event </span>
                        <p> View Events </p>
                    </a>
                </div>

            </section><!-- sidebar ends -->

            <section class="main">
                <section class="right-upper"><!-- main-upper section begins -->
                    <div class="left-text">
                        <h1>Dashboard</h1>
                    </div>
                    <div class="notification_logout">
                        <div class="notification_icon">
                            <button class="notification_btn" title="Notification">
                                <a href="#"> <span class="material-symbols-outlined">notifications</span>
                                </a>
                            </button>
                        </div>
                        <div class="logout_icon">
                            <form action="../logout.php">
                                <button class="logout_btn" title="logout">
                                    <span class="material-symbols-outlined"> logout </span>
                                </button>
                            </form>
                        </div>
                    </div>
                </section><!-- main-upper sections ends -->
                <section class="right-lower">
                    <?php
                    include "../connect.php";

                    $sql = "SELECT * FROM alumni_registration";

                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        // output data of each row
                        $i = 0;
                        // Looping through the results
                        while ($row = mysqli_fetch_assoc($result)) {
                            $records[$i] = array(
                                "id" => $row['id'],
                                "name" => $row['name'],
                                "email" => $row['email'],
                                "password" => $row['password'],
                                "image" => $row['image'],
                            );
                            $i++;
                        }
                    }
                    //connection close
                    mysqli_close($conn);
                    ?>
                    <a href="../alumni_registration/index.php">
                        <h3>Add new Alumni</h3>
                    </a>
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Image</th>
                        </tr>
                        <?php foreach ($records as $record) { ?>
                            <tr>
                                <td>
                                    <?= $record['id'] ?>
                                </td>
                                <td>
                                    <?= $record['name'] ?>
                                </td>
                                <td>
                                    <?= $record['email'] ?>
                                </td>
                                <td>
                                    <?= $record['image'] ?>
                                </td>
                                <td>
                                    <a href="../alumni_registration/update_form.php?id=<?= $record['id'] ?>">Edit</a>
                                    <a href="../alumni_registration/delete.php?id=<?= $record['id'] ?>">Delete</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                </section>
            </section>
        </div><!-- dashboard ends -->
    </body>

    </html>
    <?php
}
?>