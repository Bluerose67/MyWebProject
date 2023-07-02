<?php
session_start();
include '../connect.php';
$record = [];

$role = $_SESSION['role'];
// var_dump($role);

if (isset($_GET['admin_id'])) {
    $admin_id = $_GET['admin_id'];
    $sql = "SELECT * from users  
                JOIN admins ON users.user_id=admins.user_id
                JOIN role ON users.user_id=role.user_id 
                WHERE admins.admin_id= '$admin_id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $i = 0;
        // Looping through the results
        while ($row = mysqli_fetch_assoc($result)) {
            $record = array(
                "user_id" => $row['user_id'],
                "admin_id" => $row['admin_id'],
                "role_id" => $row['role_id'],
                "user_name" => $row['user_name'],
                "email" => $row['email'],
                "address" => $row['address'],
                "DOB" => $row['DOB'],
                "phone_no" => $row['phone_no'],
                "department" => $row['department'],
                "role" => $row['role'],
                "image" => $row['image'],
                "bio" => $row['bio'],
            );
        }
    } else {
        echo "No records found!!";
        exit;
    } ?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>
            Update Admin data
        </title>
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <div class="container">
            <div class="center">
                <h1>Update Admin Details</h1>
                <form action="updateAdmin.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="admin_id" value="<?php echo $record['admin_id'] ?>" />
                    <input type="hidden" name="user_id" value="<?php echo $record['user_id'] ?>" />
                    <input type="hidden" name="role_id" value="<?php echo $record['role_id'] ?>" />
                    <input type="hidden" name="bio" value="<?php echo $record['bio'] ?>" />
                    <div class="text">
                        <input type="text" name="user_name" value="<?= $record['user_name'] ?>" required />
                        <span> </span>
                        <label>Name</label>
                    </div>
                    <div class="text">
                        <input type="email" name="email" value="<?= $record['email'] ?>" required />
                        <span> </span>
                        <label>Email</label>
                    </div>
                    <div class="text">
                        <input type="text" name="address" value="<?= $record['address'] ?>" />
                        <span> </span>
                        <label>Address</label>
                    </div>
                    <div class="text">
                        <input type="text" name="DOB" value="<?= $record['DOB'] ?>" />
                        <span> </span>
                        <label>DOB</label>
                    </div>
                    <div class="text">
                        <input type="text" name="phone_no" value="<?= $record['phone_no'] ?>" />
                        <span> </span>
                        <label>Contact</label>
                    </div>

                    <div class="textt">

                        <input type="file" id="image" name="image">
                        <input type="hidden" id="image" name="image_old" value="<?php echo $record['image']; ?>">

                    </div>

                    <div class="profile">
                        <img src="<?php echo "../images/profile/" . $record['image']; ?>" alt="Avatar" class="avatar">
                    </div>

                    <div class="text1">
                        <select id="role" name="role" class="display-button">
                            <option value="">Select Role</option>
                            <option value="admin" <?php if ($record['role'] == 'admin')
                                echo 'selected'; ?>>Admin</option>
                            <option value="student" <?php if ($record['role'] == 'student')
                                echo 'selected'; ?>>Student
                            </option>
                        </select>
                    </div>
                    <div class="text">
                        <input type="text" name="department" value="<?= $record['department'] ?>" />
                        <span> </span>
                        <label>Department</label>
                    </div>
                    <input type="submit" value="Update" class="login-button" />
                    <!-- <span> </span> -->
                    <?php
                    if ($role === 'super_admin') { ?>
                        <button class="display-button"><a href="../DB_Superadmin/Dashboard.php"> Go back </a> </button>
                    <?php } else { ?>
                        <button class="display-button"><a href="../DB_Admin/Dashboard.php"> Go back </a> </button>
                    <?php }
                    ?>

                </form>
            </div>
        </div>
    </body>

    </html>



<?php } else if (isset($_GET['std_id'])) {
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
                "image" => $row['image'],
                "bio" => $row['bio'],
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

        <!DOCTYPE html>
        <html>

        <head>
            <title>
                Update Alumni Profile
            </title>
            <link rel="stylesheet" href="style.css">
        </head>

        <body>
            <div class="container">
                <div class="center">
                    <h1>Update Alumni Details</h1>
                    <form action="updateAlumni.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="std_id" value="<?php echo $record['std_id'] ?>" />
                        <input type="hidden" name="user_id" value="<?php echo $record['user_id'] ?>" />
                        <input type="hidden" name="role_id" value="<?php echo $record['role_id'] ?>" />
                        <input type="hidden" name="faculty_id" value="<?php echo $record['faculty_id'] ?>" />
                        <input type="hidden" name="course_id" value="<?php echo $record['course_id'] ?>" />
                        <input type="hidden" name="batch_id" value="<?php echo $record['batch_id'] ?>" />
                        <input type="hidden" name="bio" value="<?php echo $record['bio'] ?>" />

                        <div class="text">
                            <input type="text" name="user_name" value="<?= $record['user_name'] ?>" required />
                            <span> </span>
                            <label>Name</label>
                        </div>
                        <div class="text">
                            <input type="email" name="email" value="<?= $record['email'] ?>" required />
                            <span> </span>
                            <label>Email</label>
                        </div>
                        <div class="text">
                            <input type="text" name="address" value="<?= $record['address'] ?>" />
                            <span> </span>
                            <label>Address</label>
                        </div>
                        <div class="text">
                            <input type="text" name="DOB" value="<?= $record['DOB'] ?>" />
                            <span> </span>
                            <label>DOB</label>
                        </div>
                        <div class="text">
                            <input type="text" name="phone_no" value="<?= $record['phone_no'] ?>" />
                            <span> </span>
                            <label>Contact</label>
                        </div>

                        <div class="textt">

                            <input type="file" id="image" name="image">
                            <input type="hidden" id="image" name="image_old" value="<?php echo $record['image']; ?>">

                        </div>
                        <div class="profile">
                            <img src="<?php echo "../images/profile/" . $record['image']; ?>" alt="Avatar" class="avatar">
                        </div>


                        <div class="text1">
                            <select id="role" name="role" class="display-button">
                                <option value="">Select Role</option>
                                <option value="admin" <?php if ($record['role'] == 'admin')
                                    echo 'selected'; ?>>Admin</option>
                                <option value="student" <?php if ($record['role'] == 'student')
                                    echo 'selected'; ?>>Student
                                </option>
                            </select>
                        </div>
                        <div class="text">
                            <input type="text" name="faculty_name" value="<?= $record['faculty_name'] ?>" />
                            <span> </span>
                            <label>Faculty Name</label>
                        </div>
                        <div class="text">
                            <input type="text" name="course_name" value="<?= $record['course_name'] ?>" />
                            <span> </span>
                            <label>Course Name</label>
                        </div>
                        <div class="text">
                            <input type="text" name="batch_no" value="<?= $record['batch_no'] ?>" />
                            <span> </span>
                            <label>Batch Name</label>
                        </div>
                        <input type="submit" value="Update" class="login-button" />
                        <!-- <span> </span> -->
                        <?php
                        if ($role == 'super_admin') { ?>
                            <button class="display-button"><a href="../DB_Superadmin/Dashboard.php"> Go back </a> </button>
                        <?php } elseif ($role == 'admin') { ?>
                            <button class="display-button"><a href="../DB_Admin/Dashboard.php"> Go back </a> </button>
                        <?php } else {
                            echo "error";
                        }
                        ?>
                    </form>
                </div>
            </div>
        </body>

        </html>

    <?php }
mysqli_close($conn);
?>