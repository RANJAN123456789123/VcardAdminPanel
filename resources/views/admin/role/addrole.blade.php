{{-- {{dd($buttons)}} --}}

@extends('admin.layout.common.pagemaster')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-6">
                        <h4>Add Role</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Add Role</li>
                        </ol>
                    </div>

                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">


                    <div class="card card-primary">
                        <div class="card-header p-2">

                            <a type="button" href="{{ route('role') }}" class="btn btn-dark btn-sm float-right">
                                Back
                            </a>
                        </div>

                        <!-- /.card-header -->
                        <!-- form start -->

                        <form id="addRole">
                            <div class="card">
                                <div class="card-body">
                                    <h6 id="validationmessage"></h6>
                                    <h6 id="validationmessage404"></h6>
                                    <h6 id="validationmessage500"></h6>
                                    <div id="add_role">
                                        <div class="form-row mb-20">
                                            <div class="col-md-4">
                                                <label class="font-14 bold black">Name</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" id="role_name" class="form-control"
                                                    placeholder="Give role name">
                                            </div>
                                        </div>
                                        <div class="form-row mb-20">
                                            <div class="table-responsive">
                                                <h4 class="mb-3"></h4>
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Module</th>
                                                            <th scope="col">Feature</th>
                                                            <th scope="col">Create</th>
                                                            <th scope="col">Edit</th>
                                                            <th scope="col">Show</th>
                                                            <th scope="col">Delete</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach (['Admin', 'User', 'Permission', 'Role', 'Vcard', 'VcardTemplate'] as $role)
                                                            <tr>
                                                                <th>{{ $role }}</th>
                                                                <td> {{ $role }}</td>
                                                                @foreach ($buttons as $key => $item)
                                                                    {{-- Debugging: Output key, role, and item for debugging --}}
                                                                    {{-- {{ $key }} - {{ strtolower($role) }} -
                                                                    {{ json_encode($item) }} --}}
                                                                    @if ($key == strtolower($role))
                                                                        @foreach (['create', 'edit', 'show', 'delete'] as $action)
                                                                            <td>
                                                                                @if (isset($item[$action]) && $item[$action] === true)
                                                                                    <label class="switch">
                                                                                        <input type="checkbox"
                                                                                            onchange="toggleValue('{{ $role }}', '{{ $action }}', this)">
                                                                                        <span class="slider round"></span>
                                                                                    </label>
                                                                                @else
                                                                                    <!-- No {{ ucfirst($action) }} -->
                                                                                @endif
                                                                            </td>
                                                                        @endforeach
                                                                    @endif
                                                                @endforeach
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="form-row mb-20">
                                            <select id="role_status" class="form-control js-example-basic-single">
                                                <option>--Select Role Status--</option>
                                                <option value="active">Active</option>
                                                <option value="inactive">Inactive</option>
                                            </select>
                                            <div>
                                                <span id="statusshow"></span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6 text-left">
                                        <button type="submit" class="btn btn-primary"
                                            style="margin-left: 13px;">Add</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

                <div class="col-md-6">

                </div>

            </div>

        </div>


    </div>

    <script>
        document.getElementById('addRole').addEventListener('submit', function(e) {
            e.preventDefault();

            let role_name = document.getElementById('role_name').value;

            let role_status = document.getElementById('role_status').value;

            if (role_name === '') {
                document.getElementById('validationmessage').innerHTML =
                    "<h6 style='color:red;'>Role Name Required</h6>";
                setTimeout(() => {
                    document.getElementById('validationmessage').innerHTML = "";
                }, 4000);
            }

            document.getElementById('role_status').addEventListener('change', function() {
                document.getElementById('validationmessage').innerHTML = "";
            });

            if (role_status === '--Select Role Status--') {
                document.getElementById('statusshow').innerHTML =
                    "<h6 style='color:red;'>Please select a Role Status</h6>";
                setTimeout(() => {
                    document.getElementById('statusshow').innerHTML = "";
                }, 4000);
                return;
            }

            let adminCreate = toggleValues.Admin.create;
            let adminEdit = toggleValues.Admin.edit;
            let adminDelete = toggleValues.Admin.delete;
            let adminShow = toggleValues.Admin.show;

            let userCreate = toggleValues.User.create;
            let userEdit = toggleValues.User.edit;
            let userDelete = toggleValues.User.delete;
            let userShow = toggleValues.User.show;

            let permissionCreate = toggleValues.Permission.create;
            let permissionEdit = toggleValues.Permission.edit;
            let permissionDelete = toggleValues.Permission.delete;
            let permissionShow = toggleValues.Permission.show;

            let roleCreate = toggleValues.Role.create;
            let roleEdit = toggleValues.Role.edit;
            let roleDelete = toggleValues.Role.delete;
            let roleShow = toggleValues.Role.show;

            let vcardCreate = toggleValues.Vcard.create;
            let vcardEdit = toggleValues.Vcard.edit;
            let vcardDelete = toggleValues.Vcard.delete;
            let vcardShow = toggleValues.Vcard.show;

            let vcardTempCreate = toggleValues.VcardTemplate.create;
            let vcardTempEdit = toggleValues.VcardTemplate.edit;
            let vcardTempDelete = toggleValues.VcardTemplate.delete;
            let vcardTempShow = toggleValues.VcardTemplate.show;

            $.ajax({
                method: 'POST',
                url: '{{ route('addformRole.post') }}',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: JSON.stringify({
                    role_name: role_name,
                    admin_create: adminCreate,
                    admin_edit: adminEdit,
                    admin_show: adminShow,
                    admin_delete: adminDelete,
                    user_create: userCreate,
                    user_edit: userEdit,
                    user_show: userShow,
                    user_delete: userDelete,
                    permission_create: permissionCreate,
                    permission_edit: permissionEdit,
                    permission_show: permissionShow,
                    permission_delete: permissionDelete,
                    role_create: roleCreate,
                    role_edit: roleEdit,
                    role_show: roleShow,
                    role_delete: roleDelete,
                    role_status: role_status,
                    vcard_create: vcardCreate,
                    vcard_edit: vcardEdit,
                    vcard_show: vcardDelete,
                    vcard_delete: vcardShow,
                    vcardtemplate_create: vcardTempCreate,
                    vcardtemplate_edit: vcardTempEdit,
                    vcardtemplate_show: vcardTempShow,
                    vcardtemplate_delete: vcardTempDelete,
                    role_status: role_status
                }),
                success: function(data) {
                    if (data.status === 200) {
                        document.getElementById('validationmessage').innerHTML =
                            '<div class="alert alert-success"><b>' + data.message + '<b></div>';
                        setTimeout(() => {
                            document.getElementById('validationmessage').innerHTML = "";
                        }, 3000);
                    } else if (data.status === 404) {
                        document.getElementById('validationmessage404').innerHTML =
                            '<div class="alert alert-danger">' + data.message +
                            '</div>';
                        setTimeout(() => {
                            document.getElementById('validationmessage404').innerHTML = "";
                        }, 3000);
                    } else {
                        document.getElementById('validationmessage500').innerHTML =
                            '<div class="alert alert-secondary">' + data.message +
                            '</div>';
                        setTimeout(() => {
                            document.getElementById('validationmessage500').innerHTML = "";
                        }, 3000);
                    }
                }
            });

        });

        const toggleValues = {
            Admin: {
                create: "inactive",
                edit: "inactive",
                show: "inactive",
                delete: "inactive",
            },
            User: {
                create: "inactive",
                edit: "inactive",
                show: "inactive",
                delete: "inactive",
            },
            Permission: {
                create: "inactive",
                edit: "inactive",
                show: "inactive",
                delete: "inactive",
            },
            Role: {
                create: "inactive",
                edit: "inactive",
                show: "inactive",
                delete: "inactive",
            },
            Vcard: {
                create: "inactive",
                edit: "inactive",
                show: "inactive",
                delete: "inactive",
            },
            VcardTemplate: {
                create: "inactive",
                edit: "inactive",
                show: "inactive",
                delete: "inactive",
            },

            // Add other roles as necessary
        };


        function toggleValue(role, action, checkbox) {
            console.log(role, action, checkbox.checked);
            if (toggleValues[role] && toggleValues[role][action] !== undefined) {
                if (toggleValues[role][action] === null) {
                    toggleValues[role][action] = 'inactive';
                }
                toggleValues[role][action] = checkbox.checked ? 'active' : 'inactive';
                console.log(`${role}${action} value is now ${toggleValues[role][action]}`);
                checkbox.value = toggleValues[role][action];
            } else {
                console.log(`Role: ${role}, Action: ${action} - Not Found`);
            }
        }
    </script>


    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            handleCheckboxpermissioinCreate();
        });

        let adminCreate = "inactive"; // Default value

        function handleCheckboxpermissioinCreate() {
            const admindom = document.getElementById('admin_create');
            const element = document.getElementById("adminCreateVisibleHide");

            const module_feature_name = admindom.getAttribute('data-module_feature');
            const permission_name = admindom.getAttribute('data-permission_name');
            const permission_status = admindom.getAttribute('data-permission-status');

            console.log("module feature:" + module_feature_name);
            console.log("Permission name: " + permission_name);
            console.log("permission status: " + permission_status);

            $.ajax({
                method: 'POST',
                url: '{{ route('adminCreateToCheck') }}',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: JSON.stringify({
                    module_feature_name: module_feature_name,
                    permission_name: permission_name,
                    permission_status: permission_status
                }),
                success: function(data) {
                    console.log(data);

                    // Check if permission_status is active
                    if (data && data.permission_status === 'active') {
                        adminCreate = "active"; // Set the adminCreate variable to "active"
                        toggleButtonVisibility();
                    } else {
                        adminCreate = "inactive"; // Set the adminCreate variable to "inactive"
                        toggleButtonVisibility();
                    }
                }

            });
        }


        function toggleButtonVisibility() {
            const element = document.getElementById("adminCreateVisibleHide");
            if (adminCreate === "active") {
                element.style.display = "block"; // Show the button
            } else {
                element.style.display = "none"; // Hide the button
            }
        }

        function toggleValue1(element) {
            const permissionStatus = document.getElementById("admin_create").getAttribute('data-permission-status');
            if (permissionStatus === 'active') {
                adminCreate = "active";
                toggleButtonVisibility();
            } else {
                adminCreate = "inactive";
                toggleButtonVisibility();
            }
        }
    </script> --}}
@endsection
