<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Change Paassword</title>
  </head>
  <body>
    <style>
      @import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap");
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Montserrat", sans-serif;
      }
      body {
        background-color: #c9d6ff;
        background: linear-gradient(to right, #181c14, #3c3d37);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100vh;
      }
      .container {
        background-color: #fff;
        border-radius: 30px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.35);
        position: relative;
        overflow: hidden;
        width: 600px;
        max-width: 100%;
        height: auto;
      }
      .container h1 {
        text-align: center;
      }
      .reset-form form {
        display: flex;
        flex-direction: column;
        padding: 45px;
        gap: 20px;
      }
      form label,
      form a {
        font-size: 16px;
        line-height: 20px;
        letter-spacing: 0.05rem;
        font-weight: 500;
      }
      .reset-form button {
        background-color: #3c3d37;
        color: #fff;
        border-radius: 10px;
        font-size: 12px;
        padding: 15px 45px;
        font-weight: 600;
        letter-spacing: 0.5px;
        border: 1px solid transparent;
        margin-top: 10px;
        text-transform: uppercase;
        cursor: pointer;
      }
      .container input {
        border: none;
        background-color: #eee;
        padding: 10px 15px;
        border-radius: 10px;
        width: 100%;
        font-size: 14px;
        outline-offset: 3px;
        padding: 10px 1rem;
        transition: 0.25s;
        background-color: #e2e2e2;
        outline: 2px solid #512da8;
      }
      .container input:focus {
        outline-offset: 5px;
        background-color: #fff;
      }
    </style>
    <div class="container">
      <div class="reset-form">
        <form action="password.php" method="POST">
          <h1>Change Password</h1>
          <label for="current_password">Current Password:</label>
          <input
            type="password"
            name="current_password"
            placeholder="Enter your current password"
            required
          />
          <label for="new_password">New Password:</label>
          <input
            type="password"
            name="new_password"
            id="new_password"
            placeholder="Enter new password"
            required
          />
          <span style="color: red" id="pass_error"></span>
          <label for="confirm_password">Confirm Passoword:</label>
          <input
            type="password"
            name="confirm_password"
            id="confirm_password"
            placeholder="Re-enter new password"
            required
          />
          <a href="index.php">Cancel and Return to Homepage</a>
          <button id="updateBtn" type="submit">Update Password</button>
        </form>
      </div>
    </div>

    <!-- validating password -->
    <script>
        let password = document.getElementById("new_password");
        let pass_error = document.getElementById("pass_error");
        let updateBtn = document.getElementById("updateBtn");

        updateBtn.addEventListener("click", function (event) {

            let passRuleUppercase = /[A-Z]/;
            let passRuleNumber = /[0-9]/;

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
            } else {
              pass_error.innerHTML = ""; // Clear password error if valid
            }
        });
    </script>
  </body>
</html>
