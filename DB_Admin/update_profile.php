<?php
require_once('../DB_Superadmin/dashboard_template.php');
?>


<?php
if (isset($_GET['d_id'])) {
    $d_id = $_GET['d_id'];
    $sql = "SELECT * FROM users 
            JOIN admins ON admins.user_id = users.user_id
            JOIN departments on departments.d_id = admins.d_id
            JOIN role_junction on role_junction.user_id = users.user_id
            JOIN role ON role_junction.role_id = role.role_id
            WHERE departments.d_id= '$d_id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $i = 0;
        // Looping through the results
        while ($row = mysqli_fetch_assoc($result)) {
            $record = array(
                "user_id" => $row['user_id'],
                "d_id" => $row['d_id'],
                "role_id" => $row['role_id'],
                "user_name" => $row['user_name'],
                "email" => $row['email'],
                "address" => $row['address'],
                "DOB" => $row['DOB'],
                "phone_no" => $row['phone_no'],
                "bio" => $row['bio'],
                "status" => $row['status'],
                "department" => $row['department'],
                "role" => $row['role'],
                "image" => $row['image'],
            );
        }
    } else {
        echo "No records found!!";
        exit;
    } ?>
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
            <!-- Display admin form -->
            <form action="../alumni_registration/updateAdmin.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="user_id" value="<?php echo $record['user_id'] ?>" />
                <input type="hidden" name="d_id" value="<?php echo $record['d_id'] ?>" />
                <input type="hidden" name="role_id" value="<?php echo $record['role_id'] ?>" />
                <input type="hidden" name="role" value="<?php echo $record['role'] ?>" />
                <input type="hidden" name="status" value="<?php echo $record['status'] ?>" />
                <input type="hidden" name="department" value="<?= $record['department'] ?>" />


                <section class="profile-main"> <!-- profile main begins -->

                    <section class="row">

                        <div class="field1">
                            <img src="<?php echo "../images/profile/" . $record['image']; ?>" alt="" class="Profile-img">
                        </div>

                        <div class="field">
                            <input type="file" id="image" name="image">
                            <input type="hidden" id="image" name="image_old" value="<?php echo $record['image']; ?>">
                        </div>

                        <div class="field">
                            <label>User ID:</label>
                            <span>
                                <?= $record['user_id'] ?>
                            </span>
                        </div>
                        <div class="field">
                            <label>User Name:</label>
                            <span>
                                <div class="text_p">
                                    <input type="text" name="user_name" value="<?= $record['user_name'] ?>" required />
                                </div>
                            </span>
                        </div>

                        <input type="submit" value="SAVE" class="edit-profile" />

                    </section> <!-- row -->

                    <section class="profile-right"> <!-- additional and bio section -->

                        <section class="additional-info">
                            <div class="field">
                                <label>Email:</label>
                                <span>
                                    <div class="text_p">
                                        <input type="email" name="email" value="<?= $record['email'] ?>" required />
                                    </div>
                                </span>
                            </div>
                            <div class="field">
                                <label>Address:</label>
                                <span>
                                    <div class="text_p">
                                        <input type="text" name="address" value="<?= $record['address'] ?>" required />
                                    </div>
                                </span>
                            </div>
                            <div class="field">
                                <label>Date of Birth:</label>
                                <span>
                                    <div class="text_p">
                                        <input type="text" name="DOB" value="<?= $record['DOB'] ?>" required />
                                    </div>
                                </span>
                            </div>
                            <div class="field">
                                <label>Contact:</label>
                                <span>
                                    <div class="text_p">
                                        <input type="text" name="phone_no" value="<?= $record['phone_no'] ?>" required />
                                    </div>
                                </span>
                            </div>
                        </section> <!-- additional_info -->

                        <section class="Bio">
                            <div class="Bio-field">
                                <label style="margin-bottom: 10px;">Bio (About yourself):</label>
                                <span>
                                    <textarea name="bio" id="" cols="90" rows="10"> <?= $record['bio'] ?></textarea>
                                </span>
                            </div>
                        </section> <!-- bio ends -->
                    </section> <!-- additional and bio section -->
                </section> <!-- profile main ends -->
            </form>
        </main>
    </section> <!-- right-lower ends -->
    </section> <!-- content section ends -->
    </section> <!-- main section ends------------------------------ -->


    </div><!-- dashboard ends -->
    <script src="../js/sidebar.js"></script>
    </body>

    </html>
<?php } ?>