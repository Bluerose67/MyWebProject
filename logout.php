<?php

session_start();

session_unset();

session_destroy();

header("Location: Landing_pages/login.php");
?>