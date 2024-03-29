<?php
session_start();
include("../connect.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Alumni Homepage</title>
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
  <header>
    <!-- nav bar starts here -->
    <nav id="nav">
      <div class="left">
        <a href="index.php"> <img src="../images/newLogo.png" alt="Logo" /></a>
      </div>
      <div class="right">
        <ul class="nav-menu">
          <li><a href="#aboutus" class="menu-items"> About us</a></li>
          <li><a href="#Featuredevent" class="menu-items"> Events</a></li>
          <li><a href="Gallery.php" class="menu-items"> Gallery</a></li>
          <li><a href="#contact" class="menu-items"> Contact</a></li>
          <?php
          if (!isset($_SESSION['username'])) { ?>
            <li>
              <button class="login-btn">
                <a href="login.php" style="color: #e9f4fb">Login</a>
              </button>
            </li>
          <?php } else {
            if ($_SESSION['role'] === 'super_admin') { ?>
              <li>
                <button class="login-btn">
                  <a href="../DB_Superadmin/Dashboard.php" style="color: #e9f4fb">Dashboard</a>
                </button>
              </li>
            <?php } elseif ($_SESSION['role'] === 'admin') { ?>
              <li>
                <button class="login-btn">
                  <a href="../DB_Admin/Dashboard.php" style="color: #e9f4fb">Dashboard</a>
                </button>
              </li>
            <?php } else { ?>
              <li>
                <button class="login-btn">
                  <a href="../DB_Alumni/Dashboard_profile.php" style="color: #e9f4fb">Dashboard</a>
                </button>
              </li>
            <?php }
          }
          ?>
          <?php
          if (!isset($_SESSION['username'])) { ?>
            <li>
              <button class="register"> Register </button>
            </li>
          <?php } ?>
        </ul>
      </div>
    </nav>
    <div class="scrolltop">
      <button class="button" onclick="topFunction()">
        <span class="material-symbols-outlined"> north </span>
      </button>
    </div>
    <!-- nav bar ends here ------------------------------------------------------------------------------------->

  </header>
  <!-- header ends here --------------------------------------------------------------------------------------------------------->

  <!-- About section starts here ---------------------------------------------------------------------------------->
  <section class="aboutus" id="aboutus">
    <div class="heading">
      <h1>About AlumniHub</h1>
    </div>
    <section class="about1">
      <div class="left-about">
        <p>
          AlumniHub is a web-based application system that aims to connect all
          the alumni so that their precious memories with the high
          school/university never fades away and by being a guide they can
          also encourage the young generations to follow their footsteps or
          even surpass them.
        </p>
      </div>
    </section>

    <!-- <div class="video">
      <video controls poster="thumbnail.png">
        <source src="video.mp4">
      </video>
    </div> -->
    <!-- about2 section begins------------------------- -->
    <section class="about2">
      <div class="left-about">
        <div class="about_card">
          <div class="box">
            <div class="imgBx">
              <img src="../images/alumni2.jpg" alt="Logo" id="img_align" />
            </div>
            <div class="contentBx">
              <div>
                <h2>Happy Moments</h2>
                <p>
                  This is the newly graduated batch of 2074. All of the
                  students here are alumni of Asian College of Higher Studies.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="middel-about">
        <div class="about_card">
          <div class="box">
            <div class="imgBx">
              <img src="../images/alumni2.jpg" alt="Logo" id="img_align" />
            </div>
            <div class="contentBx">
              <div>
                <h2>Happy Moments</h2>
                <p>
                  This is the newly graduated batch of 2074. All of the
                  students here are alumni of Asian College of Higher Studies.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="right-about">
        <div class="about_card">
          <div class="box">
            <div class="imgBx">
              <img src="../images/alumni.jpg" alt="Logo" id="img_align" />
            </div>
            <div class="contentBx">
              <div>
                <h2>Happy Moments</h2>
                <p>
                  This is the newly graduated batch of 2074. All of the
                  students here are alumni of Asian College of Higher Studies.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- about2 section ends------------------------- -->
  </section>
  <!-- About section ends here -------------------------------------------------------------------------------------------->


  <!-- Event section starts -------------------------------------------------------------------------------------------------->
  <section class="event_section">

    <section class="featured_event" id="Featuredevent">
      <div class="content">
        <h1>Featured Events</h1>
        <p>Following Events and Meets for the alumni has been featured.</p>
        <div class="icon">
          <span class="material-symbols-outlined"> location_on </span>
          <p>Alka hospital, Lalitpur 44600</p>
        </div>
      </div>
    </section>

    <div class="event_slider">
      <div class="wrapper">
        <i id="left" class="fa-solid fa-angle-left"></i>
        <ul class="carousel">
          <?php
          // Fetch all events from the database
          $sql = "SELECT * FROM events";
          $result = mysqli_query($conn, $sql);

          if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) { ?>
              <li class="card">
                <div class="img"><img src="<?php echo "../images/events/" . $row['image'] ?>" alt="Event Image"
                    draggable="false"></div>
                <h2>
                  <?= $row['title'] ?>
                </h2>
                <span>Date :
                  <?= $row['date'] ?>
                </span>
                <?php
                if (isset($_SESSION['username'])) {
                  if ($_SESSION['role'] == 'super_admin') { ?>

                    <button class="learnMore_btn"> <a href="../DB_Superadmin/Dashboard_events.php">Learn More</a></button>

                  <?php } elseif ($_SESSION['role'] == 'admin') { ?>

                    <button class="learnMore_btn"> <a href="../DB_Admin/Dashboard_events.php">Learn More</a></button>

                  <?php } else { ?>

                    <button class="learnMore_btn"> <a href="../DB_Alumni/Dashboard_events.php">Learn More</a></button>

                  <?php }

                } else { ?>

                  <button class="learnMore_btn"> <a href="login.php">Learn More</a></button>

                <?php }
                ?>
              </li>
            <?php }
          } else {
            echo "No events found.";
          }
          ?>
        </ul>
        <i id="right" class="fa-solid fa-angle-right"></i>
      </div>
    </div>

    <section class="more_info">
      <div class="event_message">
        <p class="p1"> Making efforts on oragnizing different events helps everyone to realize the diversity of
          events.</p>
        <p class="p2"> That is why we make efforts on giving our Alumni the best thrill of their lifetime.</p>
      </div>
    </section>
  </section>
  <!-- Event section ends here -->

  <!-- Contact section starts here ---------------------------------------------------------------------------------------------->

  <section class="contact" id="contact">
    <section class="clip_path">
      <h1>Contact Us</h1>
    </section>
    <div class="contact_section"> <!-- contact section begins -->
      <div class="row1">
        <form action="sendEmail.php" method="post">
          <p> Send us a Message </p>
          <input type="text" name="name" class="verify" placeholder="Enter your Name (a-z)" pattern="[a-zA-Z\s]*" />
          <input type="email" name="email" placeholder="Enter your Email eg: abs@gmail.com" required />
          <input type="text" name="subject" class="verify" placeholder="Enter the subject" />
          <textarea name="message" placeholder="Enter your message"></textarea>
          <button type="submit" class="send_btn">Send</button>
        </form>
      </div>
      <div class="contact-col">
        <h4>Get in touch with us</h4>
        <ul>
          <li>
            <span class="material-symbols-outlined"> location_on </span>
            <p>Alka hospital, Lalitpur 44600</p>
          </li>
        </ul>
        <ul>
          <li>
            <span class="material-symbols-outlined"> Phone_In_Talk </span>
            <p>+977-01-5912727, 4538566</p>
          </li>
        </ul>
        <ul>
          <li>
            <span class="material-symbols-outlined"> mail </span>
            <p>info@achsnepal.edu.np</p>
          </li>
        </ul>
      </div>
    </div> <!-- contact_section ends -->
  </section>
  <!-- Contact section ends here ----------------------------------------------------------------------------------------------->

  <!-- footer section starts ---------------------------------------------------------------------------------------------------- -->
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
              <a href="#aboutus"> About Us</a>
            </li>
            <li>
              <a href="#Featuredevent"> Events</a>
            </li>
          </ul>
        </div> <!-- footer-col -->
        <div class="footer-col">
          <h4> Get Help </h4>
          <ul>
            <li class="register_style">
              <p>Do you have any inquiries ? Feel Free to </p>
              <button> <a href="#contact">Contact Us </a></button>
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

    <div id="registerinfo" class="register-info">
      <div class="modal-content">
        <h2>Hey! Are You New ?</h2>
        <p> After you register, We have a procedure to verify your details for you to be able to Login.
          So, please fill the form.
        </p>
        <button id="contact_btn" class="edit-button">
          <a href="../alumni_registration/signup.php">Fill up form</a>
        </button>
      </div>
    </div>

  </footer>
  <!-- footer section starts  ---------------------------------------------------------------------------------------->

  <script src="../js/index.js"></script>
  <script src="../js/slider.js" defer></script>
  <!-- Register Popup -->
  <script>
    var register = document.querySelectorAll(".register");
    var registerinfo = document.getElementById("registerinfo");
    var contact_btn = document.getElementById("contact_btn");

    register.forEach(function (Btn) {
      Btn.addEventListener("click", function () {
        registerinfo.style.display = "block";
      });
    });


    contact_btn.addEventListener("click", function () {
      // Confirm and Close the modal
      registerinfo.style.display = "none";
    });

    window.addEventListener("click", function (event) {
      if (event.target == registerinfo) {
        // Close the modal
        registerinfo.style.display = "none";
      }
    });
  </script>
  <!-- Register Popup ends-->

</body>

</html>