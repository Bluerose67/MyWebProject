<?php
session_start();
include('../connect.php');
if (isset($_POST['add_event'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image = $_FILES['image']['name'];
    $date = $_POST['date'];

    $allowed_extension = array('gif', 'jpg', 'png', 'jpeg');
    $filename = $_FILES['image']['name'];
    $file_extension = pathinfo($filename, PATHINFO_EXTENSION);
    if (!in_array($file_extension, $allowed_extension)) {
        $_SESSION['status'] = "You are only allowed with jpg, png, jpeg, gif";
        if ($_SESSION['role'] == 'admin') {
            header("location: ../DB_Admin/Dashboard_events.php");
            exit();
        } elseif ($_SESSION['role'] == 'super_admin') {
            header("location: ../DB_Superadmin/Dashboard_events.php");
            exit();
        }
    } else {


        if (file_exists("../images/profile/" . $_FILES['image']['name'])) {
            $filename = $_FILES['image']['name'];
            $_SESSION['status'] = "Please Rename your image and resubmit the form" . $filename;
            if ($_SESSION['role'] == 'admin') {
                header("location: ../DB_Admin/Dashboard_events.php");
                exit();
            } elseif ($_SESSION['role'] == 'super_admin') {
                header("location: ../DB_Superadmin/Dashboard_events.php");
                exit();
            }
        } else {

            $sql = "INSERT INTO events (title, description, image, date) VALUES ('$title', '$description', '$image', '$date')";
            if (mysqli_query($conn, $sql)) {
                $id = mysqli_insert_id($conn);

                $image = $_FILES['image']['name']; // Get the name of the uploaded file

                // Specify the destination directory where you want to save the uploaded file
                $targetDirectory = "../images/Events/";

                // Generate a unique file name to avoid conflicts
                $targetFileName = uniqid() . "_" . basename($image);

                // The full path to the uploaded file on the server
                $targetFilePath = $targetDirectory . $targetFileName;

                // Move the uploaded file to the desired location
                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
                    // File uploaded successfully

                    // Update the value of $image with the new file name
                    $image = $targetFileName;

                    // Update the database record with the new file name 
                    $updateSql = "UPDATE events SET image = '$image' WHERE id = '$id'";
                    if (mysqli_query($conn, $updateSql)) {
                        // Image file name updated in the database successfully
                    } else {
                        echo "Error updating image file name in the database: " . mysqli_error($conn);
                        exit();
                    }
                } else {
                    // File upload failed
                    echo "Sorry, there was an error uploading your file.";
                    exit();
                }

                $message = "Event added successfully.";
                if ($_SESSION['role'] == 'admin') {
                    $_SESSION["eventAdded"] = $message;
                    header('Location:../DB_Admin/Dashboard_events.php');
                    exit();
                } elseif ($_SESSION['role'] == 'super_admin') {
                    $_SESSION["eventAdded"] = $message;
                    header('Location:../DB_Superadmin/Dashboard_events.php');
                    exit();
                } else {
                    echo "No page to Redirect.";
                    exit();
                }
            } else {
                $error = "Error adding event: " . mysqli_error($conn);
                exit();

            }
        }
    }
}
?>