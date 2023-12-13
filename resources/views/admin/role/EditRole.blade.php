@extends('admin.layout.common.pagemaster')


@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-6">
                        <h4>Edit Role</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Edit Role</li>
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

                        <form id="editRole">
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
                                                <input type="text" id="role_name" value="{{ $editrole->role_name }}"
                                                    class="form-control" placeholder="Give role name">
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
                                                                <td>{{ $role }}</td>
                                                                @foreach ($buttons as $key => $item)
                                                                    @if ($key == strtolower($role))
                                                                        @foreach (['create', 'edit', 'show', 'delete'] as $action)
                                                                            <td>
                                                                                @if (isset($item[$action]) && $item[$action] === true)
                                                                                    @php
                                                                                        $toggleState = isset($editrole[strtolower($role) . '_' . $action]) ? $editrole[strtolower($role) . '_' . $action] : 'inactive';
                                                                                    @endphp
                                                                                    <label class="switch">
                                                                                        <input type="checkbox"
                                                                                            onchange="toggleValue('{{ $role }}', '{{ $action }}', this)"
                                                                                            {{ $toggleState === 'active' ? 'checked' : '' }}>
                                                                                        <span class="slider round"></span>
                                                                                    </label>
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
                                                <option value="active"
                                                    {{ $editrole->role_status == 'active' ? 'selected' : '' }}>Active
                                                </option>
                                                <option value="inactive"
                                                    {{ $editrole->role_status == 'inactive' ? 'selected' : '' }}>Inactive
                                                </option>
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
                                            style="margin-left: 13px;">Update</button>
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
        let editif = {{ $editrole['id'] }}

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
        document.getElementById('editRole').addEventListener('submit', function(e) {
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

            let vcardTemplateCreate = toggleValues.VcardTemplate.create;
            let vcardTemplateEdit = toggleValues.VcardTemplate.edit;
            let vcardTemplateDelete = toggleValues.VcardTemplate.delete;
            let vcardTemplateShow = toggleValues.VcardTemplate.show;

            $.ajax({
                url: '{{ route('EditFormRole.post', ['id' => '__id__']) }}'.replace(
                    '__id__', editif),
                type: 'POST',
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
                    vcard_create: vcardCreate,
                    vcard_edit: vcardEdit,
                    vcard_show: vcardShow,
                    vcard_delete: vcardDelete,
                    vcardtemplate_create: vcardTemplateCreate,
                    vcardtemplate_edit: vcardTemplateEdit,
                    vcardtemplate_show: vcardTemplateShow,
                    vcardtemplate_delete: vcardTemplateDelete,
                    role_status: role_status
                }),
                success: function(data) {
                    console.log(data);
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


        document.addEventListener('DOMContentLoaded', function() {
            loadeditvalue();
        });

        function loadeditvalue() {
            $.ajax({
                url: '{{ route('editRoleButtonValue.post', ['id' => '__id__']) }}'.replace('__id__', editif),
                type: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: 'json',
                success: function(data) {
                    if (data.status === 200) {

                        toggleValues.Admin.create = data.data.admin_create;
                        toggleValues.Admin.edit = data.data.admin_edit;
                        toggleValues.Admin.show = data.data.admin_show;
                        toggleValues.Admin.delete = data.data.admin_delete;


                        console.log(toggleValues.Admin.create);
                        console.log(toggleValues.Admin.edit);
                        console.log(toggleValues.Admin.show);
                        console.log(toggleValues.Admin.delete);


                        toggleValues.User.create = data.data.user_create;
                        toggleValues.User.edit = data.data.user_edit;
                        toggleValues.User.show = data.data.user_show;
                        toggleValues.User.delete = data.data.user_delete;


                        console.log(toggleValues.User.create);
                        console.log(toggleValues.User.edit);
                        console.log(toggleValues.User.show);
                        console.log(toggleValues.User.delete);

                        toggleValues.Permission.create = data.data.permission_create;
                        toggleValues.Permission.edit = data.data.permission_edit;
                        toggleValues.Permission.show = data.data.permission_show;
                        toggleValues.Permission.delete = data.data.permission_delete;

                        console.log(toggleValues.Permission.create);
                        console.log(toggleValues.Permission.edit);
                        console.log(toggleValues.Permission.show);
                        console.log(toggleValues.Permission.delete);

                        toggleValues.Role.create = data.data.role_create;
                        toggleValues.Role.edit = data.data.role_edit;
                        toggleValues.Role.show = data.data.role_show;
                        toggleValues.Role.delete = data.data.role_delete;


                        console.log(toggleValues.Role.create);
                        console.log(toggleValues.Role.edit);
                        console.log(toggleValues.Role.show);
                        console.log(toggleValues.Role.delete);


                        toggleValues.Vcard.create = data.data.vcard_create;
                        toggleValues.Vcard.edit = data.data.vcard_edit;
                        toggleValues.Vcard.show = data.data.vcard_show;
                        toggleValues.Vcard.delete = data.data.vcard_delete;


                        console.log(toggleValues.Vcard.create);
                        console.log(toggleValues.Vcard.edit);
                        console.log(toggleValues.Vcard.show);
                        console.log(toggleValues.Vcard.delete);


                        toggleValues.VcardTemplate.create = data.data.vcardtemplate_create;
                        toggleValues.VcardTemplate.edit = data.data.vcardtemplate_edit;
                        toggleValues.VcardTemplate.show = data.data.vcardtemplate_show;
                        toggleValues.VcardTemplate.delete = data.data.vcardtemplate_delete;


                        console.log(toggleValues.VcardTemplate.create);
                        console.log(toggleValues.VcardTemplate.edit);
                        console.log(toggleValues.VcardTemplate.show);
                        console.log(toggleValues.VcardTemplate.delete);

                    }
                }

            });
        }

        function toggleValue(role, action, checkbox) {
            console.log(role, action, checkbox.checkbox);
            if (toggleValues[role] && toggleValues[role][action] !== undefined) {
                toggleValues[role][action] = checkbox.checked ? 'active' : 'inactive';
                console.log(`${role}${action} value is now ${toggleValues[role][action]}`);
            }
        }
    </script>
@endsection
