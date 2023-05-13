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
            echo "File uploaded successfully!";
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
                <div class="icon6">
                    <a href="Dashboard_managegallery.php"> <span class="material-symbols-outlined">imagesmode</span>
                        <p> Manage Gallery </p>
                    </a>
                </div>

            </section><!-- sidebar ends -->

            <section class="main">
                <section class="right-upper"> <!-- main section begins -->
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
                <section class="right-lower">
                    <div class="container">
                        <div class="center">
                            <h1>Upload Images</h1>
                            <form action="" method="post" enctype="multipart/form-data">
                                <input type="hidden" value="1" name="fileupload">
                                <div class="text">
                                    <div class="label1">
                                        <label>Select a File</label>
                                    </div>

                                    <div>
                                        <input type="file" class="form-control" name="file" required autofocus>
                                    </div>
                                    <span> </span>
                                </div>
                                <input type="submit" value="Upload" class="login-button" />
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
                                    } else {
                                        ?> <!---- its a loop [change the folder name on img path]----->
                    <div class='wrapper'>
                        <a href=''>
                            <img src="../images/gallery/<?php echo $file; ?>">
                        </a>
                    </div>
                    <?php
                                    }
                                }
                                closedir($dh);
                            }
                        } ?>
    </div>
    </div>

    </section>
    </section>
    </div><!-- dashboard ends -->
    </body>

    </html>
    <?php
}
?>