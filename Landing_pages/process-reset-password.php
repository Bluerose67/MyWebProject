<?php
$passwordReset = 'Your Password has been Reset.';

$token = $_POST["token"];

$token_hash = hash("sha256", $token);

// Use the correct connection object (mysqli) directly, not require()
require "../connect.php";

$sql = "SELECT * FROM users
        WHERE reset_token_hash = ?";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Error in preparing statement: " . $conn->error);
}

$stmt->bind_param("s", $token_hash);

if (!$stmt->execute()) {
    die("Error in executing statement: " . $stmt->error);
}

$result = $stmt->get_result();

$user = $result->fetch_assoc();
// var_dump($user["user_id"]);

if ($user === null) {
    die("Token not found");
}

if (strtotime($user["reset_token_expires_at"]) <= time()) {
    die("Token has expired");
}

if (strlen($_POST["password"]) < 8) {
    die("Password must be at least 8 characters");
}

if (!preg_match("/[a-z]/i", $_POST["password"])) {
    die("Password must contain at least one letter");
}

if (!preg_match("/[0-9]/", $_POST["password"])) {
    die("Password must contain at least one number");
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
    die("Passwords must match");
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$sql = "UPDATE users
        SET password = ?,
            reset_token_hash = NULL,
            reset_token_expires_at = NULL
        WHERE user_id = ?";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Error in preparing statement: " . $conn->error);
}

$stmt->bind_param("ss", $password_hash, $user["user_id"]);

if (!$stmt->execute()) {
    die("Error in executing statement: " . $stmt->error);
}

// echo "Password updated. You can now login.";
$_SESSION['passwordReset'] = $passwordReset;
header('Location: login.php');
?>