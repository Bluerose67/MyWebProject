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
                            <i class='bx bxs-user'></i>
                            <span class="text">My Profile</span>
                        </a>
                    </li>
                    <li>
                        <a href="Dashboard_events.php">
                            <i class='bx bxs-calendar-event'></i>
                            <span class="text">Manage Events</span>
                        </a>
                    </li>
                    <li>
                        <a href="Dashboard_managegallery.php">
                            <i class='bx bxs-image-alt'></i>
                            <span class="text">Manage Gallery</span>
                        </a>
                    </li>
                </ul>
                <ul class="side-menu">

                    <li>
                        <a href="../logout.php" class="logout">
                            <i class='bx bxs-log-out-circle'></i>
                            <span class="text">Logout</span>
                        </a>
                    </li>
                </ul>
            </section>
            <!-- SIDEBAR -->

            <?php
            // Fetch user data from the database
            include "../connect.php";

            $userId = $_SESSION['user_id'];
            // var_dump($userId);
        
            $sql = "SELECT * from users  
                            JOIN admins ON users.user_id=admins.user_id
                            JOIN role ON users.user_id=role.user_id  WHERE users.user_id = '$userId'";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                } else {
                    echo "No user found";
                }
            } else {
                echo "error executing sql query" . mysqli_error($conn);
            }

            ?>



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
                            <img src="<?php echo "../images/profile/" . $row['image']; ?>" alt="Avatar" class="avatar">
                        </div>

                        <div class="notification_icon">
                            <button class="notification_btn" title="Notification">
                                <a href="#"> <span class="material-symbols-outlined">notifications</span>
                                </a>
                            </button>
                        </div>
                    </div>
                </section> <!-- main-upper sections ends -------------------------------------------------->


        </div><!-- dashboard ends -->
        <script src="dashboard.js"></script>

        <script>

            document.addEventListener('DOMContentLoaded', function () {
                const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');
                const currentPage = window.location.pathname.split('/').pop(); // Get the current page URL
                console.log(currentPage);
                console.log(allSideMenu);
                allSideMenu.forEach(item => {
                    const li = item.parentElement;
                    console.log(li);

                    if (item.getAttribute('href') === currentPage) {
                        li.classList.add('active');
                    }

                    item.addEventListener('click', function () {
                        allSideMenu.forEach(i => {
                            i.parentElement.classList.remove('active');
                        })
                        li.classList.add('active');
                    })
                });
            });
        </script>

    </body>

    </html>
    <?php
}
?>