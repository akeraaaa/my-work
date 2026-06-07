let borrowForm = document.getElementById("borrowForm");
let borrowBtn = document.getElementById("borrow");
let cancleForm = document.getElementById("cancleForm");

borrowForm.style.display = "none";
borrowBtn.addEventListener("click", () => {
  borrowForm.style.display = "block";
  borrowForm.style.opacity = "0";

  setTimeout(() => {
    borrowForm.style.opacity = "1";
    borrowForm.style.transition = "opacity 0.3s ease";
  }, 10);
  borrowForm.scrollIntoView({ behavior: "smooth", block: "center" });
});

// Smooth fade out on cancel
cancleForm.addEventListener("click", () => {
  borrowForm.style.opacity = "0";
  borrowForm.style.transition = "opacity 0.3s ease";

  setTimeout(() => {
    borrowForm.style.display = "none";
  }, 300);
});

// disable selecting past date
const currentDate = new Date();
let year = currentDate.getFullYear();
let month = currentDate.getMonth() + 1;
let day = currentDate.getDate();

month = month < 10 ? "0" + month : month;
day = day < 10 ? "0" + day : day;

document.getElementById("borrow_date").min = `${year}-${month}-${day}`;
document.getElementById("return_date").min = `${year}-${month}-${day}`;
