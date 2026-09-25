@extends('layouts.app')

@section('title', 'Users')
@vite(['resources/js/users.js'])
@section('content')

<div class="container my-3">
    <div class="card border-top shadow-lg  " style="background: linear-gradient(135deg, #811d95 0%, #7c3aed 100%); border-bottom: 2px solid #a78bfa;">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div class="px-4">
                <h2 class="fw-bolder  mb-1" style="color: #fcfcfc;">
                    <i class=" me-2"></i>User
                </h2>
                <p class="mb-0 text-white opacity-75">Manage your team members and their details.</p>
            </div>
            <div>
                <i class=" display-3 opacity-50 py-3"></i>
            </div>
        </div>
    </div>
</div>
<section>
    <div class="container pt-3 ">
        <div class="card border-0 shadow-sm" style="overflow: hidden;">
            
            <div class="card-body p-0">

                <!-- tables -->
                <div class="table-responsive">
                    <table class="table  text-center table-hover align-middle mb-0">
                        <thead class="btn-danger">
                            <tr>
                                <th scope="col">S.No</th>
                                <th scope="col">User Name</th>
                                <th scope="col">Email</th>
                                @if(Auth::user()->role === 'admin')
                                <th scope="col">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">

                            @if($data->isNotEmpty())
                            @foreach($data as $user)
                            <tr>
                                <td>{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}</td>
                                <td>{{$user->name ?? ''}}</td>
                                <td>{{$user->email ?? ''}}</td>
                                @if(Auth::user()->role === 'admin')
                                <td>

                                    <div class="container ">
                                        <button
                                            type="button"
                                            class="btn btn-secondary text-white px-3 my-1 rounded-pill btn-sm"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editMemberModal"
                                            data-id="{{ $user->id }}"
                                            data-name="{{ $user->name }}"
                                            data-email="{{ $user->email }}">
                                            Edit
                                        </button>

                                        <button class="btn  btn-danger my-1 rounded-pill btn-sm"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteMemberModal"
                                            data-id="{{ $user->id }}">
                                            Delete
                                        </button>
                                    </div>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <div class="d-flex justify-content-center">
            {{ $data->links() }}
        </div>
    </div>
</section>
<form id="editUserForm" method="POST" action="{{ route('users.editUser') }}" novalidate>
    @csrf
    @method('PUT')
    <div class="modal fade" tabindex="-1" id="editMemberModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background: linear-gradient(135deg, #811d95 0%, #7c3aed 100%); border-bottom: 2px solid #a78bfa;">
                    <h5 class="modal-title text-white ">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <small id="user-name-error" class="text-danger "></small>
                        <input type="hidden" name="user_id" id="editMemberId">
                        <input id="newUserName" name="name" class="form-control mb-2" placeholder="User Name" required>

                    </div>
                    <div class="container">
                        <small id="user-email-error" class="text-danger"></small>
                        <input type="email" id="newUserEmail" autocomplete="new-password" name="email" class="form-control mb-2" placeholder="Email" required>

                    </div>
                    <div class="container">
                        <small id="user-password-error" class="text-danger "></small>
                        <input type="password" id="newPassword" autocomplete="new-password" name="new_password" class="form-control mb-2" placeholder="New password (leave blank to keep current password)">
                    </div>
                    <div class="container">
                        <small id="user-confirm-password-error" class="text-danger "></small>
                        <input type="password" id="confirmNewPassword" name="confirm_new_password" class="form-control mb-2" placeholder="Confirm new password">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" name="register" class="btn " style="color: #fbfafc; background-color: #7c3aed;">edit</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- delete modal  -->
<form method="POST" action="{{ route('users.deleteUser') }}">
    @csrf
    @method('DELETE')
    <div class="modal fade" tabindex="-1" id="deleteMemberModal">
        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title"> Delete team member</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="fw-bold fs-5">
                        Are you sure you want to delete this member?
                    </p>
                    <input type="hidden" name="user_id" id="deleteMemberId">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" name="delete_member" class="btn btn-danger">
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    const deleteModal = document.getElementById('deleteMemberModal');
    deleteModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;
        const userId = button.getAttribute('data-id');
        document.getElementById('deleteMemberId').value = userId;
    });

    const editModal = document.getElementById("editMemberModal");
    editModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;
        const editUserId = button.getAttribute('data-id');
        const editUserName = button.getAttribute('data-name');
        const editUserEmail = button.getAttribute('data-email');

        document.getElementById('editMemberId').value = editUserId;
        document.getElementById('newUserName').value = editUserName;
        document.getElementById('newUserEmail').value = editUserEmail;
    });
</script>
@endsection