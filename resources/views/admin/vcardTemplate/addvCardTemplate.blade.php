@extends('admin.layout.common.pagemaster')
<style>
    .card-body {
        width: 100% !important;
    }

    .select2 {
        width: 100% !important;
    }



    #validationmessage404,
    #validationmessage500,
    #vcardnamemessage,
    #vcardpicturemessage,
    #vcardurlmessage {
        color: red;
    }

    #validationmessage {
        color: rgb(0, 112, 0)
    }
</style>
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-6">
                        <h4>Add vCard</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Add vCard</li>
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

                            <a type="button" href="{{ route('vcardTemplate') }}" class="btn btn-dark btn-sm float-right">
                                Back
                            </a>
                        </div>
                        <h6 id="validationmessage"></h6>
                        <h6 id="validationmessage404"></h6>
                        <h6 id="validationmessage500"></h6>
                        <form id="addvcardtemplate" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleName">VCARD NAME </label>
                                            <input type="text" placeholder="VCard name" class="form-control"
                                                id="vcardname">
                                            <span id="vcardnamemessage"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="vcardpicture">Vcard Picture <span
                                                    class="text-danger">*</span></label>
                                            <div class="custom-file">
                                                <input type="file" name="template_photo" class="custom-file-input"
                                                    id="vcardpicture" accept=".png, .jpg, .jpeg">
                                                <label class="custom-file-label" for="vcardpicture">Choose file</label>
                                            </div>
                                            <span id="vcardpicturemessage"></span>
                                            <div class="image-preview" style="margin-top: 10px;">
                                                <img id="preview_img_id" src="{{ asset('img/No_image_available.svg') }}"
                                                    width="150px" height="150px" class="img-fluid"
                                                    style="object-fit: cover;" />
                                            </div>

                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="permissionStatus">Vcard Url</label>
                                            <div class="input-group">
                                                <input type="text" id="vacrdurl" placeholder="/vcard-name/url"
                                                    class="form-control">
                                            </div>
                                            <span id="vcardurlmessage"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <input type="submit" class="btn btn-dark" value="Add">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <script>
        document.getElementById('addvcardtemplate').addEventListener('submit', function(e) {
            e.preventDefault();
            let vcardname = document.getElementById('vcardname').value;
            let vcardpicture = document.getElementById('vcardpicture').files[0];
            let vacrdurl = document.getElementById('vacrdurl').value;

            let vcardutltype = `/vcard-name/` + vacrdurl;

            if (vcardname === "") {
                document.getElementById('vcardnamemessage').innerHTML = 'Enter vcard name';
                setTimeout(() => {
                    document.getElementById('vcardnamemessage').innerHTML = "";
                }, 3000);
                return;
            }

            if (vcardpicture === undefined) {
                document.getElementById('vcardpicturemessage').innerHTML = 'Select vcard picture';
                setTimeout(() => {
                    document.getElementById('vcardpicturemessage').innerHTML = "";
                }, 3000);
                return;
            }

            if (vacrdurl === "") {
                document.getElementById('vcardurlmessage').innerHTML = 'Enter vcard url';
                setTimeout(() => {
                    document.getElementById('vcardurlmessage').innerHTML = "";
                }, 3000);
                return;
            }


            // Check if the image size is within the allowed limit (2 MB)
            if (vcardpicture.size > 2 * 1024 * 1024) {
                alert('Please choose an image file with a maximum size of 2 MB.');
                return;
            }

            console.log(vcardname);
            console.log(vcardpicture.name);
            console.log(vcardutltype);

            let formData = new FormData();
            formData.append('template_name', vcardname);
            formData.append('template_photo', vcardpicture);
            formData.append('template_url', vcardutltype);


            $.ajax({
                url: '{{ route('addvCardTemplate.post') }}',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.status === 200) {
                        document.getElementById('validationmessage').innerHTML = `
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong id="validationmessage">` + data.message + `</strong>

                            </div>
                        `;
                        setTimeout(() => {
                            document.getElementById('validationmessage').innerHTML = "";
                        }, 3000);
                    } else if (data.status === 404) {
                        document.getElementById('validationmessage404').innerHTML = `
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong id="validationmessage404">` + data.message + `</strong>

                            </div>
                        `;
                        setTimeout(() => {
                            document.getElementById('validationmessage404').innerHTML = "";
                        }, 3000);
                    } else {
                        document.getElementById('validationmessage500').innerHTML = `
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong id="validationmessage500">` + data.message + `</strong>

                            </div>
                        `;
                        setTimeout(() => {
                            document.getElementById('validationmessage500').innerHTML = "";
                        }, 3000);
                    }
                },

            });



        });
        document.getElementById('vcardname').addEventListener('input', function(e) {
            document.getElementById('vcardnamemessage').innerHTML = "";
        });

        document.getElementById('vcardpicture').addEventListener('input', function(e) {
            document.getElementById('vcardpicturemessage').innerHTML = "";
        });

        document.getElementById('vacrdurl').addEventListener('input', function(e) {
            document.getElementById('vcardurlmessage').innerHTML = "";
        });

        document.getElementById('vcardpicture').addEventListener('change', function(e) {
            let fileInput = document.getElementById('vcardpicture');
            let imagePreview = document.getElementById('preview_img_id');
            let vcardpicturemessage = document.getElementById('vcardpicturemessage');

            if (fileInput.files && fileInput.files[0]) {
                let reader = new FileReader();

                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    vcardpicturemessage.innerHTML = ''; // Clear any previous error messages
                };

                reader.readAsDataURL(fileInput.files[0]);
            } else {
                imagePreview.src = "{{ asset('img/No_image_available.svg') }}";
                vcardpicturemessage.innerHTML = 'Please choose a valid image file.';
            }
        });
    </script>
@endsection
