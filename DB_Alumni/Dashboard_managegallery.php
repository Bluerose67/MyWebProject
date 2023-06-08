<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../Landing_pages/login.php");
} else {
    ?>
    <?php
    $dir = "../images/gallery/"; // set your gallery folder name
    if (isset($_GET['del'])) {
        unlink($dir . '/' . $_GET['del']);
    }

    if (isset($_POST['fileupload'])) {
        $dirfile = $dir . basename($_FILES['file']['name']);
        if (move_uploaded_file($_FILES['file']['tmp_name'], $dirfile)) {
            // echo "File uploaded successfully!";
        } else {
            echo "Sorry, file not uploaded, please try again!";
        }
    }
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
        <link rel='stylesheet' href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css'>
    </head>

    <body>

        <div class="dashboard"> <!-- dashboard begins -->

            <!-- SIDEBAR -->
            <section id="sidebar">
                <div class="icon1">
                    <a href="../Landing_pages/index.php"><img src="../images/newlogo.png" alt="Logo1">
                    </a>
                </div>
                <ul class="side-menu top">
                    <li>
                        <a href="Dashboard.php">
                            <i class='bx bxs-dashboard'></i>
                            <span class="text">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="Dashboard_profile.php">
                            <i class='bx bxs-shopping-bag-alt'></i>
                            <span class="text">My Profile</span>
                        </a>
                    </li>
                    <li>
                        <a href="Dashboard_events.php">
                            <i class='bx bxs-doughnut-chart'></i>
                            <span class="text">Events</span>
                        </a>
                    </li>
                    <li>
                        <a href="Dashboard_managegallery.php">
                            <i class='bx bxs-message-dots'></i>
                            <span class="text">Gallery</span>
                        </a>
                    </li>
                </ul>
                <ul class="side-menu">
                    <li>
                        <a href="#">
                            <i class='bx bxs-cog'></i>
                            <span class="text">Settings</span>
                        </a>
                    </li>
                    <li>
                        <a href="../logout.php" class="logout">
                            <i class='bx bxs-log-out-circle'></i>
                            <span class="text">Logout</span>
                        </a>
                    </li>
                </ul>
            </section>
            <!-- SIDEBAR -->



            <section class="main"> <!-- main section begins ------------------------------------------------------------>

                <section class="right-upper"><!-- main-upper section begins ---------------------------------->
                    <!-- <div class="left-text">
                        <h1>Dashboard</h1>
                    </div> -->
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
                    </div>
                </section> <!-- main-upper sections ends -------------------------------------------------->
                <section class="right-lower" id="right_lower">
                    <div class="scrolltop">
                        <button class="button" onclick="scrollToTopOfElement('right_lower')">
                            <span class="material-symbols-outlined"> north </span>
                        </button>
                    </div>
                    <div class="container">
                        <div class="wrapper1">
                            <img src="../images/upload.png" alt="Choose Image" id="img">
                        </div>
                        <div class="center">
                            <h1>Upload Images</h1>
                            <form action="" method="post" enctype="multipart/form-data">
                                <input type="hidden" value="1" name="fileupload">
                                <div class="text">
                                    <div class="label1">
                                        <label>Select a File</label>
                                    </div>

                                    <div>
                                        <input type="file" id="input" class="form-control" name="file" required autofocus>
                                    </div>
                                    <span> </span>
                                </div>
                                <input type="submit" value="Upload" class="login-button" />
                                <input type="submit" value="Reset" id="resetBtn" class="login-button" />

                                <p> To upload a image, files selected must be of format</p>
                                <p class="image_type"> .Png, .jpeg, .jpg</p>
                            </form>
                        </div>
                    </div>
                    <section>
                        <div class="title">
                            <h1>Digital <span> Gallery </span></h1>
                        </div>
                    </section>
                    <!-- Image section begins here -->
                    <section class="wrapper_box" id="img_Gallery">
                        <?php
                        $dir = "../images/gallery/"; // image folder name
                        if (is_dir($dir)) {
                            if ($dh = opendir($dir)) {
                                while (($file = readdir($dh)) !== false) {
                                    if ($file == "." or $file == "..") {
                                    } else { ?> <!---- its a loop [change the folder name on img path]----->
                    <div class='wrapper'>
                        <img src="../images/gallery/<?php echo $file; ?>" onclick="openModal();currentSlide(1)"
                            class="hover-shadow">
                    </div>
                    <?php } ?>
                    <?php
                                }
                            }
                            closedir($dh);
                        } ?>
                    <!-- Image Section ends here -->

                    </section>
                    <!-- The Modal/Lightbox -->
                    <div id="myModal" class="modal">
                        <span class="close cursor" onclick="closeModal()" title="Close">&times;</span>
                        <div class="modal-content">

                            <?php
                            $dir = "../images/gallery/"; // image folder name
                            if (is_dir($dir)) {
                                if ($dh = opendir($dir)) {
                                    while (($file = readdir($dh)) !== false) {
                                        if ($file == "." or $file == "..") {
                                        } else {
                                            ?> <!---- its a loop [change the folder name on img path]----->
                        <div class='mySlides'>
                            <img src="../images/gallery/<?php echo $file; ?>">
                        </div>
                        <?php
                                        }
                                    }
                                    closedir($dh);
                                }
                            } ?>

                        <!-- Next/previous controls -->
                            <a class="prev" onclick="plusSlides(-1)" title="Prev">&#10094;</a>
                            <a class="next" onclick="plusSlides(1)" title="next">&#10095;</a>

                            <!-- Caption text -->
                            <!-- <div class="caption-container">
                                    <p id="caption"></p>
                                </div> -->

                        </div>
                    </div> <!-- Image modal ends here ---------------------------------->
                </section> <!-- main section ends here ---------------------------------------------------------->

        </div><!-- dashboard ends -->
        <script src="../js/index.js"></script>
    </body>

    </html>
    <?php
}
?>