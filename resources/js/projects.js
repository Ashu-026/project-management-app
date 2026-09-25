// Start project page validation after the page loads
document.addEventListener("DOMContentLoaded", function () {
  setupProjectsPage();
});

// Set up add and edit project forms
function setupProjectsPage() {
  const addProjectForm = document.getElementById("addProjectForm");
  const editProjectForm = document.getElementById("editProjectForm");

  if (addProjectForm) {
    ProjectValidation({
      form: addProjectForm,
      projectName: document.getElementById("projectName"),
      manager: document.getElementById("managerName"),
      summary: document.getElementById("projectSummary"),
      startDate: document.getElementById("startDate"),
      dueDate: document.getElementById("dueDate"),
      status: document.getElementById("projectStatus"),

      projectNameError: "add-project-name-error",
      managerError: "add-manager-error",
      summaryError: "add-summary-error",
      startDateError: "add-start-date-error",
      dueDateError: "add-due-date-error",
      statusError: "add-status-error",
    });
  }

  if (editProjectForm) {
    ProjectValidation({
      form: editProjectForm,
      projectName: document.getElementById("editProjectName"),
      manager: document.getElementById("editManagerName"),
      summary: document.getElementById("editProjectSummary"),
      startDate: document.getElementById("editProjectStartDate"),
      dueDate: document.getElementById("editProjectDueDate"),
      status: document.getElementById("editProjectStatus"),

      projectNameError: "edit-project-name-error",
      managerError: "edit-manager-error",
      summaryError: "edit-summary-error",
      startDateError: "edit-start-date-error",
      dueDateError: "edit-due-date-error",
      statusError: "edit-status-error",
    });
  }
}

// Add validation to a project form
function ProjectValidation(fields) {
  const validateForm = function () {
    const projectNameValid = validateRequired(
      fields.projectName,
      fields.projectNameError,
      "Please enter project name",
    );
    const managerValid = validateRequired(
      fields.manager,
      fields.managerError,
      "Please select project manager",
    );
    const summaryValid = validateRequired(
      fields.summary,
      fields.summaryError,
      "Please enter project summary",
    );
    const datesValid = validateProjectDates(
      fields.startDate,
      fields.dueDate,
      fields.startDateError,
      fields.dueDateError,
    );
    const statusValid = validateRequired(
      fields.status,
      fields.statusError,
      "Please select project status",
    );
    return (
      projectNameValid &&
      managerValid &&
      summaryValid &&
      datesValid &&
      statusValid
    );
  };

  fields.form.addEventListener("submit", function (event) {
    if (!validateForm()) {
      event.preventDefault();
    }
  });

  fields.projectName.addEventListener("input", function () {
    validateRequired(
      fields.projectName,
      fields.projectNameError,
      "Please enter project name",
    );
  });

  fields.summary.addEventListener("input", function () {
    validateRequired(
      fields.summary,
      fields.summaryError,
      "Please enter project summary",
    );
  });

  fields.manager.addEventListener("change", function () {
    validateRequired(
      fields.manager,
      fields.managerError,
      "Please select project manager",
    );
  });

  fields.status.addEventListener("change", function () {
    validateRequired(
      fields.status,
      fields.statusError,
      "Please select project status",
    );
  });

  fields.startDate.addEventListener("change", function () {
    validateProjectDates(
      fields.startDate,
      fields.dueDate,
      fields.startDateError,
      fields.dueDateError,
    );
  });

  fields.dueDate.addEventListener("change", function () {
    validateProjectDates(
      fields.startDate,
      fields.dueDate,
      fields.startDateError,
      fields.dueDateError,
    );
  });
}

// Validate a required project field
function validateRequired(input, errorId, message) {
  const error = document.getElementById(errorId);
  if (input.value.trim() === "") {
    error.innerHTML = message;
    input.style.border = "1px solid red";
    return false;
  }
  error.innerHTML = "";
  input.style.border = "1px solid green";
  return true;
}

// Validate project start and due date s
function validateProjectDates(
  startDate,
  dueDate,
  startDateErrorId,
  dueDateErrorId,
) {
  const startDateError = document.getElementById(startDateErrorId);
  const dueDateError = document.getElementById(dueDateErrorId);
  let valid = true;
  startDateError.innerHTML = "";
  dueDateError.innerHTML = "";

  if (startDate.value === "") {
    startDateError.innerHTML = "Please select start date";
    startDate.style.border = "1px solid red";
    valid = false;
  } else {
    startDate.style.border = "1px solid green";
  }
  if (dueDate.value === "") {
    dueDateError.innerHTML = "Please select due date";
    dueDate.style.border = "1px solid red";
    valid = false;
  } else {
    dueDate.style.border = "1px solid green";
  }
  if (
    startDate.value !== "" &&
    dueDate.value !== "" &&
    dueDate.value < startDate.value
  ) {
    dueDateError.innerHTML = "Due date cannot be before start date";
    dueDate.style.border = "1px solid red";
    valid = false;
  }
  return valid;
}
