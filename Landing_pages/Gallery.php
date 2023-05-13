<?
include("../connect.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Gallery</title>
  <link rel="stylesheet" href="gallerystyle.css" />
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
</head>

<body>
  <header>
    <nav>
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
            <button class="login-btn">
              <a href="login.php" style="color: #e9f4fb">Login</a>
            </button>
          </li>
        </ul>
      </div>
    </nav>
    <div class="scrolltop">
      <button class="button" onclick="topFunction()">
        <span class="material-symbols-outlined"> north </span>
      </button>
    </div>

    <section class="about1" id="aboutus">
      <div class="left-about">
        <h1>ACHS 3rd Convocation Ceremony</h1>
        <p>Wishing all the new graduates a bright future ahead.</p>
      </div>
    </section>
  </header>

  <section>
    <div class="title">
      <h1>Digital <span> Gallery </span></h1>
    </div>
  </section>
  <!-- Image section begins here -->
  <section class="wrapper_box" id="img_Gallery">
    <?php
    $dir = "../images/gallery/"; // image folder name
    if (is_dir($dir)) {
      if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
          if ($file == "." or $file == "..") {
          } else {
            ?> <!---- its a loop [change the folder name on img path]----->
    <div class='wrapper'>
      <a href=''>
        <img src="../images/gallery/<?php echo $file; ?>">
      </a>
    </div>
    <?php
          }
        }
        closedir($dh);
      }
    } ?>
    <!-- Image Section ends here -->

  </section>
  <!-- Footer begins here -->
  <footer class="fot_img">
    <img src="../images/footer-default-mobile-dark.svg" alt="" />
    <section class="cont">
      <section class="end">
        <div class="left1">
          <img src="../images/newLogo.png" alt="Logo" class="img" />
          <p>Simply connecting the memories and people</p>
        </div>

        <div class="right1">
          <p>Get in touch with us</p>
          <div class="container5">
            <div class="icon1">
              <span class="material-symbols-outlined"> location_on </span>
              <p>Alka hospital, Lalitpur 44600</p>
              <br />
            </div>
            <div class="icon2">
              <span class="material-symbols-outlined"> Phone_In_Talk </span>
              <p>+977-01-5912727, 4538566</p>
              <br />
            </div>
            <div class="icon3">
              <span class="material-symbols-outlined"> mail </span>
              <p>info@achsnepal.edu.np</p>
              <br />
            </div>
          </div>
        </div>
      </section>
      <div class="last">
        <p>
          Made by Team BlueRose with
          <span class="material-symbols-outlined"> favorite </span>.
        </p>
      </div>
    </section>
  </footer>
  <script src="../js/index.js"></script>
</body>

</html>