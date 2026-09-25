@extends('layouts.app')

@section('title', 'Projects_Details')
@vite(['resources/js/projects.js'])
@section('content')

<!-- <section class="my-4">
    <div class="card border-0  shadow-sm bg-primary-subtle text-white">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold text-primary mb-1">
                    <i class="fs-1 me-2"></i>Project Information
                </h2>
                <p class="mb-0 text-dark opacity-75">You can see all your project details here.</p>
            </div>
            <div>
                <i class=" display-3 opacity-50 py-3"></i>
            </div>
             <button type="button" class="btn btn-primary fw-bold p-2 rounded-pill btn-sm" data-bs-toggle="modal" data-bs-target="#projectbtnModal">
                                + Add Project
                        </button>
        </div>
    </div>

</section> -->
<section>
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-body" style="color: #cbc8d4;">
                <div class="card border-0 my-3  shadow-sm  text-white" style="background: linear-gradient(135deg, #811d95 0%, #7c3aed 100%); border-bottom: 2px solid #a78bfa;">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="fw-bold text-white mb-1">
                                <i class="fs-1 me-2"></i>Project Information
                            </h2>
                            <p class="mb-0 text-white opacity-75">You can see all your project details here.</p>
                        </div>
                        <div>
                            <i class=" display-3 opacity-50 py-3"></i>
                            <button type="button" class="btn  fw-bold p-2 rounded-pill btn-sm" style="color: #7c3aed; background-color: #ffffff;"
                                data-bs-toggle="modal"
                                data-bs-target="#editProjectInfo"
                                data-id="{{ $project->id }}"
                                data-name="{{ $project->project_name }}"
                                data-manager="{{ $project->manager_id }}"
                                data-summary="{{ $project->summary }}"
                                data-start="{{ $project->start_date }}"
                                data-due="{{ $project->due_date }}"
                                data-status="{{ $project->status }}">
                                Edit Information
                            </button>
                        </div>

                    </div>
                </div>
                <table class="table table-bordered">
                    <tbody>

                        <tr>
                            <th>Project Name</th>
                            <td id="name">{{$project->project_name}} </td>
                        </tr>
                        <tr>
                            <th>Summary</th>
                            <td id="Summary">{{$project->summary}}</td>
                        </tr>
                        <tr>
                            <th>Start Date</th>
                            <td id="startDate">{{$project->start_date }}</td>
                        </tr>
                        <tr>
                            <th>Due Date</th>
                            <td id="dueDate">{{$project->due_date}}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td><span id="status" class="badge bg-info text-white">{{$project->status}}</span></td>
                        </tr>
                        <tr>
                            <th>Project Manager</th>
                            <td id="teamMembers">{{$project->manager->name ?? 'Not assigned'}}</td>
                        </tr>

                    </tbody>
                </table>

            </div>
        </div>
    </div>
</section>
<section class="container my-4">
    <div class="card shadow-sm">
        <div class="card-header  text-light d-flex justify-content-between align-items-center" style="background: linear-gradient(135deg, #811d95 0%, #7c3aed 100%); border-bottom: 2px solid #a78bfa;">
            <h3 class="h5 mb-0">Project Tasks</h3>

            <button type="button" class="btn btn-light m-2 btn-sm border rounded-pill" data-bs-toggle="modal" data-bs-target="#addTaskModal">
                + Add Task
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table  table-hover align-middle">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Task Name</th>
                            <th>Assigned To</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($tasks->isNotEmpty())
                        @foreach($tasks as $task)
                        <tr>
                            <td>{{ ($tasks->currentPage() - 1) * $tasks->perPage() + $loop->iteration }}</td>
                            <td>{{ $task->task_name }}</td>
                            <td>{{ $task->manager->name ?? 'Not Assigned' }}</td>
                            @php
                            $statusColor = "bg-danger";
                            if ($task->status === "Completed") {
                            $statusColor = "bg-success";
                            } elseif ($task->status === "On Progress") {
                            $statusColor = "bg-warning text-dark";
                            }
                            @endphp
                            <td>
                                <span class="badge {{$statusColor}} ">
                                    {{ $task->status }}
                                </span>
                            </td>
                            <td class="align-item-center">
                                <button type="button"
                                    class="btn btn-secondary px-3 btn-sm rounded-pill"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editTask"
                                    data-task-id="{{ $task->id }}"
                                    data-project-id="{{ $task->project_id }}"
                                    data-task-name="{{ $task->task_name }}"
                                    data-assigned-to="{{ $task->assigned_to }}"
                                    data-task-status="{{ $task->status }}">
                                    Edit
                                </button>
                                <button type="button"
                                    class="btn btn-danger mt-1 btn-sm rounded-pill"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteModal"
                                    data-id="{{ $task->id }}">
                                    Delete
                                </button>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center mt-3">
        {{ $tasks->links() }}
    </div>
