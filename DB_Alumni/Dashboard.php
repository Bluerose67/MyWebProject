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
        <div class="dashboard"> <!-- dashboard begins ------------------------------------------------------------------->
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


                <section class="right-lower">
                    <!-- main-lower sections begins -------------------------------------------------->
                    <main>
                        <div class="head-title">
                            <div class="left">
                                <h1>Dashboard</h1>
                                <ul class="breadcrumb">
                                    <li>
                                        <a href="#">Dashboard</a>
                                    </li>
                                    <li><i class='bx bx-chevron-right'></i></li>
                                    <li>
                                        <a class="active" href="../Landing_pages/index.php">Home</a>
                                    </li>
                                </ul>
                            </div>

                        </div>

                        <ul class="box-info">
                            <li>
                                <i class='bx bxs-calendar-check'></i>
                                <span class="text">
                                    <h3>1020</h3>
                                    <p>New Order</p>
                                </span>
                            </li>
                            <li>
                                <i class='bx bxs-group'></i>
                                <span class="text">
                                    <h3>2834</h3>
                                    <p>Visitors</p>
                                </span>
                            </li>
                            <li>
                                <i class='bx bxs-dollar-circle'></i>
                                <span class="text">
                                    <h3>$2543</h3>
                                    <p>Total Sales</p>
                                </span>
                            </li>
                        </ul>


                        <div class="table-data">
                            <div class="order">

                                <?php
                                include "../connect.php";

                                $sql = "SELECT u.*, s.*,r.role, f.faculty_name, c.course_name, b.batch_no
                                        FROM users u
                                        JOIN role r ON u.user_id = r.user_id
                                        JOIN students s ON u.user_id = s.user_id
                                        JOIN faculties f ON s.faculty_id = f.faculty_id
                                        JOIN courses c ON s.course_id = c.course_id
                                        JOIN batch b ON s.batch_id = b.batch_id where role= 'student' ";

                                $result = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    // output data of each row
                                    $i = 0;
                                    // Looping through the results
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $records[$i] = array(
                                            "user_id" => $row['user_id'],
                                            "std_id" => $row['std_id'],
                                            "user_name" => $row['user_name'],
                                            "email" => $row['email'],
                                            "address" => $row['address'],
                                            "DOB" => $row['DOB'],
                                            "phone_no" => $row['phone_no'],
                                            "faculty_name" => $row['faculty_name'],
                                            "course_name" => $row['course_name'],
                                            "batch_no" => $row['batch_no'],
                                        );
                                        $i++;
                                    }
                                }
                                //connection close
                                mysqli_close($conn);
                                ?>

                                <!-- <h1 class="heading">List Of All Admins</h1> -->
                                <div class="container1">
                                    <div class="center1">
                                        <div class="head">
                                            <h3>Alumni List</h3>
                                            <div class="text1">
                                                <input type="text" id="adminSearchInput" required />
                                                <i class='bx bx-search'></i>
                                                <span> </span>
                                                <label>Search</label>
                                            </div>
                                        </div>
                                        <!-- <button class="add-button">
                                            <a href="../alumni_registration/registration.php">Add new Alumni</a>
                                        </button> -->
                                        <table>
                                            <tr>
                                                <th>Student ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Address</th>
                                                <th>DOB</th>
                                                <th>Contact</th>
                                                <th>Faculty</th>
                                                <th>Course</th>
                                                <th>Batch</th>
                                                <!-- <th>Action</th> -->
                                            </tr>
                                            <tbody id="alumniTableBody">
                                                <?php foreach ($records as $record) { ?>
                                                    <tr>
                                                        <td>
                                                            <?= $record['std_id'] ?>
                                                        </td>
                                                        <td>
                                                            <?= $record['user_name'] ?>
                                                        </td>
                                                        <td>
                                                            <?= $record['email'] ?>
                                                        </td>
                                                        <td>
                                                            <?= $record['address'] ?>
                                                        </td>
                                                        <td>
                                                            <?= $record['DOB'] ?>
                                                        </td>
                                                        <td>
                                                            <?= $record['phone_no'] ?>
                                                        </td>
                                                        <td>
                                                            <?= $record['faculty_name'] ?>
                                                        </td>
                                                        <td>
                                                            <?= $record['course_name'] ?>
                                                        </td>
                                                        <td>
                                                            <?= $record['batch_no'] ?>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </main>
                </section> <!-- main-lower sections ends -------------------------------------------------->

            </section>
            <!-- main sections ends ---------------------------------------------------------------------------------->


            <div class="notification">
                <p> Welcome,
                    <?php echo $_SESSION['username'] ?>
                </p>
                <span class="notification_progress"></span>
            </div>


        </div><!-- dashboard ends ---------------------------------------------------------------------------->
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



            /* Filter data  */

            $(document).ready(function () {
                // Admin List search
                $("#adminSearchInput").on("keyup", function () {
                    var value = $(this).val().toLowerCase();
                    $("#adminTableBody tr").filter(function () {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                    });
                });

                // Alumni List search
                $("#alumniSearchInput").on("keyup", function () {
                    var value = $(this).val().toLowerCase();
                    $("#alumniTableBody tr").filter(function () {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                    });
                });
            });
                                                                                                            /* Filter data  */
        </script>

    </body>

    </html>
    <?php
}
?>