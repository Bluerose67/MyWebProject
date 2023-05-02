<?
include("../connect.php");
?>
<!DOCTYPE html>
<html>

<head>
  <title>Login Page</title>
  <link rel="stylesheet" href="style.css" />
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
          <li>
            <!-- <button class="login-btn">
              <a href="login.php" style="color: #e9f4fb">Login</a>
            </button> -->
          </li>
        </ul>
      </div>
    </nav> <!-- nav bar ends -->
    <div class="container">
      <div class="center">
        <h1>Login</h1>
        <form action="../login_fetch.php" method="post">
          <div class="text">
            <input type="text" name="username" required />
            <span> </span>
            <label>Username</label>
          </div>
          <div class="text">
            <input type="password" name="password" required />
            <span> </span>
            <label>Password</label>
          </div>
          <p class="pass">Forgot password ?</p>
          <input type="submit" value="Login" class="login-button" />
          <?php if (isset($_GET['error'])) { ?>

            <p class="error">
              <?php echo $_GET['error']; ?>
            </p>

          <?php } ?>
        </form>
      </div>
    </div>
  </header>
</body>

</html>