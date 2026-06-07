const container = document.getElementById("container");
const register = document.getElementById("register");
const login = document.getElementById("login");

register.addEventListener("click", function () {
  container.classList.add("active"); // activate sign-up page
});

login.addEventListener("click", function () {
  container.classList.remove("active"); // activate login page
});

let fullName = document.getElementById("fullName");
let name_error = document.getElementById("name_error");
let email = document.getElementById("email");
let email_error = document.getElementById("email_error");
let phone = document.getElementById("phone");
let password = document.getElementById("password");
let confirmPassword = document.getElementById("confirmPassword");
let error = document.getElementById("error");
let phone_error = document.getElementById("phone_error");
let pass_error = document.getElementById("pass_error");
let submit = document.getElementById("submit");


submit.addEventListener("click", function (event) {
  let emailRule = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
  let passRuleUppercase = /[A-Z]/;
  let passRuleNumber = /[0-9]/;
  let passRuleSpecial = /[!@#$%^&*]/;
  let capitalLetter = /^[A-Z]/;
  let hasError = false; // Flag to check if there are any errors

  // Check for empty fields
  if (
    fullName.value === "" ||
    email.value === "" ||
    phone.value === "" ||
    password.value === "" ||
    confirmPassword.value === ""
  ) {
    error.innerHTML = "All fields must be filled.";
    hasError = true;
  } else {
    error.innerHTML = ""; // Clear error if all fields are filled
  }

  if (!emailRule.test(email.value)) {
    email_error.innerHTML = "Invalid email address";
    hasError = true;
  } else {
    email_error.innerHTML = ""; // Clear email error if valid
  }
  // Check User name rule
  if (!capitalLetter.test(fullName.value)) {
    name_error.innerHTML = "User name must contain capital letter";
    hasError = true;
  } else {
    name_error.innerHTML = "";
  }
  // Check password rules
  if (!passRuleUppercase.test(password.value)) {
    pass_error.innerHTML =
      "Password must contain at least one uppercase letter.";
    hasError = true;
  } else if (!passRuleNumber.test(password.value)) {
    pass_error.innerHTML = "Password must contain at least one number.";
    hasError = true;
  } else if (password.value.length < 8 || password.value.length > 20) {
    pass_error.innerHTML = "Password length must be between 8-20 characters.";
    hasError = true;
  } else if (!passRuleSpecial.test(password.value)) {
    pass_error.innerHTML =
      "Password must contain at least one special character.";
    hasError = true;
  } else {
    pass_error.innerHTML = ""; // Clear password error if valid
  }

  // Check phone number length
  if (phone.value.length !== 10) {
    phone_error.innerHTML = "Phone number must be exactly 10 digits.";
    hasError = true;
  } else {
    phone_error.innerHTML = ""; // Clear phone error if valid
  }

  // Checks if password matched with confirm password
  if (password.value !== confirmPassword.value) {
    error.innerHTML = "Password doesnot match";
    hasError = true;
  }
  if (hasError) {
    event.preventDefault();
  }
});

// Event listeners to clear specific error messages on input
phone.addEventListener("input", function () {
  if (phone.value.length === 10) {
    phone_error.innerHTML = "";
  }
});
