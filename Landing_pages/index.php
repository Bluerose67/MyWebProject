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

    <!-- nav bar ends here -->
    <section class="about1" id="aboutus">
      <div class="left-about">
        <h1>About AlumniHub</h1>
        <p>
          AlumniHub is a web-based application system that aims to connect all
          the alumni so that their precious memories with the high
          school/university never fades away and by being a guide they can
          also encourage the young generations to follow their footsteps or
          even surpass them.
        </p>
      </div>
    </section>

    <section class="about2">
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
    </section>
  </header>
  <!-- header ends here -->

  <!-- Event section starts -->
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
  <!-- Event section ends here -->

  <!-- Contact section starts here -->

  <section class="contact" id="contact">
    <div class="row1">
      <h1>Contact Us</h1>
      <form action="" method="post">
        <input type="text" class="verify" placeholder="Enter your Name (a-z)" pattern="[a-z]*" />
        <input type="email" placeholder="Enter your Email eg: abs@gmail.com" required />
        <textarea placeholder="Enter your message"></textarea>
        <button type="submit" class="send_btn">Send</button>
      </form>
    </div>
  </section>
  <!-- Contact section ends here -->

  <!-- Footer starts here -->
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
  <!-- footer ends here -->

  <script src="../js/index.js"></script>
</body>

</html>