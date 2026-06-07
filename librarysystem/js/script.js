// Slide show section
// Access the Images
let slideImages = document.querySelectorAll("#slide");
var counter = 0;
function slideNext() {
  slideImages[counter].style.animation = "next1 1s ease-in forwards";
  if (counter >= slideImages.length - 1) {
    counter = 0;
  } else {
    counter++;
  }
  slideImages[counter].style.animation = "next2 1s ease-in forwards";
  indicators();
}
// Auto slideing
function autoSliding() {
  deletInterval = setInterval(timer, 3000);
  function timer() {
    slideNext();
    indicators();
  }
}
autoSliding();
//End of slideshow section



