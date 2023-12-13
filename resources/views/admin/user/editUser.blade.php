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
                        <h4>Edit User</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Edit User</li>
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

                            <a type="button" href="{{ route('user') }}" class="btn btn-dark btn-sm float-right">
                                Back
                            </a>
                        </div>

                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="card-header p-2" id="addpremissionmessage"
                            style="color: red; font-size: 18px; font-weight: bold;">

                        </div>
                        <form id="editUser">
                            @csrf
                            <div class="card-body">
                                <h6 id="validationmessage"></h6>
                                <h6 id="validationmessage404"></h6>
                                <h6 id="validationmessage500"></h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="vcardpicture">Profile Picture <span
                                                    class="text-danger">*</span></label>
                                            <div class="custom-file" style="display: none;">
                                                <input type="file" name="profile_pic" class="custom-file-input"
                                                    id="vcardpicture" accept=".png, .jpg, .jpeg, .gif">
                                                <label class="custom-file-label" for="vcardpicture">Choose file</label>
                                            </div>
                                            <span id="vcardpicturemessage"></span>

                                            @php
                                                $profilePic = $userEditData->profile_pic ? asset('admin/uploads/users/' . $userEditData->profile_pic) : asset('img/No_image_available.svg');
                                            @endphp
                                            <div class="image-preview" style="margin-top: 10px;">
                                                <label for="vcardpicture">
                                                    <img id="preview_img_id" src="{{ $profilePic }}" width="150px"
                                                        height="150px" class="img-fluid"
                                                        style="object-fit: cover; cursor: pointer;" />
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleName"> NAME </label>
                                            <input type="text" placeholder="Enter name" class="form-control"
                                                id="exampleName" value="{{ $userEditData->name }}">
                                            <span id="namemessage"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleemail">EMAIL</label>
                                            <input type="email" placeholder="Enter email" class="form-control"
                                                id="exampleemail" value="{{ $userEditData->email }}">
                                            <span id="emailmessage"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="designation">Designation</label>
                                            <input type="text" placeholder="Enter designation" class="form-control"
                                                id="exampledesignation" value="{{ $userEditData->designation }}">
                                            <span id="designationmessage"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="DOB">DOB</label>
                                            <input type="date" placeholder="DOB" class="form-control" id="exampleDOB"
                                                value="{{ $userEditData->DOB }}">
                                            <span id="DOBmessage"></span>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleemail">Phone Number</label>
                                            <input type="number" placeholder="Phone Number" class="form-control"
                                                id="examplephonenumber" value="{{ $userEditData->phone_number }}">
                                            <span id="phonemessage"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleemail">Location</label>
                                            <input type="text" placeholder="Location" class="form-control"
                                                id="examplelocation" value="{{ $userEditData->location }}">
                                            <span id="locationmessage"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <select id="role_id" class="form-control js-example-basic-single"
                                                    onchange="role_select()">
                                                    <option value="--Select Role--">--Select Role--</option>
                                                    @foreach ($geteditrole as $getrole)
                                                        <option value="{{ $getrole->id }}"
                                                            @if ($userEditData->role_id == $getrole->id) selected style="background-color: #0069d9; color: #fff;" @endif>
                                                            {{ $getrole->role_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <span id="rolenamemessage"></span>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <input type="submit" class="btn btn-dark" value="Update">
                                </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('DOMContentLoaded', function() {
            let userEditData = {!! json_encode($userEditData) !!};
            console.log(userEditData);
            document.getElementById('editUser').addEventListener('submit', function(e) {
                e.preventDefault();
                let vcardpictureInput = document.getElementById('vcardpicture').files[0];
                let proimage = '';

                if (vcardpictureInput === undefined) {
                    proimage = userEditData.profile_pic;
                }

                if (vcardpictureInput) {
                    proimage = vcardpictureInput.name;
                }
                let exampleName = document.getElementById('exampleName').value;


                let exampleemail = document.getElementById('exampleemail').value;

                let role_id = document.getElementById('role_id').value;

                let namemessage = document.getElementById('namemessage');

                if (exampleName === '') {
                    namemessage.innerHTML = "<span style='color:red'>Enter name</span>";
                    setTimeout(() => {
                        namemessage.innerHTML = "";
                    }, 3000);
                    return
                }


                let emailmessage = document.getElementById('emailmessage');
                if (exampleemail === '') {
                    emailmessage.innerHTML = "<span style='color:red'>Enter Email</span>";
                    setTimeout(() => {
                        emailmessage.innerHTML = "";
                    }, 3000);
                    return
                }

                let filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if (!filter.test(exampleemail)) {
                    emailmessage.innerHTML = "<span style='color:red'>Invalid email address</span>";
                    setTimeout(() => {
                        emailmessage.innerHTML = "";
                    }, 3000);
                    return
                }
                let exampledesignation = document.getElementById('exampledesignation').value;
                let designationmessage = document.getElementById('designationmessage');
                if (exampledesignation === '') {
                    designationmessage.innerHTML = "<span style='color:red'>Enter Designation</span>";
                    setTimeout(() => {
                        designationmessage.innerHTML = "";
                    }, 3000);
                    return
                }


                let examplephonenumber = document.getElementById('examplephonenumber').value;
                let phonemessage = document.getElementById('phonemessage');
                if (examplephonenumber === '') {
                    phonemessage.innerHTML = "<span style='color:red'>Enter Phone</span>";
                    setTimeout(() => {
                        phonemessage.innerHTML = "";
                    }, 3000);
                    return
                }


                let exampleDOB = document.getElementById('exampleDOB').value;
                let DOBmessage = document.getElementById('DOBmessage');
                if (exampleDOB === '') {
                    DOBmessage.innerHTML = "<span style='color:red'>Enter DOB</span>";
                    setTimeout(() => {
                        DOBmessage.innerHTML = "";
                    }, 3000);
                    return
                }

                let examplelocation = document.getElementById('examplelocation').value;
                let locationmessage = document.getElementById('locationmessage');
                if (examplelocation === '') {
                    locationmessage.innerHTML = "<span style='color:red'>Enter Location</span>";
                    setTimeout(() => {
                        locationmessage.innerHTML = "";
                    }, 3000);
                    return
                }


                let rolenamemessage = document.getElementById('rolenamemessage');
                if (role_id === '--Select Role--') {
                    rolenamemessage.innerHTML = "<span style='color:red'>Select Role</span>";
                    setTimeout(() => {
                        rolenamemessage.innerHTML = "";
                    }, 3000);
                    return
                }

                let formData = new FormData();
                formData.append('profile_pic', vcardpictureInput);
                formData.append('name', exampleName);
                formData.append('email', exampleemail);
                formData.append('designation', exampledesignation);
                formData.append('DOB', exampleDOB);
                formData.append('phone_number', examplephonenumber);
                formData.append('location', examplelocation);
                formData.append('role_id', role_id);

                $.ajax({
                    url: '{{ route('editFormUser.post', ['id' => '__id__']) }}'.replace(
                        '__id__', userEditData.id),
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    processData: false,
                    contentType: false,
                    data: formData,
                    success: function(data) {
                        // console.log(data);
                        // return
                        if (data.status === 200) {
                            document.getElementById('validationmessage').innerHTML =
                                '<div class="alert alert-success"><b>' + data.message +
                                '<b></div>';
                            setTimeout(() => {
                                document.getElementById('validationmessage').innerHTML =
                                    "";
                            }, 3000);
                        } else if (data.status === 404) {
                            document.getElementById('validationmessage404').innerHTML =
                                '<div class="alert alert-danger">' + data.message +
                                '</div>';
                            setTimeout(() => {
                                document.getElementById('validationmessage404')
                                    .innerHTML = "";
                            }, 3000);
                        } else {
                            document.getElementById('validationmessage500').innerHTML =
                                '<div class="alert alert-secondary">' + data.message +
                                '</div>';
                            setTimeout(() => {
                                document.getElementById('validationmessage500')
                                    .innerHTML = "";
                            }, 3000);
                        }
                    }
                });

            });

            document.getElementById('vcardpicture').addEventListener('change', function(e) {
                let fileInput = document.getElementById('vcardpicture');
                let imagePreview = document.getElementById('preview_img_id');
                let vcardpicturemessage = document.getElementById('vcardpicturemessage');

                if (fileInput.files && fileInput.files[0]) {
                    let reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.src = e.target.result;
                        vcardpicturemessage.innerHTML = '';
                    };
                    reader.readAsDataURL(fileInput.files[0]);
                } else {
                    imagePreview.src = "{{ asset('img/No_image_available.svg') }}";
                    document.getElementById('vcardpicturemessage').innerHTML =
                        "<span style='color:red'>Please choose a valid image file.</span>";
                    setTimeout(() => {
                        document.getElementById('vcardpicturemessage').innerHTML = '';
                    }, 3000);
                }
            });

        });
    </script>
@endsection