</section>
<!-- edit project model  -->
<div class="modal fade" tabindex="-1" id="editProjectInfo">
    <div class="modal-dialog modal-lg">
        <form id="editProjectForm" method="POST" action="{{route('projects.update')}}" class="modal-content" novalidate>
            @csrf
            @method('PUT')
            <div class="modal-header " style="background: linear-gradient(135deg, #811d95 0%, #7c3aed 100%); border-bottom: 2px solid #a78bfa;">
                <h5 class="modal-title text-white">EDIT Project </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-2">
                    <input type="hidden" name="project_id" id="editProjectId" value="">
                    <input type="hidden" name="return_page" value="project-details">
                    <label for="editProjectName" class="form-label ">Project Name</label>
                    <input type="text" id="editProjectName" name="project_name" class="form-control" placeholder="Enter project name" value="" required>
                    <small id="edit-project-name-error" class="text-danger"></small>
                </div>
                <div class="mb-2">
                    <label for="managerName" class="form-label">Project Manager</label>
                    <select id="editManagerName" name="manager_id" class="form-select" required>
                        <option value="">Select Manager</option>
                        @foreach($users as $manager)
                        <option value="{{ $manager->id }}">{{ $manager->name }}</option>
                        @endforeach
                    </select>
                    <small id="edit-manager-error" class="text-danger"></small>
                </div>
                <small id="edit-manager-error" class="text-danger"></small>

                <div class="mb-2">
                    <label for="editProjectSummary" class="form-label">Project Summary</label>
                    <textarea id="editProjectSummary" name="summary" class="form-control" rows="3" placeholder="Enter project summary" required></textarea>
                    <small id="edit-summary-error" class="text-danger"></small>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="editProjectStartDate" class="form-label">Start Date</label>
                        <input type="date" id="editProjectStartDate" name="start_date"
                            class="form-control"
                            value=""
                            required><small id="edit-start-date-error" class="text-danger"></small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="editProjectDueDate" class="form-label">Due Date</label>
                        <input type="date" id="editProjectDueDate" name="due_date"
                            class="form-control"
                            value=""
                            required><small id="edit-due-date-error" class="text-danger"></small>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="editProjectStatus" class="form-label">Project Status</label>
                    <select id="editProjectStatus" name="status" class="form-select" required>
                        <option value="">Select Status</option>
                        <option value="Pending">Pending</option>
                        <option value="On Progress">On Progress</option>
                        <option value="Completed">Completed</option>
                    </select>
                    <small id="edit-status-error" class="text-danger"></small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white border" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="submit" name="edit-project" class=" btn " style="color: #fbfafc; background-color: #7c3aed;">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>
<!-- add task model  -->
<div class="modal fade" id="addTaskModal" tabindex="-1">
    <div class="modal-dialog">
        <form id="detailsAddTaskForm" method="POST" action="{{route('tasks.store')}}" class="modal-content" novalidate>
            @csrf
            <div class="modal-header  text-white" style="background: linear-gradient(135deg, #811d95 0%, #7c3aed 100%); border-bottom: 2px solid #a78bfa;">
                <h5 class="modal-title">Add Task</h5>
                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal">
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="project_id" value="{{$project->id}}">
                <input type="hidden" name="return_page" value="project-details">
                <div class="mb-1">
                    <label for="detailTaskName" class="form-label">
                        Task Name
                    </label>
                    <input type="text" id="detailTaskName" name="task_name" class="form-control" required>
                    <small id="detail-task-name-error" class="text-danger"></small>
                </div>
                <div class="mb-1">
                    <label for="detailAssignedTo" class="form-label">
                        Assigned To
                    </label>
                    <select id="detailAssignedTo" name="assigned_to" class="form-select" required>
                        <option value="">Select User</option>
                        @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    <small id="detail-assigned-error" class="text-danger"></small>
                </div>
                <div class="mb-1">
                    <label for="detailTaskStatus" class="form-label">
                        Status
                    </label>
                    <select id="detailTaskStatus" name="status" class="form-select" required>
                        <option value="">Select Status</option>
                        <option value="Pending">Pending</option>
                        <option value="On Progress">On Progress</option>
                        <option value="Completed">Completed</option>
                    </select>
                    <small id="detail-status-error" class="text-danger"></small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancel
                </button>
                <button type="submit" class="btn" style="color: #fbfafc; background-color: #7c3aed;">
                    Save Task
                </button>
            </div>
        </form>
    </div>
