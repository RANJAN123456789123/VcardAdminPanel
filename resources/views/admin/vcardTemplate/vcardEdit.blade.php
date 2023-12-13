{{-- {{  dd(Session::get('userId')) }} --}}
{{-- {{dd($userfdata->testimonial2)}} --}}
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Emma</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
    #LoginMesage {
        color: red;
    }

    #passwordMessage {
        color: red;
    }

    #messageEmail {
        color: red;
    }

    .dark {
        /* background-color: #ffe35d;
        background-image: linear-gradient(180deg, #f62b2bbf 10%, #dcdc0f 100%); */
        background: rgb(30, 6, 152);
        background: linear-gradient(180deg, rgba(30, 6, 152, 1) 0%, rgba(255, 0, 159, 1) 100%);
        background-size: cover;
    }

    .btn-primary {
        color: #f3f3f3;
        background-color: #000000;
        border-color: #000000;
    }

    .select2 {
        width: 100% !important;
    }

    #namemessage,
    #messageEmail,
    #companynamemessage,
    #plainmessage,
    #refercmpmessage,
    #thememessage,
    #passwordMessage,
    #confirmpasswordMessage {
        color: red;
    }

    #validationmessage404,
    #validationmessage500 {
        color: red;
    }

    #validationmessage {
        color: rgb(0, 112, 0)
    }

    #RegisterMesage {
        color: rgb(0, 112, 0);
    }
</style>

