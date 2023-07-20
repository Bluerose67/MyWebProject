<?php

$name = $_POST["name"];
$email = $_POST["email"];
$subject = $_POST["subject"];
$message = $_POST["message"];

$mail = require __DIR__ . "/mailer.php";

$mail->setFrom($email, $name);
$mail->addAddress("rushabkhadka67@gmail.com", "Rushab");

$mail->Subject = $subject;
$mail->Body = $message;
$mail->Body = $email;

$mail->send();

header("Location: sent.php");
?>