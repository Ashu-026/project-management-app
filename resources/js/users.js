document.addEventListener("DOMContentLoaded", function () {
  setupProfilePage();
  setupEditUserForm();
});

function setupProfilePage() {
  const profileForm = document.getElementById("profileForm");
  if (!profileForm) {
    return;
  }

  const profileName = document.getElementById("profileName");
  const profileEmail = document.getElementById("profileEmail");
  const newPassword = document.getElementById("newPassword");
  const confirmPassword = document.getElementById("confirmNewPassword");

  const nameError = document.getElementById("profile-name-error");
  const emailError = document.getElementById("profile-email-error");
  const passwordError = document.getElementById("profile-password-error");
  const confirmError = document.getElementById(
    "profile-confirm-password-error",
  );

  function validateProfileForm() {
    let valid = true;

    if (profileName.value.trim() === "") {
      nameError.innerHTML = "Please enter your name";
      profileName.style.border = "1px solid red";
      valid = false;
    } else if (!/^[A-Za-z ]+$/.test(profileName.value.trim())) {
      nameError.innerHTML = "Name should contain only alphabets";
      profileName.style.border = "1px solid red";
      valid = false;
    } else {
      nameError.innerHTML = "";
      profileName.style.border = "1px solid green";
    }

    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (profileEmail.value.trim() === "") {
      emailError.innerHTML = "Please enter email";
      profileEmail.style.border = "1px solid red";
      valid = false;
    } else if (!emailPattern.test(profileEmail.value.trim())) {
      emailError.innerHTML = "Enter valid email";
      profileEmail.style.border = "1px solid red";
      valid = false;
    } else {
      emailError.innerHTML = "";
      profileEmail.style.border = "1px solid green";
    }

    if (newPassword.value !== "" || confirmPassword.value !== "") {
      if (newPassword.value.length < 6) {
        passwordError.innerHTML = "Password must contain minimum 6 characters";
        newPassword.style.border = "1px solid red";
        valid = false;
      } else {
        passwordError.innerHTML = "";
        newPassword.style.border = "1px solid green";
      }

      if (confirmPassword.value === "") {
        confirmError.innerHTML = "Please confirm password";
        confirmPassword.style.border = "1px solid red";
        valid = false;
      } else if (newPassword.value !== confirmPassword.value) {
        confirmError.innerHTML = "Passwords do not match";
        confirmPassword.style.border = "1px solid red";
        valid = false;
      } else {
        confirmError.innerHTML = "";
        confirmPassword.style.border = "1px solid green";
      }
    } else {
      passwordError.innerHTML = "";
      confirmError.innerHTML = "";
      newPassword.style.border = "";
      confirmPassword.style.border = "";
    }

    return valid;
  }

  profileForm.addEventListener("submit", function (event) {
    if (!validateProfileForm()) {
      event.preventDefault();
    }
  });

  profileName.addEventListener("input", validateProfileForm);
  profileEmail.addEventListener("input", validateProfileForm);
  newPassword.addEventListener("input", validateProfileForm);
  confirmPassword.addEventListener("input", validateProfileForm);
}

function setupEditUserForm() {
  const editUserForm = document.getElementById("editUserForm");

  if (!editUserForm) {
    return;
  }

  const nameInput = document.getElementById("newUserName");
  const emailInput = document.getElementById("newUserEmail");
  const passwordInput = document.getElementById("newPassword");
  const confirmPasswordInput = document.getElementById("confirmNewPassword");

  const nameError = document.getElementById("user-name-error");
  const emailError = document.getElementById("user-email-error");
  const passwordError = document.getElementById("user-password-error");
  const confirmPasswordError = document.getElementById(
    "user-confirm-password-error",
  );

  function validateEditUserForm() {
    let valid = true;
    const name = nameInput.value.trim();
    const email = emailInput.value.trim();
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (name === "") {
      nameError.textContent = "Please enter a name";
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
      emailError.textContent = "Please enter an email";
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
          "Password must contain at least 6 characters";
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
    } else {
      passwordError.textContent = "";
      confirmPasswordError.textContent = "";
      passwordInput.style.border = "";
      confirmPasswordInput.style.border = "";
    }

    return valid;
  }

  editUserForm.addEventListener("submit", function (event) {
    if (!validateEditUserForm()) {
      event.preventDefault();
    }
  });

  nameInput.addEventListener("input", validateEditUserForm);
  emailInput.addEventListener("input", validateEditUserForm);
  passwordInput.addEventListener("input", validateEditUserForm);
  confirmPasswordInput.addEventListener("input", validateEditUserForm);
}
