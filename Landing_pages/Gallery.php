<?php
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
          } else { ?> <!---- its a loop [change the folder name on img path]----->
    <div class='wrapper'>
      <img src="../images/gallery/<?php echo $file; ?>" onclick="openModal();currentSlide(1)" class="hover-shadow">
    </div>
    <?php } ?>
    <?php
        }
      }
      closedir($dh);
    } ?>
    <!-- Image Section ends here -->

  </section>
  <!-- The Modal/Lightbox -->
  <div id="myModal" class="modal">
    <span class="close cursor" onclick="closeModal()" title="Close">&times;</span>
    <div class="modal-content">

      <?php
      $dir = "../images/gallery/"; // image folder name
      if (is_dir($dir)) {
        if ($dh = opendir($dir)) {
          while (($file = readdir($dh)) !== false) {
            if ($file == "." or $file == "..") {
            } else {
              ?> <!---- its a loop [change the folder name on img path]----->
      <div class='mySlides'>
        <img src="../images/gallery/<?php echo $file; ?>">
      </div>
      <?php
            }
          }
          closedir($dh);
        }
      } ?>

      <!-- Next/previous controls -->
      <a class="prev" onclick="plusSlides(-1)" title="Prev">&#10094;</a>
      <a class="next" onclick="plusSlides(1)" title="next">&#10095;</a>

      <!-- Caption text -->
      <!-- <div class="caption-container">
                <p id="caption"></p>
            </div> -->

    </div>
  </div>
  <!-- Footer begins here ------------------------------------------------------------------------------------------------------------->
  <footer class="footer">
    <div class="footer_containerleft">
      <img src="../images/newLogo.png" alt="Logo" class="img" />
    </div>
    <div class="footer_containerright">
      <div class="row">
        <div class="footer-col">
          <h4> Alumni Hub</h4>
          <ul>
            <li>
              <a href="#"> About Us</a>
            </li>
            <li>
              <a href="#"> Contact</a>
            </li>
          </ul>
        </div> <!-- footer-col -->
        <div class="footer-col">
          <h4> Get Help </h4>
          <ul>
            <li class="register_style">
              <p>Are you an alumni? Do you want to</p>
              <a href="#"> register ?</a>
            </li>
          </ul>
        </div> <!-- footer-col -->
        <div class="footer-col">
          <h4> Follow US</h4>
          <div class="social-links">
            <a href="#"> <i class="fab fa-facebook-f"></i></a>
            <a href="#"> <i class="fab fa-instagram"></i></a>
            <a href="#"> <i class="fab fa-linkedin-in"></i></a>
            <a href="#"> <i class="fab fa-twitter"></i></a>
          </div>
        </div> <!-- footer-col ends -->
      </div> <!-- row -->
      <div class="copyright1">
        <p> 2023 BlueRose. All rights reserved.</p>
        <p>Use of this site constitutes acceptance of our User Agreement and privacy policy.</p>
        <p>The Material on this site may not be reproduced, distributed, transmitted, cached or otherwise used, except
          with the prior written permission of BlueRose.</p>
      </div>
    </div> <!-- footer_containerright -->

  </footer>
  <!-- footer ends here ---------------------------------------------------------------------------------------- -->
  <script src="../js/index.js"></script>
</body>

</html>