<?php
require_once('../DB_Alumni/dashboard_template.php');
?>
<?php
if (isset($_GET['std_id'])) {
    $std_id = $_GET['std_id'];
    $sql = "SELECT u.*, s.*, r.*, f.*, c.*, b.*
            FROM users u
            JOIN role r ON u.user_id = r.user_id
            JOIN students s ON u.user_id = s.user_id
            JOIN faculties f ON s.faculty_id = f.faculty_id
            JOIN courses c ON s.course_id = c.course_id
            JOIN batch b ON s.batch_id = b.batch_id
            WHERE s.std_id = '$std_id'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $i = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $record = array(
                "user_id" => $row['user_id'],
                "std_id" => $row['std_id'],
                "role_id" => $row['role_id'],
                "faculty_id" => $row['faculty_id'],
                "course_id" => $row['course_id'],
                "batch_id" => $row['batch_id'],
                "user_name" => $row['user_name'],
                "email" => $row['email'],
                "address" => $row['address'],
                "DOB" => $row['DOB'],
                "phone_no" => $row['phone_no'],
                "bio" => $row['bio'],
                "image" => $row['image'],
                "role" => $row['role'],
                "faculty_name" => $row['faculty_name'],
                "course_name" => $row['course_name'],
                "batch_no" => $row['batch_no'],
            );
            $i++;
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
            <form action="../alumni_registration/updateAlumni.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="user_id" value="<?php echo $record['user_id'] ?>" />
                <input type="hidden" name="std_id" value="<?php echo $record['std_id'] ?>" />
                <input type="hidden" name="role_id" value="<?php echo $record['role_id'] ?>" />
                <input type="hidden" name="faculty_id" value="<?php echo $record['faculty_id'] ?>" />
                <input type="hidden" name="course_id" value="<?php echo $record['course_id'] ?>" />
                <input type="hidden" name="batch_id" value="<?php echo $record['batch_id'] ?>" />

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
                                <div class="text">
                                    <input type="text" name="user_name" value="<?= $record['user_name'] ?>" required />
                                </div>
                            </span>
                        </div>
                        <div class="field">
                            <label>Role:</label>
                            <span>
                                <div class="text">
                                    <input type="text" name="role" value="<?= $record['role'] ?>" required />
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
                                    <div class="text">
                                        <input type="email" name="email" value="<?= $record['email'] ?>" required />
                                    </div>
                                </span>
                            </div>
                            <div class="field">
                                <label>Address:</label>
                                <span>
                                    <div class="text">
                                        <input type="text" name="address" value="<?= $record['address'] ?>" required />
                                    </div>
                                </span>
                            </div>
                            <div class="field">
                                <label>Date of Birth:</label>
                                <span>
                                    <div class="text">
                                        <input type="text" name="DOB" value="<?= $record['DOB'] ?>" required />
                                    </div>
                                </span>
                            </div>
                            <div class="field">
                                <label>Contact:</label>
                                <span>
                                    <div class="text">
                                        <input type="text" name="phone_no" value="<?= $record['phone_no'] ?>" required />
                                    </div>
                                </span>
                            </div>
                            <div class="field">
                                <label>Faculty:</label>
                                <span>
                                    <div class="text">
                                        <input type="text" name="faculty_name" value="<?= $record['faculty_name'] ?>"
                                            required />
                                    </div>
                                </span>
                            </div>
                            <div class="field">
                                <label>Course:</label>
                                <span>
                                    <div class="text">
                                        <input type="text" name="course_name" value="<?= $record['course_name'] ?>"
                                            required />
                                    </div>
                                </span>
                            </div>
                            <div class="field">
                                <label>Batch:</label>
                                <span>
                                    <div class="text">
                                        <input type="text" name="batch_no" value="<?= $record['batch_no'] ?>" required />
                                    </div>
                                </span>
                            </div>
                        </section> <!-- additional_info -->

                        <section class="Bio">
                            <div class="Bio-field">
                                <label style="margin-bottom: 10px;">Bio (About yourself):</label>
                                <span>
                                    <input type="text" name="bio" value="<?= $record['bio'] ?>" class="custom-input">
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