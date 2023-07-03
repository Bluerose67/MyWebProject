<?php
require_once('Dashboard_template.php');
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
                            "image" => $row['image'],
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

                <div class="container1">
                    <div class="center1">
                        <div class="head">
                            <h3>Alumni List</h3>
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
                                <!-- <th>Action</th> -->
                            </tr>
                            <tbody id="alumniTableBody">
                                <?php foreach ($records as $record) { ?>
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
<!-- content sections ends ---------------------------------------------------------------------------------->


<div class="notification">
    <p> Welcome,
        <?php echo $_SESSION['username'] ?>
    </p>
    <span class="notification_progress"></span>
</div>


</div><!-- dashboard ends ---------------------------------------------------------------------------->
<script src="../js/sidebar.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

    /* Filter data  */

    $(document).ready(function () {
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