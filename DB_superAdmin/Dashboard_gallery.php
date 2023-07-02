<?php
require_once('dashboard_template.php');
?>

<section class="right-lower" id="right_lower">
    <main>
        <div class="head-title">
            <div class="left">
                <h1>Gallery</h1>
                <ul class="breadcrumb">
                    <li>
                        <a href="#">Gallery</a>
                    </li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li>
                        <a class="active" href="../Landing_pages/index.php">Home</a>
                    </li>
                </ul>
            </div>

        </div>

        <div class="scrolltop">
            <button class="button" onclick="scrollToTopOfElement('right_lower')">
                <span class="material-symbols-outlined"> north </span>
            </button>
        </div>
        <div class="container">
            <div class="wrapper1">
                <img src="../images/upload.png" alt="Choose Image" id="img">
            </div>
            <div class="center">
                <h1>Upload Images</h1>
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" value="1" name="fileupload">
                    <div class="image-upload">
                        <div class="label1">
                            <label>Select a File</label>
                        </div>

                        <div>
                            <input type="file" id="input" class="form-control" name="file" required autofocus>
                        </div>
                        <span> </span>
                    </div>
                    <input type="submit" value="Upload" class="login-button" />
                    <input type="submit" value="Reset" id="resetBtn" class="login-button" />

                    <p> To upload a image, files selected must be of format</p>
                    <p class="image_type"> .Png, .jpeg, .jpg</p>
                </form>
            </div>
        </div>

        <!-- code to Move uploaded image to the destination folder -->
        <?php
        $dir = "../images/gallery/"; // set your gallery folder name
        if (isset($_GET['del'])) {
            unlink($dir . '/' . $_GET['del']);
        }

        if (isset($_POST['fileupload'])) {
            $dirfile = $dir . basename($_FILES['file']['name']);
            if (move_uploaded_file($_FILES['file']['tmp_name'], $dirfile)) {
                // echo "File uploaded successfully!";
            } else {
                echo "Sorry, file not uploaded, please try again!";
            }
        }
        ?>

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
                <img src="../images/gallery/<?php echo $file; ?>" onclick="openModal();currentSlide(1)"
                    class="hover-shadow">
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
        </div> <!-- Image modal ends here ---------------------------------->
    </main>
</section> <!-- right lower section ends -->
</section> <!-- content section ends -->
</section> <!-- main section ends here ---------------------------------------------------------->

</div><!-- dashboard ends -->
<script src="../js/index.js"></script>
<script>

    document.addEventListener('DOMContentLoaded', function () {
        const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');
        const currentPage = window.location.pathname.split('/').pop(); // Get the current page URL
        console.log(currentPage);
        console.log(allSideMenu);
        allSideMenu.forEach(item => {
            const li = item.parentElement;
            console.log(li);

            if (item.getAttribute('href') === currentPage) {
                li.classList.add('active');
            }

            item.addEventListener('click', function () {
                allSideMenu.forEach(i => {
                    i.parentElement.classList.remove('active');
                })
                li.classList.add('active');
            })
        });
    });
</script>
<script src="dashboard.js"></script>

</body>

</html>