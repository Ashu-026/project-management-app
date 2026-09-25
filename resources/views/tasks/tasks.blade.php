@extends('layouts.app')

@section('title', 'Tasks')
@vite(['resources/js/tasks.js'])
@section('content')

<section class=" my-3">
    <div class="container">
        <div class="card border-0  shadow-sm  text-white" style="background: linear-gradient(135deg, #811d95 0%, #7c3aed 100%); border-bottom: 2px solid #a78bfa;">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div class="px-4">
                    <h2 class="fw-bold text-white mb-1">
                        <i class="fs-1 me-2"></i>Tasks
                    </h2>
                    <p class="mb-0 text-white opacity-75">You can view and manage all your tasks here.</p>
                </div>

                <button type="button" data-bs-toggle="modal" data-bs-target="#taskModal" class="btn  fw-bold p-2 rounded-pill btn-sm" style="color: #7c3aed; background-color: #ffffff;">
                    + Add Task
                </button>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container py-3">
        <div class="card border-0 shadow-sm" style="overflow: hidden;">
            <div class="card-header d-flex justify-content-between text-dark">
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table  text-center table-hover align-middle mb-0">
                        <thead class="btn-danger">
                            <tr class="bg-secondary">
                                <th scope="col">S.No</th>
                                <th scope="col">Task Name</th>
                                <th scope="col">Project Name</th>
                                <th scope="col">Assigned To </th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="taskTable" class="table-group-divider">
                            @if($tasks->isNotEmpty())
                            @foreach($tasks as $task)
                            <tr>
                                <td>{{ ($tasks->currentPage() - 1) * $tasks->perPage() + $loop->iteration }}</td>
                                <td>{{$task->task_name}}</td>
                                <td>{{$task->project->project_name}}</td>
                                <td>{{$task->manager->name ?? 'Not assigned'}}</td>
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
                                        {{$task->status}}
                                    </span>
                                </td>
                                <td>

                                    <button type="button"
                                        class="btn btn-secondary text-white px-3 my-1 rounded-pill btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editTask"
                                        data-task-id="{{ $task->id }}"
                                        data-project-id="{{ $task->project_id }}"
                                        data-task-name="{{ $task->task_name }}"
                                        data-project-name="{{ $task->project->project_name }}"
                                        data-assigned-to="{{ $task->assigned_to }}"
                                        data-task-status="{{ $task->status }}">
                                        Edit
                                    </button> <button
                                        type="button"
                                        class="btn  btn-danger my-1 rounded-pill btn-sm"
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
        <div class="d-flex justify-content-center ">
            {{ $tasks->links() }}
        </div>
    </div>
</section>

<!-- delete task model -->
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
                <input type="hidden" name="return_page" value="tasks">
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


<!-- add task model -->
<div class="modal fade" tabindex="-1" id="taskModal">
    <div class="modal-dialog">
        <form id="addTaskForm" method="POST" class="modal-content" action="{{route('tasks.store')}}" novalidate>
            @csrf
            <div class="modal-header  text-white" style="background: linear-gradient(135deg, #811d95 0%, #7c3aed 100%); border-bottom: 2px solid #a78bfa;">
                <h5 class="modal-title">Add Task</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal">
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="taskName" class="form-label">
                        Task Name
                    </label>
                    <input type="text" id="taskName" name="task_name" class="form-control" required>
                    <small id="task-name-error" class="text-danger"></small>
                </div>
                <div class="mb-3">
                    <label for="projectID" class="form-label">
                        Project
                    </label>
                    <select id="projectID" name="project_id" class="form-select" required>
                        <option value="">Select projects</option>
                        @foreach($projects as $project)
                        <option value="{{ $project->id }}">{{ $project->project_name }}</option>
                        @endforeach
                    </select>
                    <small id="task-project-error" class="text-danger"></small>
                </div>
                <div class="mb-3">
                    <label for="assignedTo" class="form-label">
                        Assigned To
                    </label>
                    <select id="assignedTo" name="assigned_to" class="form-select" required>
                        <option value="">Select Manager</option>
                        @foreach($users as $manager)
                        <option value="{{ $manager->id }}">{{ $manager->name }}</option>
                        @endforeach
                    </select>
                    <small id="task-assigned-error" class="text-danger"></small>
                </div>

                <div class="mb-3">
                    <label for="taskStatus" class="form-label">
                        Status
                    </label>
                    <select id="taskStatus" name="status" class="form-select" required>
                        <option value="">Select Status</option>
                        <option value="Pending">Pending</option>
                        <option value="On Progress">On Progress</option>
                        <option value="Completed">Completed</option>
                    </select><small id="task-status-error" class="text-danger"></small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Close
                </button>
                <button type="submit" name="add_task" class="btn" style="color: #fbfafc; background-color: #7c3aed;"> Save Task
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
            <div class="modal-header  text-white" style="background: linear-gradient(135deg, #811d95 0%, #7c3aed 100%); border-bottom: 2px solid #a78bfa;">
                <h5 class="modal-title">Edit Task</h5>
                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal">
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="task_id" id="editTaskId">
                <!-- <input type="hidden" name="project_id" id="editTaskProjectId"
                    value=""> -->
                <input type="hidden" name="return_page" value="tasks">
                <div class="mb-1">
                    <label for="editTaskName" class="form-label">
                        Task Name
                    </label>
                    <input type="text" id="editTaskName" name="task_name" class="form-control" required>
                    <small id="edit-detail-task-name-error" class="text-danger"></small>
                </div>
                <div class="mb-3">
                    <label for="editProjectID" class="form-label">
                        Project
                    </label>
                    <select id="editProjectID" name="project_id" class="form-select" required>
                        <option value="">Select projects</option>
                        @foreach($projects as $project)
                        <option value="{{ $project->id }}">{{ $project->project_name }}</option>
                        @endforeach
                    </select>
                    <small id="editTask-project-error" class="text-danger"></small>
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
                <button type="submit" class="btn " style="color: #fbfafc; background-color: #7c3aed;">
                    Save changes
                </button>
            </div>
        </form>
    </div>
</div>


<Script>
    const deleteTaskModel = document.getElementById('deleteModal');
    deleteTaskModel.addEventListener("show.bs.modal", function(event) {
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
        document.getElementById('editTaskName').value = taskName;
        document.getElementById('editProjectID').value = taskProjectId;
        document.getElementById('editTaskAssignedTo').value = taskManager;
        document.getElementById('editTaskStatus').value = taskStatus;
    });
</Script>


@endsection