<?php
require_once('dashboard_template.php');
?>

<section class="right-lower">
    <main>
        <div class="head-title">
            <div class="left">
                <h1>Events</h1>
                <ul class="breadcrumb">
                    <li>
                        <a href="#">Events</a>
                    </li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li>
                        <a class="active" href="../Landing_pages/index.php">Home</a>
                    </li>
                </ul>
            </div>

        </div>
    </main>
</section> <!-- right lower ends -->
</section> <!-- content section ends -->
</section> <!-- main section ends -->
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