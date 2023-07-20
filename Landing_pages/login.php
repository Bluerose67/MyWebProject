<?php
session_start();
include("../connect.php");
if (isset($_SESSION['username'])) {
  if ($_SESSION['role'] == 'admin') {
    header("Location: ../DB_Admin/Dashboard.php");
  } elseif ($_SESSION['role'] == 'super_admin') {
    header("Location: ../DB_Superadmin/Dashboard.php");
  } else {
    header("Location: ../DB_Alumni/Dashboard_profile.php");
  }
  // var_dump($_SESSION['role']);
} else {
  ?>

  <!DOCTYPE html>
  <html>

  <head>
    <title>Login Page</title>
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
          <h1>Login</h1>
          <form action="../login_fetch.php" method="post">

            <div class="text">
              <input type="text" name="username" required />
              <span> </span>
              <label>Username</label>
            </div>

            <div class="text">
              <input type="password" name="password" id="passwordInput" required />
              <i class="toggle-password fas fa-eye-slash"></i>
              <span> </span>
              <label>Password</label>
            </div>

            <p class="pass"> <a href="forgotPassword.php">Forgot password ?</a> </p>

            <input type="submit" value="Login" class="login-button" />

            <?php
            if (isset($_SESSION["error"])) {
              $error = $_SESSION["error"];
              echo "<span class= 'error'>" . $error . "</span>";
              unset($_SESSION["error"]);
              exit();
            }
            if (isset($_SESSION['pending'])) {
              echo "<span class= 'error'>" . $_SESSION['pending'] . "</span>";
              unset($_SESSION['pending']);
              exit();
            }
            if (isset($_SESSION["denied"])) {
              echo "<span class= 'error'>" . $_SESSION['denied'] . "</span>";
              unset($_SESSION['denied']);
              exit();
            }
            if (isset($_SESSION['passwordReset'])) {
              echo "<span class= 'error'>" . $_SESSION['passwordReset'] . "</span>";
              unset($_SESSION['passwordReset']);
              exit();
            }

            ?>
          </form>

          <div class="signup">
            <button class="signup-btn"> Register </button>
          </div>

        </div>
      </div>
    </header>

    <!-- Popup for register -->
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
    <!-- Popup for register -->


    <!-- footer begins -->
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
                <a href="index.php#aboutus"> About Us</a>
              </li>
              <li>
                <a href="index.php#Featuredevent"> Events</a>
              </li>
            </ul>
          </div> <!-- footer-col -->
          <div class="footer-col">
            <h4> Get Help </h4>
            <ul>
              <li class="register_style">
                <p>Do you have any inquiries ? Feel Free to </p>
                <button> <a href="index.php#contact">Contact Us </a></button>
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
      </div> <!-- footer_container right -->

    </footer>

    <!-- Footer ends here -->
    <script>
      const eyeIcon = document.querySelector(".toggle-password");
      const passwordInput = document.querySelector("#passwordInput");

      eyeIcon.addEventListener("click", () => {
        //toggle the input type between password and text
        passwordInput.type = passwordInput.type === "password" ? "text" : "password";

        //update the eye icon class based on the input type
        // eyeIcon.className = `fa-solid fa-eye${passwordInput.type === "password" ? "" : "-slash"}`;
        eyeIcon.classList.toggle("fa-eye-slash");
        eyeIcon.classList.toggle("fa-eye");

      });
    </script>
    <!-- Register Popup -->
    <script>
      var register = document.querySelectorAll(".signup-btn");
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
  <?php
}
?>