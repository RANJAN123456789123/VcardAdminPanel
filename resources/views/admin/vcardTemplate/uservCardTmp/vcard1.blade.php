{{-- @php
    $getsession = Session::get('userId');
@endphp --}}

<html lang="en">

<head>
    <link>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link href="{{ asset('front/css/bootstrap.min.css') }}" rel="stylesheet">
    <title>vcard1</title>

    {{-- css link --}}
    <link rel="stylesheet" href="{{ asset('assets/css/vcard1.css') }}">

    {{-- font-awesome --}}
    <link href="{{ asset('backend/css/all.min.css') }}" rel="stylesheet">

    {{-- slick slider --}}
    <link rel="stylesheet" href="{{ asset('backend/css/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/slick/slick-theme.css') }}">

    {{-- google font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

</head>
<style>
    #namemessage,
    #phonemessage,
    #publicmessage,
    #Edit_message_five,
    #Edit_message_notffound {
        color: red;
    }

    #Edit_message {
        color: green;
    }
</style>

<body>
    <?php
    // Get profile picture path with a default if not available
    $profilePic = isset($getUserData->profile_pic) ? 'admin/uploads/users/' . $getUserData->profile_pic : 'img/No_image_available.svg';

    $profilePic = asset($profilePic);

    // Create an array with user data
    $userData = [
        'name' => isset($getUserData->name) ? htmlspecialchars($getUserData->name, ENT_QUOTES) : 'N/A',
        'email' => isset($getUserData->email) ? htmlspecialchars($getUserData->email, ENT_QUOTES) : 'N/A',
        'designation' => isset($getUserData->designation) ? htmlspecialchars($getUserData->designation, ENT_QUOTES) : 'N/A',
        'phone_number' => isset($getUserData->phone_number) ? htmlspecialchars($getUserData->phone_number, ENT_QUOTES) : 'N/A',
        'DOB' => isset($getUserData->DOB) ? htmlspecialchars($getUserData->DOB, ENT_QUOTES) : 'N/A',
        'profile_pic' => $profilePic, // Default photo path or handle missing profile photo
    ];

    $person = $userData;
    ?>

    <div class="container">
        <div class="vcard-one main-content w-100 mx-auto">
            <div class="d-flex justify-content-end mt-4">
                <div class="language pt-4 me-2">
                    <ul class="text-decoration-none">
                        <li class="dropdown1 dropdown lang-list">
                            <a href="#" class="dropdown-toggle lang-head text-decoration-none"
                                data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="fa-solid fa-language me-2"></i>Language</a>
                            <ul class="dropdown-menu start-0 lang-hover-list">
                                <li>
                                    <img src="{{ asset('assets/img/vcard1/english.png') }}" width="25px"
                                        height="20px" class="me-3"><a href="#">English</a>
                                </li>
                                <li>
                                    <img src="{{ asset('assets/img/vcard1/spain.png') }}" width="25px" height="20px"
                                        class="me-3"><a href="#">Spanish</a>
                                </li>
                                <li>
                                    <img src="{{ asset('assets/img/vcard1/france.png') }}" width="25px" height="20px"
                                        class="me-3"><a href="#">Franch</a>
                                </li>
                                <li>
                                    <img src="{{ asset('assets/img/vcard1/arabic.svg') }}" width="25px" height="20px"
                                        class="me-3"><a href="#">Arabic</a>
                                </li>
                                <li>
                                    <img src="{{ asset('assets/img/vcard1/german.png') }}" width="25px"
                                        height="20px" class="me-3"><a href="#">German</a>
                                </li>
                                <li>
                                    <img src="{{ asset('assets/img/vcard1/russian.jpeg') }}" width="25px"
                                        height="20px" class="me-3"><a href="#">russian</a>
                                </li>
                                <li>
                                    <img src="{{ asset('assets/img/vcard1/turkish.png') }}" width="25px"
                                        height="20px" class="me-3"><a href="#">Turkish</a>
                                </li>

                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            {{-- banner --}}
            <div class="vcard-one__banner w-100">
                <img src="{{ asset('assets/img/vcard1/vcard-one-bg.png') }}" class="img-fluid"
                    alt="background image" />
            </div>
            {{-- profile --}}
            <div class="vcard_eight">
                @php
                    $profilePic = isset($getUserData->profile_pic) ? asset('admin/uploads/users/' . $getUserData->profile_pic) : asset('img/No_image_available.svg');
                @endphp
                <img src="{{ $profilePic }}" alt="profile-img" class="rounded-circle" />

                <div class="vcard-eight_block">
                    {{-- <div class="d-flex flex-column">
                        <span
                            class="vcard-eight-heading fw-bold text-white text-sm-start text-center">{{ isset($getUserData->name) ? $getUserData->name : 'NA' }}</span>
                        <span
                            class="avatar-designation text-white text-sm-start text-center">{{ isset($getUserData->designation) ? $getUserData->designation : 'NA' }}</span>
                        <span
                            class="avatar-designation text-white text-sm-start text-center">{{ isset($getUserData->company_name) ? $getUserData->company_name : 'NA' }}</span>
                    </div> --}}
                </div>
                <a href="{{ isset($getUserData->email) ? url('vcard-login/' . $getUserData->id) : url('vcard-register/' . $getUserData->nfc_id) }}"
                    class="edit_profile_cus btn btn-primary" style="text-decoration: auto;"> <i
                        class="fas fa-pencil"></i> <span><b>Edit</b></span> </a>
            </div>
            {{-- profile details --}}
            <div
                class="vcard-one__profile-details py-3 d-flex flex-column align-items-center justify-content-center px-3">
                <h4 class="profile-name pt-2 mb-0">{{ isset($getUserData->name) ? $getUserData->name : 'NA' }}</h4>
                <span
                    class="profile-designation pt-2 fw-light">{{ isset($getUserData->designation) ? $getUserData->designation : 'NA' }}
                </span>
                <span
                    class="avatar-designation text-black text-sm-start text-center">{{ isset($getUserData->company_name) ? $getUserData->company_name : 'NA' }}
                </span>

                <div class="social-icons d-flex justify-content-center pt-4">
                    <a href="{{ isset($getUserData->websiteURL) ? 'https://' . $getUserData->websiteURL : 'https://www.google.com' }}"
                        target="_blank">
                        <i class="fas fa-globe icon fa-2x" title="Website"></i></a>
                    <a href="{{ isset($getUserData->instagramURL) ? 'https://' . $getUserData->instagramURL : 'https://www.instagram.com' }}"
                        target="_blank">
                        <i class="fab fa-instagram instagram-icon icon fa-2x" title="Instagram"></i></a>
                    <a href="{{ isset($getUserData->youtubeURL) ? 'https://' . $getUserData->youtubeURL : 'https://www.youtube.com' }}"
                        target="_blank">
                        <i class="fab fa-youtube youtube-icon icon fa-2x" title="Youtube"></i>
                    </a>
                    <a href="{{ isset($getUserData->linkedinURL) ? 'https://' . $getUserData->linkedinURL : 'https://www.linkedin.com' }}"
                        target="_blank">
                        <i class="fab fa-linkedin linkedin-icon icon fa-2x" title="Linkedin"></i>
                    </a>
                    <a href="{{ isset($getUserData->whatsappURL) ? 'https://' . $getUserData->whatsappURL : 'https://www.whatsapp.com' }}"
                        target="_blank">
                        <i class="fab fa-whatsapp whatsapp-icon icon fa-2x" title="Whatsapp"></i>
                    </a>
                </div>
            </div>
            {{-- event --}}
            <div class="vcard-one__event py-3 px-3">
                <div class="container">
                    <div class="row g-3">
                        <div class="col-sm-6 col-12">
                            <div class="card event-card p-3 h-100 border-0">
                                <span class="event-icon d-flex justify-content-center">
                                    <img src="{{ asset('assets/img/vcard1/vcard1-email.png') }}" alt="email" />
                                </span>
                                <h6 class="event-name text-center pt-3 mb-0">
                                    {{ isset($getUserData->email) ? $getUserData->email : 'NA' }}</h6>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="card event-card p-3 h-100 border-0">
                                <span class="event-icon d-flex justify-content-center">
                                    <img src="{{ asset('assets/img/vcard1/vcard1-birthday.png') }}" alt="email" />
                                </span>
                                <h6 class="event-name text-center pt-3 mb-0">
                                    {{ isset($getUserData->DOB) ? $getUserData->DOB : 'NA' }}</h6>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="card event-card p-3 h-100 border-0">
                                <span class="event-icon d-flex justify-content-center">
                                    <img src="{{ asset('assets/img/vcard1/vcard1-phone.png') }}" alt="email" />
                                </span>
                                <h6 class="event-name text-center pt-3 mb-0">
                                    {{ isset($getUserData->phone_number) ? $getUserData->phone_number : 'NA' }}</h6>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="card event-card p-3 h-100 border-0">
                                <span class="event-icon d-flex justify-content-center">
                                    <img src="{{ asset('assets/img/vcard1/vcard1-location.png') }}" alt="email" />
                                </span>
                                <h6 class="event-name text-center pt-3 mb-0">
                                    {{ isset($getUserData->location) ? $getUserData->location : 'NA' }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Appointment --}}
            {{-- <div class="vcard-one__appointment py-3">
                <h4 class="vcard-one-heading text-center pb-4">Make an Appointment</h4>
                <div class="container px-4">
                    <div class="appointment-one">
                        <div class="row d-flex align-items-center justify-content-center mb-3">
                            <div class="col-md-2">
                                <label for="date" class="me-4 appoint-date mb-2">Date</label>
                            </div>
                            <div class="col-md-10">
                                <input id="myID" type="text" class="appoint-input mb-2"
                                    placeholder="Pick a Date" />
                            </div>
                        </div>
                        <div class="row d-flex align-items-center justify-content-center mb-md-3">
                            <div class="col-md-2">
                                <label for="text" class="me-4 appoint-date mb-2">Hour</label>
                            </div>
                            <div class="col-md-5 mb-md-0 mb-3">
                                <div class="card appoint-input flex-row">
                                    <span>08:10 - 20:00</span>
                                </div>
                            </div>
                            <div class="col-md-5 mb-md-0 mb-3">
                                <div class="card appoint-input flex-row">
                                    <span>08:10 - 20:00</span>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex align-items-center justify-content-center">
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-5 mb-md-0 mb-3">
                                <div class="card appoint-input flex-row">
                                    <span>08:10 - 20:00</span>
                                </div>
                            </div>
                            <div class="col-md-5 mb-md-0 mb-3">
                                <div class="card appoint-input flex-row">
                                    <span>08:10 - 20:00</span>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="appoint-btn text-white mt-4 d-block mx-auto ">Make an
                            Appointment
                        </button>
                    </div>
                </div>
            </div> --}}
            {{-- our services --}}
            <div class="vcard-one__service my-3 py-5">
                <h4 class="vcard-one-heading text-center pb-4">Our Services</h4>
                <div class="container">
                    <div class="row g-3">
                        <div class="col-sm-6 col-12">
                            <div class="card service-card d-flex align-items-center flex-row p-2 border-0 h-100">
                                <div
                                    class="service-image d-flex justify-content-center align-items-center rounded-circle">
                                    <img src="{{ isset($getUserData->icon1) ? asset('our_services/' . $getUserData->icon1) : asset('img/No_image_available.svg') }}"
                                        alt="icon1" />

                                </div>
                                <div class="service-details ms-3">
                                    <h4 class="service-title">
                                        {{ isset($getUserData->title1) ? $getUserData->title1 : 'NA' }}
                                    </h4>
                                    <p class="service-paragraph mb-0">
                                        {{ isset($getUserData->description1) ? $getUserData->description1 : 'NA' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="card service-card d-flex align-items-center flex-row p-2 border-0 h-100">
                                <div
                                    class="service-image d-flex justify-content-center align-items-center rounded-circle">
                                    <img src="{{ isset($getUserData->icon2) ? asset('our_services/' . $getUserData->icon2) : asset('img/No_image_available.svg') }}"
                                        alt="icon1" />
                                </div>
                                <div class="service-details ms-3">
                                    <h4 class="service-title">
                                        {{ isset($getUserData->title2) ? $getUserData->title2 : 'NA' }}
                                    </h4>
                                    <p class="service-paragraph mb-0">
                                        {{ isset($getUserData->description2) ? $getUserData->description2 : 'NA' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="card service-card d-flex align-items-center flex-row p-2 border-0 h-100">
                                <div
                                    class="service-image d-flex justify-content-center align-items-center rounded-circle">
                                    <img src="{{ isset($getUserData->icon3) ? asset('our_services/' . $getUserData->icon3) : asset('img/No_image_available.svg') }}"
                                        alt="icon1" />
                                </div>
                                <div class="service-details ms-3">
                                    <h4 class="service-title">
                                        {{ isset($getUserData->title3) ? $getUserData->title3 : 'NA' }}
                                    </h4>
                                    <p class="service-paragraph mb-0">
                                        {{ isset($getUserData->description3) ? $getUserData->description3 : 'NA' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="card service-card d-flex align-items-center flex-row p-2 border-0 h-100">
                                <div
                                    class="service-image d-flex justify-content-center align-items-center rounded-circle">
                                    <img src="{{ isset($getUserData->icon4) ? asset('our_services/' . $getUserData->icon4) : asset('img/No_image_available.svg') }}"
                                        alt="icon1" />
                                </div>
                                <div class="service-details ms-3">
                                    <h4 class="service-title">
                                        {{ isset($getUserData->title4) ? $getUserData->title4 : 'NA' }}
                                    </h4>
                                    <p class="service-paragraph mb-0">
                                        {{ isset($getUserData->description4) ? $getUserData->description4 : 'NA' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="card service-card d-flex align-items-center flex-row p-2 border-0 h-100">
                                <div
                                    class="service-image d-flex justify-content-center align-items-center rounded-circle">
                                    <img src="{{ isset($getUserData->icon5) ? asset('our_services/' . $getUserData->icon5) : asset('img/No_image_available.svg') }}"
                                        alt="icon1" />
                                </div>
                                <div class="service-details ms-3">
                                    <h4 class="service-title">
                                        {{ isset($getUserData->title5) ? $getUserData->title5 : 'NA' }}
                                    </h4>
                                    <p class="service-paragraph mb-0">
                                        {{ isset($getUserData->description5) ? $getUserData->description5 : 'NA' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="card service-card d-flex align-items-center flex-row p-2 border-0 h-100">
                                <div
                                    class="service-image d-flex justify-content-center align-items-center rounded-circle">
                                    <img src="{{ isset($getUserData->icon6) ? asset('our_services/' . $getUserData->icon6) : asset('img/No_image_available.svg') }}"
                                        alt="icon1" />
                                </div>
                                <div class="service-details ms-3">
                                    <h4 class="service-title">
                                        {{ isset($getUserData->title6) ? $getUserData->title6 : 'NA' }}
                                    </h4>
                                    <p class="service-paragraph mb-0">
                                        {{ isset($getUserData->description6) ? $getUserData->description6 : 'NA' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- gallery --}}

            <div class="vcard-one__gallery py-3">
                <h4 class="vcard-one-heading text-center pb-4">Gallery</h4>
                <div class="container">
                    <div class="row g-4 gallery-slider overflow-hidden">
                        <div class="col-6 mb-2">
                            <div class="card gallery-card p-2 border-0 w-100 h-100">
                                <div class="gallery-profile">
                                    {{-- <img src="{{ asset('assets/img/vcard1/v1.jpg') }}" alt="profile"
                                        class="w-100" /> --}}
                                    <img src="{{ isset($getUserData->galleryImage) ? asset('Gallery/' . $getUserData->galleryImage) : asset('img/No_image_available.svg') }}"
                                        alt="icon1" class="w-100" />
                                </div>
                            </div>
                        </div>
                        <div class="col-6 mb-2">
                            <div class="card gallery-card p-2 border-0 w-100 h-100">
                                <div class="gallery-profile">
                                    <div>
                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal" class="gallery-link">
                                            <video controls class="gallery-item">
                                                <source
                                                    src="{{ isset($getUserData->videoFile) ? asset('videoGallery/' . $getUserData->videoFile) : '' }}"
                                                    type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <iframe src="//www.youtube.com/embed/Q1NKMPhP8PY" class="w-100" height="315">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Product slider --}}
            <div class="vcard-one__product py-3">
                <h4 class="vcard-one-heading text-center pb-4">Products</h4>
                <div class="container">
                    <div class="row g-4 product-slider overflow-hidden">
                        <div class="col-6 mb-2">
                            <div class="card product-card p-2 border-0 w-100 h-100">
                                <div class="product-profile">
                                    <img src="{{ isset($getUserData->productimage1) ? asset('productGallery/' . $getUserData->productimage1) : asset('img/No_image_available.svg') }}"
                                        alt="profile" class="w-100" />
                                </div>
                                <div class="product-details mt-3">
                                    <h4>{{ isset($getUserData->producttitle1) ? $getUserData->producttitle1 : 'NA' }}
                                    </h4>
                                    <p class="mb-2">
                                        {{ isset($getUserData->productdescription1) ? $getUserData->productdescription1 : 'NA' }}
                                    </p>
                                    <span
                                        class="text-black">{{ isset($getUserData->productprice1) ? $getUserData->productprice1 : 'NA' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 mb-2">
                            <div class="card product-card p-2 border-0 w-100 h-100">
                                <div class="product-profile">
                                    <img src="{{ isset($getUserData->productimage2) ? asset('productGallery/' . $getUserData->productimage2) : asset('img/No_image_available.svg') }}"
                                        alt="profile" class="w-100" />
                                </div>
                                <div class="product-details mt-3">
                                    <h4>{{ isset($getUserData->producttitle2) ? $getUserData->producttitle2 : 'NA' }}
                                    </h4>
                                    <p class="mb-2">
                                        {{ isset($getUserData->productdescription2) ? $getUserData->productdescription2 : 'NA' }}
                                    </p>
                                    <span class="text-black">
                                        {{ isset($getUserData->productprice2) ? $getUserData->productprice2 : 'NA' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 mb-2">
                            <div class="card product-card p-2 border-0 w-100 h-100">
                                <div class="product-profile">
                                    <img src="{{ isset($getUserData->productimage3) ? asset('productGallery/' . $getUserData->productimage3) : asset('img/No_image_available.svg') }}"
                                        alt="profile" class="w-100" />
                                </div>
                                <div class="product-details mt-3">
                                    <h4>{{ isset($getUserData->producttitle3) ? $getUserData->producttitle3 : 'NA' }}
                                    </h4>
                                    <p class="mb-2">
                                        {{ isset($getUserData->productdescription3) ? $getUserData->productdescription3 : 'NA' }}
                                    </p>
                                    <span class="text-black">
                                        {{ isset($getUserData->productprice3) ? $getUserData->productprice3 : 'NA' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- testimonial --}}
            <div class="vcard-one__testimonial py-3">
                <h4 class="vcard-one-heading text-center pb-4">Testimonial</h4>
                <div class="container">
                    <div class="row g-4 pt-5 testimonial-slider overflow-hidden">
                        <div class="col-6">
                            <div class="card testimonial-card position-relative p-2 border-0 w-100">
                                <div class="testimonial-profile position-absolute top-0 start-50 translate-middle">
                                    <img src=" {{ isset($getUserData->testmonial1) ? asset('testmonial/' . $getUserData->testmonial1) : '' }}"
                                        alt="testimonial" class="rounded-circle" />
                                </div>
                                <div class="testimonial-details mt-5">
                                    <h4 class="text-center">
                                        {{ isset($getUserData->testimonial_title1) ? $getUserData->testimonial_title1 : 'NA' }}
                                    </h4>
                                    <span
                                        class="text-center d-block mb-2">{{ isset($getUserData->subtitle1) ? $getUserData->subtitle1 : 'NA' }}</span>
                                    <p class="text-center">
                                        {{ isset($getUserData->testimonialDescription1) ? $getUserData->testimonialDescription1 : 'NA' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card testimonial-card position-relative p-2 border-0 w-100">
                                <div class="testimonial-profile position-absolute top-0 start-50 translate-middle">
                                    <img src=" {{ isset($getUserData->testimonial2) ? asset('testmonial/' . $getUserData->testimonial2) : '' }}"
                                        alt="testimonial" class="rounded-circle" />
                                </div>
                                <div class="testimonial-details mt-5">
                                    <h4 class="text-center">
                                        {{ isset($getUserData->testimonial_title2) ? $getUserData->testimonial_title2 : 'NA' }}
                                    </h4>
                                    <span
                                        class="text-center d-block mb-2">{{ isset($getUserData->subtitle2) ? $getUserData->subtitle2 : 'NA' }}</span>
                                    <p class="text-center">
                                        {{ isset($getUserData->testimonialDescription2) ? $getUserData->testimonialDescription2 : 'NA' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            {{-- Qr code --}}
            {{-- <div class="vcard-one__qr-code my-3 py-5 px-3">
                <h4 class="vcard-one-heading text-center pb-4">QR Code</h4>
                <div class="qr-code p-3 card d-block mx-auto border-0">
                    <div class="qr-code-profile d-flex justify-content-center">
                        <img src="{{ $profilePic }}" alt="qr profile" class="rounded-circle" />
                    </div>
                    <div class="qr-code-image mt-4 d-flex justify-content-center">
                        <img id="qrCodeImage" src="{{ asset('qr_codes/' . (isset($qrcode) ? $qrcode : 'NA')) }}"
                            alt="qr code" />
                    </div>
                </div>
                <button type="button" class="qr-code-btn text-white mt-4 d-block mx-auto"
                    onclick="downloadQRCode()">Download My QR Code</button>
            </div> --}}

            {{-- <form id="addVcard1">
                @csrf
                <div class="vcard-one__contact py-5">
                    <h4 class="vcard-one-heading text-center pb-4">GST</h4>

                    <h6 id="Edit_message"></h6>
                    <h6 id="Edit_message_five"></h6>
                    <h6 id="Edit_message_notffound"></h6>

                    <div class="contact-form px-3">
                        <div class="mb-3">
                            <label class="form-label">GST</label><br>
                            <span id="namemessage"></span>
                            <div class="input-group mb-3">
                                <label></label>
                                <input type="text" class="form-control border-start-0" placeholder="Enter GST Number"
                                    id="vcard1name">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">E-mail</label><br>
                            <span id="emailmessage"></span>
                            <div class="input-group mb-3">
                                <span class="input-group-text border-end-0"><i class="far fa-envelope"></i></span>
                                <input type="email" class="form-control border-start-0"
                                    placeholder="E-mail Address" id="vcard1email">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone</label><br>
                            <span id="phonemessage"></span>
                            <div class="input-group mb-3">
                                <span class="input-group-text border-end-0"><i class="fas fa-phone"></i></span>
                                <input type="number" placeholder="Mobile Number" class="form-control border-start-0"
                                    id="vcard1phone">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Message</label><br>
                            <span id="publicmessage"></span>
                            <textarea class="form-control" placeholder="Type a message here..." id="message" rows="5"></textarea>
                        </div>
                        <button type="submit" class="contact-btn text-white mt-4 d-block ms-auto">Send
                            Message</button>
                    </div>
                </div>
            </form> --}}



            {{-- business hour --}}
            {{-- <div class="vcard-one__timing py-3 px-1">
                <h4 class="vcard-one-heading text-center pb-4">GST</h4>
                <div class="container pb-4">
                    <div class="row g-3">
                        <div class="col-sm-6 col-12">
                            <div class="card business-card flex-row justify-content-center">
                                <span class="me-2">GST</span>
                                <span>{{ isset($getUserData->mondaystart) ? $getUserData->mondaystart : 'NA' }} -
                                    {{ isset($getUserData->tuesdaystart) ? $getUserData->tuesdaystart : 'NA' }}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="card business-card flex-row justify-content-center">
                                <span class="me-2">Tuesday :</span>
                                <span>{{ isset($getUserData->tuesdaystart) ? $getUserData->tuesdaystart : 'NA' }} -
                                    {{ isset($getUserData->tuesdayend) ? $getUserData->tuesdayend : 'NA' }}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="card business-card flex-row justify-content-center">
                                <span class="me-2">Wednesday :</span>
                                <span>{{ isset($getUserData->wednesdaystart) ? $getUserData->wednesdaystart : 'NA' }} -
                                    {{ isset($getUserData->wednesdayend) ? $getUserData->wednesdayend : 'NA' }}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="card business-card flex-row justify-content-center">
                                <span class="me-2">Thursday :</span>
                                <span>{{ isset($getUserData->thursdaystart) ? $getUserData->thursdaystart : 'NA' }} -
                                    {{ isset($getUserData->thursdayend) ? $getUserData->thursdayend : 'NA' }}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="card business-card flex-row justify-content-center">
                                <span class="me-2">Friday :</span>
                                <span>{{ isset($getUserData->fridaystart) ? $getUserData->fridaystart : 'NA' }} -
                                    {{ isset($getUserData->fridayend) ? $getUserData->fridayend : 'NA' }}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="card business-card flex-row justify-content-center">
                                <span class="me-2">Saturday :</span>
                                <span>{{ isset($getUserData->saturdaystart) ? $getUserData->saturdaystart : 'NA' }} -
                                    {{ isset($getUserData->saturdayend) ? $getUserData->saturdayend : 'NA' }}</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div> --}}
            {{-- Contact --}}


            {{-- <form id="addVcard1" data-get-email="{{ $getUserData->email }}">
                @csrf
                <div class="vcard-one__contact py-5">
                    <h4 class="vcard-one-heading text-center pb-4">Contact Us</h4>

                    <h6 id="Edit_message"></h6>
                    <h6 id="Edit_message_five"></h6>
                    <h6 id="Edit_message_notffound"></h6>

                    <div class="contact-form px-3">
                        <div class="mb-3">
                            <label class="form-label">Your Name</label><br>
                            <span id="namemessage"></span>
                            <div class="input-group mb-3">
                                <span class="input-group-text border-end-0"><i class="far fa-user"></i></span>
                                <input type="text" class="form-control border-start-0" placeholder="Full Name"
                                    id="vcard1name">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">E-mail</label><br>
                            <span id="emailmessage"></span>
                            <div class="input-group mb-3">
                                <span class="input-group-text border-end-0"><i class="far fa-envelope"></i></span>
                                <input type="email" class="form-control border-start-0"
                                    placeholder="E-mail Address" id="vcard1email">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone</label><br>
                            <span id="phonemessage"></span>
                            <div class="input-group mb-3">
                                <span class="input-group-text border-end-0"><i class="fas fa-phone"></i></span>
                                <input type="number" placeholder="Mobile Number" class="form-control border-start-0"
                                    id="vcard1phone">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Message</label><br>
                            <span id="publicmessage"></span>
                            <textarea class="form-control" placeholder="Type a message here..." id="message" rows="5"></textarea>
                        </div>
                        <button type="submit" class="contact-btn text-white mt-4 d-block ms-auto">Send
                            Message</button>
                    </div>
                </div>
            </form> --}}
            <div class="d-sm-flex justify-content-center mt-5">

                <button type="submit" class="vcard-one-btn text-white d-block mb-sm-0 mb-3"
                        onclick="downloadQRCode()">
                        <i class="fas fa-download me-2"></i>Qr code
                    </button>

                <button type="submit" class="vcard-one-btn text-white d-block mb-sm-0 mb-3" id="addToContact">
                    <i class="fas fa-download me-2"></i> Download Vcard
                </button>
                {{-- share btn --}}
                <button type="button" class="vcard-one-btn text-white d-block mb-sm-0 mb-3" data-toggle="modal"
                data-target="#shareButtonall">
                <a href="#" class="text-decoration-none">
                    <i class="fas fa-share-alt me-2"></i>Share</a>
            </button>
            <div class="modal fade" id="shareButtonall" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><span>
                                    <button onclick="myFunction()"></button>
                                </span> <i class="fa fa-share-alt"></i> &nbsp;Share link </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="vcard-eight__social py-3 px-sm-3 px-2 position-relative">
                                <div class="social-icons d-flex justify-content-center pt-4 flex-wrap">
                                    <span
                                        class="social-back rounded-circle d-flex justify-content-center align-items-center m-sm-2 m-1">
                                        <a href="{{ isset($getUserData->websiteURL) ? 'https://' . $getUserData->websiteURL : 'https://www.google.com' }}"
                                            target="_blank" class="share-button facebook">
                                            <i class="fab fa-facebook icon fa-2x" title="Website"></i>
                                        </a>
                                    </span>
                                    <span
                                        class="social-back rounded-circle d-flex justify-content-center align-items-center m-sm-2 m-1">
                                        <a href="{{ isset($getUserData->instagramURL) ? 'https://' . $getUserData->instagramURL : 'https://www.instagram.com' }}"
                                            target="_blank" class="share-button instagram">
                                            <i class="fab fa-instagram instagram-icon icon fa-2x"
                                                title="Instagram"></i>
                                        </a>
                                    </span>
                                    <span
                                        class="social-back rounded-circle d-flex justify-content-center align-items-center m-sm-2 m-1">
                                        <a href="{{ isset($getUserData->youtubeURL) ? 'https://' . $getUserData->youtubeURL : 'https://www.youtube.com' }}"
                                            target="_blank" class="share-button youtube">
                                            <i class="fab fa-youtube youtube-icon icon fa-2x" title="Youtube"></i>
                                        </a>
                                    </span>
                                    <span
                                        class="social-back rounded-circle d-flex justify-content-center align-items-center m-sm-2 m-1">
                                        <a href="{{ isset($getUserData->linkedinURL) ? 'https://' . $getUserData->linkedinURL : 'https://www.linkedin.com' }}"
                                            target="_blank" class="share-button linkedin">
                                            <i class="fab fa-linkedin linkedin-icon icon fa-2x"
                                                title="Linkedin"></i>
                                        </a>
                                    </span>
                                    <span
                                        class="social-back rounded-circle d-flex justify-content-center align-items-center m-sm-2 m-1">
                                        <a href="{{ isset($getUserData->whatsappURL) ? 'https://' . $getUserData->whatsappURL : 'https://www.whatsapp.com' }}"
                                            target="_blank" class="share-button whatsapp">
                                            <i class="fab fa-whatsapp whatsapp-icon icon fa-2x"
                                                title="Whatsapp"></i>
                                        </a>
                                    </span>
                                    <span
                                        class="social-back rounded-circle d-flex justify-content-center align-items-center m-sm-2 m-1">
                                        <button onclick="myFunction()"><i class="fa-solid fa-copy"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            </div>
        </div>

    </div>
    </div>
    <script type="text/javascript" src="{{ asset('backend/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('front/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/js/slick.min.js') }}" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <script>
        $('.testimonial-slider').slick({
            dots: true,
            infinite: true,
            arrows: false,
            speed: 300,
            slidesToShow: 2,
            autoplay: true,
            slidesToScroll: 1,
            responsive: [{
                breakpoint: 575,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: true
                }
            }]
        });
    </script>

    <script>
        $('.product-slider').slick({
            dots: true,
            infinite: true,
            arrows: false,
            speed: 300,
            slidesToShow: 2,
            autoplay: true,
            slidesToScroll: 1,
            responsive: [{
                breakpoint: 575,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: true
                }
            }]
        });
    </script>
    <script>
        $("#myID").flatpickr();
    </script>

    <script>
        $('.gallery-slider').slick({
            dots: true,
            infinite: true,
            arrows: false,
            speed: 300,
            slidesToShow: 2,
            autoplay: true,
            slidesToScroll: 1,
            responsive: [{
                breakpoint: 575,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: true
                }
            }]
        });
    </script>


    <script>
        $(document).ready(function() {
            $('.dropdown1').hover(function() {
                $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeIn(100);
            }, function() {
                $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeOut(100);
            });
        });
    </script>


<script>
    function downloadQRCode() {
        // alert("Downloading");

        var appUrl = '{{ config('app.url') }}';
        var autoset = appUrl ? appUrl + ':' + '8000' + '/' + 'qrcodeprimary' + '/' +
            '{{ isset($getUserData->qr_code) ? $getUserData->qr_code : 'NA' }}' : window.location.origin + '/' +
            'qrcodeprimary' + '/' +
            '{{ isset($getUserData->qr_code) ? $getUserData->qr_code : 'NA' }}';

        var downloadLink = document.createElement('a');
        downloadLink.href = autoset; // Change to 'url' instead of 'qrCodeImg.src'
        downloadLink.download = '{{ isset($getUserData->name) ? $getUserData->name : 'NA' }}_qr_code.png';
        document.body.appendChild(downloadLink);
        downloadLink.click();
        document.body.removeChild(downloadLink);
    }
</script>


    <script>
        var saveBtn = document.getElementById("addToContact");
        saveBtn.addEventListener("click", function() {
            var vcard = "BEGIN:VCARD\nVERSION:3.0\n";
            vcard += "FN:" + "<?php echo $person['name']; ?>" + "\n";
            vcard += "EMAIL:" + "<?php echo $person['email']; ?>" + "\n";
            vcard += "TITLE:" + "<?php echo $person['designation']; ?>" + "\n";
            vcard += "TEL:" + "<?php echo $person['phone_number']; ?>" + "\n";
            vcard += "BDAY:" + "<?php echo $person['DOB']; ?>" + "\n"; // Use BDAY instead of DOB for vCard

            vcard += "PHOTO;VALUE=URL:" + "<?php echo $person['profile_pic']; ?>" + "\n";
            vcard += "END:VCARD";

            var blob = new Blob([vcard], {
                type: "text/vcard"
            });
            var url = URL.createObjectURL(blob);

            const newLink = document.createElement('a');
            newLink.download = "<?php echo $person['name']; ?>" + ".vcf";
            newLink.textContent = "Download vCard";
            newLink.href = url;
            newLink.click();
        });
    </script>
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {

            document.getElementById('addVcard1').addEventListener('submit', function(event) {
                event.preventDefault();
                changeform();
                let vcard1name = document.getElementById('vcard1name').value;
                let vcard1email = document.getElementById('vcard1email').value;
                let vcard1phone = document.getElementById('vcard1phone').value;
                let message = document.getElementById('message').value;

                let getAtt = document.getElementById('addVcard1');
                let ToEmail = getAtt.getAttribute('data-get-email');


                if (vcard1name === '') {
                    document.getElementById('namemessage').innerHTML = "Enter Name ";
                    setTimeout(() => {
                        document.getElementById('namemessage').innerHTML = "";
                    }, 3000);
                    return
                }

                let emailmessage = document.getElementById('emailmessage');
                if (vcard1email === '') {
                    emailmessage.innerHTML = "<span style='color:red'>Enter Email</span>";
                    setTimeout(() => {
                        emailmessage.innerHTML = "";
                    }, 3000);
                    return
                }

                let filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if (!filter.test(vcard1email)) {
                    emailmessage.innerHTML = "<span style='color:red'>Invalid email address</span>";
                    setTimeout(() => {
                        emailmessage.innerHTML = "";
                    }, 3000);
                    return
                }



                if (vcard1phone.trim() === '') {
                    document.getElementById('phonemessage').innerHTML = "Enter phone number";
                    setTimeout(() => {
                        document.getElementById('phonemessage').innerHTML = "";
                    }, 3000);
                    return
                } else {
                    const numericValue = vcard1phone.replace(/\D/g, ''); // Remove non-digits
                    if (numericValue.length !== 10) {
                        document.getElementById('phonemessage').innerHTML = "Enter 10 digit phone number";
                        setTimeout(() => {
                            document.getElementById('phonemessage').innerHTML = "";
                        }, 3000);
                        return
                    }
                }

                if (message === '') {
                    document.getElementById('publicmessage').innerHTML = "Enter Message";
                    setTimeout(() => {
                        document.getElementById('publicmessage').innerHTML = "";
                    }, 3000);
                    return
                }

                $.ajax({
                    url: '{{ route('AddFormVcardEmail.post', ['fromEmail' => '__fromEmailValue__']) }}'
                        .replace('__fromEmailValue__', encodeURIComponent(ToEmail)),
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                            .getAttribute(
                                'content')
                    },
                    data: JSON.stringify({
                        name: vcard1name,
                        fromEmail: vcard1email,
                        phone_number: vcard1phone,
                        message: message,
                    }),
                    success: function(data) {
                        console.log(data.data);
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
                                document.getElementById('Edit_message_notffound')
                                    .innerHTML = "";
                            }, 3000);
                        } else {
                            document.getElementById('Edit_message_five').innerHTML =
                                "<div class='alert alert-danger'>" + data.message + "</div>";
                            setTimeout(() => {
                                document.getElementById('Edit_message_five').innerHTML =
                                    "";
                            }, 3000);
                        }
                    }
                });
            });

            function changeform() {
                document.getElementById('vcard1name').addEventListener('input', function() {
                    let namemessage = document.getElementById('namemessage');
                    namemessage.innerHTML = "";
                });

                document.getElementById('vcard1email').addEventListener('input', () => {
                    document.getElementById('emailmessage').innerHTML = "";
                })

                document.getElementById('vcard1phone').addEventListener('input', () => {
                    document.getElementById('phonemessage').innerHTML = "";
                })

                document.getElementById('message').addEventListener('input', () => {
                    document.getElementById('publicmessage').innerHTML = "";
                })
            }
        });
    </script> --}}
    <script>
        const shareButtons = document.querySelectorAll('.share-button');
        shareButtons.forEach(button => {
            button.addEventListener('click', () => {
                const url = window.location.href;
                const platform = button.classList[1];
                let shareUrl;
                switch (platform) {
                    case 'facebook':
                        shareUrl =
                            `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`;
                        break;
                    case 'instagram':
                        shareUrl = `https://instagram.com/share?url=${encodeURIComponent(url)}`;
                        break;

                    case 'youtube':
                        shareUrl = `https://youtube.com/share?url=${encodeURIComponent(url)}`;
                        break;

                    case 'linkedin':
                        shareUrl = `https://www.linkedin.com/shareArticle?url=${encodeURIComponent(url)}`;
                        break;
                    case 'whatsapp':
                        shareUrl = `https://api.whatsapp.com/send?text=${encodeURIComponent(url)}`;
                        break;
                }
                // Open a new window to share the URL
                window.open(shareUrl, '_blank');
            });
        });
    </script>

    <script>
        function myFunction() {
            const url = window.location.href;
            const copyText = document.createElement("textarea");
            copyText.value = url;
            document.body.appendChild(copyText);
            copyText.select();
            document.execCommand("copy");
            document.body.removeChild(copyText);
            alert("Copied the URL: " + url);
        }
    </script>

</body>


</html>
