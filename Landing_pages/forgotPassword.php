<!DOCTYPE html>
<html>

<head>
    <title>Forgot Password</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <header>
        <nav> <!-- nav bar begins -->
            <div class="left">
                <a href="index.php"> <img src="../images/newLogo.png" alt="Logo" /></a>
            </div>
            <div class="right">
                <ul class="nav-menu">
                    <li>
                        <a href="index.php#aboutus" class="menu-items"> About us</a>
                    </li>
                    <li>
                        <a href="index.php#Featuredevent" class="menu-items"> Events</a>
                    </li>
                    <li><a href="Gallery.php" class="menu-items"> Gallery</a></li>
                    <li>
                        <a href="index.php#contact" class="menu-items"> Contact</a>
                    </li>
                </ul>
            </div>
        </nav> <!-- nav bar ends -->
        <div class="container">
            <div class="center">
                <h1>Forgot Password ?</h1>
                <form action="sendPasswordReset.php" method="post">

                    <div class="text">
                        <input type="text" name="email" required />
                        <span> </span>
                        <label>Email</label>
                    </div>

                    <input type="submit" value="Submit" class="login-button" />
                    <div class="goBack">
                        <button class="goBack-btn"> <a href="login.php"> Go Back </a> </button>
                    </div>

                    <p class="changePasswordMessage"> A code will be sent to your Email which will allow your to change
                        your password.</p>

                    <?php
                    if (isset($_SESSION['mailSent'])) {
                        echo $_SESSION['mailSent'];
                        unset($_SESSION['mailSent']);
                    }
                    ?>

                </form>

            </div>
        </div>
    </header>