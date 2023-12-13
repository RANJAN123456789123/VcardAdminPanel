@php
    $createPermission = $allButtonAccessHelper->checkPermissionForActionPermission($request, 'create');
    $editPermission = $allButtonAccessHelper->checkPermissionForActionPermission($request, 'edit');
    $showPermission = $allButtonAccessHelper->checkPermissionForActionPermission($request, 'show');
    $deletePermission = $allButtonAccessHelper->checkPermissionForActionPermission($request, 'delete');
@endphp

@extends('admin.layout.common.pagemaster')
<style>
    .highlight-select {
        background-color: red !important;
    }

    #Edit_message {
        color: rgb(0, 148, 7) !important;
    }

    #Edit_message_five,
    #Edit_message_notffound,
    #modulemessage,
    #permnissionmessage {
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
                        <h4>Permission</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Permission</li>
                        </ol>
                    </div>

                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <div class="card mx-3 card-primary">
            <div class="card-header">
                <h3 class="card-title">All Permissions</h3>
                <ul class="list-unstyled">
                    <li>
                        @if ($createPermission === 'active')
                            <a type="button" href="{{ route('addPermission') }}"
                                class="btn btn-dark btn-sm float-right">Add
                                Permission</a>
                        @endif
                    </li>
                </ul>
            </div>
            <div class="card-body table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">MODULE FEATURE NAME</th>
                            <th class="text-center">PERMISSION NAME</th>
                            @if ($editPermission === 'active')
                                <th class="text-center">STATUS</th>
                            @endif
                            <th class="text-center">CREATED AT</th>
                            @if ($editPermission === 'active' || $deletePermission === 'active')
                                <th class="text-center">ACTION</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($permisonview as $key => $viewPermission)
                            <tr>
                                <td class="text-center">
                                    {{ $i++ }}
                                </td>
                                <td class="text-center">{{ $viewPermission->module_feature_name }}</td>
                                <td class="text-center">{{ $viewPermission->permission_name }}</td>


                                @if ($editPermission === 'active')
                                    <td class="text-center toggle-status" data-permission-id="{{ $viewPermission->id }}">

                                        <form id="{{ $viewPermission->id }}">
                                            @csrf
                                            <label class="switch">
                                                <input type="checkbox" onclick="toggleButtonConfirm(event)"
                                                    name="permission_status" class="toggle-permission"
                                                    data-permission-id="{{ $viewPermission->id }}"
                                                    {{ $viewPermission->permission_status === 'active' ? 'checked' : '' }}>
                                                <span class="slider round"></span>
                                            </label>
                                        </form>

                                    </td>
                                @endif



                                <td class="text-center"><span class="badge badge-secondary">{{ $viewPermission->created_at }}</span></td>

                                @if ($editPermission === 'active' || $deletePermission === 'active')
                                    <td class="text-center">
                                        <ul class="list-unstyled">
                                            <li>
                                                @if ($editPermission === 'active')
                                                    <a href="#" class="btn btn-primary"
                                                        onclick="openEditModal('{{ $viewPermission->id }}')"
                                                        data-toggle="modal" data-target="#editModal"
                                                        data-get-id="{{ $viewPermission->id }}">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                @endif

                                                @if ($deletePermission === 'active')
                                                    <a href="#"
                                                        onclick="deletePermission('{{ $viewPermission->id }}')"
                                                        class="btn btn-danger">
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
                    <h4 class="modal-title">Edit Permission</h4>

                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>


                <h6 id="Edit_message"></h6>
                <h6 id="Edit_message_five"></h6>
                <h6 id="Edit_message_notffound"></h6>

                <!-- Modal body -->
                <div class="modal-body">
                    <form id="myForm">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleFirstName">MODULE FEATURE NAME </label>

                                    <select class="form-control js-example-basic-single" name="module_feature_name"
                                        id="module_feature_name" data-module="">
                                        <option>--Select module--</option>
                                        <option value="admin"> Admin</option>
                                        <option value="user">User</option>
                                        <option value="vcard"> Vcard</option>
                                        <option value="nfs">NFS</option>
                                        <option value="vcardtemplate">Vcard Template</option>
                                        <option value="plans">Plans</option>
                                        <option value="affiliations">Affiliations</option>
                                        <option value="frontCMS">Front CMS</option>
                                        <option value="role"> Role </option>
                                        <option value="permission">Permission</option>
                                        <option value="setting">Setting</option>
                                    </select>


                                    <span id="modulemessage"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleLastName">PERMISSION NAME</label>
                                    <select class="form-control js-example-basic-single" name="permission_name"
                                        id="permission_name" data-permission="">
                                        <option>--Select permission--</option>
                                        <option value="create">Create</option>
                                        <option value="edit">Edit</option>
                                        <option value="show">Show</option>
                                        <option value="delete">Delete</option>
                                    </select>
                                    <span id="permnissionmessage"></span>
                                </div>
                            </div>

                        </div>
                        <input type="hidden" id="editPermissionId" name="editPermissionId">
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-dark" value="Update">
                            <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                            <!-- Add your update button or any other necessary buttons here -->
                        </div>
                    </form>
                </div>

                <!-- Modal footer -->

            </div>
        </div>
    </div>


    <script>
        function toggleButtonConfirm() {
            if (confirm('Are you sure you want to change this status?')) {

            } else {

                event.stopImmediatePropagation();
                event.preventDefault();
            }
        }

        document.querySelectorAll('.toggle-permission').forEach(function(toggle) {
            toggle.addEventListener('change', function() {
                let permissionId = this.dataset.permissionId;
                let permissionStatus = this.checked ? 'active' : 'inactive';

                $.ajax({
                    method: 'POST',
                    url: '{{ route('permissionToggle.post') }}',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: JSON.stringify({
                        id: permissionId,
                        permission_status: permissionStatus,
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
    </script>


    <script>
        function openEditModal(id) {
            $.ajax({
                url: '{{ route('getFormPermission.post', ['id' => '__id__']) }}'.replace('__id__', id),
                type: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                success: function(data) {
                    if (data.status === 200) {
                        console.log(data);
                        var selectedModule = data.data.module_feature_name;
                        var selectedPermission = data.data.permission_name;

                        document.getElementById('editPermissionId').value = id;
                        var moduleFeatureSelect = document.getElementById('module_feature_name');
                        var permissionSelect = document.getElementById('permission_name');

                        for (var i = 0; i < moduleFeatureSelect.options.length; i++) {
                            if (moduleFeatureSelect.options[i].value === selectedModule) {
                                var temp = moduleFeatureSelect.options[i].outerHTML;
                                moduleFeatureSelect.remove(i);
                                moduleFeatureSelect.insertAdjacentHTML('afterbegin', temp);
                                moduleFeatureSelect.selectedIndex = 0;
                            }
                        }

                        for (var i = 0; i < permissionSelect.options.length; i++) {
                            if (permissionSelect.options[i].value === selectedPermission) {
                                var temp = permissionSelect.options[i].outerHTML;
                                permissionSelect.remove(i);
                                permissionSelect.insertAdjacentHTML('afterbegin', temp);
                                permissionSelect.selectedIndex = 0;
                            }
                        }
                    } else {
                        console.error('Error fetching permission details');
                    }
                },
                error: function(error) {
                    console.error('Error fetching permission details:', error);
                }
            });
        }
    </script>


    <script>
        let getidedit = '';

        window.addEventListener('load', function() {
            document.getElementById('myForm').addEventListener('submit', function(e) {
                e.preventDefault();

                let updateedit = document.getElementById('module_feature_name').value;
                let permission = document.getElementById('permission_name').value;

                console.log('Module Feature Name: ' + updateedit);
                console.log('Permission Name: ' + permission);
                console.log('id: ' + getidedit);

                if (updateedit === '--Select module--') {
                    document.getElementById('modulemessage').innerHTML =
                        "Select a module";
                    setTimeout(() => {
                        document.getElementById('modulemessage').innerHTML = "";
                    }, 3000);
                } else if (permission === '--Select permission--') {
                    document.getElementById('permnissionmessage').innerHTML = "Select a Permission";
                    setTimeout(() => {
                        document.getElementById('permnissionmessage').innerHTML = "";
                    }, 3000);
                } else {
                    $.ajax({
                        url: '{{ route('EditFormPermission.post', ['id' => '__id__']) }}'.replace(
                            '__id__', getidedit),
                        type: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: JSON.stringify({
                            module_feature_name: updateedit,
                            permission_name: permission
                        }),
                        dataType: 'json',
                        success: function(data) {
                            if (data.status === 200) {
                                document.getElementById('Edit_message').innerHTML =
                                    "<div class='alert alert-success'><b>Updated Success!<b></div>'";
                                setTimeout(() => {
                                    document.getElementById('Edit_message').innerHTML =
                                        "";
                                }, 3000);
                                window.location.href = data.redirect;
                            } else if (data.status === 404) {
                                document.getElementById('Edit_message_notffound').innerHTML =
                                    "<div class='alert alert-danger'><b>" + data.message +
                                    "</b></div>";

                                setTimeout(() => {
                                    document.getElementById('Edit_message_notffound')
                                        .innerHTML = "";
                                }, 3000);
                            } else {
                                document.getElementById('Edit_message_five').innerHTML =
                                    "<div class='alert alert-danger'><b>" + data.message +
                                    "</b></div>";
                                setTimeout(() => {
                                    document.getElementById('Edit_message_five')
                                        .innerHTML =
                                        "";
                                }, 3000);
                            }
                        }
                    });
                }
            });

            document.querySelectorAll('[data-get-id]').forEach(function(element) {
                element.addEventListener('click', function(e) {
                    e.preventDefault();
                    document.getElementById('module_feature_name').addEventListener('change',
                        function() {
                            document.getElementById('modulemessage').innerHTML = "";
                        });

                    document.getElementById('permission_name').addEventListener('change',
                        function() {
                            document.getElementById('permissionmessage').innerHTML = "";
                        });

                    getidedit = this.getAttribute('data-get-id');
                    // console.log('Clicked ID: ' + getidedit);
                });
            });
        });
    </script>

    <script>
        function deletePermission($id) {
            if (confirm('Are you sure you want to delete this permission?')) {
                $.ajax({
                    method: 'POST',
                    url: '{{ route('deletePermission.post', ['id' => '__id__']) }}'.replace('__id__', $id),
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: JSON.stringify({
                        id: $id
                    }),
                    success: function(data) {
                        if (data.status === 200) {
                            alert(data.message);
                            window.location.href = data.redirect;
                        } else if (data.status === 404) {
                            alert(data.message);
                        } else {
                            alert(data.message);
                        }
                    }

                })
            } else {
                event.stopImmediatePropagation();
                event.preventDefault();
            }
        }
    </script>
@endsection
