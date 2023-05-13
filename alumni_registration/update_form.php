<?php
include '../connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM alumni_registration WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $i = 0;
        // Looping through the results
        while ($row = mysqli_fetch_assoc($result)) {
            $record = array(
                "id" => $row['id'],
                "name" => $row['name'],
                "email" => $row['email'],
                // "password" => $row['password'],
                "image" => $row['image'],
            );
        }
    } else {
        echo "No records found!!";
        exit;
    }
}
mysqli_close($conn);
?>
<!DOCTYPE html>
<html>

<head>
    <title>
        Update alumni data
    </title>
</head>

<body>
    <form method="POST" action="update.php">
        <table>
            <tr>
                <td>
                    SN
                </td>
                <td>
                    <input type="hidden" name="id" value="<?php echo $record['id'] ?>" />
                    <input type="text" placeholder="Enter id" name="id" id="id" value="<?php echo $record['id'] ?>"
                        required />
                </td>
            </tr>
            <tr>
                <td>Name</td>
                <td>
                    <input type="text" name="Name" value="<?= $record['name'] ?>" placeholder="Enter your Name"
                        required />
                </td>
            </tr>
            <tr>
                <td>
                    Email
                </td>
                <td>
                    <input type="Email" name="Email" value="<?= $record['email'] ?>" placeholder="Enter your Email"
                        required />
                </td>
            </tr>
            <tr>
                <td>
                    <button type="submit">Update</button>
                </td>
                <td>
                    <a href="Display.php"> Go back </a>
                </td>
            </tr>
        </table>
    </form>
</body>

<style>
    form {
        width: 500px;
        margin-left: auto;
        margin-right: auto;
    }

    input {
        width: 270px;
    }

    textarea {
        width: 270px;
        height: 60px;
    }
</style>

</html>