<?
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

    <section class="about2"> <!-- about2 section begins------------------------- -->
      <div class="left-about">
        <div class="card">
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
        <div class="card">
          <div class="box">
            <div class="imgBx">
              <img src="../images/alumni3.jpg" alt="Logo" id="img_align" />
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
        <div class="card">
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
    </section> <!-- about2 section ends------------------------- -->
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

    <section class="events">
      <div class="content1">
        <div class="div1">
          <h1>
            15 <br />
            APRIL
          </h1>
        </div>

        <div class="div2">
          <p>Annual Meetup & Scholarship Presentation</p>
          <input type="button" value="Learn More" class="btn" />
        </div>
      </div>

      <div class="content2">
        <div class="div1">
          <h1>
            19 <br />
            JULY
          </h1>
        </div>

        <div class="div2">
          <p>Web-Development Club Discussion: "New Gen dev"</p>
          <input type="button" value="Learn More" class="btn" />
        </div>
      </div>

      <div class="content3">
        <div class="div1">
          <h1>
            12 <br />
            August
          </h1>
        </div>

        <div class="div2">
          <p>Annual Sports Meet and Festa</p>
          <input type="button" value="Learn More" class="btn" />
        </div>
      </div>
    </section>
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
        <form action="" method="post">
          <p> Send us a Message </p>
          <input type="text" class="verify" placeholder="Enter your Name (a-z)" pattern="[a-z]*" />
          <input type="email" placeholder="Enter your Email eg: abs@gmail.com" required />
          <textarea placeholder="Enter your message"></textarea>
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
              <a href="#contact"> Contact</a>
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
  <!-- footer section starts  ---------------------------------------------------------------------------------------->

  <script src="../js/index.js"></script>
</body>

</html>