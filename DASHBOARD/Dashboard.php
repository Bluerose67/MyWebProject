<?php
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['password'])) {

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
                <div>
                    <p>
                        <?php echo "welcome" . $_SESSION['username'];
                        echo "<br> password" . $_SESSION['password']; ?>
                    </p>
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


            <section class="right"><!-- main section begins -->
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
                        <button class="logout_btn" title="logout">
                            <a href="logout.php"> <span class="material-symbols-outlined"> logout </span> </a>
                        </button>
                    </div>
                </div>


            </section><!-- main sections ends -->


        </div><!-- dashboard ends -->
    </body>

    </html>
    <?php

} else {

    header("Location: ../Landing_pages/login.php");

    exit();

}

?>