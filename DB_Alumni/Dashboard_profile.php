<?php
require_once('Dashboard_template.php');
?>
<section class="right-lower">
    <main>
        <div class="head-title">
            <div class="left">
                <h1>My Profile</h1>
                <ul class="breadcrumb">
                    <li>
                        <a href="#">My Profile</a>
                    </li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li>
                        <a class="active" href="../Landing_pages/index.php">Home</a>
                    </li>
                </ul>
            </div>

        </div>

        <!-- Keep the profile code here -->
        <section class="profile-main"> <!-- profile main begins -->

            <section class="row">

                <div class="field1">
                    <img src="<?php echo "../images/profile/" . $row['image']; ?>" alt="" class="Profile-img">
                </div>
                <div class="field">
                    <label>User ID:</label>
                    <span>
                        <?= $row['user_id'] ?>
                    </span>
                </div>
                <div class="field">
                    <label>User Name:</label>
                    <span>
                        <?= $row['user_name'] ?>
                    </span>
                </div>
                <div class="field">
                    <label>Role:</label>
                    <span>
                        <?= $row['role'] ?>
                    </span>
                </div>
                <button class="edit-profile">
                    <a href="update_profile.php?std_id=<?= $row['std_id'] ?>">Edit
                        Profile</a>
                </button>

            </section> <!-- row -->

            <section class="profile-right"> <!-- additional and bio section -->

                <section class="additional-info">
                    <div class="field">
                        <label>Email:</label>
                        <span>
                            <?= $row['email'] ?>
                        </span>
                    </div>
                    <div class="field">
                        <label>Address:</label>
                        <span>
                            <?= $row['address'] ?>
                        </span>
                    </div>
                    <div class="field">
                        <label>Date of Birth:</label>
                        <span>
                            <?= $row['DOB'] ?>
                        </span>
                    </div>
                    <div class="field">
                        <label>Contact:</label>
                        <span>
                            <?= $row['phone_no'] ?>
                        </span>
                    </div>
                    <div class="field">
                        <label>Faculty:</label>
                        <span>
                            <?= $row['faculty_name'] ?>
                        </span>
                    </div>
                    <div class="field">
                        <label>Course:</label>
                        <span>
                            <?= $row['course_name'] ?>
                        </span>
                    </div>
                    <div class="field">
                        <label>Batch:</label>
                        <span>
                            <?= $row['batch_no'] ?>
                        </span>
                    </div>
                </section> <!-- additional_info -->

                <section class="Bio">
                    <div class="Bio-field">
                        <label style="margin-bottom: 10px;">Bio (About yourself):</label>
                        <div>
                            <?= $row['bio'] ?>
                        </div>
                    </div>
                </section> <!-- bio ends -->
            </section> <!-- additional and bio section -->
            </secttion> <!-- profile main ends -->

            <!--  -->
    </main>
</section> <!-- rigth lower ends------------------- -->
</section> <!-- content section ends------------------------------ -->
</section> <!-- main section ends -->

</div><!-- dashboard ends -->

<script src="../js/sidebar.js"></script>

</body>

</html>