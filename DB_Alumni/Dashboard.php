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


        <?php
        include "../connect.php";
        $fetchBatchQuery = "SELECT u.user_id, s.*,r.role, c.course_name, b.batch_no
                            FROM users u
                            JOIN role_junction rj on rj.user_id = u.user_id
                            JOIN role r on rj.role_id = r.role_id
                            JOIN students s ON u.user_id = s.user_id
                            JOIN courses c ON s.course_id = c.course_id
                            JOIN batch b ON s.batch_id = b.batch_id 
                            where u.user_id = " . $_SESSION['user_id'] . " ";

        $result = mysqli_query($conn, $fetchBatchQuery);
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
            } else {
                echo "No user found";
            }
        } else {
            echo "error executing sql query" . mysqli_error($conn);
        }

        // Fetch batch and course info of the logged in user
        $batch = $row['batch_no'];
        $course_name = $row['course_name'];


        //Display the event count 
        $upcommingEventQuery = "SELECT COUNT(*) as event_count FROM events";
        $result = mysqli_query($conn, $upcommingEventQuery);
        $upcommingEvent = $result->fetch_assoc()['event_count'];


        //Display the approved alumni count with the same batch_no and course as logged in user 
        $totalApprovedAlumniQuery = "SELECT COUNT(*) as total_count, u.* FROM users u
                                        JOIN role_junction rj on rj.user_id = u.user_id
                                        JOIN role r on rj.role_id = r.role_id
                                        JOIN students s ON u.user_id = s.user_id
                                        JOIN faculties f ON s.faculty_id = f.faculty_id
                                        JOIN courses c ON s.course_id = c.course_id
                                        JOIN batch b ON s.batch_id = b.batch_id 
                                        where r.role= 'student' AND b.batch_no = '$batch' 
                                        AND c.course_name = '$course_name' AND u.status = 'approved'";

        $result = mysqli_query($conn, $totalApprovedAlumniQuery);
        $totalApprovedAlumni = $result->fetch_assoc()['total_count'];
        ?>

        <ul class="box-info">
            <li>
                <i class='bx bxs-calendar-check'></i>
                <span class="text">
                    <h3>
                        <?php echo $upcommingEvent; ?>
                    </h3>
                    <p>No. of Upcomming Events</p>
                </span>
            </li>
            <li>
                <i class='bx bxs-group'></i>
                <span class="text">
                    <h3>
                        <?php echo $totalApprovedAlumni; ?>
                    </h3>
                    <p>Total No of Alumni from
                        (
                        <?php echo $course_name; ?>)
                        <?php echo $batch; ?> Batch
                    </p>
                </span>
            </li>
        </ul>


        <div class="table-data">
            <div class="order">

                <?php
                include "../connect.php";

                $sqlAlumni = "SELECT u.*, s.*,r.*, f.*, c.*, b.*
                        FROM users u
                        JOIN role_junction rj on rj.user_id = u.user_id
                        JOIN role r on rj.role_id = r.role_id
                        JOIN students s ON u.user_id = s.user_id
                        JOIN faculties f ON s.faculty_id = f.faculty_id
                        JOIN courses c ON s.course_id = c.course_id
                        JOIN batch b ON s.batch_id = b.batch_id 
                        where r.role= 'student' AND b.batch_no = '$batch' AND c.course_name = '$course_name' AND u.status = 'approved' ";

                $resultAlumni = mysqli_query($conn, $sqlAlumni);

                if ($resultAlumni) {
                    $alumniRecords = array(); // Initialize an empty array
                
                    if (mysqli_num_rows($resultAlumni) > 0) {
                        // output data of each row
                        $i = 0;
                        // Looping through the results
                        while ($row = mysqli_fetch_assoc($resultAlumni)) {
                            $alumniRecords[$i] = array(
                                "user_id" => $row['user_id'],
                                "std_id" => $row['std_id'],
                                "user_name" => $row['user_name'],
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
                                    <th>Faculty</th>
                                    <th>Course</th>
                                    <th>Batch</th>
                                    <!-- <th>Action</th> -->
                                </tr>
                                <tbody id="alumniTableBody">
                                    <?php
                                    if (empty($alumniRecords)) {
                                        echo "<tr><td colspan='8'>No Alumni Record Available.</td></tr>";
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
                                                    <?= $record['faculty_name'] ?>
                                                </td>
                                                <td>
                                                    <?= $record['course_name'] ?>
                                                </td>
                                                <td>
                                                    <?= $record['batch_no'] ?>
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