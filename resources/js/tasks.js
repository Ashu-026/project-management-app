document.addEventListener("DOMContentLoaded", function () {
  setupTasksPage();
  setupDetailTaskPage();
});

// Set up the main tasks page form
function setupTasksPage() {
  const addTaskForm = document.getElementById("addTaskForm");
  if (!addTaskForm) {
    return;
  }
  const taskNameInput = document.getElementById("taskName");
  const projectInput = document.getElementById("projectID");
  const assignedToInput = document.getElementById("assignedTo");
  const statusInput = document.getElementById("taskStatus");

  addTaskForm.addEventListener("submit", function (event) {
    const taskNameValid = validateTaskName(taskNameInput);
    const projectValid = validateTaskProject(projectInput);
    const assignedToValid = validateAssignedUser(assignedToInput);
    const statusValid = validateTaskStatus(statusInput);

    if (!taskNameValid || !projectValid || !assignedToValid || !statusValid) {
      event.preventDefault();
    }
  });
  taskNameInput.addEventListener("input", function () {
    validateTaskName(taskNameInput);
  });
  projectInput.addEventListener("change", function () {
    validateTaskProject(projectInput);
  });
  assignedToInput.addEventListener("change", function () {
    validateAssignedUser(assignedToInput);
  });
  statusInput.addEventListener("change", function () {
    validateTaskStatus(statusInput);
  });
}

// Validate task name on the tasks page
function validateTaskName(taskNameInput) {
  const error = document.getElementById("task-name-error");
  const taskName = taskNameInput.value.trim();
  if (taskName === "") {
    error.innerHTML = "Please enter task name";
    taskNameInput.style.border = "1px solid red";
    return false;
  }
  error.innerHTML = "";
  taskNameInput.style.border = "1px solid green";
  return true;
}

// Validate project selection on the tasks page
function validateTaskProject(projectInput) {
  const error = document.getElementById("task-project-error");
  if (projectInput.value === "") {
    error.innerHTML = "Please select project";
    projectInput.style.border = "1px solid red";
    return false;
  }
  error.innerHTML = "";
  projectInput.style.border = "1px solid green";
  return true;
}

// Validate assigned user on the tasks page
function validateAssignedUser(assignedToInput) {
  const error = document.getElementById("task-assigned-error");
  if (assignedToInput.value === "") {
    error.innerHTML = "Please select assigned user";
    assignedToInput.style.border = "1px solid red";
    return false;
  }
  error.innerHTML = "";
  assignedToInput.style.border = "1px solid green";
  return true;
}

// Validate task status on the tasks page
function validateTaskStatus(statusInput) {
  const error = document.getElementById("task-status-error");
  if (statusInput.value === "") {
    error.innerHTML = "Please select task status";
    statusInput.style.border = "1px solid red";
    return false;
  }
  error.innerHTML = "";
  statusInput.style.border = "1px solid green";
  return true;
}

// Set up add and edit task forms on the project details page
function setupDetailTaskPage() {
  const addForm = document.getElementById("detailsAddTaskForm");
  const editForm = document.getElementById("detailEditTaskForm");
  if (addForm) {
    const name = document.getElementById("detailTaskName");
    const assigned = document.getElementById("detailAssignedTo");
    const status = document.getElementById("detailTaskStatus");
    const nameError = document.getElementById("detail-task-name-error");
    const assignedError = document.getElementById("detail-assigned-error");
    const statusError = document.getElementById("detail-status-error");
    // Validate the details page add-task form
    function validateAddDetails() {
      let valid = true;
      if (name.value.trim() === "") {
        nameError.innerHTML = "Please enter task name";
        name.style.border = "1px solid red";
        valid = false;
      } else {
        nameError.innerHTML = "";
        name.style.border = "1px solid green";
      }
      if (assigned.value === "") {
        assignedError.innerHTML = "Please select assigned user";
        assigned.style.border = "1px solid red";
        valid = false;
      } else {
        assignedError.innerHTML = "";
        assigned.style.border = "1px solid green";
      }
      if (status.value === "") {
        statusError.innerHTML = "Please select task status";
        status.style.border = "1px solid red";
        valid = false;
      } else {
        statusError.innerHTML = "";
        status.style.border = "1px solid green";
      }
      return valid;
    }
    addForm.addEventListener("submit", function (event) {
      if (!validateAddDetails()) {
        event.preventDefault();
      }
    });
    name.addEventListener("input", validateAddDetails);
    assigned.addEventListener("change", validateAddDetails);
    status.addEventListener("change", validateAddDetails);
  }
  if (editForm) {
    const name = document.getElementById("editTaskName");
    const assigned = document.getElementById("editTaskAssignedTo");
    const status = document.getElementById("editTaskStatus");
    const nameError = document.getElementById("edit-detail-task-name-error");
    const assignedError = document.getElementById("edit-detail-assigned-error");
    const statusError = document.getElementById("edit-detail-status-error");

    // Validate the details page edit-task form
    function validateEditDetails() {
      let valid = true;

      if (name.value.trim() === "") {
        nameError.innerHTML = "Please enter task name";
        name.style.border = "1px solid red";
        valid = false;
      } else {
        nameError.innerHTML = "";
        name.style.border = "1px solid green";
      }

      if (assigned.value === "") {
        assignedError.innerHTML = "Please select assigned user";
        assigned.style.border = "1px solid red";
        valid = false;
      } else {
        assignedError.innerHTML = "";
        assigned.style.border = "1px solid green";
      }

      if (status.value === "") {
        statusError.innerHTML = "Please select task status";
        status.style.border = "1px solid red";
        valid = false;
      } else {
        statusError.innerHTML = "";
        status.style.border = "1px solid green";
      }
      return valid;
    }

    editForm.addEventListener("submit", function (event) {
      if (!validateEditDetails()) {
        event.preventDefault();
      }
    });

    name.addEventListener("input", validateEditDetails);
    assigned.addEventListener("change", validateEditDetails);
    status.addEventListener("change", validateEditDetails);
  }
}