</div>
<!-- edit task model  -->
<div class="modal fade" id="editTask" tabindex="-1">
    <div class="modal-dialog">
        <form id="detailEditTaskForm" method="POST" action="{{route('tasks.update')}}" class="modal-content" novalidate>
            @csrf
            @method('PUT')
            <div class="modal-header text-white" style="background: linear-gradient(135deg, #811d95 0%, #7c3aed 100%); border-bottom: 2px solid #a78bfa;">
                <h5 class="modal-title">Edit Task</h5>
                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal">
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="task_id" id="editTaskId">
                <input type="hidden" name="project_id" id="editTaskProjectId"
                    value="">
                <input type="hidden" name="return_page" value="project-details">
                <div class="mb-1">
                    <label for="editTaskName" class="form-label">
                        Task Name
                    </label>
                    <input type="text" id="editTaskName" name="task_name" class="form-control" required>
                    <small id="edit-detail-task-name-error" class="text-danger"></small>
                </div>
                <div class="mb-1">
                    <label for="editTaskAssignedTo" class="form-label">
                        Assigned To
                    </label>
                    <select id="editTaskAssignedTo" name="assigned_to" class="form-select" required>
                        <option value="">Select User</option>
                        @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    <small id="edit-detail-assigned-error" class="text-danger"></small>
                </div>
                <div class="mb-1">
                    <label for="editTaskStatus" class="form-label">
                        Status
                    </label>
                    <select id="editTaskStatus" name="status" class="form-select" required>
                        <option value="">Select Status</option>
                        <option value="Pending">Pending</option>
                        <option value="On Progress">On Progress</option>
                        <option value="Completed">Completed</option>
                    </select>
                    <small id="edit-detail-status-error" class="text-danger"></small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancel
                </button>
                <button type="submit" class="btn" style="color: #fbfafc; background-color: #7c3aed;">
                    Save changes
                </button>
            </div>
        </form>
    </div>
</div>


<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" action="{{route('tasks.delete')}}" class="modal-content">
            @csrf
            @method('DELETE')
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Delete Task</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body fw-bolder">
                <p>Are you sure you want to delete this task?</p>
                <input type="hidden" name="task_id" id="deleteTaskId">
                <input type="hidden" name="return_page" value="project-details">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancel
                </button>
                <button type="submit" class="btn btn-danger">
                    Delete
                </button>
            </div>
        </form>
    </div>
</div>
<script>
    const deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;
        const taskId = button.getAttribute('data-id');
        document.getElementById('deleteTaskId').value = taskId;
    });


    const editModal = document.getElementById('editTask');
    editModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;
        const taskId = button.getAttribute('data-task-id');
        const taskProjectId = button.getAttribute('data-project-id');
        const taskName = button.getAttribute('data-task-name');
        const taskManager = button.getAttribute('data-assigned-to');
        const taskStatus = button.getAttribute('data-task-status');

        document.getElementById('editTaskId').value = taskId;
        document.getElementById('editTaskProjectId').value = taskProjectId;
        document.getElementById('editTaskName').value = taskName;
        document.getElementById('editTaskAssignedTo').value = taskManager;
        document.getElementById('editTaskStatus').value = taskStatus;
    });
    //  to show data in the project data form 
    const editProjectModal = document.getElementById("editProjectInfo");
    editProjectModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;
        const projectId = button.getAttribute('data-id');
        const projectName = button.getAttribute('data-name');
        const managerName = button.getAttribute('data-manager');
        const projectSummary = button.getAttribute('data-summary');
        const projectStartDate = button.getAttribute('data-start');
        const projectDueDate = button.getAttribute('data-due');
        const projectStatus = button.getAttribute('data-status');

        document.getElementById('editProjectId').value = projectId;
        document.getElementById('editProjectName').value = projectName;
        document.getElementById('editManagerName').value = managerName;
        document.getElementById('editProjectSummary').value = projectSummary;
        document.getElementById('editProjectStartDate').value = projectStartDate;
        document.getElementById('editProjectDueDate').value = projectDueDate;
        document.getElementById('editProjectStatus').value = projectStatus;
    });
</script>

@endsection