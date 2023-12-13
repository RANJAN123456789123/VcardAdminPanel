@extends('admin.layout.common.pagemaster')
<style>
    .card-body {
        width: 100% !important;
    }

    .select2 {
        width: 100% !important;
    }



    #validationmessage404,
    #validationmessage500 {
        color: red;
    }

    #validationmessage {
        color: rgb(0, 112, 0)
    }

    * {
        box-sizing: border-box
    }

    /* Set height of body and the document to 100% */
    body,
    html {
        height: 100%;
        margin: 0;
        font-family: Arial;
    }

    /* Style tab links */
    .tablink {
        background-color: #555;
        color: white;
        /* float: left;
        border: none;
        outline: none;
        cursor: pointer; */
        /* padding: 14px 16px; */
        /* font-size: 17px;
        width: 25%; */
    }

    .tablink:hover {
        background-color: #777;
    }

    /* Style the tab content (and add height:100% for full page content) */
    .tabcontent {
        color: rgb(0, 0, 0);
        /* display: none;
        padding: 100px 20px;
        height: 100%; */
    }
</style>
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-6">
                        <h4>Add User</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Add User</li>
                        </ol>
                    </div>

                </div>

            </div><!-- /.container-fluid -->

        </section>

        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header p-2 bg-white">
                            <button class="tablink btn btn-md" onclick="openPage('Profile', this, '#a2fda8')"
                                id="defaultOpen">Profile</button>
                            <button class="tablink btn btn-md" onclick="openPage('OurService', this, '#a2fda8')">Our
                                Services</button>
                            <button class="tablink btn btn-md"
                                onclick="openPage('Gallery', this, '#a2fda8')">Gallery</button>
                            <button class="tablink btn btn-md"
                                onclick="openPage('Product', this, '#a2fda8')">Product</button>
                            <button class="tablink btn btn-md"
                                onclick="openPage('Testimonial', this, '#a2fda8')">Testimonial</button>
                            <button class="tablink btn btn-md" onclick="openPage('BusinessHours', this, '#a2fda8')">Business
                                Hours</button>


                            <a type="button" href="{{ route('user') }}" class="btn btn-dark btn-sm float-right">
                                Back
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form id="adduser" enctype="multipart/form-data">
            <div id="Profile" class="tabcontent">
                <div class="col-md-12">
                    <div class="card card-primary ">
                        <div class="card-header p-2 bg-white">
                            <h6 id="validationmessage"></h6>
                            <h6 id="validationmessage404"></h6>
                            <h6 id="validationmessage500"></h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vcardpicture">Profile Picture </label>
                                        <div style="display: none;">
                                            <input type="file" name="profile_pic" class="custom-file-input"
                                                id="vcardpicture">
                                            <label class="custom-file-label" for="vcardpicture">Choose file</label>
                                        </div>
                                        <span id="vcardpicturemessage"></span>
                                        <div class="image-preview" style="margin-top: 10px;">
                                            <label for="vcardpicture">
                                                <img id="preview_img_id" src="{{ asset('img/No_image_available.svg') }}"
                                                    width="150px" height="150px" class="img-fluid"
                                                    style="object-fit: cover; cursor: pointer;" />
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleName"> NAME </label>
                                        <input type="text" placeholder="Enter name" class="form-control"
                                            id="exampleName">
                                        <span id="namemessage"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleemail">EMAIL</label>
                                        <input type="email" placeholder="Enter email" class="form-control"
                                            id="exampleemail">
                                        <span id="emailmessage"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="designation">Designation</label>
                                        <input type="text" placeholder="Enter designation" class="form-control"
                                            id="exampledesignation">
                                        <span id="designationmessage"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="DOB">DOB</label>
                                        <input type="date" placeholder="DOB" class="form-control" id="exampleDOB">
                                        <span id="DOBmessage"></span>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleemail">Phone Number</label>
                                        <input type="number" placeholder="Phone Number" class="form-control"
                                            id="examplephonenumber">
                                        <span id="phonemessage"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleemail">Location</label>
                                        <input type="text" placeholder="Location" class="form-control"
                                            id="examplelocation">
                                        <span id="locationmessage"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="permissionStatus">PASSWORD</label>
                                        <div class="input-group">
                                            <input type="password" id="passwordInput" placeholder="Enter password"
                                                class="form-control">
                                            <span class="input-group-text" id="togglePassword">
                                                <i class="bi bi-eye-slash" id="toggleIcon"></i>
                                            </span>
                                        </div>
                                        <span id="passwordmessage"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="permissionStatus">CONFIRM PASSWORD</label>
                                        <div class="input-group">
                                            <input type="password" id="confirmPasswordInput"
                                                placeholder="Confirm password" class="form-control">
                                            <span class="input-group-text" id="toggleConfirmPassword">
                                                <i class="bi bi-eye-slash" id="toggleConfirmIcon"></i>
                                            </span>
                                        </div>
                                        <span id="confirmpasswordmessage"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <select id="role_name" class="form-control js-example-basic-single"
                                                onchange="role_select()">
                                                <option value="--Select Role--">--Select Role--</option>
                                                @foreach ($getallrole as $item)
                                                    <option value="{{ $item->id }}">{{ $item->role_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <span id="rolenamemessage"></span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <input type="submit" class="btn btn-dark" value="Add">
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            <div id="OurService" class="tabcontent">
                <div class="col-md-12">
                    <div class="card card-primary ">
                        <div class="card-header p-2 bg-white">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="icon1">Icon1</label>
                                        <div class="custom-file" style="display: none;">
                                            <input type="file" class="custom-file-input" id="icon1"
                                                name="profile_pic" accept=".png, .jpg, .jpeg, .gif"
                                                onchange="previewImage1(event, 'preview_img_id_1')">
                                            <label class="custom-file-label" for="icon1">Choose file</label>
                                        </div>
                                        <span id="icon1"></span>
                                        <div class="image-preview" style="margin-top: 10px;">
                                            <label for="icon1">
                                                <img id="preview_img_id_1" src="{{ asset('img/noimages.png') }}"
                                                    width="150px" height="150px" class="img-fluid"
                                                    style="object-fit: cover; cursor: pointer;" />
                                            </label>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleName1">Title1</label>
                                            <input type="text" class="form-control" id="title1"
                                                placeholder="Title1">
                                            <span id="titleMessage1"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleDescription1">Description1</label>
                                            <textarea id="description1" cols="5" rows="2" class="form-control" placeholder="Description1"></textarea>
                                            <span id="descriptionMessage1"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="icon2">Icon2</label>
                                        <div class="custom-file" style="display: none;">
                                            <input type="file" class="custom-file-input" id="icon2"
                                                accept=".png, .jpg, .jpeg, .gif"
                                                onchange="previewImage2(event, 'preview_img_id_2')">
                                            <label class="custom-file-label" for="icon2">Choose file</label>
                                        </div>
                                        <span id="iconPreview2"></span>
                                        <div class="image-preview" style="margin-top: 10px;">
                                            <label for="icon2">
                                                <img id="preview_img_id_2" src="{{ asset('img/noimages.png') }}"
                                                    width="150px" height="150px" class="img-fluid"
                                                    style="object-fit: cover; cursor: pointer;" />
                                            </label>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleName2">Title2</label>
                                            <input type="text" class="form-control" id="title2"
                                                placeholder="Title2">
                                            <span id="titleMessage2"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleDescription2">Description2</label>
                                            <textarea id="description2" cols="5" rows="2" class="form-control" placeholder="Description2"></textarea>
                                            <span id="descriptionMessage2"></span>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="icon3">Icon3</label>
                                        <div class="custom-file" style="display: none;">
                                            <input type="file" class="custom-file-input" id="icon3"
                                                accept=".png, .jpg, .jpeg, .gif"
                                                onchange="previewImage3(event, 'preview_img_id_3')">
                                            <label class="custom-file-label" for="icon3">Choose file</label>
                                        </div>
                                        <span id="iconPreview3"></span>
                                        <div class="image-preview" style="margin-top: 10px;">
                                            <label for="icon3">
                                                <img id="preview_img_id_3" src="{{ asset('img/noimages.png') }}"
                                                    width="150px" height="150px" class="img-fluid"
                                                    style="object-fit: cover; cursor: pointer;" />
                                            </label>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleName2">Title3</label>
                                            <input type="text" class="form-control" id="title3"
                                                placeholder="Title3">
                                            <span id="titleMessage3"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleDescription2">Description3</label>
                                            <textarea id="description3" cols="5" rows="2" class="form-control" placeholder="Description3"></textarea>
                                            <span id="descriptionMessage3"></span>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="icon4">Icon4</label>
                                        <div class="custom-file" style="display: none;">
                                            <input type="file" class="custom-file-input" id="icon4"
                                                accept=".png, .jpg, .jpeg, .gif"
                                                onchange="previewImage4(event, 'preview_img_id_4')">
                                            <label class="custom-file-label" for="icon4">Choose file</label>
                                        </div>
                                        <span id="iconPreview4"></span>
                                        <div class="image-preview" style="margin-top: 10px;">
                                            <label for="icon4">
                                                <img id="preview_img_id_4" src="{{ asset('img/noimages.png') }}"
                                                    width="150px" height="150px" class="img-fluid"
                                                    style="object-fit: cover; cursor: pointer;" />
                                            </label>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleName2">Title4</label>
                                            <input type="text" class="form-control" id="title4"
                                                placeholder="Title4">
                                            <span id="titleMessage4"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleDescription2">Description4</label>
                                            <textarea id="description4" cols="5" rows="2" class="form-control" placeholder="Description4"></textarea>
                                            <span id="descriptionMessage4"></span>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="icon5">Icon5</label>
                                        <div class="custom-file" style="display: none;">
                                            <input type="file" class="custom-file-input" id="icon5"
                                                accept=".png, .jpg, .jpeg, .gif"
                                                onchange="previewImage5(event, 'preview_img_id_5')">
                                            <label class="custom-file-label" for="icon5">Choose file</label>
                                        </div>
                                        <span id="iconPreview5"></span>
                                        <div class="image-preview" style="margin-top: 10px;">
                                            <label for="icon5">
                                                <img id="preview_img_id_5" src="{{ asset('img/noimages.png') }}"
                                                    width="150px" height="150px" class="img-fluid"
                                                    style="object-fit: cover; cursor: pointer;" />
                                            </label>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleName2">Title5</label>
                                            <input type="text" class="form-control" id="title5"
                                                placeholder="Title5">
                                            <span id="titleMessage5"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleDescription2">Description5</label>
                                            <textarea id="description5" cols="5" rows="2" class="form-control" placeholder="Description5"></textarea>
                                            <span id="descriptionMessage5"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="icon6">Icon6</label>
                                        <div class="custom-file" style="display: none;">
                                            <input type="file" name="icon6" class="custom-file-input"
                                                id="icon6" accept=".png, .jpg, .jpeg, .gif"
                                                onchange="previewImage6(event, 'preview_img_id_6')">
                                            <label class="custom-file-label" for="icon6">Choose file</label>
                                        </div>
                                        <span id="iconPreview6"></span>
                                        <div class="image-preview" style="margin-top: 10px;">
                                            <label for="icon6">
                                                <img id="preview_img_id_6" src="{{ asset('img/noimages.png') }}"
                                                    width="150px" height="150px" class="img-fluid"
                                                    style="object-fit: cover; cursor: pointer;" />
                                            </label>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleName2">Title6</label>
                                            <input type="text" class="form-control" id="title6"
                                                placeholder="Title6">
                                            <span id="titleMessage6"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleDescription2">Description6</label>
                                            <textarea id="description6" cols="5" rows="2" class="form-control" placeholder="Description6"></textarea>
                                            <span id="descriptionMessage6"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div id="Gallery" class="tabcontent">
                <div class="col-md-12">
                    <div class="card card-primary ">
                        <div class="card-header p-2 bg-white">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="icon1">Video</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="videoUpload"
                                                name="videoFile" accept="video/*"
                                                onchange="previewVideo(event, 'preview_video')">
                                            <label class="custom-file-label" for="videoUpload">Choose video file</label>
                                        </div>

                                        <div class="video-preview" style="margin-top: 10px;">
                                            <video id="preview_video" width="300px" height="300px" controls
                                                style="object-fit: cover;">
                                                <source src="#" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                            <p>Video Duration: <span id="videoDuration"></span></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="galleryInput">Gallery image</label>
                                    <div class="custom-file" style="display: none;">
                                        <input type="file" class="custom-file-input" id="galleryInput"
                                            accept=".png, .jpg, .jpeg, .gif"
                                            onchange="galleryImage(event, 'galleryPreview')">
                                        <label class="custom-file-label" for="galleryInput">Choose file</label>
                                    </div>
                                    <span id="galleryImageSpan"></span>
                                    <div class="image-preview" style="margin-top: 10px;">
                                        <label for="galleryInput">
                                            <img id="galleryPreview" src="{{ asset('img/noimages.png') }}"
                                                width="400px" height="400px" class="img-fluid"
                                                style="object-fit: cover; cursor: pointer;" />
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="Product" class="tabcontent">
                <div class="col-md-12">
                    <div class="card card-primary ">
                        <div class="card-header p-2 bg-white">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product1">Product1</label>
                                        <div class="custom-file" style="display: none;">
                                            <input type="file" class="custom-file-input" id="product1"
                                                name="product1" accept=".png, .jpg, .jpeg, .gif"
                                                onchange="productImage1(event, 'product1Preview')">
                                            <label class="custom-file-label" for="product1">Choose file</label>
                                        </div>
                                        <span id="product1"></span>
                                        <div class="image-preview" style="margin-top: 10px;">
                                            <label for="product1">
                                                <img id="product1Preview" src="{{ asset('img/noimages.png') }}"
                                                    width="150px" height="150px" class="img-fluid"
                                                    style="object-fit: cover; cursor: pointer;" />
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleName1">Product Title</label>
                                            <input type="text" class="form-control" id="product_title1"
                                                placeholder="Product title1">
                                            <span id="productTitleMessage1"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleDescription1">Description</label>
                                            <textarea id="productDescription1" cols="5" rows="2" class="form-control"
                                                placeholder="Product Description1"></textarea>
                                            <span id="productdescriptionMessage1"></span>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleDescription1">Price</label>
                                            <input type="number" class="form-control" id="productprice1"
                                                placeholder="Product Price1">
                                            <span id="descriptionMessage1"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product2">Product2</label>
                                        <div class="custom-file" style="display: none;">
                                            <input type="file" class="custom-file-input" id="product2"
                                                accept=".png, .jpg, .jpeg, .gif"
                                                onchange="productImage2(event, 'product2Preview')">
                                            <label class="custom-file-label" for="product2">Choose file</label>
                                        </div>
                                        <span id="product2"></span>
                                        <div class="image-preview" style="margin-top: 10px;">
                                            <label for="product2">
                                                <img id="product2Preview" src="{{ asset('img/noimages.png') }}"
                                                    width="150px" height="150px" class="img-fluid"
                                                    style="object-fit: cover; cursor: pointer;" />
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleName1">Product Title</label>
                                            <input type="text" class="form-control" id="product_title2"
                                                placeholder="Product title2">
                                            <span id="productTitleMessage1"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleDescription1">Description</label>
                                            <textarea id="productDescription2" cols="5" rows="2" class="form-control"
                                                placeholder="Product Description2"></textarea>
                                            <span id="productdescriptionMessage1"></span>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleDescription1">Price</label>
                                            <input type="number" class="form-control" id="productprice2"
                                                placeholder="Product Price2">
                                            <span id="descriptionMessage1"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product3">Product3</label>
                                        <div class="custom-file" style="display: none;">
                                            <input type="file" class="custom-file-input" id="product3"
                                                accept=".png, .jpg, .jpeg, .gif"
                                                onchange="productImage3(event, 'product3Preview')">
                                            <label class="custom-file-label" for="product3">Choose file</label>
                                        </div>
                                        <span id="product3"></span>
                                        <div class="image-preview" style="margin-top: 10px;">
                                            <label for="product3">
                                                <img id="product3Preview" src="{{ asset('img/noimages.png') }}"
                                                    width="150px" height="150px" class="img-fluid"
                                                    style="object-fit: cover; cursor: pointer;" />
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleName1">Product Title</label>
                                            <input type="text" class="form-control" id="product_title3"
                                                placeholder="Product title3">
                                            <span id="productTitleMessage1"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleDescription1">Description</label>
                                            <textarea id="productDescription3" cols="5" rows="2" class="form-control"
                                                placeholder="Product Description3"></textarea>
                                            <span id="productdescriptionMessage1"></span>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleDescription1">Price</label>
                                            <input type="number" class="form-control" id="productprice3"
                                                placeholder="Product Price3">
                                            <span id="descriptionMessage1"></span>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product4">Product4</label>
                                        <div class="custom-file" style="display: none;">
                                            <input type="file" class="custom-file-input" id="product4"
                                                accept=".png, .jpg, .jpeg, .gif"
                                                onchange="productImage4(event, 'product4Preview')">
                                            <label class="custom-file-label" for="product4">Choose file</label>
                                        </div>
                                        <span id="product4"></span>
                                        <div class="image-preview" style="margin-top: 10px;">
                                            <label for="product4">
                                                <img id="product4Preview" src="{{ asset('img/noimages.png') }}"
                                                    width="150px" height="150px" class="img-fluid"
                                                    style="object-fit: cover; cursor: pointer;" />
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleName1">Product Title</label>
                                            <input type="text" class="form-control" id="product_title4"
                                                placeholder="Product title4">
                                            <span id="productTitleMessage1"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleDescription1">Description</label>
                                            <textarea id="productDescription4" cols="5" rows="2" class="form-control"
                                                placeholder="Product Description4"></textarea>
                                            <span id="productdescriptionMessage1"></span>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleDescription1">Price</label>
                                            <input type="number" class="form-control" id="productprice4"
                                                placeholder="Product Price4">
                                            <span id="descriptionMessage1"></span>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product5">Product5</label>
                                        <div class="custom-file" style="display: none;">
                                            <input type="file" class="custom-file-input" id="product5"
                                                accept=".png, .jpg, .jpeg, .gif"
                                                onchange="productImage5(event, 'product5Preview')">
                                            <label class="custom-file-label" for="product5">Choose file</label>
                                        </div>
                                        <span id="product5"></span>
                                        <div class="image-preview" style="margin-top: 10px;">
                                            <label for="product5">
                                                <img id="product5Preview" src="{{ asset('img/noimages.png') }}"
                                                    width="150px" height="150px" class="img-fluid"
                                                    style="object-fit: cover; cursor: pointer;" />
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleName1">Product Title</label>
                                            <input type="text" class="form-control" id="product_title5"
                                                placeholder="Product title5">
                                            <span id="productTitleMessage1"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleDescription1">Description</label>
                                            <textarea id="productDescription5" cols="5" rows="2" class="form-control"
                                                placeholder="Product Description5"></textarea>
                                            <span id="productdescriptionMessage1"></span>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleDescription1">Price</label>
                                            <input type="number" class="form-control" id="productprice5"
                                                placeholder="Product Price5">
                                            <span id="descriptionMessage1"></span>
                                        </div>
                                    </div>
                                </div>



                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product6">Product6</label>
                                        <div class="custom-file" style="display: none;">
                                            <input type="file" class="custom-file-input" id="product6"
                                                accept=".png, .jpg, .jpeg, .gif"
                                                onchange="productImage6(event, 'product6Preview')">
                                            <label class="custom-file-label" for="product6">Choose file</label>
                                        </div>
                                        <span id="product6"></span>
                                        <div class="image-preview" style="margin-top: 10px;">
                                            <label for="product6">
                                                <img id="product6Preview" src="{{ asset('img/noimages.png') }}"
                                                    width="150px" height="150px" class="img-fluid"
                                                    style="object-fit: cover; cursor: pointer;" />
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleName1">Product Title</label>
                                            <input type="text" class="form-control" id="product_title6"
                                                placeholder="Product title6">
                                            <span id="productTitleMessage1"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleDescription1">Description</label>
                                            <textarea id="productDescription6" cols="5" rows="2" class="form-control"
                                                placeholder="Product Description6"></textarea>
                                            <span id="productdescriptionMessage1"></span>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleDescription1">Price</label>
                                            <input type="number" class="form-control" id="productprice6"
                                                placeholder="Product Price6">
                                            <span id="descriptionMessage1"></span>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="Testimonial" class="tabcontent">
                <div class="col-md-12">
                    <div class="card card-primary ">
                        <div class="card-header p-2 bg-white">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="testmonial1">Testimonial 1</label>
                                        <div class="custom-file" style="display: none;">
                                            <input type="file" class="custom-file-input" id="testmonial1"
                                                name="testmonial1" accept=".png, .jpg, .jpeg, .gif"
                                                onchange="testmonialImage1(event, 'testmonial1Preview')">
                                            <label class="custom-file-label" for="testmonial1">Choose file</label>
                                        </div>
                                        <span id="testmonial1"></span>
                                        <div class="image-preview" style="margin-top: 10px;">
                                            <label for="testmonial1">
                                                <img id="testmonial1Preview" src="{{ asset('img/noimages.png') }}"
                                                    width="150px" height="150px" class="img-fluid"
                                                    style="object-fit: cover; cursor: pointer;" />
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleName1">title</label>
                                            <input type="text" class="form-control" id="testimonial_title1"
                                                placeholder="Testmonial title1">
                                            <span id="testimonialMessage1"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleDescription1">Description</label>
                                            <textarea id="testimonialDescription1" cols="5" rows="2" class="form-control"
                                                placeholder="Testimonial Description1"></textarea>
                                            <span id="productdescriptionMessage1"></span>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleDescription1">Sub title</label>
                                            <input type="text" class="form-control" id="subtitle1"
                                                placeholder="Sub title1">
                                            <span id="descriptionMessage1"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="testimonial2">Testimonial 2</label>
                                        <div class="custom-file" style="display: none;">
                                            <input type="file" class="custom-file-input" id="testimonial2"
                                                name="testimonial2" accept=".png, .jpg, .jpeg, .gif"
                                                onchange="testimonialImage2(event, 'testimonial2Preview')">
                                            <label class="custom-file-label" for="testimonial2">Choose file</label>
                                        </div>
                                        <span id="testimonial2"></span>
                                        <div class="image-preview" style="margin-top: 10px;">
                                            <label for="testimonial2">
                                                <img id="testimonial2Preview" src="{{ asset('img/noimages.png') }}"
                                                    width="150px" height="150px" class="img-fluid"
                                                    style="object-fit: cover; cursor: pointer;" />
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleName1">Title</label>
                                            <input type="text" class="form-control" id="testimonial_title2"
                                                placeholder="testimonial title2">
                                            <span id="productTitleMessage1"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleDescription1">Description</label>
                                            <textarea id="testimonialDescription2" cols="5" rows="2" class="form-control"
                                                placeholder="Testimonial Description2"></textarea>
                                            <span id="productdescriptionMessage1"></span>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleDescription1">Sub title</label>
                                            <input type="text" class="form-control" id="subtitle2"
                                                placeholder="Sub title2">
                                            <span id="descriptionMessage1"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="BusinessHours" class="tabcontent">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header p-2 bg-white">
                            <div class="form-group card p-2">
                                <div class="custom-file">
                                    <label class="days" for="">Monday</label>
                                    <label>Start</label>
                                    <input type="time" id="mondaystart" min="00:00" max="18:00">
                                    <label>End</label>
                                    <input type="time" id="mondayend" min="00:00" max="18:00">
                                </div>
                            </div>
                            <div class="form-group card p-2">
                                <div class="custom-file">
                                    <label class="days" for="">Wednesday</label>
                                    <label>Start</label>
                                    <input type="time" id="wednesdaystart" min="00:00" max="18:00">
                                    <label>End</label>
                                    <input type="time" id="wednesdayend" min="00:00" max="18:00">
                                </div>
                            </div>
                            <div class="form-group card p-2">
                                <div class="custom-file">
                                    <label class="days" for="">Tuesday</label>
                                    <label>Start</label>
                                    <input type="time" id="tuesdaystart" min="00:00" max="18:00">
                                    <label>End</label>
                                    <input type="time" id="tuesdayend" min="00:00" max="18:00">
                                </div>
                            </div>

                            <div class="form-group card p-2">
                                <div class="custom-file">
                                    <label class="days" for="">Thursday</label>
                                    <label>Start</label>
                                    <input type="time" id="thursdaystart" min="00:00" max="18:00">
                                    <label>End</label>
                                    <input type="time" id="thursdayend" min="00:00" max="18:00">
                                </div>
                            </div>
                            <div class="form-group card p-2">
                                <div class="custom-file">
                                    <label class="days" for="">Friday</label>
                                    <label>Start</label>
                                    <input type="time" id="fridaystart" min="00:00" max="18:00">
                                    <label>End</label>
                                    <input type="time" id="fridayend" min="00:00" max="18:00">
                                </div>
                            </div>
                            <div class="form-group card p-2">
                                <div class="custom-file">
                                    <label class="days" for="">Saturday</label>
                                    <label>Start</label>
                                    <input type="time" id="saturdaystart" min="00:00" max="18:00">
                                    <label>End</label>
                                    <input type="time" id="saturdayend" min="00:00" max="18:00">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>



        </form>
    </div>
    </div>
    </div>
    </div>
    </div>

    </div>
    </div>


    {{-- add form data  --}}
    <script>
        document.getElementById('adduser').addEventListener('submit', function(event) {
            event.preventDefault();
            let vcardpictureInput = document.getElementById('vcardpicture').files[0];


            let exampleName = document.getElementById('exampleName').value;
            let namemessage = document.getElementById('namemessage');

            if (exampleName === '') {
                namemessage.innerHTML = "<span style='color:red'>Enter name</span>";
                setTimeout(() => {
                    namemessage.innerHTML = "";
                }, 3000);
                return
            }

            let exampleemail = document.getElementById('exampleemail').value;
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

            let passwordInput = document.getElementById('passwordInput').value;
            let passwordmessage = document.getElementById('passwordmessage');
            if (passwordInput === '') {
                passwordmessage.innerHTML = "<span style='color:red'>Enter Password</span>";
                setTimeout(() => {
                    passwordmessage.innerHTML = "";
                }, 3000);
                return
            }

            let confirmPasswordInput = document.getElementById('confirmPasswordInput').value;
            let confirmpasswordmessage = document.getElementById('confirmpasswordmessage');
            if (confirmPasswordInput === '') {
                confirmpasswordmessage.innerHTML = "<span style='color:red'>Enter Confirm Password</span>";
                setTimeout(() => {
                    confirmpasswordmessage.innerHTML = "";
                }, 3000);
                return
            } else if (passwordInput !== confirmPasswordInput) {
                confirmpasswordmessage.innerHTML = "<span style='color:red'>Password does not match</span>";
                setTimeout(() => {
                    confirmpasswordmessage.innerHTML = "";
                }, 3000);
                return
            }


            let role_name = document.getElementById('role_name').value;

            let rolenamemessage = document.getElementById('rolenamemessage');

            if (role_name === '--Select Role--') {
                rolenamemessage.innerHTML = "<span style='color:red'>Select Role</span>";
                setTimeout(() => {
                    rolenamemessage.innerHTML = "";
                }, 3000);
                return
            }

            let icon1 = document.getElementById('icon1').files[0];
            let icon2 = document.getElementById('icon2').files[0];
            let icon3 = document.getElementById('icon3').files[0];
            let icon4 = document.getElementById('icon4').files[0];
            let icon5 = document.getElementById('icon5').files[0];
            let icon6 = document.getElementById('icon6').files[0];

            let galleryInput = document.getElementById('galleryInput').files[0];
            let videoUpload = document.getElementById('videoUpload').files[0];


            let productimage1 = document.getElementById('product1').files[0];
            let product_title1 = document.getElementById('product_title1').value;
            let productDescription1 = document.getElementById('productDescription1').value;
            let productprice1 = document.getElementById('productprice1').value;


            let productimage2 = document.getElementById('product2').files[0];
            let product_title2 = document.getElementById('product_title2').value;
            let productDescription2 = document.getElementById('productDescription2').value;
            let productprice2 = document.getElementById('productprice2').value;

            let productimage3 = document.getElementById('product3').files[0];
            let product_title3 = document.getElementById('product_title3').value;
            let productDescription3 = document.getElementById('productDescription3').value;
            let productprice3 = document.getElementById('productprice3').value;


            let productimage4 = document.getElementById('product4').files[0];
            let product_title4 = document.getElementById('product_title4').value;
            let productDescription4 = document.getElementById('productDescription4').value;
            let productprice4 = document.getElementById('productprice4').value;


            let productimage5 = document.getElementById('product5').files[0];
            let product_title5 = document.getElementById('product_title5').value;
            let productDescription5 = document.getElementById('productDescription5').value;
            let productprice5 = document.getElementById('productprice5').value;


            let productimage6 = document.getElementById('product6').files[0];
            let product_title6 = document.getElementById('product_title6').value;
            let productDescription6 = document.getElementById('productDescription6').value;
            let productprice6 = document.getElementById('productprice6').value;

            let testmonial1 = document.getElementById('testmonial1').files[0];
            let testimonial_title1 = document.getElementById('testimonial_title1').value;
            let testimonialDescription1 = document.getElementById('testimonialDescription1').value;
            let subtitle1 = document.getElementById('subtitle1').value;

            let testmonial2 = document.getElementById('testimonial2').files[0];
            let testimonial_title2 = document.getElementById('testimonial_title2').value;
            let testimonialDescription2 = document.getElementById('testimonialDescription2').value;
            let subtitle2 = document.getElementById('subtitle2').value;

            // console.log(productprice5);
            // console.log(videoUpload);
            //return

            let title1 = document.getElementById('title1').value;
            let description1 = document.getElementById('description1').value;


            let title2 = document.getElementById('title2').value;
            let description2 = document.getElementById('description2').value;


            let title3 = document.getElementById('title3').value;
            let description3 = document.getElementById('description3').value;

            let title4 = document.getElementById('title4').value;
            let description4 = document.getElementById('description4').value;

            let title5 = document.getElementById('title5').value;
            let description5 = document.getElementById('description5').value;

            let title6 = document.getElementById('title6').value;
            let description6 = document.getElementById('description6').value;


            let mondaystart = document.getElementById('mondaystart').value;
            let mondayend = document.getElementById('mondayend').value;
            let tuesdaystart = document.getElementById('tuesdaystart').value;
            let tuesdayend = document.getElementById('tuesdayend').value;
            let wednesdaystart = document.getElementById('wednesdaystart').value;
            let wednesdayend = document.getElementById('wednesdayend').value;
            let thursdaystart = document.getElementById('thursdaystart').value;
            let thursdayend = document.getElementById('thursdayend').value;
            let fridaystart = document.getElementById('fridaystart').value;
            let fridayend = document.getElementById('fridayend').value;
            let saturdaystart = document.getElementById('saturdaystart').value;
            let saturdayend = document.getElementById('saturdayend').value;


            let formData = new FormData();
            formData.append('profile_pic', vcardpictureInput);
            formData.append('name', exampleName);
            formData.append('email', exampleemail);
            formData.append('designation', exampledesignation);
            formData.append('DOB', exampleDOB);
            formData.append('phone_number', examplephonenumber);
            formData.append('location', examplelocation);
            formData.append('password', passwordInput);
            formData.append('confirm_password', confirmPasswordInput);
            formData.append('role_id', role_name);

            formData.append('icon1', icon1);
            formData.append('title1', title1);
            formData.append('description1', description1);

            formData.append('icon2', icon2);
            formData.append('title2', title2);
            formData.append('description2', description2);

            formData.append('icon3', icon3);
            formData.append('title3', title3);
            formData.append('description3', description3);

            formData.append('icon4', icon4);
            formData.append('title4', title4);
            formData.append('description4', description4);

            formData.append('icon5', icon5);
            formData.append('title5', title5);
            formData.append('description5', description5);

            formData.append('icon6', icon6);
            formData.append('title6', title6);
            formData.append('description6', description6);

            formData.append('galleryImage', galleryInput);
            formData.append('videoUpload', videoUpload);

            formData.append('productimage1', productimage1);
            formData.append('producttitle1', product_title1);
            formData.append('productdescription1', productDescription1);
            formData.append('productprice1', productprice1);

            formData.append('productimage2', productimage2);
            formData.append('producttitle2', product_title2);
            formData.append('productdescription2', productDescription2);
            formData.append('productprice2', productprice2);

            formData.append('productimage3', productimage3);
            formData.append('producttitle3', product_title3);
            formData.append('productdescription3', productDescription3);
            formData.append('productprice3', productprice3);

            formData.append('productimage4', productimage4);
            formData.append('producttitle4', product_title4);
            formData.append('productdescription4', productDescription4);
            formData.append('productprice4', productprice4);

            formData.append('productimage5', productimage5);
            formData.append('producttitle5', product_title5);
            formData.append('productdescription5', productDescription5);
            formData.append('productprice5', productprice5);

            formData.append('productimage6', productimage6);
            formData.append('producttitle6', product_title6);
            formData.append('productdescription6', productDescription6);
            formData.append('productprice6', productprice6);

            formData.append('testmonial1', testmonial1);
            formData.append('testimonial_title1', testimonial_title1);
            formData.append('testimonialDescription1', testimonialDescription1);
            formData.append('subtitle1', subtitle1);

            formData.append('testimonial2', testmonial2);
            formData.append('testimonial_title2', testimonial_title2);
            formData.append('testimonialDescription2', testimonialDescription2);
            formData.append('subtitle2', subtitle2);

            formData.append('mondaystart', mondaystart);
            formData.append('mondayend', mondayend);
            formData.append('tuesdaystart', tuesdaystart);
            formData.append('tuesdayend', tuesdayend);

            formData.append('wednesdaystart', wednesdaystart);
            formData.append('wednesdayend', wednesdayend);
            formData.append('thursdaystart', thursdaystart);
            formData.append('thursdayend', thursdayend);

            formData.append('fridaystart', fridaystart);
            formData.append('fridayend', fridayend);
            formData.append('saturdaystart', saturdaystart);
            formData.append('saturdayend', saturdayend);


            fetch('{{ route('AddFormUsers.post') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 200) {
                        // console.log(data);
                        // return
                        document.getElementById('validationmessage').innerHTML = `
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong id="validationmessage">` + data.message + `</strong>
                            </div>`;
                        setTimeout(() => {
                            document.getElementById('validationmessage').innerHTML = "";
                        }, 3000);
                    } else if (data.status === 404) {
                        document.getElementById('validationmessage404').innerHTML = `
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong id="validationmessage404">` + data.message + `</strong>
                            </div> `;
                        setTimeout(() => {
                            document.getElementById('validationmessage404').innerHTML = "";
                        }, 3000);
                    } else {
                        document.getElementById('validationmessage500').innerHTML = `
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong id="validationmessage500">` + data.message + `</strong>
                            </div>`;
                        setTimeout(() => {
                            document.getElementById('validationmessage500').innerHTML = "";
                        }, 3000);
                    }
                })
                .catch(error => {
                    console.error('line:', error);
                });
        });

        document.getElementById('role_name').addEventListener('onchange', function() {
            document.getElementById('rolenamemessage').innerHTML = "";
        });


        document.getElementById('exampleName').addEventListener('input', function() {
            let namemessage = document.getElementById('namemessage');
            namemessage.innerHTML = "";
        });

        document.getElementById('exampleemail').addEventListener('input', function() {
            let emailmessage = document.getElementById('emailmessage');
            emailmessage.innerHTML = "";
        });

        document.getElementById('passwordInput').addEventListener('input', function() {
            let passwordmessage = document.getElementById('passwordmessage');
            passwordmessage.innerHTML = "";
        });

        document.getElementById('confirmPasswordInput').addEventListener('input', function() {
            let confirmpasswordmessage = document.getElementById('confirmpasswordmessage');
            confirmpasswordmessage.innerHTML = "";
        });


        document.getElementById('exampledesignation').addEventListener('input', function() {
            let namemessage = document.getElementById('designationmessage');
            namemessage.innerHTML = "";
        });

        document.getElementById('exampleDOB').addEventListener('input', function() {
            let emailmessage = document.getElementById('DOBmessage');
            emailmessage.innerHTML = "";
        });

        document.getElementById('examplephonenumber').addEventListener('input', function() {
            let passwordmessage = document.getElementById('phonemessage');
            passwordmessage.innerHTML = "";
        });

        document.getElementById('examplelocation').addEventListener('input', function() {
            let confirmpasswordmessage = document.getElementById('locationmessage');
            confirmpasswordmessage.innerHTML = "";
        });

        document.getElementById('vcardpicture').addEventListener('input', function(e) {
            document.getElementById('vcardpicturemessage').innerHTML = "";
        });

        function role_select() {
            let role_name = document.getElementById('role_name').value;
            if (role_name) {
                let rolenamemessage = document.getElementById('rolenamemessage').innerHTML = "";
            }
        }


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
    </script>


    {{-- passowrd and confirm password eye hide and visible --}}
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const passwordInput = document.querySelector('#passwordInput');
        const toggleIcon = document.querySelector('#toggleIcon');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            toggleIcon.classList.toggle('bi-eye');
            toggleIcon.classList.toggle('bi-eye-slash');
        });

        const toggleConfirmPassword = document.querySelector('#toggleConfirmPassword');
        const confirmPasswordInput = document.querySelector('#confirmPasswordInput');
        const toggleConfirmIcon = document.querySelector('#toggleConfirmIcon');

        toggleConfirmPassword.addEventListener('click', function() {
            const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPasswordInput.setAttribute('type', type);
            toggleConfirmIcon.classList.toggle('bi-eye');
            toggleConfirmIcon.classList.toggle('bi-eye-slash');
        });
    </script>

    {{-- local storage save which tab is clicked  --}}
    <script>
        function openPage(pageName, elmnt, color) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablink");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].classList.remove('active'); // Remove 'active' class from all buttons
                tablinks[i].style.backgroundColor = ""; // Clear background color for all buttons
            }
            document.getElementById(pageName).style.display = "block";
            elmnt.style.backgroundColor = color;
            elmnt.classList.add('active'); // Add 'active' class to the clicked button

            // Store the active tab in localStorage
            localStorage.setItem('activeTab', pageName);
        }

        document.addEventListener('DOMContentLoaded', function() {
            var activeTab = localStorage.getItem('activeTab');
            if (activeTab) {
                var activeButton = document.querySelector(`[onclick="openPage('${activeTab}', this, '#a2fda8')"]`);
                if (activeButton) {
                    openPage(activeTab, activeButton, '#a2fda8');
                }
            } else {
                // Set default tab (Profile) and button as active
                var defaultTab = document.getElementById('Profile');
                var defaultButton = document.getElementById('defaultOpen');
                openPage('Profile', defaultButton, '#a2fda8');
            }
        });
    </script>


    {{-- all image preview  --}}

    <script>
        function previewImage1(event, previewId) {
            const fileInput = event.target;
            const file = fileInput.files[0];
            console.log(file);
            const preview = document.getElementById(previewId);
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        }

        function previewImage2(event, previewId) {
            const fileInput = event.target;
            const file = fileInput.files[0];
            console.log(file);
            const preview = document.getElementById(previewId);
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        }


        function previewImage3(event, previewId) {
            const fileInput = event.target;
            const file = fileInput.files[0];
            console.log(file);
            const preview = document.getElementById(previewId);
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        }

        function previewImage4(event, previewId) {
            const fileInput = event.target;
            const file = fileInput.files[0];
            console.log(file);
            const preview = document.getElementById(previewId);
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        }

        function previewImage5(event, previewId) {
            const fileInput = event.target;
            const file = fileInput.files[0];
            console.log(file);
            const preview = document.getElementById(previewId);
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        }

        function previewImage6(event, previewId) {
            const fileInput = event.target;
            const file = fileInput.files[0];
            console.log(file);
            const preview = document.getElementById(previewId);
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        }

        function galleryImage(event, previewId) {

            console.log('galleryImage function called');
            const fileInput = event.target;
            const file = fileInput.files[0];
            console.log(file);
            const preview = document.getElementById(previewId);
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        }


        function productImage1(event, previewId) {

            console.log('galleryImage function called');
            const fileInput = event.target;
            const file = fileInput.files[0];
            console.log(file);
            const preview = document.getElementById(previewId);
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        }

        function productImage2(event, previewId) {

            console.log('galleryImage function called');
            const fileInput = event.target;
            const file = fileInput.files[0];
            console.log(file);
            const preview = document.getElementById(previewId);
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        }

        function productImage3(event, previewId) {

            console.log('galleryImage function called');
            const fileInput = event.target;
            const file = fileInput.files[0];
            console.log(file);
            const preview = document.getElementById(previewId);
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        }

        function productImage4(event, previewId) {

            console.log('galleryImage function called');
            const fileInput = event.target;
            const file = fileInput.files[0];
            console.log(file);
            const preview = document.getElementById(previewId);
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        }

        function productImage5(event, previewId) {

            console.log('galleryImage function called');
            const fileInput = event.target;
            const file = fileInput.files[0];
            console.log(file);
            const preview = document.getElementById(previewId);
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        }

        function productImage6(event, previewId) {

            console.log('galleryImage function called');
            const fileInput = event.target;
            const file = fileInput.files[0];
            console.log(file);
            const preview = document.getElementById(previewId);
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        }

        function testmonialImage1(event, previewId) {

            console.log('galleryImage function called');
            const fileInput = event.target;
            const file = fileInput.files[0];
            console.log(file);
            const preview = document.getElementById(previewId);
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        }

        function testimonialImage2(event, previewId) {

            console.log('galleryImage function called');
            const fileInput = event.target;
            const file = fileInput.files[0];
            console.log(file);
            const preview = document.getElementById(previewId);
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>



    <script>
        function previewVideo(event, previewId) {
            const videoFile = event.target.files[0];
            const videoElement = document.getElementById(previewId);
            const videoDurationDisplay = document.getElementById('videoDuration');

            const reader = new FileReader();
            reader.onload = function() {
                videoElement.src = reader.result;

                videoElement.onloadedmetadata = function() {
                    // Retrieve video duration and display it
                    const duration = videoElement.duration;
                    const formattedDuration = formatVideoDuration(duration);
                    videoDurationDisplay.textContent = formattedDuration;
                };
            };
            reader.readAsDataURL(videoFile);
        }

        function formatVideoDuration(seconds) {
            const minutes = Math.floor(seconds / 60);
            const remainingSeconds = Math.floor(seconds % 60);
            return `${minutes}:${remainingSeconds < 10 ? '0' : ''}${remainingSeconds}`;
        }
    </script>
@endsection
