/* Image modal display ------------------------------------ */
// Open the Modal
    function openModal() {
        document.getElementById("myModal").style.display = "block";
    }

    // Close the Modal
    function closeModal() {
        document.getElementById("myModal").style.display = "none";
    }

    // Get all the slides
    var slides = document.getElementsByClassName("mySlides");

    // Function to show the specified slide
    function showSlide(n) {
        // Check if the slide index is out of bounds
        if (n < 1) {
            n = 1;
        } else if (n > slides.length) {
            n = slides.length;
        }

        // Hide all slides
        for (var i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }

        // Display the specified slide
        slides[n - 1].style.display = "flex";
    }

    // Initialize the slide index
    var slideIndex = 1;
    showSlide(slideIndex);

    // Next/previous controls
    function plusSlides(n) {
        showSlide(slideIndex += n);
    }

    // Thumbnail image controls
    function currentSlide(n) {
        showSlide(n);
    }
/* Image modal display ends ------------------------------------ */


/* scroll function */
function topFunction(){
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}
/* scroll function */


/* image form starts------------------------------------------------------------------------------ */

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


/* scroll function for admin gallery--------------------------------------------------------- */
function scrollToTopOfElement(right_lower) {
  const element = document.getElementById(right_lower);
  if (element) {
    element.scrollTop = 0;
  }
}
/* scroll function for admin gallery ends--------------------------------------------------------- */