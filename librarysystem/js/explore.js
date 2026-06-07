// Select all category button and books
const categoryBtn = document.querySelectorAll(".category-button button");
const book = document.querySelectorAll(".books .book");

// Define categoryBook function
const categoryBook = (e) => {
  document.querySelector(".active").classList.remove("active");
  e.target.classList.add("active");

  // selects the categroy data
  const selectedCategory = e.target.getAttribute("data-name");

  // Iterate over book category
  book.forEach((books) => {
    // Add hide class to hide the book
    books.classList.add("hide");
    // Check if the book matches with selected category or "all" is selected
    if (
      books.getAttribute("data-name") === selectedCategory ||
      selectedCategory === "all"
    ) {
      books.classList.remove("hide");
    }
  });
};

// Add click event listener to ecah category button
categoryBtn.forEach((button) => button.addEventListener("click", categoryBook));
