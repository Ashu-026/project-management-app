
document.addEventListener("DOMContentLoaded", function () {
  console.log("app.js is connected");
  setupAuthPage();
});
function setupAuthPage() {
  const loginForm = document.getElementById("loginForm");
  const registerForm = document.getElementById("registerForm");

  if (!loginForm || !registerForm) {
    // Login email validation
    return;
  }
  const loginEmail = document.getElementById("loginEmail");
  const loginPassword = document.getElementById("loginPassword");
  const showLoginPassword = document.getElementById("showLoginPassword");
  const loginEyeIcon = document.getElementById("loginEyeIcon");
  const showRegisterBtn = document.getElementById("showRegisterBtn");
  const showLoginBtn = document.getElementById("showLoginBtn");

  const registerName = document.getElementById("registerName");
  const registerEmail = document.getElementById("registerEmail");
  const registerPassword = document.getElementById("registerPassword");
  const registerConfirmPassword = document.getElementById(
    "registerConfirmPassword",
  );

  // Switch: Login form -> Register form
  showRegisterBtn.addEventListener("click", function () {
    loginForm.classList.add("d-none");
    registerForm.classList.remove("d-none");
  });

  // Switch: Register form -> Login form
  showLoginBtn.addEventListener("click", function () {
    registerForm.classList.add("d-none");
    loginForm.classList.remove("d-none");
  });
  // Show/hide Login password
  showLoginPassword.addEventListener("click", function () {
    if (loginPassword.type === "password") {
      loginPassword.type = "text";
      loginEyeIcon.className = "bi bi-eye-slash";
    } else {
      loginPassword.type = "password";
      loginEyeIcon.className = "bi bi-eye";
    }
  });
  // Login submit validation
  loginForm.addEventListener("submit", function (event) {
    const emailValid = validateLoginEmail(loginEmail);
    const passwordValid = validateLoginPassword(loginPassword);

    if (!emailValid || !passwordValid) {
      event.preventDefault();
    }
  });
  // Login live validation
  loginEmail.addEventListener("input", function () {
    validateLoginEmail(loginEmail);
  });
  loginPassword.addEventListener("input", function () {
    validateLoginPassword(loginPassword);
  });

  // Register submit validation
  registerForm.addEventListener("submit", function (event) {
    const nameValid = validateRegisterName(registerName);
    const emailValid = validateRegisterEmail(registerEmail);
    const passwordValid = validateRegisterPassword(registerPassword);
    const confirmPasswordValid = validateConfirmPassword(
      registerPassword,
      registerConfirmPassword,
    );
    if (!nameValid || !emailValid || !passwordValid || !confirmPasswordValid) {
      event.preventDefault();
    }
  });

  // Register live validation
  registerName.addEventListener("input", function () {
    validateRegisterName(registerName);
  });
  registerEmail.addEventListener("input", function () {
    validateRegisterEmail(registerEmail);
  });
  registerPassword.addEventListener("input", function () {
    validateRegisterPassword(registerPassword);
    validateConfirmPassword(registerPassword, registerConfirmPassword);
  });
  registerConfirmPassword.addEventListener("input", function () {
    validateConfirmPassword(registerPassword, registerConfirmPassword);
  });
}

// Login email validation
function validateLoginEmail(loginEmail) {
  const error = document.getElementById("login-email-error");
  const email = loginEmail.value.trim();
  const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (email === "") {
    error.innerHTML = "Please enter email";
    loginEmail.style.border = "1px solid red";
    return false;
  }
  if (!emailPattern.test(email)) {
    error.innerHTML = "Enter valid email";
    loginEmail.style.border = "1px solid red";
    return false;
  }
  error.innerHTML = "";
  loginEmail.style.border = "1px solid green";
  return true;
}

// Login password validation
function validateLoginPassword(loginPassword) {
  const error = document.getElementById("login-password-error");
  const password = loginPassword.value;
  if (password === "") {
    error.innerHTML = "Please enter password";
    loginPassword.style.border = "1px solid red";
    return false;
  }
  error.innerHTML = "";
  loginPassword.style.border = "1px solid green";
  return true;
}

// Register name validation
function validateRegisterName(registerName) {
  const error = document.getElementById("register-name-error");
  const name = registerName.value.trim();
  if (name === "") {
    error.innerHTML = "Please enter your name";
    registerName.style.border = "1px solid red";
    return false;
  }
  if (!/^[A-Za-z ]+$/.test(name)) {
    error.innerHTML = "Name should contain only alphabets";
    registerName.style.border = "1px solid red";
    return false;
  }
  error.innerHTML = "";
  registerName.style.border = "1px solid green";
  return true;
}

// Register email validation
function validateRegisterEmail(registerEmail) {
  const error = document.getElementById("register-email-error");
  const email = registerEmail.value.trim();
  const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (email === "") {
    error.innerHTML = "Please enter email";
    registerEmail.style.border = "1px solid red";
    return false;
  }
  if (!emailPattern.test(email)) {
    error.innerHTML = "Enter valid email";
    registerEmail.style.border = "1px solid red";
    return false;
  }
  error.innerHTML = "";
  registerEmail.style.border = "1px solid green";
  return true;
}

// Register password validation
function validateRegisterPassword(registerPassword) {
  const error = document.getElementById("register-password-error");
  const password = registerPassword.value;

  if (password === "") {
    error.innerHTML = "Please enter password";
    registerPassword.style.border = "1px solid red";
    return false;
  }
  if (password.length < 8) {
    error.innerHTML = "Password must contain minimum 8 characters";
    registerPassword.style.border = "1px solid red";
    return false;
  }
  if (!/(?=.*[A-Z])(?=.*[0-9])(?=.*[@#$%])/.test(password)) {
    error.innerHTML =
      "Password must contain uppercase, number and special character";
    registerPassword.style.border = "1px solid red";

    return false;
  }
  error.innerHTML = "";
  registerPassword.style.border = "1px solid green";
  registerPassword.style.backgroundColor="lightgreen";
  return true;
}

// Confirm password validation
function validateConfirmPassword(registerPassword, registerConfirmPassword) {
  const error = document.getElementById("register-confirm-password-error");
  const password = registerPassword.value;
  const confirmPassword = registerConfirmPassword.value;
  if (confirmPassword === "") {
    error.innerHTML = "Please confirm password";
    registerConfirmPassword.style.border = "1px solid red";
    return false;
  }
  if (password !== confirmPassword) {
    error.innerHTML = "Passwords do not match";
    registerConfirmPassword.style.border = "1px solid red";
    return false;
  }
  error.innerHTML = "";
  registerConfirmPassword.style.border = "1px solid green";
  return true;
}
