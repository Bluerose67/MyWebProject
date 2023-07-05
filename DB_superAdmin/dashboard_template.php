<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../Landing_pages/login.php");
    exit();
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
    <div class="dashboard">
        <!-- Sidebar -->
        <section id="sidebar">
            <!-- Sidebar content here -->
            <div class="icon1">
                <a href="../Landing_pages/index.php"><img src="../../AlumniHub/images/newlogo.png" alt="Logo1"></a>
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
                        <span class="text">Events</span>
                    </a>
                </li>
                <li>
                    <a href="Dashboard_gallery.php">
                        <i class='bx bxs-image-alt'></i>
                        <span class="text">Gallery</span>
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
        <!-- Sidebar -->

        <?php
        // Fetch user data from the database
        include "../connect.php";

        $userId = $_SESSION['user_id'];
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
            echo "Error executing SQL query: " . mysqli_error($conn);
        }
        ?>

        <section class="main">
            <section class="right-upper">
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
                            <a href="#"><span class="material-symbols-outlined">notifications</span></a>
                        </button>
                    </div>
                </div>
            </section>
            <!-- End of right-upper section -->

            <!-- Content section -->
            <section class="content">
                <!-- Content for individual pages will be included here -->