<?php
require_once('../DB_Superadmin/dashboard_template.php');
?>

<!-- Notification -->
<?php if (isset($_SESSION['alumniAdded'])) { ?>
    <div class="notification_CRUD">
        <p>
            <?php
            echo $_SESSION['alumniAdded'];

            unset($_SESSION['alumniAdded']);
            ?>
        </p>
        <span class="notification_progress_CRUD"></span>
    </div>
<?php } elseif (isset($_SESSION["alumniUpdated"])) { ?>
    <div class="notification_CRUD">
        <p>
            <?php
            echo $_SESSION['alumniUpdated'];

            unset($_SESSION['alumniUpdated']);
            ?>
        </p>
        <span class="notification_progress_CRUD"></span>
    </div>
<?php } elseif (isset($_SESSION["alumniDeleted"])) { ?>
    <div class="notification_CRUD">
        <p>
            <?php
            echo $_SESSION['alumniDeleted'];

            unset($_SESSION['alumniDeleted']);
            ?>
        </p>
        <span class="notification_progress_CRUD"></span>
    </div>
<?php } else { ?>
    <div class="notification_CRUD">
        <p>
            <?php
            echo "Welcome, " . $_SESSION['username'];
            ?>
        </p>
        <span class="notification_progress_CRUD"></span>
    </div>
<?php }
?>

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
            //Display the pending student count 
            $studentQuery = "SELECT COUNT(*) as student_count FROM role 
            JOIN role_junction ON role_junction.role_id = role.role_id
            JOIN users on role_junction.user_id = users.user_id 
            WHERE role.role = 'student' AND users.status = 'pending'";
            $result = mysqli_query($conn, $studentQuery);
            $pendingstudentCount = $result->fetch_assoc()['student_count'];

            //Display the denied student count 
            $studentQuery = "SELECT COUNT(*) as student_count FROM role 
            JOIN role_junction ON role_junction.role_id = role.role_id
            JOIN users on role_junction.user_id = users.user_id 
            WHERE role.role = 'student' AND users.status = 'denied'";
            $result = mysqli_query($conn, $studentQuery);
            $deniedstudentCount = $result->fetch_assoc()['student_count'];

            ?>
            <li>
                <i class='bx bxs-group'></i>
                <span class="text">
                    <h3>
                        <?php echo $pendingstudentCount; ?>
                    </h3>
                    <p>No of pending alumni</p>
                </span>
            </li>
            <li>
                <i class='bx bxs-group'></i>
                <span class="text">
                    <h3>
                        <?php echo $deniedstudentCount; ?>
                    </h3>
                    <p>No of denied alumni</p>
                </span>
            </li>
        </ul>

        <!-- Pending alumni table------------------------------------------------------ -->
        <?php
        $sqlAlumni = "SELECT u.*, s.*, r.*, f.*, c.*, b.*
                    FROM users u
                    JOIN role_junction rj on rj.user_id = u.user_id
                    JOIN role r on rj.role_id = r.role_id
                    JOIN students s on s.user_id = u.user_id
                    JOIN faculties f on f.faculty_id = s.faculty_id
                    JOIN courses c on c.course_id = s.course_id 
                    JOIN batch b on b.batch_id = s.batch_id
                    WHERE r.role = 'student' AND u.status = 'pending'";

        $resultAlumni = mysqli_query($conn, $sqlAlumni);

        if ($resultAlumni) {
            $alumniRecords = array(); // Initialize an empty array
            if (mysqli_num_rows($resultAlumni) > 0) {
                $i = 0;
                // Looping through the results
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
                        "status" => $row['status'],
                        "image" => $row['image'],
                        "faculty_name" => $row['faculty_name'],
                        "course_name" => $row['course_name'],
                        "batch_no" => $row['batch_no'],
                    );
                    $i++;
                }
            }
            ?>


            <div class="table-data">
                <div class="order">
                    <div class="container1">
                        <div class="center1">
                            <div class="head">
                                <h3>Alumni List (Pending)</h3>
                                <div class="text1">
                                    <input type="text" id="alumniSearchInput" required />
                                    <i class='bx bx-search'></i>
                                    <span> </span>
                                    <label>Search</label>
                                </div>
                            </div>

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
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                <tbody id="alumniTableBody">
                                    <?php
                                    if (empty($alumniRecords)) {
                                        echo "<tr><td colspan='8'>No Data are in pending list.</td></tr>";
                                    } else {
                                        foreach ($alumniRecords as $record) { ?>
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
                                                <td>
                                                    <?= $record['status'] ?>
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
                                        <?php }
                                    } ?>
                                </tbody>
                            </table>

                            <?php
        } else {
            // Error executing the query
            echo "Error: " . mysqli_error($conn);
        } ?>
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
        <!-- Pending alumni table ends------------------------------------------------------ -->
        <?php
        $sqlAlumni = "SELECT u.*, s.*, r.*, f.*, c.*, b.*
                    FROM users u
                    JOIN role_junction rj on rj.user_id = u.user_id
                    JOIN role r on rj.role_id = r.role_id
                    JOIN students s on s.user_id = u.user_id
                    JOIN faculties f on f.faculty_id = s.faculty_id
                    JOIN courses c on c.course_id = s.course_id 
                    JOIN batch b on b.batch_id = s.batch_id
                    WHERE r.role = 'student' AND u.status = 'denied'";

        $resultAlumni = mysqli_query($conn, $sqlAlumni);

        if ($resultAlumni) {
            $alumniRecords = array(); // Initialize an empty array
        
            if (mysqli_num_rows($resultAlumni) > 0) {
                $i = 0;
                // Looping through the results
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
                        "status" => $row['status'],
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
                                <h3>Alumni List (Denied)</h3>
                                <div class="text1">
                                    <input type="text" id="alumniSearchInput" required />
                                    <i class='bx bx-search'></i>
                                    <span> </span>
                                    <label>Search</label>
                                </div>
                            </div>

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
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                <tbody id="alumniTableBody">
                                    <?php
                                    if (empty($alumniRecords)) {
                                        echo "<tr><td colspan='8'>No Data are in denied list.</td></tr>";
                                    } else {
                                        foreach ($alumniRecords as $record) { ?>
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
                                                <td>
                                                    <?= $record['status'] ?>
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
                                        <?php }
                                    } ?>
                                </tbody>
                            </table>

                            <?php
        } else {
            // Error executing the query
            echo "Error: " . mysqli_error($conn);
        } ?>
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

        <!-- Denied alumni table ends ------------------------------------------------------ -->
    </main>
</section> <!-- main-lower sections ends -------------------------------------------------->

</section>
<!-- End of content section -->
</section>
<!-- End of main section -->
</div>

<script src="../js/sidebar.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
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
</script>
<script src="../js/deleteConfirmation.js"></script>

</body>

</html>