<?php
require_once('dashboard_template.php');
?>

<div class="notification">
    <p> Welcome,
        <?php echo $_SESSION['username'] ?>
    </p>
    <span class="notification_progress"></span>
</div>

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
                        <?php echo $adminCount; ?>
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
                    "role_id" => $row['role_id'],
                    "user_name" => $row['user_name'],
                    "email" => $row['email'],
                    "address" => $row['address'],
                    "DOB" => $row['DOB'],
                    "phone_no" => $row['phone_no'],
                    "department" => $row['department'],
                    "role" => $row['role'],
                    "image" => $row['image'],

                );
                $i++;
            }
        }

        $sqlAlumni = "SELECT u.*, s.*, r.*, f.*, c.*, b.*
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
                    "role_id" => $row['role_id'],
                    "faculty_id" => $row['faculty_id'],
                    "course_id" => $row['course_id'],
                    "batch_id" => $row['batch_id'],
                    "user_name" => $row['user_name'],
                    "email" => $row['email'],
                    "address" => $row['address'],
                    "DOB" => $row['DOB'],
                    "phone_no" => $row['phone_no'],
                    "image" => $row['image'],
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
                            <!-- <input type="text" id="adminSearchInput" placeholder="Search"> -->
                            <div class="text1">
                                <input type="text" id="adminSearchInput" required />
                                <i class='bx bx-search'></i>
                                <span> </span>
                                <label>Search</label>
                            </div>
                        </div>
                        <button class="add-button">
                            <a href="../alumni_registration/Adminregistration.php">Add new Admin</a>
                        </button>
                        <table>
                            <tr>
                                <th>Profile</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>DOB</th>
                                <th>Contact</th>
                                <th>Department</th>
                                <th>Action</th>
                            </tr>
                            <tbody id="adminTableBody">
                                <?php foreach ($adminRecords as $record) { ?>
                                    <tr>
                                        <td>
                                            <img src="<?php echo "../images/profile/" . $record['image'] ?>">
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
                                        <td class="change-buttons">
                                            <div class="dropdown">
                                                <button class="icon-button">&#x22EE;</button>
                                                <div class="dropdown-menu">
                                                    <button class="edit-button">
                                                        <a
                                                            href="../alumni_registration/update_form.php?admin_id=<?= $record['admin_id'] ?>">Edit</a>
                                                    </button>
                                                    <button class="edit-button adminDeleteBtn">
                                                        Delete
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <div id="confirmationModalAdmin" class="modal_delete">
                            <div class="modal-content_delete">
                                <h2>Confirmation</h2>
                                <p>Are you sure you want to delete?</p>
                                <button id="confirmDeleteBtnAdmin" class="edit-button">
                                    <a
                                        href="../alumni_registration/deleteAdmin.php?user_id=<?= $record['user_id'] ?>&admin_id=<?= $record['admin_id'] ?>&role_id=<?= $record['role_id'] ?>&image=<?= $record['image'] ?>">Delete</a>
                                </button>
                                <button id="cancelDeleteBtnAdmin" class="edit-button">No</button>
                            </div>
                        </div>
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
                            <!-- <i class='bx bx-search'></i>
                                                            <input type="text" id="alumniSearchInput" placeholder="Search"> -->
                            <div class="text1">
                                <input type="text" id="alumniSearchInput" required />
                                <i class='bx bx-search'></i>
                                <span> </span>
                                <label>Search</label>
                            </div>
                        </div>
                        <button class="add-button">
                            <a href="../alumni_registration/sAlumniregistration.php">Add new Alumni</a>
                        </button>
                        <table>
                            <tr>
                                <th>Profile</th>
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
                            <tbody id="alumniTableBody">
                                <?php foreach ($alumniRecords as $record) { ?>
                                    <tr>
                                        <td>
                                            <img src="<?php echo "../images/profile/" . $record['image'] ?>">
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
                                                    <button class="edit-button alumniDeleteBtn">
                                                        Delete
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                        <div id="confirmationModalAlumni" class="modal_delete">
                            <div class="modal-content_delete">
                                <h2>Confirmation</h2>
                                <p>Are you sure you want to delete?</p>
                                <button id="confirmDeleteBtnAlumni" class="edit-button">
                                    <a
                                        href="../alumni_registration/deleteAdmin.php?user_id=<?= $record['user_id'] ?>&std_id=<?= $record['std_id'] ?>&faculty_id=<?= $record['faculty_id'] ?>&course_id=<?= $record['course_id'] ?>&batch_id=<?= $record['batch_id'] ?>&role_id=<?= $record['role_id'] ?>&image=<?= $record['image'] ?>">Delete</a>
                                </button>
                                <button id="cancelDeleteBtnAlumni" class="edit-button">No</button>
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
<!-- End of content section -->
</section>
<!-- End of main section -->
</div>

<script src="dashboard.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

    /* delete button confirmation box --------------------------------------------------------------------- */

    var adminDeleteBtns = document.querySelectorAll(".adminDeleteBtn");
    var alumniDeleteBtns = document.querySelectorAll(".alumniDeleteBtn");
    var confirmationModalAdmin = document.getElementById("confirmationModalAdmin");
    var confirmationModalAlumni = document.getElementById("confirmationModalAlumni");
    var confirmDeleteBtnAdmin = document.getElementById("confirmDeleteBtnAdmin");
    var confirmDeleteBtnAlumni = document.getElementById("confirmDeleteBtnAlumni");
    var cancelDeleteBtnAdmin = document.getElementById("cancelDeleteBtnAdmin");
    var cancelDeleteBtnAlumni = document.getElementById("cancelDeleteBtnAlumni");

    adminDeleteBtns.forEach(function (deleteBtn) {
        deleteBtn.addEventListener("click", function () {
            confirmationModalAdmin.style.display = "block";
        });
    });

    alumniDeleteBtns.forEach(function (deleteBtn) {
        deleteBtn.addEventListener("click", function () {
            confirmationModalAlumni.style.display = "block";
        });
    });

    confirmDeleteBtnAdmin.addEventListener("click", function () {
        // Close the modal
        confirmationModalAdmin.style.display = "none";
    });

    confirmDeleteBtnAlumni.addEventListener("click", function () {
        // Close the modal
        confirmationModalAlumni.style.display = "none";
    });

    cancelDeleteBtnAdmin.addEventListener("click", function () {
        // Close the modal
        confirmationModalAdmin.style.display = "none";
    });

    cancelDeleteBtnAlumni.addEventListener("click", function () {
        // Close the modal
        confirmationModalAlumni.style.display = "none";
    });

    window.addEventListener("click", function (event) {
        if (event.target == confirmationModalAdmin) {
            // Close the modal
            confirmationModalAdmin.style.display = "none";
        }

        if (event.target == confirmationModalAlumni) {
            // Close the modal
            confirmationModalAlumni.style.display = "none";
        }
    });


    /* delete button confirmation box --------------------------------------------------------------------- */

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