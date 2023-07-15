<?php

require_once('dashboard_template.php');

?>

<div class="notification_CRUD">
    <p>
        <?php
        if (isset($_SESSION['adminAdded'])) {

            echo $_SESSION['adminAdded'];

            unset($_SESSION['adminAdded']);

        } elseif (isset($_SESSION['adminUpdated'])) {

            echo $_SESSION['adminUpdated'];

            unset($_SESSION['adminUpdated']);

        } elseif (isset($_SESSION['adminDeleted'])) {

            echo $_SESSION['adminDeleted'];

            unset($_SESSION['adminDeleted']);

        } elseif (isset($_SESSION['alumniAdded'])) {

            echo $_SESSION['alumniAdded'];

            unset($_SESSION['alumniAdded']);

        } elseif (isset($_SESSION['alumniUpdated'])) {

            echo $_SESSION['alumniUpdated'];

            unset($_SESSION['alumniUpdated']);

        } elseif (isset($_SESSION['alumniDeleted'])) {

            echo $_SESSION['alumniDeleted'];

            unset($_SESSION['alumniDeleted']);

        } else {
            echo "Welcome, " . $_SESSION['username'];
        }
        ?>
    </p>
    <span class="notification_progress_CRUD"></span>
</div>

<section class="right-lower">
    <!-- main-lower sections begins -------------------------------------------------->
    <main>
        <div class="head-title">
            <div class="left">
                <h1>Admin List</h1>
                <ul class="breadcrumb">
                    <li>
                        <a href="#">Admin List</a>
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
            $studentQuery = "SELECT COUNT(*) as student_count FROM role 
            JOIN role_junction ON role_junction.role_id = role.role_id
            JOIN users on role_junction.user_id = users.user_id 
            WHERE role.role = 'student' AND users.status = 'approved'";
            $result = mysqli_query($conn, $studentQuery);
            $studentCount = $result->fetch_assoc()['student_count'];

            //Display the Admin Count
            $adminQuery = "SELECT COUNT(*) as admin_count FROM role 
            JOIN role_junction ON role_junction.role_id = role.role_id
            JOIN users on role_junction.user_id = users.user_id
            WHERE role.role = 'admin' AND users.status = 'approved'";
            $result = mysqli_query($conn, $adminQuery);
            $adminCount = $result->fetch_assoc()['admin_count'];

            //Display the Total Count
            $totalQuery = "SELECT COUNT(*) as total_count FROM users WHERE users.status = 'approved'";
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
                    JOIN departments on departments.d_id = admins.d_id
                    JOIN role_junction on role_junction.user_id = users.user_id
                    JOIN role ON role_junction.role_id = role.role_id
                    WHERE role.role = 'admin' AND users.status = 'approved'";

        $resultAdmin = mysqli_query($conn, $sqlAdmin);

        if ($resultAdmin) {
            $adminRecords = array(); // Initialize an empty array
        
            if (mysqli_num_rows($resultAdmin) > 0) {
                $i = 0;
                // Looping through the results
                while ($row = mysqli_fetch_assoc($resultAdmin)) {
                    $adminRecords[$i] = array(
                        "user_id" => $row['user_id'],
                        "d_id" => $row['d_id'],
                        "role_id" => $row['role_id'],
                        "user_name" => $row['user_name'],
                        "email" => $row['email'],
                        "address" => $row['address'],
                        "DOB" => $row['DOB'],
                        "phone_no" => $row['phone_no'],
                        "status" => $row['status'],
                        "department" => $row['department'],
                        "role" => $row['role'],
                        "image" => $row['image'],

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
                                    <th>Status</th>
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
                                            <td>
                                                <?= $record['status'] ?>
                                            </td>
                                            <td class="change-buttons">
                                                <div class="dropdown">
                                                    <button class="icon-button">&#x22EE;</button>
                                                    <div class="dropdown-menu">
                                                        <button class="edit-button">
                                                            <a
                                                                href="../alumni_registration/update_form.php?d_id=<?= $record['d_id'] ?>">Edit</a>
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
                            <?php
        } else {
            // Error executing the query
            echo "Error: " . mysqli_error($conn);
        } ?>
                        <div id="confirmationModalAdmin" class="modal_delete">
                            <div class="modal-content_delete">
                                <h2>Confirmation</h2>
                                <p>Are you sure you want to delete?</p>
                                <button id="confirmDeleteBtnAdmin" class="edit-button">
                                    <a
                                        href="../alumni_registration/deleteAdmin.php?user_id=<?= $record['user_id'] ?>&d_id=<?= $record['d_id'] ?>&image=<?= $record['image'] ?>">Delete</a>
                                </button>
                                <button id="cancelDeleteBtnAdmin" class="edit-button">No</button>
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