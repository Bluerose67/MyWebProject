<?php
session_start();
include '../connect.php';
$record = [];

$role = $_SESSION['role'];
// var_dump($role);

if ($role == "admin") {
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
                    "user_name" => $row['user_name'],
                    "email" => $row['email'],
                    "address" => $row['address'],
                    "DOB" => $row['DOB'],
                    "phone_no" => $row['phone_no'],
                    "department" => $row['department'],
                    "role" => $row['role'],
                );
            }
        } else {
            echo "No records found!!";
            exit;
        }
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
                <form action="update.php" method="post">
                    <input type="hidden" name="admin_id" value="<?php echo $record['admin_id'] ?>" />
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
                    <div class="text">
                        <input type="text" name="department" value="<?= $record['department'] ?>" />
                        <span> </span>
                        <label>Department</label>
                    </div>
                    <input type="submit" value="Update" class="login-button" />
                    <!-- <span> </span> -->
                    <button class="display-button"><a href="../DB_Admin/Dashboard_alumni.php"> Go back </a> </button>
                </form>
            </div>
        </div>
    </body>

    </html>
<?php } else {

    if (isset($_GET['std_id'])) {
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
                    "user_name" => $row['user_name'],
                    "email" => $row['email'],
                    "address" => $row['address'],
                    "DOB" => $row['DOB'],
                    "phone_no" => $row['phone_no'],
                    "department" => $row['department'],
                    "role" => $row['role'],
                );
            }
        } else {
            echo "No records found!!";
            exit;
        }
    } ?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>
            Update Alumni data
        </title>
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <div class="container">
            <div class="center">
                <h1>Update Alumni Details</h1>
                <form action="update.php" method="post">
                    <input type="hidden" name="admin_id" value="<?php echo $record['admin_id'] ?>" />
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
                    <div class="text">
                        <input type="text" name="department" value="<?= $record['department'] ?>" />
                        <span> </span>
                        <label>Department</label>
                    </div>
                    <input type="submit" value="Update" class="login-button" />
                    <!-- <span> </span> -->
                    <button class="display-button"><a href="../DB_Admin/Dashboard_alumni.php"> Go back </a> </button>
                </form>
            </div>
        </div>
    </body>

    </html>

    <?php
}
mysqli_close($conn);
?>