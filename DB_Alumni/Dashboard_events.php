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
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="event">';
                    echo '<h3>' . $row['title'] . '</h3>';
                    echo '<img src="../event_photos/' . $row['photo'] . '" alt="Event Photo">';
                    echo '<p>' . $row['description'] . '</p>';
                    echo '<p>Date: ' . $row['date'] . '</p>';
                    echo '<p><a href="events.php?delete_event=' . $row['id'] . '">Delete</a></p>';
                    echo '</div>';
                }
            } else {
                echo "Sorry, There are no any events going on.";
            }
            ?>
        </div>
    </main>
</section> <!-- right lower ends -->
</section> <!-- content section ends -->
</section> <!-- main section ends -->
</div><!-- dashboard ends -->
<script src="../js/sidebar.js"></script>

</body>

</html>