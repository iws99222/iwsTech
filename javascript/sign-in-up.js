document.addEventListener("DOMContentLoaded", () => {
  const container = document.querySelector(".container");
  const registerBtn = document.querySelector(".register-link-txt");
  const loginBtn = document.querySelector(".login-link-txt");

  registerBtn.addEventListener("click", () => {
    container.classList.add("active");
  });
  loginBtn.addEventListener("click", () => {
    container.classList.remove("active");
  });

  // init login
  loginUser();
  // init register
  registerUser();
  // init controlling password visibility
  setUpPasswordVisibility();
});

// function responsible on user Registration
function registerUser() {
  // getting register form id
  const registerationForm = document.getElementById("register-form");
  // adding event listener to handle submit
  registerationForm.addEventListener("submit", (e) => {
    e.preventDefault(); // we need to prevent page refresh

    // getting the target
    const form = e.target;
    // creating form data
    const formData = new FormData(form);

    // we need to check the password & confirm password values if same
    // user must enter the password and confirm it
    let password = formData.get("password");
    let confirmPassword = formData.get("confirm-password");
    // here we are checking if not identical
    if (password != confirmPassword) {
      // showing password mismatch dialog
      showDialog(
        "Password Mismatch",
        "The passwords you entered do not match. Please try again.",
        "red"
      );
      return; // exiting the function
    }
    /*
    after ensuring that the 'password' and 'confirm password' matched
    we are ready to start registering
    */
    // creating the ajax
    const request = new XMLHttpRequest();
    // we are openning the request
    // since we are sending data, this mean 'POST'
    request.open("POST", "../../database/register.php", true);
    // now adding onLoad
    request.onload = function () {
      if (request.status === 200) {
        // this means that we successfully accessed register page
        // now we are checking the page if it includes 'success'
        // Successfully accessed register page
        if (request.responseText.includes("success")) {
          console.log("success register in");
          // removing the .active from container
          document.querySelector(".container").classList.remove("active");
          // to get back to Login page
          // container.classList.remove("active");
          // Registration was successful
          // so showing the dialog of success registered
          showDialog(
            "Registration Successful",
            "Your account has been created successfully.You can log in with your account now.",
            "var(--highlight-color)"
          );
          // resetting all form data
          e.target.reset();

          // now this is for handling the duplication of the username
          // the username is unique, can't have multi users with same username
          // so if the request response includes this text, this means that we caught
          // that user registering with a taken username. We want to prevent him
        } else if (request.responseText.includes("for key 'users.username'")) {
          // so now we show to the user dialog says that the username is taken before
          // and he must choose another username
          showDialog(
            "This Username is already taken",
            "Please choose another username.",
            "red" // setting dialog background color to red
          );
          // here also catching the duplicated email, email is unique
          // can't belong to more than 1 user.
        } else if (request.responseText.includes("for key 'users.email'")) {
          // so showing a dialog that he must register with another email
          showDialog(
            "This Email is already taken",
            "Please choose another email for registration",
            "red" // seting dialog background color to red
          );
        } else {
          // Registration failed with server-provided message
          showDialog("Registration Failed", request.responseText, "red");
        }
      } else {
        // Server error occurred
        showDialog(
          "Server Error",
          "An unexpected server error occurred. Please try again later.",
          "red"
        );
      }
    };
    request.onerror = function () {
      showDialog(
        "Connection Error",
        "Check your internet or try again later.",
        "red"
      );
    };
    /// finally we are sending the request
    request.send(formData);
  });
}

// function responsible on user login
function loginUser() {
  // getting the login form
  var loginForm = document.getElementById("sign-in-form");
  loginForm.addEventListener("submit", (e) => {
    // preventing page from refresh when submit
    e.preventDefault();

    // getting the form target
    const form = e.target;
    const formData = new FormData(form);

    // now creating ajax
    const request = new XMLHttpRequest();
    // openning the connection
    request.open("POST", "../../database/login.php", true);
    // onLoad
    request.onload = function () {
      // checking if the login request was successful
      if (request.status === 200) {
        // if includes this text, means can log in
        if (request.responseText.includes("successfully signed in")) {
          // successfully navigating to main screen
          window.location.href = "../../pages/nav-screens/main.php";
          // if includes above,means incorrect pass or username
        } else if (request.responseText.includes("incorrect email/password")) {
          showDialog(
            "Authentication",
            "Incorrect username / password",
            "var(--red-color)"
          );
          // checking if user account deactivation
        } else if (request.responseText.includes("Account deactivated")) {
          showDialog(
            "Account Deactivated",
            "Your account has been deactivated by the administrator. Please contact support for further assistance.",
            "var(--red-color)"
          );
          // resetting the form
          e.target.reset();
        } else {
          // account nof found, he must register
          showDialog(
            "Account Not Found",
            "We couldn't find an account with this email. Please check your details or sign up first.",
            "var(--red-color)"
          );
        }
      }
    };

    // sending the form to the login.php page
    request.send(formData);
  });
}

// this function in order to show the dialog
function showDialog(title, message, bgColor) {
  // getting the dialog container
  const dialogContainer = document.querySelector(".dialog-container");
  dialogContainer.style.opacity = 1;
  dialogContainer.style.display = "block";
  dialogContainer.style.animation = "scale-in-animation 0.4s ease-in-out";
  dialogContainer.style.zIndex = 10000;
  dialogContainer.style.backgroundColor = bgColor;
  document.querySelector(".dialog-title").textContent = title;
  document.querySelector(".dialog-message").textContent = message;
  document.querySelector(".close-dialog-btn").addEventListener("click", () => {
    dialogContainer.style.animation =
      "scale-out-animation 0.2s ease-in-out forwards";
  });
}

// responsible for password toggle visibility
function setUpPasswordVisibility() {
  // getting all password containers
  document.querySelectorAll(".password-container").forEach((container) => {
    // getting inputs
    const input = container.querySelector(".my-input");
    // password visibility toggle
    const toggle = container.querySelector(".password-visibility");
    // adding click event
    toggle.addEventListener("click", () => {
      // Check if the input is currently of type "password"
      const isPassword = input.getAttribute("type") === "password";
      // If it is, change it to "text" to show the password, otherwise switch back to "password"
      input.setAttribute("type", isPassword ? "text" : "password");
      // Change the icon (image source) based on visibility state
      toggle.src = isPassword
        ? "../../drawables/icons/ic-eye-open.png" // Show 'eye open' icon when password is visible
        : "../../drawables/icons/ic-eye-closed.png"; // Show 'eye closed' icon when password is hidden
    });
  });
}
