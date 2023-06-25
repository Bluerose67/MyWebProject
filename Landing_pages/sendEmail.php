<?php

$name = $_POST["name"];
$email = $_POST["email"];
$subject = $_POST["subject"];
$message = $_POST["message"];

require "../phpmailer/vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

$mail = new PHPMailer(true);

$mail->SMTPDebug = SMTP::DEBUG_SERVER;

$mail->isSMTP();
$mail->SMTPAuth = true;

$mail->Host = "smtp.gmail.com";
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;

$mail->Username = "rushabkhadka67@gmail.com";
$mail->Password = "agchzchhvndntqny";

$mail->setFrom($email, $name);
$mail->addAddress("rushabkhadka67@gmail.com", "Rushab");

$mail->Subject = $subject;
$mail->Body = $message;

$mail->send();

header("Location: sent.php");
?>