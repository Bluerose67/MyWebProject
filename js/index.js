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
