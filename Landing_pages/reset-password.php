<?php

$token = $_GET["token"];

$token_hash = hash("sha256", $token);

// Use the correct connection object (mysqli) directly, not require()
require "../connect.php";

$sql = "SELECT * FROM users
        WHERE reset_token_hash = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("s", $token_hash);

$stmt->execute();

$result = $stmt->get_result();

$user = $result->fetch_assoc();

if ($user === null) {
    die("token not found");
}

if (strtotime($user["reset_token_expires_at"]) <= time()) {
    die("token has expired");
} ?>


<!DOCTYPE html>
<html>

<head>
    <title>Reset Password</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <header>
        <div class="container">
            <div class="center">
                <h1>Reset Password </h1>
                <form action="process-reset-password.php" method="post">

                    <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

                    <div class="text">
                        <input type="password" id="password" name="password" required />
                        <span> </span>
                        <label>New Password</label>
                    </div>
                    <div class="text">
                        <input type="password" id="password_confirmation" name="password_confirmation" required />
                        <span> </span>
                        <label>Repeat Password</label>
                    </div>

                    <input type="submit" value="Reset" class="login-button" />

                    <!-- <p class="changePasswordMessage"> A code will be sent to your Email which will allow your to change
                        your password.</p> -->

                </form>
            </div>
        </div>
    </header>
</body>

</html>