<body class="dark">
    <div class="wrapper">
        <section class="login-content">
            <div class="container h-100">
                <div class="row align-items-center justify-content-center h-100">
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-body">

                                <h2 class="mb-2 text-center">Edit</h2>

                                <div id="RegisterMesage"></div>
                                <h6 id="validationmessage"></h6>
                                <h6 id="validationmessage404"></h6>
                                <h6 id="validationmessage500"></h6>

                                <form id="edituser" enctype="multipart/form-data">
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
                                                                <label for="vcardpicture">PICTURE </label>
                                                                <div style="display: none;">
                                                                    <input type="file" name="profile_pic"
                                                                        class="custom-file-input" id="vcardpicture"
                                                                        accept=".png, .jpg, .jpeg, .gif .webp">
                                                                    <label class="custom-file-label"
                                                                        for="vcardpicture">Choose file</label>
                                                                </div>
                                                                <span id="vcardpicturemessage"></span>
                                                                @php
                                                                    $profilePic = $userfdata->profile_pic ? asset('admin/uploads/users/' . $userfdata->profile_pic) : asset('img/No_image_available.svg');
                                                                @endphp
                                                                <div class="image-preview" style="margin-top: 10px;">
                                                                    <label for="vcardpicture">
                                                                        <img id="preview_img_id"
                                                                            src="{{ $profilePic }}" width="150px"
                                                                            height="150px" class="img-fluid"
                                                                            style="object-fit: cover; cursor: pointer;" />
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="exampleName"> SELECT TEMPLATE </label>
                                                                <select id="vcard_id"
                                                                    class="form-control js-example-basic-single">
                                                                    <option>--Select--</option>
                                                                    @foreach ($getallcards as $getvalue)
                                                                        <option value="{{ $getvalue->id }}"
                                                                            @if ($gettempelate->vcard_id == $getvalue->id) selected style="background-color: #0069d9; color: #fff;" @endif>
                                                                            {{ $getvalue->template_name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="exampleName"> NAME </label>
                                                                <input type="text" placeholder="Enter name"
                                                                    class="form-control" id="exampleName"
                                                                    value="{{ $userfdata->name }}">
                                                                <span id="namemessage"></span>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="exampleemail">EMAIL</label>
                                                                <input type="email" placeholder="Enter email"
                                                                    class="form-control" id="exampleemail"
                                                                    value="{{ $userfdata->email }}">
                                                                <span id="emailmessage"></span>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="designation">DESIGNATION</label>
                                                                <input type="text" placeholder="Enter designation"
                                                                    class="form-control" id="exampledesignation"
                                                                    value="{{ $userfdata->designation }}">
                                                                <span id="designationmessage"></span>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="DOB">DOB</label>
                                                                <input type="date" placeholder="DOB"
                                                                    class="form-control" id="exampleDOB"
                                                                    value="{{ $userfdata->DOB }}">
                                                                <span id="DOBmessage"></span>
                                                            </div>
                                                        </div>


                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="exampleemail">PHONE NUMBER</label>
                                                                <input type="number" placeholder="Phone Number"
                                                                    class="form-control" id="examplephonenumber"
                                                                    value="{{ $userfdata->phone_number }}">
                                                                <span id="phonemessage"></span>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="exampleemail">COMPANY NAME</label>
                                                                <input type="text" placeholder="Company Name"
                                                                    class="form-control" id="companyname"
                                                                    value="{{ $userfdata->company_name }}">
                                                                <span id="phonemessage"></span>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="exampleemail">ADDRESS</label>
                                                                <input type="text" placeholder="Address"
                                                                    class="form-control" id="examplelocation"
                                                                    value="{{ $userfdata->location }}">
                                                                <span id="locationmessage"></span>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="exampleemail">WEBSITE LINK</label>
                                                                <input type="text" placeholder="Website"
                                                                    class="form-control" id="websiteurl"
                                                                    value="{{ isset($userfdata->websiteURL) ? $userfdata->websiteURL : 'NA' }}">
                                                                <span id="locationmessage"></span>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="exampleemail">INSTAGRAM LINK</label>
                                                                <input type="text" placeholder="Instagram"
                                                                    class="form-control" id="instagramurl"
                                                                    value="{{ isset($userfdata->instagramURL) ? $userfdata->instagramURL : 'NA' }}">
                                                                <span id="locationmessage"></span>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="exampleemail">YOUTUBE LINK</label>
                                                                <input type="text" placeholder="Youtube"
                                                                    class="form-control" id="youtubeurl"
                                                                    value="{{ isset($userfdata->youtubeURL) ? $userfdata->youtubeURL : 'NA' }}">
                                                                <span id="locationmessage"></span>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="exampleemail">LINKEDIN LINK</label>
                                                                <input type="text" placeholder="Linkedin"
                                                                    class="form-control" id="linkedinurl"
                                                                    value="{{ isset($userfdata->linkedinURL) ? $userfdata->linkedinURL : 'NA' }}">
                                                                <span id="locationmessage"></span>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="exampleemail">WHATSAPP LINK</label>
                                                                <input type="text" placeholder="Whatsapp"
                                                                    class="form-control" id="whatsappurl"
                                                                    value="{{ isset($userfdata->whatsappURL) ? $userfdata->whatsappURL : 'NA' }}">
                                                                <span id="locationmessage"></span>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="exampleemail">GST NUMBER</label>
                                                                <input type="text" placeholder="GST number"
                                                                    class="form-control" id="gstnumber"
                                                                    value="{{ isset($userfdata->gstNumber) ? $userfdata->gstNumber : '09AAACH7409R1ZZ' }}">
                                                                <span id="locationmessage"></span>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="exampleemail">BANK</label>
                                                                <input type="text" placeholder="Bank name"
                                                                    class="form-control" id="bankname"
                                                                    value="{{ isset($userfdata->bankname) ? $userfdata->bankname : 'Kotak mahindra' }}">
                                                                <span id="locationmessage"></span>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="exampleemail">ACCOUNT</label>
                                                                <input type="text" placeholder="Account number"
                                                                    class="form-control" id="accountnumber"
                                                                    value="{{ isset($userfdata->accountnumber) ? $userfdata->accountnumber : '000000004545' }}">
                                                                <span id="locationmessage"></span>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="exampleemail">BRANCH</label>
                                                                <input type="text" placeholder="Branch name"
                                                                    class="form-control" id="branch"
                                                                    value="{{ isset($userfdata->branch) ? $userfdata->branch : 'Fort Mumbai' }}">
                                                                <span id="locationmessage"></span>
                                                            </div>
                                                        </div>


                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="exampleemail">IFSC</label>
                                                                <input type="text" placeholder="IFSC code"
                                                                    class="form-control" id="ifscode"
                                                                    value="{{ isset($userfdata->ifsccode) ? $userfdata->ifsccode : 'KKBK0245' }}">
                                                                <span id="locationmessage"></span>
                                                            </div>
                                                        </div>

                                                        <br>
                                                        {{-- services --}}
                                                        {{-- 1 --}}
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="icon1">SERVICES</label>
                                                                <div style="display: none;">
                                                                    <input type="file" name="icon1"
                                                                        class="custom-file-input" id="icon1"
                                                                        accept=".png, .jpg, .jpeg, .gif .webp">
                                                                    <label class="custom-file-label"
                                                                        for="icon1">Choose file</label>
                                                                </div>
                                                                <span id="icon1message"></span>
                                                                @php
                                                                    $icon1 = $userfdata->icon1 ? asset('our_services/' . $userfdata->icon1) : asset('img/No_image_available.svg');
                                                                @endphp
                                                                <div class="image-preview" style="margin-top: 10px;">
                                                                    <label for="icon1">
                                                                        <img id="icon1_preview"
                                                                            src="{{ $icon1 }}" width="100px"
                                                                            height="100px" class="img-fluid"
                                                                            style="object-fit: cover; cursor: pointer;" />
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input type="text" placeholder="Title1"
                                                                    class="form-control" id="title1"
                                                                    value="{{ isset($userfdata->title1) ? $userfdata->title1 : 'Your title' }}">
                                                                <span id="locationmessage"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input type="text" placeholder="Description1"
                                                                    class="form-control" id="description1"
                                                                    value="{{ isset($userfdata->description1) ? $userfdata->description1 : 'Your description' }}">
                                                                <span id="locationmessage"></span>
                                                            </div>
                                                        </div>


                                                        {{-- 2 --}}
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <div style="display: none;">
                                                                    <input type="file" name="icon2"
                                                                        class="custom-file-input" id="icon2"
                                                                        accept=".png, .jpg, .jpeg, .gif .webp">
                                                                    <label class="custom-file-label"
                                                                        for="icon2">Choose file</label>
                                                                </div>
                                                                <span id="icon2message"></span>
                                                                @php
                                                                    $icon2 = $userfdata->icon2 ? asset('our_services/' . $userfdata->icon2) : asset('img/No_image_available.svg');
                                                                @endphp
                                                                <div class="image-preview" style="margin-top: 10px;">
                                                                    <label for="icon2">
                                                                        <img id="icon2_preview"
                                                                            src="{{ $icon2 }}" width="100px"
                                                                            height="100px" class="img-fluid"
                                                                            style="object-fit: cover; cursor: pointer;" />
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input type="text" placeholder="Title2"
                                                                    class="form-control" id="title2"
                                                                    value="{{ isset($userfdata->title2) ? $userfdata->title2 : 'Your title' }}">
                                                                <span id="locationmessage"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input type="text" placeholder="Description2"
                                                                    class="form-control" id="description2"
                                                                    value="{{ isset($userfdata->description2) ? $userfdata->description2 : 'Your description' }}">
                                                                <span id="locationmessage"></span>
                                                            </div>
                                                        </div>



                                                        {{-- 3 --}}
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <div style="display: none;">
                                                                    <input type="file" name="icon3"
                                                                        class="custom-file-input" id="icon3"
                                                                        accept=".png, .jpg, .jpeg, .gif .webp">
                                                                    <label class="custom-file-label"
                                                                        for="icon3">Choose file</label>
                                                                </div>
                                                                <span id="icon3message"></span>
                                                                @php
                                                                    $icon3 = $userfdata->icon3 ? asset('our_services/' . $userfdata->icon3) : asset('img/No_image_available.svg');
                                                                @endphp
                                                                <div class="image-preview" style="margin-top: 10px;">
                                                                    <label for="icon3">
                                                                        <img id="icon3_preview"
                                                                            src="{{ $icon3 }}" width="100px"
                                                                            height="100px" class="img-fluid"
                                                                            style="object-fit: cover; cursor: pointer;" />
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input type="text" placeholder="Title3"
                                                                    class="form-control" id="title3"
                                                                    value="{{ isset($userfdata->title3) ? $userfdata->title3 : 'Your title' }}">
                                                                <span id="locationmessage"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input type="text" placeholder="Description3"
                                                                    class="form-control" id="description3"
                                                                    value="{{ isset($userfdata->description3) ? $userfdata->description3 : 'Your description' }}">
                                                                <span id="locationmessage"></span>
                                                            </div>
                                                        </div>

                                                        {{-- 4 --}}
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <div style="display: none;">
                                                                    <input type="file" name="icon4"
                                                                        class="custom-file-input" id="icon4"
                                                                        accept=".png, .jpg, .jpeg, .gif .webp">
                                                                    <label class="custom-file-label"
                                                                        for="icon4">Choose file</label>
                                                                </div>
                                                                <span id="icon4message"></span>
                                                                @php
                                                                    $icon4 = $userfdata->icon4 ? asset('our_services/' . $userfdata->icon4) : asset('img/No_image_available.svg');
                                                                @endphp
                                                                <div class="image-preview" style="margin-top: 10px;">
                                                                    <label for="icon4">
                                                                        <img id="icon4_preview"
                                                                            src="{{ $icon4 }}" width="100px"
                                                                            height="100px" class="img-fluid"
                                                                            style="object-fit: cover; cursor: pointer;" />
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input type="text" placeholder="Title4"
                                                                    class="form-control" id="title4"
                                                                    value="{{ isset($userfdata->title4) ? $userfdata->title4 : 'Your title' }}">
                                                                <span id="locationmessage"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input type="text" placeholder="Description4"
                                                                    class="form-control" id="description4"
                                                                    value="{{ isset($userfdata->description4) ? $userfdata->description4 : 'Your description' }}">
                                                                <span id="locationmessage"></span>
                                                            </div>
                                                        </div>


                                                        {{-- 5 --}}
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <div style="display: none;">
                                                                    <input type="file" name="icon5"
                                                                        class="custom-file-input" id="icon5"
                                                                        accept=".png, .jpg, .jpeg, .gif .webp">
                                                                    <label class="custom-file-label"
                                                                        for="icon5">Choose file</label>
                                                                </div>
                                                                <span id="icon5message"></span>
                                                                @php
                                                                    $icon5 = $userfdata->icon5 ? asset('our_services/' . $userfdata->icon5) : asset('img/No_image_available.svg');
                                                                @endphp
                                                                <div class="image-preview" style="margin-top: 10px;">
                                                                    <label for="icon5">
                                                                        <img id="icon5_preview"
                                                                            src="{{ $icon5 }}" width="100px"
                                                                            height="100px" class="img-fluid"
                                                                            style="object-fit: cover; cursor: pointer;" />
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input type="text" placeholder="Title5"
                                                                    class="form-control" id="title5"
                                                                    value="{{ isset($userfdata->title5) ? $userfdata->title5 : 'Your title' }}">
                                                                <span id="locationmessage"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input type="text" placeholder="Description5"
                                                                    class="form-control" id="description5"
                                                                    value="{{ isset($userfdata->description5) ? $userfdata->description5 : 'Your description' }}">
                                                                <span id="locationmessage"></span>
                                                            </div>
                                                        </div>


                                                        {{-- 6 --}}
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <div style="display: none;">
                                                                    <input type="file" name="icon6"
                                                                        class="custom-file-input" id="icon6"
                                                                        accept=".png, .jpg, .jpeg, .gif .webp">
                                                                    <label class="custom-file-label"
                                                                        for="icon6">Choose file</label>
                                                                </div>
                                                                <span id="icon6message"></span>
                                                                @php
                                                                    $icon6 = $userfdata->icon6 ? asset('our_services/' . $userfdata->icon6) : asset('img/No_image_available.svg');
                                                                @endphp
                                                                <div class="image-preview" style="margin-top: 10px;">
                                                                    <label for="icon6">
                                                                        <img id="icon6_preview"
                                                                            src="{{ $icon6 }}" width="100px"
                                                                            height="100px" class="img-fluid"
                                                                            style="object-fit: cover; cursor: pointer;" />
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input type="text" placeholder="Title6"
                                                                    class="form-control" id="title6"
                                                                    value="{{ isset($userfdata->title6) ? $userfdata->title6 : 'Your title' }}">
                                                                <span id="locationmessage"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input type="text" placeholder="Description6"
                                                                    class="form-control" id="description6"
                                                                    value="{{ isset($userfdata->description6) ? $userfdata->description6 : 'Your description' }}">
                                                                <span id="locationmessage"></span>
                                                            </div>
                                                        </div>



                                                        {{-- Gallery --}}
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <div style="display: none;">
                                                                    <input type="file" name="galleryImage"
                                                                        class="custom-file-input" id="galleryImage"
                                                                        accept=".png, .jpg, .jpeg, .gif .webp">
                                                                    <label class="custom-file-label"
                                                                        for="galleryImage">Choose file</label>
                                                                </div>
                                                                <span id="galleryImagemessage"></span>
                                                                @php
                                                                    $galleryImagephot = $userfdata->galleryImage ? asset('Gallery/' . $userfdata->galleryImage) : asset('img/No_image_available.svg');
                                                                @endphp
                                                                <div class="image-preview" style="margin-top: 10px;">
                                                                    <label for="galleryImage">
                                                                        <img id="galleryImage_preview"
                                                                            src="{{ $galleryImagephot }}"
                                                                            width="100px" height="100px"
                                                                            class="img-fluid"
                                                                            style="object-fit: cover; cursor: pointer;" />
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input"
                                                                        id="videoFile" name="videoFile"
                                                                        accept="video/*"
                                                                        onchange="previewVideo(event, 'preview_video')">
                                                                    <label class="custom-file-label"
                                                                        for="videoFile">Choose video file</label>
                                                                </div>
                                                                @php
                                                                    $upvideo = $userfdata->videoFile ? asset('videoGallery/' . $userfdata->videoFile) : '';
                                                                @endphp
                                                                <div class="video-preview" style="margin-top: 10px;">
                                                                    <video id="preview_video" width="100px"
                                                                        height="100px" controls
                                                                        style="object-fit: cover;">
                                                                        <source src="{{ $upvideo }}"
                                                                            type="video/mp4">
                                                                        Your browser does not support the video tag.
                                                                    </video>
                                                                    <p>Video Duration: <span id="videoDuration"></span>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{-- product --}}
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                @php
                                                                    $productimage1 = $userfdata->productimage1 ? asset('productGallery/' . $userfdata->productimage1) : asset('img/No_image_available.svg');
                                                                @endphp
                                                                <div class="custom-file" style="display: none;">
                                                                    <input type="file" class="custom-file-input"
                                                                        id="product1" name="product1"
                                                                        accept=".png, .jpg, .jpeg, .gif"
                                                                        onchange="productImage1(event, 'product1Preview')">
                                                                    <label class="custom-file-label"
                                                                        for="product1">Choose file</label>
                                                                </div>

                                                                <span id="product1"></span>
                                                                <div class="image-preview" style="margin-top: 10px;">
                                                                    <label for="product1">
                                                                        <img id="product1Preview"
                                                                            src="{{ $productimage1 }}" width="100px"
                                                                            height="100px" class="img-fluid"
                                                                            style="object-fit: cover; cursor: pointer;" />
                                                                    </label>
                                                                </div>

                                                                <div class="form-group">

                                                                    <input type="text" class="form-control"
                                                                        id="product_title1"
                                                                        placeholder="Product title"
                                                                        value="{{ $userfdata->producttitle1 }}">
                                                                    <span id="productTitleMessage1"></span>
                                                                </div>

                                                                <div class="form-group">
                                                                    <textarea id="productDescription1" cols="5" rows="2" class="form-control"
                                                                        placeholder="Product Description">{{ $userfdata->productdescription1 }}</textarea>
                                                                    <span id="productdescriptionMessage1"></span>
                                                                </div>

                                                                <div class="form-group">

                                                                    <input type="number" class="form-control"
                                                                        id="productprice1" placeholder="Product Price"
                                                                        value="{{ $userfdata->productprice1 }}">
                                                                    <span id="descriptionMessage1"></span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                @php
                                                                    $productimage2 = $userfdata->productimage2 ? asset('productGallery/' . $userfdata->productimage2) : asset('img/No_image_available.svg');
                                                                @endphp
                                                                <div class="custom-file" style="display: none;">
                                                                    <input type="file" class="custom-file-input"
                                                                        id="product2"
                                                                        accept=".png, .jpg, .jpeg, .gif"
                                                                        onchange="productImage2(event, 'product2Preview')">
                                                                    <label class="custom-file-label"
                                                                        for="product2">Choose file</label>
                                                                </div>
                                                                <span id="product2"></span>
                                                                <div class="image-preview" style="margin-top: 10px;">
                                                                    <label for="product2">
                                                                        <img id="product2Preview"
                                                                            src="{{ $productimage2 }}" width="100px"
                                                                            height="100px" class="img-fluid"
                                                                            style="object-fit: cover; cursor: pointer;" />
                                                                    </label>
                                                                </div>
                                                                <div class="form-group">

                                                                    <input type="text" class="form-control"
                                                                        id="product_title2"
                                                                        placeholder="Product title"
                                                                        value="{{ $userfdata->producttitle2 }}">
                                                                    <span id="productTitleMessage1"></span>
                                                                </div>
                                                                <div class="form-group">

                                                                    <textarea id="productDescription2" cols="5" rows="2" class="form-control"
                                                                        placeholder="Product Description">{{ $userfdata->productdescription2 }}</textarea>
                                                                    <span id="productdescriptionMessage1"></span>
                                                                </div>

                                                                <div class="form-group">

                                                                    <input type="number" class="form-control"
                                                                        id="productprice2" placeholder="Product Price"
                                                                        value="{{ $userfdata->productprice2 }}">
                                                                    <span id="descriptionMessage1"></span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                @php
                                                                    $productimage3 = $userfdata->productimage3 ? asset('productGallery/' . $userfdata->productimage3) : asset('img/No_image_available.svg');
                                                                @endphp
                                                                <div class="custom-file" style="display: none;">
                                                                    <input type="file" class="custom-file-input"
                                                                        id="product3"
                                                                        accept=".png, .jpg, .jpeg, .gif"
                                                                        onchange="productImage3(event, 'product3Preview')">
                                                                    <label class="custom-file-label"
                                                                        for="product3">Choose file</label>
                                                                </div>
                                                                <span id="product3"></span>
                                                                <div class="image-preview" style="margin-top: 10px;">
                                                                    <label for="product3">
                                                                        <img id="product3Preview"
                                                                            src="{{ $productimage3 }}" width="100px"
                                                                            height="100px" class="img-fluid"
                                                                            style="object-fit: cover; cursor: pointer;" />
                                                                    </label>
                                                                </div>
                                                                <div class="form-group">

                                                                    <input type="text" class="form-control"
                                                                        id="product_title3"
                                                                        placeholder="Product title"
                                                                        value="{{ $userfdata->productprice3 }}">
                                                                    <span id="productTitleMessage1"></span>
                                                                </div>
                                                                <div class="form-group">

                                                                    <textarea id="productDescription3" cols="5" rows="2" class="form-control"
                                                                        placeholder="Product Description">{{ $userfdata->productdescription3 }}</textarea>
                                                                    <span id="productdescriptionMessage1"></span>
                                                                </div>

                                                                <div class="form-group">

                                                                    <input type="number" class="form-control"
                                                                        id="productprice3" placeholder="Product Price"
                                                                        value="{{ $userfdata->productprice3 }}">
                                                                    <span id="descriptionMessage1"></span>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                @php
                                                                    $productimage4 = $userfdata->productimage4 ? asset('productGallery/' . $userfdata->productimage4) : asset('img/No_image_available.svg');
                                                                @endphp
                                                                <div class="custom-file" style="display: none;">
                                                                    <input type="file" class="custom-file-input"
                                                                        id="product4"
                                                                        accept=".png, .jpg, .jpeg, .gif"
                                                                        onchange="productImage4(event, 'product4Preview')">
                                                                    <label class="custom-file-label"
                                                                        for="product4">Choose file</label>
                                                                </div>
                                                                <span id="product4"></span>
                                                                <div class="image-preview" style="margin-top: 10px;">
                                                                    <label for="product4">
                                                                        <img id="product4Preview"
                                                                            src="{{ $productimage4 }}" width="100px"
                                                                            height="100px" class="img-fluid"
                                                                            style="object-fit: cover; cursor: pointer;" />
                                                                    </label>
                                                                </div>
                                                                <div class="form-group">

                                                                    <input type="text" class="form-control"
                                                                        id="product_title4"
                                                                        placeholder="Product title"
                                                                        value="{{ $userfdata->producttitle4 }}">
                                                                    <span id="productTitleMessage1"></span>
                                                                </div>
                                                                <div class="form-group">

                                                                    <textarea id="productDescription4" cols="5" rows="2" class="form-control"
                                                                        placeholder="Product Description">{{ $userfdata->productdescription4 }}</textarea>
                                                                    <span id="productdescriptionMessage1"></span>
                                                                </div>

                                                                <div class="form-group">

                                                                    <input type="number" class="form-control"
                                                                        id="productprice4" placeholder="Product Price"
                                                                        value="{{ $userfdata->productprice4 }}">
                                                                    <span id="descriptionMessage1"></span>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                @php
                                                                    $productimage5 = $userfdata->productimage5 ? asset('productGallery/' . $userfdata->productimage5) : asset('img/No_image_available.svg');
                                                                @endphp
                                                                <div class="custom-file" style="display: none;">
                                                                    <input type="file" class="custom-file-input"
                                                                        id="product5"
                                                                        accept=".png, .jpg, .jpeg, .gif"
                                                                        onchange="productImage5(event, 'product5Preview')">
                                                                    <label class="custom-file-label"
                                                                        for="product5">Choose file</label>
                                                                </div>
                                                                <span id="product5"></span>
                                                                <div class="image-preview" style="margin-top: 10px;">
                                                                    <label for="product5">
                                                                        <img id="product5Preview"
                                                                            src="{{ $productimage5 }}" width="100px"
                                                                            height="100px" class="img-fluid"
                                                                            style="object-fit: cover; cursor: pointer;" />
                                                                    </label>
                                                                </div>
                                                                <div class="form-group">

                                                                    <input type="text" class="form-control"
                                                                        id="product_title5"
                                                                        placeholder="Product title"
                                                                        value="{{ $userfdata->producttitle5 }}">
                                                                    <span id="productTitleMessage1"></span>
                                                                </div>
                                                                <div class="form-group">

                                                                    <textarea id="productDescription5" cols="5" rows="2" class="form-control"
                                                                        placeholder="Product Description">{{ $userfdata->productdescription5 }}</textarea>
                                                                    <span id="productdescriptionMessage1"></span>
                                                                </div>

                                                                <div class="form-group">

                                                                    <input type="number" class="form-control"
                                                                        id="productprice5" placeholder="Product Price"
                                                                        value="{{ $userfdata->productprice5 }}">
                                                                    <span id="descriptionMessage1"></span>
                                                                </div>
                                                            </div>
                                                        </div>



                                                        <div class="col-md-6">
                                                            <div class="form-group">

                                                                @php
                                                                    $productimage6 = $userfdata->productimage6 ? asset('productGallery/' . $userfdata->productimage6) : asset('img/No_image_available.svg');
                                                                @endphp
                                                                <div class="custom-file" style="display: none;">
                                                                    <input type="file" class="custom-file-input"
                                                                        id="product6"
                                                                        accept=".png, .jpg, .jpeg, .gif"
                                                                        onchange="productImage6(event, 'product6Preview')">
                                                                    <label class="custom-file-label"
                                                                        for="product6">Choose file</label>
                                                                </div>
                                                                <span id="product6"></span>
                                                                <div class="image-preview" style="margin-top: 10px;">
                                                                    <label for="product6">
                                                                        <img id="product6Preview"
                                                                            src="{{ $productimage6 }}" width="100px"
                                                                            height="100px" class="img-fluid"
                                                                            style="object-fit: cover; cursor: pointer;" />
                                                                    </label>
                                                                </div>
                                                                <div class="form-group">

                                                                    <input type="text" class="form-control"
                                                                        id="product_title6"
                                                                        placeholder="Product title"
                                                                        value="{{ $userfdata->producttitle6 }}">
                                                                    <span id="productTitleMessage1"></span>
                                                                </div>
                                                                <div class="form-group">

                                                                    <textarea id="productDescription6" cols="5" rows="2" class="form-control"
                                                                        placeholder="Product Description">{{ $userfdata->productdescription6 }}</textarea>
                                                                    <span id="productdescriptionMessage1"></span>
                                                                </div>

                                                                <div class="form-group">

                                                                    <input type="number" class="form-control"
                                                                        id="productprice6" placeholder="Product Price"
                                                                        value="{{ $userfdata->productprice6 }}">
                                                                    <span id="descriptionMessage1"></span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{-- testimonial --}}

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                @php
                                                                    $testmonial1image = $userfdata->testmonial1 ? asset('testmonial/' . $userfdata->testmonial1) : asset('img/No_image_available.svg');
                                                                @endphp
                                                                <div class="custom-file" style="display: none;">
                                                                    <input type="file" class="custom-file-input"
                                                                        id="testmonial1" name="testmonial1"
                                                                        accept=".png, .jpg, .jpeg, .gif"
                                                                        onchange="testmonialImage1(event, 'testmonial1Preview')">
                                                                    <label class="custom-file-label"
                                                                        for="testmonial1">Choose file</label>
                                                                </div>
                                                                <span id="testmonial1"></span>
                                                                <div class="image-preview" style="margin-top: 10px;">
                                                                    <label for="testmonial1">
                                                                        <img id="testmonial1Preview"
                                                                            src="{{ $testmonial1image }}"
                                                                            width="100" height="100"
                                                                            class="img-fluid"
                                                                            style="object-fit: cover; cursor: pointer;" />
                                                                    </label>
                                                                </div>
                                                                <div class="form-group">

                                                                    <input type="text" class="form-control"
                                                                        id="testimonial_title1"
                                                                        placeholder="Testmonial title"
                                                                        value="{{ $userfdata->testimonial_title1 }}">
                                                                    <span id="testimonialMessage1"></span>
                                                                </div>
                                                                <div class="form-group">

                                                                    <textarea id="testimonialDescription1" cols="5" rows="2" class="form-control"
                                                                        placeholder="Testimonial description">{{ $userfdata->testimonialDescription1 }}</textarea>
                                                                    <span id="productdescriptionMessage1"></span>
                                                                </div>

                                                                <div class="form-group">
                                                                    <input type="text" class="form-control"
                                                                        id="subtitle1" placeholder="Sub title"
                                                                        value="{{ $userfdata->subtitle1 }}">
                                                                    <span id="descriptionMessage1"></span>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                @php
                                                                    $testmonial1image2 = $userfdata->testimonial2 ? asset('testmonial/' . $userfdata->testimonial2) : asset('img/No_image_available.svg');
                                                                @endphp
                                                                <div class="custom-file" style="display: none;">
                                                                    <input type="file" class="custom-file-input"
                                                                        id="testimonial2" name="testimonial2"
                                                                        accept=".png, .jpg, .jpeg, .gif"
                                                                        onchange="testimonialImage2(event, 'testimonial2Preview')">
                                                                    <label class="custom-file-label"
                                                                        for="testimonial2">Choose file</label>
                                                                </div>
                                                                <span id="testimonial2"></span>
                                                                <div class="image-preview" style="margin-top: 10px;">
                                                                    <label for="testimonial2">
                                                                        <img id="testimonial2Preview"
                                                                            src="{{ $testmonial1image2 }}"
                                                                            width="100px" height="100px"
                                                                            class="img-fluid"
                                                                            style="object-fit: cover; cursor: pointer;" />
                                                                    </label>
                                                                </div>
                                                                <div class="form-group">

                                                                    <input type="text" class="form-control"
                                                                        id="testimonial_title2"
                                                                        placeholder="Testimonial title"
                                                                        value="{{ $userfdata->testimonial_title2 }}">
                                                                    <span id="productTitleMessage1"></span>
                                                                </div>
                                                                <div class="form-group">

                                                                    <textarea id="testimonialDescription2" cols="5" rows="2" class="form-control"
                                                                        placeholder="Testimonial description">{{ $userfdata->testimonialDescription2 }}</textarea>
                                                                    <span id="productdescriptionMessage1"></span>
                                                                </div>

                                                                <div class="form-group">

                                                                    <input type="text" class="form-control"
                                                                        id="subtitle2" placeholder="Sub title2"
                                                                        value="{{ $userfdata->subtitle2 }}">
                                                                    <span id="descriptionMessage1"></span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div>
                                                        <input type="submit" class="btn btn-dark" value="Update">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </form>

                                <div>
                                    {{-- <a href="{{ route('login') }}">if you have Account?</a> --}}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script> --}}


    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        })
    </script>
    <script>
        window.addEventListener('DOMContentLoaded', function() {
            let userEditData = {!! json_encode($userfdata) !!};
            console.log(userEditData);
            document.getElementById('edituser').addEventListener('submit', function(e) {
                e.preventDefault();
                formRegister();
            });

            function formRegister() {
                let vcard_id = document.getElementById('vcard_id').value;

                let vcardpictureInput = document.getElementById('vcardpicture').files[0];

                let exampleName = document.getElementById('exampleName').value;

                let exampleemail = document.getElementById('exampleemail').value;

                let exampledesignation = document.getElementById('exampledesignation').value;

                let exampleDOB = document.getElementById('exampleDOB').value;

                let examplephonenumber = document.getElementById('examplephonenumber').value;

                let examplelocation = document.getElementById('examplelocation').value;


                let websiteurl = document.getElementById('websiteurl').value;
                let instagramurl = document.getElementById('instagramurl').value;
                let youtubeurl = document.getElementById('youtubeurl').value;
                let linkedinurl = document.getElementById('linkedinurl').value;
                let whatsappurl = document.getElementById('whatsappurl').value;

                let gstnumber = document.getElementById('gstnumber').value;
                let bankname = document.getElementById('bankname').value;
                let accountnumber = document.getElementById('accountnumber').value;
                let branch = document.getElementById('branch').value;
                let ifscode = document.getElementById('ifscode').value;

                let companyname = document.getElementById('companyname').value;

                let icon1 = document.getElementById('icon1').files[0];
                let title1 = document.getElementById('title1').value;
                let description1 = document.getElementById('description1').value;

                let icon2 = document.getElementById('icon2').files[0];
                let title2 = document.getElementById('title2').value;
                let description2 = document.getElementById('description2').value;


                let icon3 = document.getElementById('icon3').files[0];
                let title3 = document.getElementById('title3').value;
                let description3 = document.getElementById('description3').value;

                let icon4 = document.getElementById('icon4').files[0];
                let title4 = document.getElementById('title4').value;
                let description4 = document.getElementById('description4').value;


                let icon5 = document.getElementById('icon5').files[0];
                let title5 = document.getElementById('title5').value;
                let description5 = document.getElementById('description5').value;

                let icon6 = document.getElementById('icon6').files[0];
                let title6 = document.getElementById('title6').value;
                let description6 = document.getElementById('description6').value;


                let galleryInput = document.getElementById('galleryImage').files[0];
                let videoUpload = document.getElementById('videoFile').files[0];

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
                // console.log(galleryInput, videoUpload);
                // return


                // testimonial
                let testmonial1 = document.getElementById('testmonial1').files[0];
                let testimonial_title1 = document.getElementById('testimonial_title1').value;
                let testimonialDescription1 = document.getElementById('testimonialDescription1').value;
                let subtitle1 = document.getElementById('subtitle1').value;

                let testmonial2 = document.getElementById('testimonial2').files[0];
                let testimonial_title2 = document.getElementById('testimonial_title2').value;
                let testimonialDescription2 = document.getElementById('testimonialDescription2').value;
                let subtitle2 = document.getElementById('subtitle2').value;

                // console.log(testmonial1);
                // console.log(testmonial2);
                // return

                let vcarddata = new FormData();
                vcarddata.append('vcard_id', vcard_id);
                vcarddata.append('profile_pic', vcardpictureInput);
                vcarddata.append('name', exampleName);
                vcarddata.append('email', exampleemail);
                vcarddata.append('designation', exampledesignation);
                vcarddata.append('DOB', exampleDOB);
                vcarddata.append('phone_number', examplephonenumber);
                vcarddata.append('location', examplelocation);
                vcarddata.append('websiteURL', websiteurl);
                vcarddata.append('instagramURL', instagramurl);
                vcarddata.append('youtubeURL', youtubeurl);
                vcarddata.append('linkedinURL', linkedinurl);
                vcarddata.append('whatsappURL', whatsappurl);
                vcarddata.append('gstNumber', gstnumber);
                vcarddata.append('bankname', bankname);
                vcarddata.append('accountnumber', accountnumber);
                vcarddata.append('branch', branch);
                vcarddata.append('ifsccode', ifscode);
                vcarddata.append('company_name', companyname);
                vcarddata.append('icon1', icon1);
                vcarddata.append('title1', title1);
                vcarddata.append('description1', description1);
                vcarddata.append('icon2', icon2);
                vcarddata.append('title2', title2);
                vcarddata.append('description2', description2);
                vcarddata.append('icon3', icon3);
                vcarddata.append('title3', title3);
                vcarddata.append('description3', description3);
                vcarddata.append('icon4', icon4);
                vcarddata.append('title4', title4);
                vcarddata.append('description4', description4);
                vcarddata.append('icon5', icon5);
                vcarddata.append('title5', title5);
                vcarddata.append('description5', description5);
                vcarddata.append('icon6', icon6);
                vcarddata.append('title6', title6);
                vcarddata.append('description6', description6);
                vcarddata.append('galleryImage', galleryInput);
                vcarddata.append('videoFile', videoUpload);

                vcarddata.append('productimage1', productimage1);
                vcarddata.append('producttitle1', product_title1);
                vcarddata.append('productdescription1', productDescription1);
                vcarddata.append('productprice1', productprice1);

                vcarddata.append('productimage2', productimage2);
                vcarddata.append('producttitle2', product_title2);
                vcarddata.append('productdescription2', productDescription2);
                vcarddata.append('productprice2', productprice2);

                vcarddata.append('productimage3', productimage3);
                vcarddata.append('producttitle3', product_title3);
                vcarddata.append('productdescription3', productDescription3);
                vcarddata.append('productprice3', productprice3);

                vcarddata.append('productimage4', productimage4);
                vcarddata.append('producttitle4', product_title4);
                vcarddata.append('productdescription4', productDescription4);
                vcarddata.append('productprice4', productprice4);

                vcarddata.append('productimage5', productimage5);
                vcarddata.append('producttitle5', product_title5);
                vcarddata.append('productdescription5', productDescription5);
                vcarddata.append('productprice5', productprice5);

                vcarddata.append('productimage6', productimage6);
                vcarddata.append('producttitle6', product_title6);
                vcarddata.append('productdescription6', productDescription6);
                vcarddata.append('productprice6', productprice6);

                vcarddata.append('testmonial1', testmonial1);
                vcarddata.append('testimonial_title1', testimonial_title1);
                vcarddata.append('testimonialDescription1', testimonialDescription1);
                vcarddata.append('subtitle1', subtitle1);

                vcarddata.append('testimonial2', testmonial2);
                vcarddata.append('testimonial_title2', testimonial_title2);
                vcarddata.append('testimonialDescription2', testimonialDescription2);
                vcarddata.append('subtitle2', subtitle2);

                // for (var pair of vcarddata.entries()) {
                //     console.log(pair[0] + ', ' + pair[1]);
                // }
                // return
                $.ajax({
                    method: 'POST',
                    url: '{{ route('editcardDetails.post', ['id' => '__id__']) }}'.replace(
                        '__id__', userEditData.id),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    processData: false,
                    contentType: false,
                    data: vcarddata,
                    success: function(data) {
                        // console.log(data);
                        // return
                        if (data.status === 200) {
                            document.getElementById('RegisterMesage').innerHTML = `
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong id="validationmessage">` + data.message + `</strong>
                            </div> `;;
                            setTimeout(() => {
                                document.getElementById('RegisterMesage').innerHTML = "";
                            }, 3000);
                            window.location.href = data.redirect; // Redirect to the dashboard page
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
                    }
                });


                // document.getElementById('name').addEventListener('input', function() {
                //     let namemessage = document.getElementById('namemessage');
                //     namemessage.innerHTML = "";
                // });

                // document.getElementById('email').addEventListener('input', function() {
                //     let namemessage = document.getElementById('messageEmail');
                //     namemessage.innerHTML = "";
                // });

                // document.getElementById('password').addEventListener('input', function() {
                //     let namemessage = document.getElementById('passwordmessage');
                //     namemessage.innerHTML = "";
                // });
                // document.getElementById('c_password').addEventListener('input', function() {
                //     let namemessage = document.getElementById('confirmpasswordmessage');
                //     namemessage.innerHTML = "";
                // });
            }

        });
    </script>
    <script>
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


    <script>
        document.getElementById('icon1').addEventListener('change', function(e) {
            let fileInput = document.getElementById('icon1');
            let imagePreview = document.getElementById('icon1_preview');
            let vcardpicturemessage = document.getElementById('icon1message');

            if (fileInput.files && fileInput.files[0]) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    vcardpicturemessage.innerHTML = '';
                };
                reader.readAsDataURL(fileInput.files[0]);
            } else {
                imagePreview.src = "{{ asset('img/No_image_available.svg') }}";
                document.getElementById('icon1message').innerHTML =
                    "<span style='color:red'>Please choose a valid image file.</span>";
                setTimeout(() => {
                    document.getElementById('icon1message').innerHTML = '';
                }, 3000);
            }
        });
    </script>

    <script>
        document.getElementById('icon2').addEventListener('change', function(e) {
            let fileInput = document.getElementById('icon2');
            let imagePreview = document.getElementById('icon2_preview');
            let vcardpicturemessage = document.getElementById('icon2message');

            if (fileInput.files && fileInput.files[0]) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    vcardpicturemessage.innerHTML = '';
                };
                reader.readAsDataURL(fileInput.files[0]);
            } else {
                imagePreview.src = "{{ asset('img/No_image_available.svg') }}";
                document.getElementById('icon2message').innerHTML =
                    "<span style='color:red'>Please choose a valid image file.</span>";
                setTimeout(() => {
                    document.getElementById('icon2message').innerHTML = '';
                }, 3000);
            }
        });
    </script>


    <script>
        document.getElementById('icon3').addEventListener('change', function(e) {
            let fileInput = document.getElementById('icon3');
            let imagePreview = document.getElementById('icon3_preview');
            let vcardpicturemessage = document.getElementById('icon3message');

            if (fileInput.files && fileInput.files[0]) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    vcardpicturemessage.innerHTML = '';
                };
                reader.readAsDataURL(fileInput.files[0]);
            } else {
                imagePreview.src = "{{ asset('img/No_image_available.svg') }}";
                document.getElementById('icon3message').innerHTML =
                    "<span style='color:red'>Please choose a valid image file.</span>";
                setTimeout(() => {
                    document.getElementById('icon3message').innerHTML = '';
                }, 3000);
            }
        });
    </script>


    <script>
        document.getElementById('icon4').addEventListener('change', function(e) {
            let fileInput = document.getElementById('icon4');
            let imagePreview = document.getElementById('icon4_preview');
            let vcardpicturemessage = document.getElementById('icon4message');

            if (fileInput.files && fileInput.files[0]) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    vcardpicturemessage.innerHTML = '';
                };
                reader.readAsDataURL(fileInput.files[0]);
            } else {
                imagePreview.src = "{{ asset('img/No_image_available.svg') }}";
                document.getElementById('icon4message').innerHTML =
                    "<span style='color:red'>Please choose a valid image file.</span>";
                setTimeout(() => {
                    document.getElementById('icon4message').innerHTML = '';
                }, 3000);
            }
        });
    </script>


    <script>
        document.getElementById('icon5').addEventListener('change', function(e) {
            let fileInput = document.getElementById('icon5');
            let imagePreview = document.getElementById('icon5_preview');
            let vcardpicturemessage = document.getElementById('icon5message');

            if (fileInput.files && fileInput.files[0]) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    vcardpicturemessage.innerHTML = '';
                };
                reader.readAsDataURL(fileInput.files[0]);
            } else {
                imagePreview.src = "{{ asset('img/No_image_available.svg') }}";
                document.getElementById('icon5message').innerHTML =
                    "<span style='color:red'>Please choose a valid image file.</span>";
                setTimeout(() => {
                    document.getElementById('icon5message').innerHTML = '';
                }, 3000);
            }
        });
    </script>


    <script>
        document.getElementById('icon6').addEventListener('change', function(e) {
            let fileInput = document.getElementById('icon6');
            let imagePreview = document.getElementById('icon6_preview');
            let vcardpicturemessage = document.getElementById('icon6message');

            if (fileInput.files && fileInput.files[0]) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    vcardpicturemessage.innerHTML = '';
                };
                reader.readAsDataURL(fileInput.files[0]);
            } else {
                imagePreview.src = "{{ asset('img/No_image_available.svg') }}";
                document.getElementById('icon6message').innerHTML =
                    "<span style='color:red'>Please choose a valid image file.</span>";
                setTimeout(() => {
                    document.getElementById('icon6message').innerHTML = '';
                }, 3000);
            }
        });
    </script>

    <script>
        document.getElementById('galleryImage').addEventListener('change', function(e) {
            let fileInput = document.getElementById('galleryImage');
            let imagePreview = document.getElementById('galleryImage_preview');
            let vcardpicturemessage = document.getElementById('galleryImagemessage');

            if (fileInput.files && fileInput.files[0]) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    vcardpicturemessage.innerHTML = '';
                };
                reader.readAsDataURL(fileInput.files[0]);
            } else {
                imagePreview.src = "{{ asset('img/No_image_available.svg') }}";
                document.getElementById('galleryImagemessage').innerHTML =
                    "<span style='color:red'>Please choose a valid image file.</span>";
                setTimeout(() => {
                    document.getElementById('galleryImagemessage').innerHTML = '';
                }, 3000);
            }
        });
    </script>

    {{-- <script>
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
    </script> --}}


    <script>
        // Disable back and forward navigation
        window.history.pushState(null, "", window.location.href);
        window.onpopstate = function() {
            window.history.pushState(null, "", window.location.href);
        };
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

    <script>
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
</body>

</html>
