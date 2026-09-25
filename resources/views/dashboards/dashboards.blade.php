@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<section class="container mt-2">
    <div class="card border-0 shadow-sm " style="background: linear-gradient(135deg, #811d95 0%, #7c3aed 100%); border-bottom: 2px solid #a78bfa;">
        <div class="card-body p-4 d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h2 text-white fw-bold mb-1">
                    Welcome, {{ $currentUser }}
                </h1>
                <p class="mb-0 text-white opacity-50">
                    Here is the latest information from your projects and tasks.
                </p>
            </div>
            <i class="bi bi-inboxes-fill display-3 text-white  d-none d-sm-block"></i>
        </div>
    </div>
</section>

<!-- Cards section -->
<section class="container my-3">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-4">
            <div class="card border-0 shadow-sm h-100 hover-card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">Total Projects</p>
                        <h2 class="fw-bold mb-2 text-dark">{{ $totalProjects }}</h2>
                        <a href="/projects" class="text-decoration-none fw-semibold" style="color: #7c3aed;">View projects</a>
                    </div>
                    <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-folder-fill fs-2 text-success"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-xl-4">
            <div class="card border-0 shadow-sm h-100 hover-card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">Total Tasks</p>
                        <h2 class="fw-bold mb-2 text-dark">{{ $totalTasks }}</h2>
                        <a href="/tasks" class="text-decoration-none fw-semibold" style="color: #7c3aed; border-color: #7c3aed;">View tasks</a>
                    </div>
                    <div class="bg-info bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-list-check fs-2 text-info"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-xl-4">
            <div class="card border-0 shadow-sm h-100 hover-card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">Team Members</p>
                        <h2 class="fw-bold mb-2 text-dark">{{ $totalUsers }}</h2>
                        <a href="/users" class="text-decoration-none fw-semibold" style="color: #7c3aed; border-color: #7c3aed;">View team</a>
                    </div>
                    <div class="bg-secondary bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-people-fill fs-2 text-info"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Task status summary strip -->
<section class="container mb-3">
    <div class="row g-3">
        <div class="col-4">
            <div class="card border-0 shadow-sm text-center py-2">
                <span class="badge bg-danger mx-auto mb-1" style="width: fit-content;">{{ $pendingTasks }}</span>
                <small class="text-muted">Pending</small>
            </div>
        </div>
        <div class="col-4">
            <div class="card border-0 shadow-sm text-center py-2">
                <span class="badge bg-warning text-dark mx-auto mb-1" style="width: fit-content;">{{ $onGoingTasks }}</span>
                <small class="text-muted">On Progress</small>
            </div>
        </div>
        <div class="col-4">
            <div class="card border-0 shadow-sm text-center py-2">
                <span class="badge bg-success mx-auto mb-1" style="width: fit-content;">{{ $completedTasks }}</span>
                <small class="text-muted">Completed</small>
            </div>
        </div>
    </div>
</section>

<!-- task cards  -->
<section class="container pb-4">
    <div class="row g-4">
        <!-- project cards  -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 pt-4 px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="h5 fw-bold mb-1">Projects</h2>
                            <p class="text-muted small mb-0">Real projects with manager and task totals</p>
                        </div>
                        <a href="/projects" class="btn btn-sm rounded-pill" style="color: #7c3aed; border-color: #7c3aed;">
                            All projects
                        </a>
                    </div>
                </div>
                <div class="card-body px-4">
                    @if($recentProjects->isEmpty())
                    <div class="text-center text-muted py-4">
                        <i class="bi bi-inbox display-4 d-block mb-2 opacity-50"></i>
                        No projects have been added yet.
                    </div>
                    @else
                    @foreach($recentProjects as $project)
                    @php
                    $statusColor = match($project->status) {
                    'Completed' => 'bg-success',
                    'On Progress' => 'bg-warning text-dark',
                    default => 'bg-danger',
                    };
                    @endphp
                    <a href="/projects/{{ $project->id }}/project-details" class="text-decoration-none text-dark">
                        <div class="border rounded-3 p-3 mb-3 shadow-sm hover-card">
                            <div class="d-flex justify-content-between gap-2 mb-2">
                                <h3 class="h6 fw-bold mb-0">
                                    {{ $project->project_name }}
                                </h3>
                                <span class="badge {{ $statusColor }}">{{ $project->status }}</span>
                            </div>
                            <p class="text-muted small mb-2">
                                <i class="bi bi-person me-1"></i>
                                Manager: {{ $project->manager->name ?? 'Not assigned' }}
                            </p>
                            <div class="d-flex gap-3 small">
                                <span>
                                    <i class="bi bi-list-check me-1"></i>
                                    {{ $project->tasks->count() }} tasks
                                </span>
                                <span class="text-success">
                                    <i class="bi bi-check-circle me-1"></i>
                                    {{ $project->tasks->where('status', 'Completed')->count() }} done
                                </span>
                            </div>
                        </div>
                    </a>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>

        <!-- user card -->
        <div class="col-lg-6">
            <div class="card border-0 pt-2 shadow-sm h-100">
                <div class="card-header bg-white border-0 pt-3 px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="h5 fw-bold mb-1">Team Members</h2>
                            <p class="text-muted small mb-0">People currently saved in the system</p>
                        </div>
                        <a href="/users" class="btn btn-sm rounded-pill" style="color: #7c3aed; border-color: #7c3aed;">
                            All users
                        </a>
                    </div>
                </div>
                <div class="card-body px-4">
                    @if($recentUsers->isEmpty())
                    <div class="text-center text-muted py-4">
                        <i class="bi bi-people display-4 d-block mb-2 opacity-50"></i>
                        No team members have been added yet.
                    </div>
                    @else
                    @foreach($recentUsers as $user)
                    <div class="border rounded-3 p-3 mb-3 shadow-sm hover-card">
                        <div class="d-flex align-items-center border-bottom py-3">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                <i class="bi bi-person-fill fs-4 text-primary"></i>
                            </div>
                            <div>
                                <h3 class="h6 mb-1">{{ $user->name }}</h3>
                                <small class="text-muted">{{ $user->email }}</small>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

<style>
    .hover-card {
        transition: transform 0.15s ease, box-shadow 0.15s ease;
    }

    .hover-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .1) !important;
    }
</style>