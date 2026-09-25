
document.addEventListener("DOMContentLoaded", function () {
  const profileForm = document.getElementById("profileForm");

  if (!profileForm) {
    return;
  }

  const nameInput = document.getElementById("profileName");
  const emailInput = document.getElementById("profileEmail");
  const passwordInput = document.getElementById("newPassword");
  const confirmPasswordInput = document.getElementById("confirmNewPassword");

  const nameError = document.getElementById("profile-name-error");
  const emailError = document.getElementById("profile-email-error");
  const passwordError = document.getElementById("profile-password-error");
  const confirmPasswordError = document.getElementById(
    "profile-confirm-password-error",
  );

  function validateProfileForm() {
    let valid = true;
    const name = nameInput.value.trim();
    const email = emailInput.value.trim();
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (name === "") {
      nameError.textContent = "Please enter your name";
      nameInput.style.border = "1px solid red";
      valid = false;
    } else if (!/^[A-Za-z ]+$/.test(name)) {
      nameError.textContent = "Name should contain only alphabets";
      nameInput.style.border = "1px solid red";
      valid = false;
    } else {
      nameError.textContent = "";
      nameInput.style.border = "1px solid green";
    }

    if (email === "") {
      emailError.textContent = "Please enter your email";
      emailInput.style.border = "1px solid red";
      valid = false;
    } else if (!emailPattern.test(email)) {
      emailError.textContent = "Enter a valid email";
      emailInput.style.border = "1px solid red";
      valid = false;
    } else {
      emailError.textContent = "";
      emailInput.style.border = "1px solid green";
    }

    if (passwordInput.value !== "" || confirmPasswordInput.value !== "") {
      if (passwordInput.value.length < 6) {
        passwordError.textContent =
          "Password must contain at least 8 characters";
        passwordInput.style.border = "1px solid red";
        valid = false;
      } else {
        passwordError.textContent = "";
        passwordInput.style.border = "1px solid green";
      }

      if (confirmPasswordInput.value === "") {
        confirmPasswordError.textContent = "Please confirm your password";
        confirmPasswordInput.style.border = "1px solid red";
        valid = false;
      } else if (passwordInput.value !== confirmPasswordInput.value) {
        confirmPasswordError.textContent = "Passwords do not match";
        confirmPasswordInput.style.border = "1px solid red";
        valid = false;
      } else {
        confirmPasswordError.textContent = "";
        confirmPasswordInput.style.border = "1px solid green";
      }
    }

    return valid;
  }

  profileForm.addEventListener("submit", function (event) {
    if (!validateProfileForm()) {
      event.preventDefault();
    }
  });

  nameInput.addEventListener("input", validateProfileForm);
  emailInput.addEventListener("input", validateProfileForm);
  passwordInput.addEventListener("input", validateProfileForm);
  confirmPasswordInput.addEventListener("input", validateProfileForm);
});