@php
    $createUser = $allButtonAccessHelper->checkPermissionForActionUser($request, 'create');
    $editUser = $allButtonAccessHelper->checkPermissionForActionUser($request, 'edit');
    $showUser = $allButtonAccessHelper->checkPermissionForActionUser($request, 'show');
    $deleteUser = $allButtonAccessHelper->checkPermissionForActionUser($request, 'delete');
@endphp
@extends('admin.layout.common.pagemaster')
<style>
    .highlight-select {
        background-color: red !important;
    }

    #Edit_message {
        color: green !important;
    }

    #Edit_message_five,
    #Edit_message_notffound,
    #modulemessage,
    #permnissionmessage,
    #passwordmessage,
    #confirmpasswordmessage {
        color: red !important;
    }
</style>
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-6">
                        <h4>Users</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Users</li>
                        </ol>
                    </div>

                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <div class="card mx-3 card-primary">
            <div class="card-header">
                <h3 class="card-title">Users</h3>
                <ul class="list-unstyled">
                    <li>
                        @if ($createUser === 'active')
                            <a type="button" href="{{ route('adduser') }}" class="btn btn-dark btn-sm float-right">Add
                                Users</a>
                        @endif
                    </li>
                </ul>
            </div>
            <div class="card-body table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center" data-sortable="true">NO</th>
                            <th class="text-center" data-sortable="true">FULL NAME</th>

                            {{-- <th class="text-center" data-sortable="true">CURRENT PLAN</th> --}}
                            <th class="text-center" data-sortable="true">EMAIL VERIFIED </th>

                            <th class="text-center" data-sortable="true">ROLE</th>

                            @if ($editUser === 'active')
                                <th class="text-center" data-sortable="true">IS ACTIVE</th>
                            @endif

                            <th class="text-center" data-sortable="true">CREATED AT</th>

                            @if ($editUser === 'active' || $deleteUser === 'active')
                                <th class="text-center">Action</th>
                            @endif
                        </tr>
                    </thead>

                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($alluser as $getrole)
                            <tr>
                                <td class="text-center">{{ $i++ }}</td>
                                <td class="text-center">{{ isset($getrole->name) ? $getrole->name : 'NA' }}</td>
                                <td class="text-center">{{ isset($getrole->email) ? $getrole->email : 'NA' }}</td>
                                <td class="text-center">
                                    {{ isset($getrole->rolemodel->role_name) ? $getrole->rolemodel->role_name : 'NA' }}</td>


                                @if ($editUser === 'active')
                                    <td class="text-center">
                                        <form id="{{ $getrole->id }}">
                                            @csrf
                                            <label class="switch">
                                                <input type="checkbox" name="user_status"
                                                    onclick="toggleButtonConfirm(event)" class="toggle-permission"
                                                    data-roleid="{{ $getrole->id }}"
                                                    {{ $getrole->user_status === 'active' ? 'checked' : '' }}>
                                                <span class="slider round"></span>
                                            </label>
                                        </form>
                                    </td>
                                @endif



                                <td class="text-center"><span class="badge badge-secondary">{{ $getrole->created_at }}</span></td>

                                @if ($editUser === 'active' || $deleteUser === 'active')
                                    <td class="text-center">
                                        <ul class="list-unstyled">
                                            <li>
                                                @if ($editUser === 'active')
                                                    <a href="#" class="btn btn-primary" title="Chanage Password"
                                                        data-toggle="modal" data-target="#editModal"
                                                        onclick="openEditID('{{ $getrole->id }}')">
                                                        <i class="fa fa-key"></i>
                                                    </a>
                                                @endif
                                                @if ($editUser === 'active')
                                                    <a href="{{ url('editUser', $getrole->id) }}" class="btn btn-primary"
                                                        title="Edit">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                @endif

                                                @if ($deleteUser === 'active')
                                                    <a href="#" onclick="deleteUser('{{ $getrole->id }}')"
                                                        class="btn btn-danger" title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                @endif
                                            </li>
                                        </ul>
                                    </td>
                                @endif

                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <br>
            </div>
        </div>
    </div>


    <div class="modal" id="editModal" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Change Password</h4>

                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>


                <h6 id="Edit_message"></h6>
                <h6 id="Edit_message_five"></h6>
                <h6 id="Edit_message_notffound"></h6>

                <!-- Modal body -->
                <div class="modal-body">

                    <div class="col-md-12">
                        <form id="myForm">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <div class="input-group">
                                            <input type="password" placeholder="Password" class="form-control"
                                                id="password">
                                            <span class="input-group-text" id="togglePassword"
                                                onclick="togglePasswordVisibility('password', 'toggleIcon')">
                                                <i class="bi bi-eye-slash" id="toggleIcon"></i>
                                            </span>

                                        </div>

                                        <span id="passwordmessage"></span>

                                        <label for="exampleLastName">Confirm Password</label>
                                        <div class="input-group">
                                            <input type="password" placeholder="Confirm Password" class="form-control"
                                                id="confirmpassword">
                                            <span class="input-group-text" id="toggleConfirmPassword"
                                                onclick="togglePasswordVisibility('confirmpassword', 'toggleConfirmIcon')">
                                                <i class="bi bi-eye-slash" id="toggleConfirmIcon"></i>
                                            </span>

                                        </div>
                                        <span id="confirmpasswordmessage"></span>
                                    </div>

                                </div>
                            </div>

                            <div class="modal-footer">
                                <input type="submit" class="btn btn-primary" value="Update">
                                <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>

                            </div>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <script>
        let userId = '';

        function deleteUser(id) {
            const userId = parseInt(id, 10); // Specify the radix (base) as 10 for decimal numbers
            if (isNaN(userId)) {
                console.error('Invalid user ID:', id);
                return;
            }
            if (confirm('Are you sure you want to change this status?')) {
                $.ajax({
                    url: '{{ route('userDelete.post', ['id' => '__id__']) }}'.replace(
                        '__id__', userId),
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: JSON.stringify({
                        id: userId,
                    }),
                    success: function(data) {
                        if (data.status === 200) {
                            alert(data.message);
                            if (data.redirect) {
                                window.location.href = data.redirect;
                            }
                        } else if (data.status === 404) {
                            alert(data.message);
                        } else {
                            alert(data.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            } else {
                event.stopImmediatePropagation();
                event.preventDefault();
            }
        }
    </script>

    <script>
        function toggleButtonConfirm(event) {
            if (confirm('Are you sure you want to change the status?')) {
                alert('Are you sure you want to change the status?');
                document.querySelectorAll('.toggle-permission').forEach(function(toggle) {
                    toggle.addEventListener('change', function() {
                        let roleid = this.dataset.roleid;
                        let userstatus = this.checked ? 'active' : 'inactive';
                        console.log(roleid);
                        console.log(userstatus);

                        $.ajax({
                            url: '{{ route('userStatusToggle.post') }}',
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: JSON.stringify({
                                id: roleid,
                                user_status: userstatus,
                            }),
                            success: function(data) {
                                if (data.message === 200) {
                                    alert(data.message);
                                } else if (data.message === 404) {
                                    alert(data.message);
                                } else {
                                    alert(data.message);
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                            }
                        });
                    });
                });
            } else {
                event.stopImmediatePropagation();
                event.preventDefault();
            }
        }
    </script>



    <script>
        function togglePasswordVisibility(inputId, iconId) {
            var input = document.getElementById(inputId);
            var icon = document.getElementById(iconId);

            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("bi-eye-slash");
                icon.classList.add("bi-eye");
            } else {
                input.type = "password";
                icon.classList.remove("bi-eye");
                icon.classList.add("bi-eye-slash");
            }
        }
    </script>



    <script>
        let getid = '';

        function openEditID(id) {
            console.log(id);
            getid = id;
        }
        document.getElementById('myForm').addEventListener('submit', function(e) {
            e.preventDefault();
            let password = document.getElementById('password').value;
            let confirm_password = document.getElementById('confirmpassword').value;

            if (password === '') {
                document.getElementById('passwordmessage').innerHTML =
                    "<div >Enter Password</div>";
                setTimeout(() => {
                    document.getElementById('passwordmessage').innerHTML = "";
                }, 3000);
                return;
            }

            if (confirm_password === '') {
                document.getElementById('confirmpasswordmessage').innerHTML =
                    "<div >Enter Confirm Password</div>";
                setTimeout(() => {
                    document.getElementById('confirmpasswordmessage').innerHTML = "";
                }, 3000);
                return;
            }

            if (password !== confirm_password) {
                document.getElementById('confirmpasswordmessage').innerHTML =
                    "<div >Password does not match!!</div>";
                setTimeout(() => {
                    document.getElementById('confirmpasswordmessage').innerHTML = "";
                }, 3000);
                return;
            }

            $.ajax({
                url: '{{ route('editPassword.post', ['id' => '__id__']) }}'.replace(
                    '__id__', getid),
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: JSON.stringify({
                    password: password,
                    confirm_password: confirm_password,
                }),
                success: function(data) {
                    if (data.status === 200) {
                        document.getElementById('Edit_message').innerHTML =
                            "<div class='alert alert-success'>" + data.message + "</div>";
                        setTimeout(() => {
                            document.getElementById('Edit_message').innerHTML = "";
                        }, 3000);
                    } else if (data.status === 404) {
                        document.getElementById('Edit_message_notffound').innerHTML =
                            "<div class='alert alert-danger'>" + data.message + "</div>";
                        setTimeout(() => {
                            document.getElementById('Edit_message_notffound').innerHTML = "";
                        }, 3000);
                    } else {
                        document.getElementById('Edit_message_five').innerHTML =
                            "<div class='alert alert-danger'>" + data.message + "</div>";
                        setTimeout(() => {
                            document.getElementById('Edit_message_five').innerHTML = "";
                        }, 3000);
                    }
                },
            });
        });

        document.getElementById('password').addEventListener('input', function() {
            document.getElementById('passwordmessage').innerHTML = "";
        });

        document.getElementById('confirmpassword').addEventListener('input', function() {
            document.getElementById('confirmpasswordmessage').innerHTML = "";
        });
    </script>
@endsection
