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
                            <span class="text">Manage Events</span>
                        </a>
                    </li>
                    <li>
                        <a href="Dashboard_managegallery.php">
                            <i class='bx bxs-message-dots'></i>
                            <span class="text">Manage Gallery</span>
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

                            <?php
                            include "../connect.php";
                            //Display the student count 
                            $studentQuery = "SELECT COUNT(*) as student_count FROM role WHERE role.role = 'student'";
                            $result = mysqli_query($conn, $studentQuery);
                            $studentCount = $result->fetch_assoc()['student_count'];

                            //Display the Admin Count
                            $adminQuery = "SELECT COUNT(*) as admin_count FROM role WHERE role.role = 'admin'";
                            $result = mysqli_query($conn, $adminQuery);
                            $adminCount = $result->fetch_assoc()['admin_count'];

                            //Display the Total Count
                            $totalQuery = "SELECT COUNT(*) as total_count FROM users";
                            $result = mysqli_query($conn, $totalQuery);
                            $totalCount = $result->fetch_assoc()['total_count'];

                            ?>
                            <li>
                                <i class='bx bxs-calendar-check'></i>
                                <span class="text">
                                    <h3>
                                        <?php echo $studentCount; ?>
                                    </h3>
                                    <p>No. of Students</p>
                                </span>
                            </li>
                            <li>
                                <i class='bx bxs-group'></i>
                                <span class="text">
                                    <h3>
                                        <?php echo $studentCount; ?>
                                    </h3>
                                    <p>No of Admins</p>
                                </span>
                            </li>
                            <li>
                                <i class='bx bxs-dollar-circle'></i>
                                <span class="text">
                                    <h3>
                                        <?php echo $totalCount; ?>
                                    </h3>
                                    <p>Total Users</p>
                                </span>
                            </li>
                        </ul>

                        <!-- details tables------------------------------------------------------>
                        <?php
                        include "../connect.php";

                        $sqlAdmin = "SELECT * FROM users 
                                                JOIN admins ON admins.user_id = users.user_id
                                                JOIN role ON users.user_id = role.user_id
                                                WHERE role.role = 'admin'";

                        $resultAdmin = mysqli_query($conn, $sqlAdmin);

                        if (mysqli_num_rows($resultAdmin) > 0) {
                            $i = 0;
                            // Looping through the results
                            while ($row = mysqli_fetch_assoc($resultAdmin)) {
                                $adminRecords[$i] = array(
                                    "user_id" => $row['user_id'],
                                    "admin_id" => $row['admin_id'],
                                    "user_name" => $row['user_name'],
                                    "email" => $row['email'],
                                    "address" => $row['address'],
                                    "DOB" => $row['DOB'],
                                    "phone_no" => $row['phone_no'],
                                    "department" => $row['department'],
                                    "role" => $row['role'],
                                );
                                $i++;
                            }
                        }

                        $sqlAlumni = "SELECT u.*, s.*, r.role, f.faculty_name, c.course_name, b.batch_no
                                                FROM users u
                                                JOIN role r ON u.user_id = r.user_id
                                                JOIN students s ON u.user_id = s.user_id
                                                JOIN faculties f ON s.faculty_id = f.faculty_id
                                                JOIN courses c ON s.course_id = c.course_id
                                                JOIN batch b ON s.batch_id = b.batch_id
                                                WHERE r.role = 'student'";

                        $resultAlumni = mysqli_query($conn, $sqlAlumni);

                        if (mysqli_num_rows($resultAlumni) > 0) {
                            $i = 0;
                            while ($row = mysqli_fetch_assoc($resultAlumni)) {
                                $alumniRecords[$i] = array(
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
                        // Close the connection
                        mysqli_close($conn);
                        ?>
                        <div class="table-data">
                            <div class="order">
                                <div class="container1">
                                    <div class="center1">
                                        <div class="head">
                                            <h3>Admin List</h3>
                                            <i class='bx bx-search'></i>
                                            <i class='bx bx-filter'></i>
                                        </div>
                                        <!-- <button class="add-button">
                                            <a href="../alumni_registration/Adminregistration.php">Add new Admin</a>
                                        </button> -->
                                        <table>
                                            <tr>
                                                <th>Admin ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Address</th>
                                                <th>DOB</th>
                                                <th>Contact</th>
                                                <th>Department</th>
                                                <!-- <th>Action</th> -->
                                            </tr>
                                            <?php foreach ($adminRecords as $record) { ?>
                                                <tr>
                                                    <td>
                                                        <?= $record['admin_id'] ?>
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
                                                        <?= $record['department'] ?>
                                                    </td>
                                                    <!-- <td class="change-buttons">
                                                        <div class="dropdown">
                                                            <button class="icon-button">&#x22EE;</button>
                                                            <div class="dropdown-menu">
                                                                <button class="edit-button">
                                                                    <a
                                                                        href="../alumni_registration/update_form.php?admin_id=<?= $record['admin_id'] ?>">Edit</a>
                                                                </button>
                                                                <button class="edit-button" id="deleteBtn">Delete</button>
                                                            </div>
                                                        </div>
                                                    </td> -->
                                                </tr>
                                            <?php } ?>
                                        </table>
                                        <!-- <div id="confirmationModal" class="modal_delete">
                                            <div class="modal-content_delete">
                                                <h2>Confirmation</h2>
                                                <p>Are you sure you want to delete?</p>
                                                <button id="confirmDeleteBtn" class="edit-button">Yes</button>
                                                <button id="cancelDeleteBtn" class="edit-button">No</button>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-data">
                            <div class="order">
                                <div class="container1">
                                    <div class="center1">
                                        <div class="head">
                                            <h3>Alumni List</h3>
                                            <i class='bx bx-search'></i>
                                            <i class='bx bx-filter'></i>
                                        </div>
                                        <button class="add-button">
                                            <a href="../alumni_registration/Alumniregistration.php">Add new Alumni</a>
                                        </button>
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
                                                <th>Action</th>
                                            </tr>
                                            <?php foreach ($alumniRecords as $record) { ?>
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
                                                    <td class="change-buttons">
                                                        <div class="dropdown">
                                                            <button class="icon-button">&#x22EE;</button>
                                                            <div class="dropdown-menu">
                                                                <button class="edit-button">
                                                                    <a
                                                                        href="../alumni_registration/update_form.php?std_id=<?= $record['std_id'] ?>">Edit</a>
                                                                </button>
                                                                <button class="edit-button" id="deleteBtn">Delete</button>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </table>

                                        <div id="confirmationModal" class="modal_delete">
                                            <div class="modal-content_delete">
                                                <h2>Confirmation</h2>
                                                <p>Are you sure you want to delete?</p>
                                                <button id="confirmDeleteBtn" class="edit-button">Yes</button>
                                                <button id="cancelDeleteBtn" class="edit-button">No</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- details tables------------------------------------------------------>
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
        </script>

    </body>

    </html>
    <?php
}
?>