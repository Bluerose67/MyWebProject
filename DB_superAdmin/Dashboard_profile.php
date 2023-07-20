<?php
require_once('dashboard_template.php');
?>

<?php if (isset($_SESSION['adminUpdated'])) { ?>
    <div class="notification_CRUD">
        <p>
            <?php
            echo $_SESSION['adminUpdated'];

            unset($_SESSION['adminUpdated']);
            ?>
        </p>
        <span class="notification_progress_CRUD"></span>
    </div>
<?php } ?>
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

        <!-- profile code here -->
        <secttion class="profile-main"> <!-- profile main begins -->

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

                <?php if ($_SESSION['role'] == 'admin') { ?>
                    <button class="edit-profile">
                        <a href="update_profile.php?d_id=<?= $row['d_id'] ?>">Edit
                            Profile</a>
                    </button>
                <?php } ?>

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
                        <label>department:</label>
                        <span>
                            <?= $row['department'] ?>
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
    </main>
</section> <!-- rigth lower ends------------------- -->
</section> <!-- content section ends -->
</section> <!-- main section ends------------------------------ -->


</div><!-- dashboard ends -->
<script src="../js/sidebar.js"></script>

</body>

</html>