<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'My App')</title>

  <!-- Bootstrap CSS (CDN) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

</head>

<body class="d-flex flex-column min-vh-100">
  <nav class="navbar navbar-expand-lg navbar-dark shadow py-2 sticky-top" style="background: linear-gradient(135deg, #811d95 0%, #7c3aed 100%); ">
    <div class="container  ">
      <a class="navbar-brand fw-bold  d-flex align-items-center gap-2" href="/dashboard">
        <div class="d-flex align-items-center justify-content-center rounded" style="background-color: rgba(255, 255, 255, 0.15); width: 38px; height: 38px;">
          <i class="bi bi-inboxes-fill text-white fs-5"></i>
        </div>
        <span class="text-white">Project<span style="color: #c4b5fd;">Manager</span></span>
      </a>
      <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" style="background-color: rgba(255, 255, 255, 0.1);">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto ms-lg-4 gap-lg-1">
          <li class="nav-item">
            <a class="nav-link px-3 rounded-2 fw-medium  text-white" href="/dashboard" style="opacity: 0.9;">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link px-3 rounded-2 fw-medium  text-white" href="/projects" style="opacity: 0.9;">Projects</a>
          </li>
          <li class="nav-item">
            <a class="nav-link px-3 rounded-2 fw-medium  text-white" href="/tasks" style="opacity: 0.9;">Tasks</a>
          </li>
          <li class="nav-item">
            <a class="nav-link px-3 rounded-2 fw-medium  text-white" href="/users" style="opacity: 0.9;">Users</a>
          </li>
        </ul>
        <div class="d-flex flex-column flex-lg-row align-items-lg-center gap-3 mt-3 mt-lg-0 pt-3 pt-lg-0">
          <a href="/profile" class="text-decoration-none d-flex align-items-center gap-2" title="Open profile">
            <i class="bi bi-person-circle fs-4" style="color: #fefefe;"></i>
            <span class="text-white fw-medium">
              Project Manager
            </span>
          </a>
          <form method="POST" action="{{ route('logout') }}" class="m-0">
            <button type="submit" class="btn btn-sm rounded-pill px-4 fw-bold shadow-sm" style="background-color: #ffffff; color: #6d28d9; border: none;">
              Log Out
            </button>
          </form>

        </div>
      </div>
    </div>
  </nav>

  <main class="container-fluid container-lg mt-4 mb-4 flex-grow-1 d-flex flex-column px-2 px-sm-3">
    <div class="col-sm-12 flex-grow-1 d-flex">
      <div class="card border-0 shadow-lg w-100" style="background-color: #FAF9F6;">
        <div class="card-body">
          <!-- success message  -->
          @if(session('success'))
          <div class="modal fade" id="successModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content text-center border-0 shadow-lg">
                <div class="modal-body p-5">
                  <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i>
                  <h4 class="mt-3 fw-bold">{{ session('success') }}</h4>
                </div>
              </div>
            </div>
          </div>
          @endif
          @yield('content')
        </div>
      </div>
    </div>
  </main>

  <!-- Bootstrap JS (CDN) — needed for dropdown/toggler to work -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <footer class="bg-white border-top mt-auto py-3">
    <div class="container-fluid px-4">
      <div class="d-flex flex-column align-items-center gap-2">
        <p class="mb-0 text-secondary small">
          &copy; <?= date("Y"); ?> Project Management System
        </p>
        <p class="mb-0 text-secondary small"> All rights reserved.</p>
      </div>
    </div>
  </footer>
  <script>
    const successMessage = document.getElementById('successModal');
    if (successMessage) {
      const successModal = new bootstrap.Modal(successMessage);
      successModal.show();
      setTimeout(function() {
        successModal.hide();
      }, 1000);
    }
  </script>
</body>

</html>