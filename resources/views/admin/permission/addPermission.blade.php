@extends('admin.layout.common.pagemaster')

<style>
    .card-body {
        width: 100% !important;
    }

    .select2 {
        width: 100% !important;
    }

    #permissionstatus,
    #modulemessage,
    #permnissionmessage,
    #addpremissionmessage {
        color: red;
    }
</style>
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-6">
                        <h4>Add Permission</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Add Permission</li>
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

                            <a type="button" href="{{ route('permission') }}" class="btn btn-dark btn-sm float-right">
                                Back
                            </a>
                        </div>

                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="card-header p-2" id="addpremissionmessage"
                            style="color: red; font-size: 18px; font-weight: bold;">

                        </div>
                        <form id="addPermission">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleFirstName">MODULE FEATURE NAME</label>
                                            <select class="form-control js-example-basic-single" name="module_feature_name"
                                                id="module_feature_name">
                                                <option value="--Select module--">--Select module--</option>
                                                <option value="admin">Admin</option>
                                                <option value="user">User</option>
                                                <option value="vcard">Vcard</option>
                                                <option value="nfs">NFS</option>
                                                <option value="vcardtemplate">Vcard Template</option>
                                                <option value="plans">Plans</option>
                                                <option value="affiliations">Affiliations</option>
                                                <option value="frontCMS">Front CMS</option>
                                                <option value="role">Role</option>
                                                <option value="permission">Permission</option>
                                                <option value="setting">Setting</option>
                                            </select>
                                            <span id="modulemessage"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleLastName">PERMISSION NAME </label>
                                            <select class="form-control js-example-basic-single" name="permission_name"
                                                id="permission_name">
                                                <option value="--Select permission--">--Select permission--</option>
                                                <option value="create">Create</option>
                                                <option value="edit">Edit</option>
                                                <option value="show">Show</option>
                                                <option value="delete">Delete</option>
                                            </select>
                                            <span id="permnissionmessage"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="permissionStatus">PERMISSION STATUS</label>
                                            <select class="form-control js-example-basic-single" name="permission_status"
                                                id="permission_status">
                                                <option value="--Select status--">--Select status--</option>
                                                <option value="active">Active</option>
                                                <option value="inactive">Inactive</option>
                                            </select>
                                            <span id="permissionstatus"></span>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <input type="submit" class="btn btn-dark" value="Add">
                                </div>
                        </form>
                    </div>


                </div>
            </div>



        </div>

    </div>


    </div>
    <script>
        document.getElementById('addPermission').addEventListener('submit', function(e) {
            e.preventDefault();
            addPermission();
        });

        function addPermission() {
            let module_feature_name = document.getElementById('module_feature_name').value;
            let permission_name = document.getElementById('permission_name').value;
            let permission_status = document.getElementById('permission_status').value;

            if (module_feature_name === '--Select module--') {
                document.getElementById('modulemessage').innerHTML = "Select module";
                setTimeout(() => {
                    document.getElementById('modulemessage').innerHTML = "";
                }, 3000);
                return;
            }

            if (permission_name === '--Select permission--') {
                document.getElementById('permnissionmessage').innerHTML = "Select permission";
                setTimeout(() => {
                    document.getElementById('permnissionmessage').innerHTML = "";
                }, 3000);
                return;
            }

            if (permission_status === '--Select status--') {
                document.getElementById('permissionstatus').innerHTML = "Select status";
                setTimeout(() => {
                    document.getElementById('permissionstatus').innerHTML = "";
                }, 3000);
                return;
            }

            // If all fields are selected, proceed with the AJAX request
            $.ajax({
                method: 'POST',
                url: '{{ route('addFormPermission.post') }}',
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
                    if (data.status === 200) {
                        document.getElementById('addpremissionmessage').innerHTML =
                            "<h5 style='color:green'>Permission added</h6>";
                    } else {
                        document.getElementById('addpremissionmessage').innerHTML = data.message;
                    }
                    setTimeout(() => {
                        document.getElementById('addpremissionmessage').innerHTML = "";
                    }, 3000);
                }
            });
        }
    </script>
@endsection
