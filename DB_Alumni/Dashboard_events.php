<?php
require_once('Dashboard_template.php');
?>

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