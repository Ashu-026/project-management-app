@extends('layouts.app')

@section('title', 'Projects')
@vite(['resources/js/projects.js'])
@section('content')


<section class="my-3 ">
        <div class="container ">
                <div class="card border-0  shadow-sm  rounded-pill  text-white">
                        <div class="card-body d-flex justify-content-between rounded align-items-center" style="background: linear-gradient(135deg, #811d95 0%, #7c3aed 100%); border-bottom: 2px solid #a78bfa;">
                                <div class="px-4">
                                        <h2 class="fw-bold text-white mb-1">
                                                <i class="fs-1 me-2"></i>Projects
                                        </h2>
                                        <p class="mb-0 text-white opacity-75">You can view and manage all your projects here.</p>
                                </div>
                                <div class="px-4">
                                        <i class=" display-3 opacity-50 py-3"></i>
                                </div><button type="button" class="btn  fw-bold p-2 rounded-pill btn-sm" data-bs-toggle="modal" data-bs-target="#projectbtnModal" style="color: #7c3aed; background-color: #ffffff;">
                                        + Add Project
                                </button>
                        </div>
                </div>
        </div>

</section>
<section>
        <div class="container pt-3">
                <div class="card border-0 shadow-sm" style="overflow: hidden;">
                        <div class="card-header d-flex justify-content-between text-dark">

                        </div>
                        <div class="card-body p-0">
                                <div class="table-responsive">
                                        <table class="table text-center table-hover align-middle mb-0">
                                                <thead class="table-light">
                                                        <tr>
                                                                <th scope="col">S.No</th>
                                                                <th scope="col">Projects Name</th>
                                                                <th scope="col">Projects Manager</th>
                                                                <th scope="col">Action</th>
                                                        </tr>
                                                </thead>
                                                <tbody class="table-group-divider">
                                                        @if($projects->isNotEmpty())
                                                        @foreach($projects as $project)
                                                        <tr>
                                                                <td>{{ ($projects->currentPage() - 1) * $projects->perPage() + $loop->iteration }}</td>
                                                                <td>{{ $project->project_name }}</td>
                                                                <td>{{ $project->manager->name ?? 'Not Assigned' }}</td>
                                                                <td>
                                                                        <div>
                                                                                <a href="/projects/{{ $project->id }}/project-details" class="btn my-1 px-3 rounded-pill btn-sm" style="color: #fbfafc; background-color: #7c3aed;">
                                                                                        View
                                                                                </a>
                                                                                <button type="button"
                                                                                        class="btn btn-secondary text-white px-3 my-1 rounded-pill btn-sm"
                                                                                        data-bs-toggle="modal"
                                                                                        data-bs-target="#editProjectInfo"
                                                                                        data-id="{{ $project->id }}"
                                                                                        data-name="{{ $project->project_name }}"
                                                                                        data-manager="{{ $project->manager_id }}"
                                                                                        data-summary="{{ $project->summary }}"
                                                                                        data-start="{{ $project->start_date }}"
                                                                                        data-due="{{ $project->due_date }}"
                                                                                        data-status="{{ $project->status }}">
                                                                                        Edit Project
                                                                                </button>
                                                                                <button type="button"
                                                                                        class="btn  btn-danger my-1 rounded-pill btn-sm"
                                                                                        data-bs-toggle="modal"
                                                                                        data-bs-target="#deleteProjectModal"
                                                                                        data-id="{{ $project->id }}">
                                                                                        Delete
                                                                                </button>
                                                                        </div>
                                                                </td>
                                                        </tr>
                                                        @endforeach
                                                        @endif
                                                </tbody>
                                        </table>

                                </div>
                        </div>

                </div>
                <div class="d-flex justify-content-center">
                        {{ $projects->links() }}
                </div>

        </div>
</section>
<div class="modal fade" tabindex="-1" id="projectbtnModal">
        <div class="modal-dialog modal-lg">
                <form id="addProjectForm" method="POST" action="{{route('projects.store')}}" class="modal-content" novalidate>
                        @csrf
                        <div class="modal-header" style="background: linear-gradient(135deg, #811d95 0%, #7c3aed 100%); border-bottom: 2px solid #a78bfa;">
                                <h5 class="modal-title text-white">Add Project </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                                <div class="mb-2">
                                        <label for="projectName" class="form-label ">Project Name</label>
                                        <input type="text" id="projectName" name="project_name" class="form-control" placeholder="Enter project name" required>
                                        <small id="add-project-name-error" class="text-danger"></small>
                                </div>

                                <div class="mb-2">
                                        <label for="managerName" class="form-label">Project Manager</label>
                                        <select id="managerName" name="manager_id" class="form-select" required>
                                                <option value="">Select Manager</option>
                                                @foreach($users as $manager)
                                                <option value="{{ $manager->id }}">{{ $manager->name }}</option>
                                                @endforeach
                                        </select>
                                        <small id="add-manager-error" class="text-danger"></small>
                                </div>

                                <div class="mb-2">
                                        <label for="projectSummary" class="form-label">Project Summary</label>
                                        <textarea id="projectSummary" name="summary" class="form-control" rows="3" placeholder="Enter project summary" required></textarea>
                                        <small id="add-summary-error" class="text-danger"></small>
                                </div>
                                <div class="row">
                                        <div class="col-md-6 mb-3">
                                                <label for="startDate" class="form-label">Start Date</label>
                                                <input type="date" id="startDate" name="start_date" class="form-control" required>
                                                <small id="add-start-date-error" class="text-danger"></small>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                                <label for="dueDate" class="form-label">Due Date</label>
                                                <input type="date" id="dueDate" name="due_date" class="form-control" required>
                                                <small id="add-due-date-error" class="text-danger"></small>
                                        </div>
                                </div>
                                <div class="mb-3">
                                        <label for="projectStatus" class="form-label">Project Status</label>
                                        <select id="projectStatus" name="status" class="form-select" required>
                                                <option value="">Select Status</option>
                                                <option value="Pending">Pending</option>
                                                <option value="On Progress">On Progress</option>
                                                <option value="Completed">Completed</option>
                                        </select>
                                        <small id="add-status-error" class="text-danger"></small>
                                </div>

                                <div class="modal-footer">
                                        <button type="button" class="btn btn-white border" data-bs-dismiss="modal">
                                                Close
                                        </button>
                                        <button type="submit" name="add_project" class="btn " style="color: #fbfafc; background-color: #7c3aed;">
                                                Save
                                        </button>
                                </div>
                        </div>
                </form>
        </div>
</div>

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
<div class="modal fade" tabindex="-1" id="deleteProjectModal">
        <div class="modal-dialog modal-dialog-centered">
                <form method="POST" class="modal-content" action="{{route('projects.delete')}}">
                        @csrf
                        @method('DELETE')
                        <div class="modal-header bg-danger">
                                <h5 class="modal-title">Delete Project</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body fw-bolder">
                                <p>Are you sure you want to delete this project?</p>
                                <input type="hidden" name="project_id" id="deleteProjectId">
                        </div>
                        <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        Close
                                </button>
                                <button type="submit" class="btn btn-danger">
                                        Delete
                                </button>
                        </div>
                </form>
        </div>
</div>
<script>
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

        const deleteProjectModal = document.getElementById('deleteProjectModal');
        deleteProjectModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const projectId = button.getAttribute('data-id');
                document.getElementById('deleteProjectId').value = projectId;
        });
</script>



@endsection