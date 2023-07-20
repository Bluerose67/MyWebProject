<?php
require_once('../DB_Superadmin/Dashboard_template.php');
?>
<section class="right-lower">
    <!-- main-lower sections begins -------------------------------------------------->
    <main>
        <div class="head-title">
            <div class="left">
                <h1>Event Participants List</h1>
                <ul class="breadcrumb">
                    <li>
                        <a href="#">Event Participants List</a>
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

            $eventId = $_GET['id'];

            //Display the pending student count 
            $interestedUserQuery = "SELECT COUNT(*) as interestedUser_count FROM interested_users 
            WHERE interested_users.id = '$eventId' ";

            $result = mysqli_query($conn, $interestedUserQuery);
            $interestedUserCount = $result->fetch_assoc()['interestedUser_count'];

            ?>
            <li>
                <i class='bx bxs-group'></i>
                <span class="text">
                    <h3>
                        <?php echo $interestedUserCount; ?>
                    </h3>
                    <p>No. of Interested user for this event.</p>
                </span>
            </li>
        </ul>


        <?php

        // Fetch the interested users for the event
        $sqlInterested = "SELECT users.*, events.title FROM interested_users 
                        JOIN users ON interested_users.user_id = users.user_id
                        JOIN events ON events.id = interested_users.id 
                        WHERE interested_users.id = '$eventId'";
        $resultInterested = mysqli_query($conn, $sqlInterested);

        if ($resultInterested) {

            $interestedUsers = [];
            if ($resultInterested && mysqli_num_rows($resultInterested) > 0) {
                $i = 0;
                while ($interestedRow = mysqli_fetch_assoc($resultInterested)) {
                    $interestedUsers[$i] = array(
                        "user_name" => $interestedRow['user_name'],
                        "title" => $interestedRow['title'],
                        "image" => $interestedRow['image'],
                        "email" => $interestedRow['email'],
                        "address" => $interestedRow['address'],
                        "phone_no" => $interestedRow['phone_no'],
                    );
                    $i++;
                }
            } ?>

            <div class="table-data">
                <div class="order">
                    <div class="container1">
                        <div class="center1">
                            <div class="head">
                                <h3>Interested Users for
                                    <?php
                                    $eventTitle = "SELECT events.title FROM events
                                    JOIN interested_users ON interested_users.id = events.id
                                    WHERE interested_users.id = '$eventId'";

                                    $eventTitleResult = mysqli_query($conn, $eventTitle);
                                    if ($eventTitleResult && mysqli_num_rows($eventTitleResult) > 0) {
                                        $eventTtileRow = mysqli_fetch_assoc($eventTitleResult);
                                        $eventTitle = $eventTtileRow['title'];

                                        echo $eventTitle;
                                    } else {
                                        echo "Event not found.";
                                    }
                                    ?>
                                </h3>
                                <!-- <input type="text" id="adminSearchInput" placeholder="Search"> -->
                                <div class="text1">
                                    <input type="text" id="adminSearchInput" required />
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
                                    <th>Contact</th>
                                </tr>
                                <tbody id="adminTableBody">
                                    <?php
                                    if (empty($interestedUsers)) {
                                        echo "<tr><td colspan='8'>There are no interested users in this event.</td></tr>";
                                    } else {
                                        foreach ($interestedUsers as $user) { ?>
                                            <tr>
                                                <td>
                                                    <img src="<?php echo "../images/profile/" . $user['image'] ?>">
                                                </td>
                                                <td>
                                                    <?= $user['user_name'] ?>
                                                </td>
                                                <td>
                                                    <?= $user['email'] ?>
                                                </td>
                                                <td>
                                                    <?= $user['address'] ?>
                                                </td>
                                                <td>
                                                    <?= $user['phone_no'] ?>
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
                    </div> <!-- center1 div -->
                </div> <!-- container1 div -->
            </div> <!-- order div -->
        </div> <!-- table data div -->
</section>
</body>

</html>