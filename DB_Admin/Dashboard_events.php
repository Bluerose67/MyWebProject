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
                        <p>Manage Alumni </p>
                    </a>
                </div>

                <div class="icon5">
                    <a href="Dashboard_events.php"> <span class="material-symbols-outlined">event </span>
                        <p> Manage Events </p>
                    </a>
                </div>
                <div class="icon6">
                    <a href="Dashboard_managegallery.php"> <span class="material-symbols-outlined">imagesmode </span>
                        <p> Manage Gallery </p>
                    </a>
                </div>

            </section><!-- sidebar ends -->


            <section class="right-upper"><!-- main section begins -->
                <div class="left-text">
                    <h1>Dashboard</h1>
                </div>
                <div class="right_about">
                    <div>
                        <p>
                            <?php echo $_SESSION['username']; ?>
                        </p>
                    </div>

                    <div class="profile">
                        <img src="../images/avatar.jpg" alt="Avatar" class="avatar">
                    </div>

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

            </section><!-- main sections ends -->


        </div><!-- dashboard ends -->
    </body>

    </html>
    <?php
}
?>