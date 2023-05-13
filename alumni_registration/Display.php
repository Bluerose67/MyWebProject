<?php
include "../connect.php";

$sql = "SELECT * FROM alumni_registration";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    $i = 0;
    // Looping through the results
    while ($row = mysqli_fetch_assoc($result)) {
        $records[$i] = array(
            "id" => $row['id'],
            "name" => $row['name'],
            "email" => $row['email'],
            "password" => $row['password'],
            "image" => $row['image'],
        );
        $i++;
    }
}
//connection close
mysqli_close($conn);
?>
<!DOCTYPE html>
<html>

<head>
    <title>
        Display All Alumni
    </title>
</head>

<body>
    <a href="index.php">
        <h3>Add new Alumni</h3>
    </a>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Image</th>
        </tr>
        <?php foreach ($records as $record) { ?>
            <tr>
                <td>
                    <?= $record['id'] ?>
                </td>
                <td>
                    <?= $record['name'] ?>
                </td>
                <td>
                    <?= $record['email'] ?>
                </td>
                <td>
                    <?= $record['image'] ?>
                </td>
                <td>
                    <a href="update_form.php?id=<?= $record['id'] ?>">Edit</a>
                    <a href="delete.php?id=<?= $record['id'] ?>">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>