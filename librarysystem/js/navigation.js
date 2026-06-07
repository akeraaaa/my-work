window.addEventListener("scroll", function () {
  var nav = document.querySelector(".nav");
  if (window.scrollY > 50) {
    // Adjust this value to control when the effect starts
    nav.classList.add("scrolled");
  } else {
    nav.classList.remove("scrolled");
  }
});

// for hamburger
const hamburger = document.querySelector(".hamburger");
const nav = document.querySelector(".nav");

hamburger.addEventListener("click", () => {
  nav.classList.toggle("active");
  //   for user detail
  if (userDetail.style.display == "block") {
    userDetail.style.display = "none";
  }
});

// user button section
let userDetail = document.querySelector(".user-detail");
let userBtn = document.getElementById("user");

let notiBtn = document.getElementById("notification");
let notification = document.querySelector(".notification");

userDetail.style.display = "none";
notification.style.display = "none";

userBtn.addEventListener("click", function () {
  if (userDetail.style.display == "none") {
    userDetail.style.display = "block";
    notification.style.display == "none";
  } else {
    userDetail.style.display = "none";
  }
});

// notification button section

notiBtn.addEventListener("click", function () {
  if (
    notification.style.display == "none" ||
    userDetail.style.display == "block"
  ) {
    notification.style.display = "block";
    userDetail.style.display = "none";
  } else {
    notification.style.display = "none";
  }
});

