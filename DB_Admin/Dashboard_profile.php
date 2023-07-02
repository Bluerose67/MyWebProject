<?php
require_once('../DB_Superadmin/Dashboard_template.php');
?>

<section class="right-lower">
    <main>
        <div class="head-title">
            <div class="left">
                <h1>My Profile</h1>
                <ul class="breadcrumb">
                    <li>
                        <a href="#">My Profile</a>
                    </li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li>
                        <a class="active" href="../Landing_pages/index.php">Home</a>
                    </li>
                </ul>
            </div>

        </div>

        <!-- Keep the profile code here -->
        <section class="profile-main"> <!-- profile main begins -->

            <section class="row">

                <div class="field1">
                    <img src="<?php echo "../images/profile/" . $row['image']; ?>" alt="" class="Profile-img">
                </div>
                <div class="field">
                    <label>User ID:</label>
                    <span>
                        <?= $row['user_id'] ?>
                    </span>
                </div>
                <div class="field">
                    <label>User Name:</label>
                    <span>
                        <?= $row['user_name'] ?>
                    </span>
                </div>
                <div class="field">
                    <label>Role:</label>
                    <span>
                        <?= $row['role'] ?>
                    </span>
                </div>
                <button class="edit-profile">
                    <a href="update_profile.php?admin_id=<?= $row['admin_id'] ?>">Edit
                        Profile</a>
                </button>

            </section> <!-- row -->

            <section class="profile-right"> <!-- additional and bio section -->

                <section class="additional-info">
                    <div class="field">
                        <label>Email:</label>
                        <span>
                            <?= $row['email'] ?>
                        </span>
                    </div>
                    <div class="field">
                        <label>Address:</label>
                        <span>
                            <?= $row['address'] ?>
                        </span>
                    </div>
                    <div class="field">
                        <label>Date of Birth:</label>
                        <span>
                            <?= $row['DOB'] ?>
                        </span>
                    </div>
                    <div class="field">
                        <label>Contact:</label>
                        <span>
                            <?= $row['phone_no'] ?>
                        </span>
                    </div>
                    <div class="field">
                        <label>department:</label>
                        <span>
                            <?= $row['department'] ?>
                        </span>
                    </div>

                </section> <!-- additional_info -->

                <section class="Bio">
                    <div class="Bio-field">
                        <label style="margin-bottom: 10px;">Bio (About yourself):</label>
                        <div>
                            <?= $row['bio'] ?>
                        </div>
                    </div>
                </section> <!-- bio ends -->
            </section> <!-- additional and bio section -->
            </secttion> <!-- profile main ends -->

            <!--  -->
    </main>
</section> <!-- rigth lower ends------------------- -->
</section> <!-- content section ends ------------------------->
</section> <!-- main section ends------------------------------ -->


</div><!-- dashboard ends -->
<script src="dashboard.js"></script>

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

</body>

</html>