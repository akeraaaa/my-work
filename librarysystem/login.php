<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login page</title>
    <link rel="stylesheet" href="css/login.css" />
  </head>
  <body>
    <div class="container" id="container">
      <div class="form-container sign-up">
        <form action="user.php" method="POST">
          <!-- Create account section -->
          <h1>Create Account</h1>
          <input
            type="text"
            name="name"
            id="fullName"
            placeholder="Full Name"
            required
          />
          <span style="color: red" id="name_error"></span>
          <input
            type="email"
            name="email"
            id="email"
            placeholder="Email"
            required
          />
          <span style="color: red" id="email_error"></span>
          <input
            type="number"
            name="phone"
            id="phone"
            placeholder="Phone Number"
            required
          />
          <span style="color: red" id="phone_error"></span>
          <input
            type="password"
            name="password"
            id="password"
            placeholder="Password"
            required
          />
          <span style="color: red" id="pass_error"></span>
          <input
            type="password"
            name="confirmPassword"
            id="confirmPassword"
            placeholder="Confirm Password"
          />
          <span style="color: red" id="error"></span>
          <button id="submit">Submit</button>
        </form>
      </div>
      <!-- End of create account section -->

      <!-- Sign in sectoin -->
      <div class="form-container sign-in">
        <form action="signin.php" method="POST">
          <h1>Sign In</h1>
          <input
            type="email"
            name="email"
            id="login-email"
            placeholder="Email"
            required
          />
          <input
            type="password"
            name="password"
            id="login-password"
            placeholder="Password"
            required
          />
          <span style="color: red" id="login-error"></span>
          <a href="forgotPW.html">Forgot Your Password?</a>

          <select name="role" id="role" required>
            <option value="" disabled selected>Select Role</option>
            <option value="user">Student</option>
            <option value="admin">Admin</option>
          </select>

          <button id="">Login</button>
        </form>
      </div>
      <!-- End of sign in serctoin -->

      <!-- Toggle section -->
      <div class="toggle-container">
        <div class="toggle">
          <div class="toggle-panel toggle-left">
            <h1>Welcome Back!</h1>
            <p>Enter your personal details to use all of site features</p>
            <button class="hidden" id="login">Sign In</button>
          </div>

          <div class="toggle-panel toggle-right">
            <h1>Hello Friend!</h1>
            <p>
              Register with your personal details to use all of site features
            </p>
            <button class="hidden" id="register">Sign Up</button>
          </div>
        </div>
      </div>
      <!-- End of toggle section -->
    </div>
    <script src="js/login.js"></script>
  </body>
</html>
