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

        <div class="form-box">
            <div class="center-box">
                <h2>Add Event</h2>
                <form action="../Events/addEvents.php" method="post" enctype="multipart/form-data">
                    <div class="text">
                        <input type="text" id="title" name="title" required>
                        <span> </span>
                        <label for="event_title">Event Title</label>
                    </div>

                    <div class="text">
                        <input type="text" name="description" id="description" required>
                        <span> </span>
                        <label for="username">Description</label>
                    </div>

                    <div class="textt">
                        <input type="file" id="image" name="image" required>
                    </div>

                    <div class="text">
                        <input type="date" id="DOB" name="DOB" required>
                        <span> </span>
                        <label for="DOB">Event Date</label>
                    </div>
                    <input type="submit" name="add_event" value="Add Event">

                </form>
            </div>
        </div>

        <div class="message <?php echo isset($message) ? 'success' : (isset($error) ? 'error' : ''); ?>">
            <?php echo isset($message) ? $message : (isset($error) ? $error : ''); ?>
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
                    echo '<img src="../images/events/' . $row['image'] . '" alt="Event Photo">';
                    echo '<p>' . $row['description'] . '</p>';
                    echo '<p>Date: ' . $row['date'] . '</p>';
                    echo '<p><a href="events.php?delete_event=' . $row['id'] . '">Delete</a></p>';
                    echo '</div>';
                }
            } else {
                echo "No events found.";
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