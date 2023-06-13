function topFunction(){
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}
/* image form ------------------------------------------------------------------------------ */
let img= document.getElementById("img");
let input = document.getElementById('input');
let resetBtn = document.getElementById('resetBtn');

input.onchange = (e) => {
  if(input.files[0])
  img.src = URL.createObjectURL(input.files[0]);
};

/* reset the selected image */
resetBtn.addEventListener('click', () => {
  input.value = ''; // Reset the input value
  img.src = '../images/upload.png'; // Reset the image source
});
/* image form close ------------------------------------------------------------------------ */

/* image modal box --------------------------------------------------------------------------- */
// Open the Modal 
function openModal() {
  document.getElementById("myModal").style.display = "block";
}

// Close the Modal
function closeModal() {
  document.getElementById("myModal").style.display = "none";
}

var slideIndex = 1;
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
  showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");

  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }

  slides[slideIndex-1].style.display = "flex";

}

/* image modal box close --------------------------------------------------------------------------- */

/* scroll function for admin gallery--------------------------------------------------------- */
function scrollToTopOfElement(right_lower) {
  const element = document.getElementById(right_lower);
  if (element) {
    element.scrollTop = 0;
  }
}
/* scroll function for admin gallery ends--------------------------------------------------------- */

/* side bar change ---------------------------------------------------------------------------------- */

  document.addEventListener('DOMContentLoaded', function() {
  const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');
  const currentPage = window.location.pathname.split('/').pop(); // Get the current page URL
console.log(currentPage);
console.log(allSideMenu);
  allSideMenu.forEach(item => {
    const li = item.parentElement;

    if (item.getAttribute('href') === currentPage) {
      li.classList.add('active');
    }

    item.addEventListener('click', function() {
      allSideMenu.forEach(i => {
        i.parentElement.classList.remove('active');
      })
      li.classList.add('active');
    })
  });
});


  /* side bar change ends---------------------------------------------------------------------------------- */

            /* delete button confirmation box --------------------------------------------------------------------- */
            
            var deleteBtn = document.getElementById("deleteBtn");
            var confirmationModal = document.getElementById("confirmationModal");
            var confirmDeleteBtn = document.getElementById("confirmDeleteBtn");
            var cancelDeleteBtn = document.getElementById("cancelDeleteBtn");
            // var close_delete = document.getElementsByClassName("close_delete");

            deleteBtn.addEventListener("click", function () {
                confirmationModal.style.display = "block";
            });

            confirmDeleteBtn.addEventListener("click", function () {

                // Close the modal
                confirmationModal.style.display = "none";
            });

            cancelDeleteBtn.addEventListener("click", function () {
                // Close the modal
                confirmationModal.style.display = "none";
            });
            // close_delete.addEventListener("click", function () {
            //     confirmationModal.style.display = "none";

            // })

            window.addEventListener("click", function (event) {
                if (event.target == confirmationModal) {
                    // Close the modal
                    confirmationModal.style.display = "none";
                }
            });

            /* delete button confirmation box --------------------------------------------------------------------- */



/* Automatic Slider change  ---------------------------------------------------------------------------*/

var counter = 1;
        setInterval(function () {
            document.getElementById('radio' + counter).checked = true;
            counter++;
            if (counter > 4) {
                counter = 1;
            }
        }, 5000);
        
/* Automatic Slider change  ---------------------------------------------------------------------------*/
