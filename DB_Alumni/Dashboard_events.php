<?php
require_once('Dashboard_template.php');
?>

<!-- Notification  -->
<?php if (isset($_SESSION['interested'])) { ?>
    <div class="notification_CRUD">
        <p>
            <?php
            echo $_SESSION['interested'];
            unset($_SESSION['interested']);
            ?>
        </p>
        <span class="notification_progress_CRUD"></span>
    </div>
<?php } ?>

<section class="right-lower">
    <main>
        <div class="head-title">
            <div class="left">
                <h1>Events</h1>
                <ul class="breadcrumb">
                    <li>
                        <a href="#">Events</a>
                    </li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li>
                        <a class="active" href="../Landing_pages/index.php">Home</a>
                    </li>
                </ul>
            </div>

        </div>

        <div class="event-list">

            <?php


            // Fetch all events from the database
            $sql = "SELECT * FROM events";
            $result = mysqli_query($conn, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) { ?>
                    <?php
                    $eventId = $row['id'];

                    // Fetch the interested users for the event
                    $sqlInterested = "SELECT users.user_name FROM interested_users 
                                    JOIN users ON interested_users.user_id = users.user_id 
                                    WHERE interested_users.id = '$eventId'";
                    $resultInterested = mysqli_query($conn, $sqlInterested);

                    $interestedUsers = [];
                    if ($resultInterested && mysqli_num_rows($resultInterested) > 0) {
                        while ($interestedRow = mysqli_fetch_assoc($resultInterested)) {
                            $interestedUsers[] = $interestedRow['user_name'];
                        }
                    }
                    ?>
                    <div class="event">
                        <h3>
                            <?= $row['title'] ?>
                        </h3>
                        <div class="event_image">
                            <img src="<?php echo "../images/events/" . $row['image'] ?>" alt="Event Photo" class="image">
                        </div>
                        <p>
                            <?= $row['description'] ?>
                        </p>
                        <p>Date:
                            <?= $row['date'] ?>
                        </p>
                        <!-- Interest buttons -->
                        <?php if (in_array($_SESSION['username'], $interestedUsers)): ?>
                            <form action="../Events/event.php?id=<?= $row['id'] ?>&title=<?= urlencode($row['title']) ?>"
                                method="POST">

                                <button type="submit" name="cancel_interest" class="edit-profile">Cancel Interest</button>
                            </form>
                        <?php else: ?>
                            <form action="../Events/event.php?id=<?= $row['id'] ?>&title=<?= urlencode($row['title']) ?>"
                                method="POST">
                                <button type="submit" name="show_interest" class="edit-profile">Show Interest</button>
                            </form>
                        <?php endif; ?>

                    </div>
                <?php }
            } else {
                echo "Sorry, There are no events going on or about to happen.";
            }
            ?>
        </div>

        <section class="more_info">
            <div class="event_message">
                <p class="p1"> ACHS provides various kinds of events for the personal growth of the students. </p>
                <p class="p1"> Not only that but also refreshment is necessary for the students from all the pressure
                    from studies.</p>
                <p class="p2"> If any alumni are interested in the events then they are requested to reachout to the
                    frontdesk.</p>
            </div>
        </section>

    </main>
</section> <!-- right lower ends -->
</section> <!-- content section ends -->
</section> <!-- main section ends -->
</div><!-- dashboard ends -->
<script src="../js/sidebar.js"></script>

</body>

</html>