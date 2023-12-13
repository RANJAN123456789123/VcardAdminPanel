<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link href="{{ asset('front/css/bootstrap.min.css') }}" rel="stylesheet">

    <title>Vcard7</title>

    {{-- css link --}}
    <link rel="stylesheet" href="{{ asset('assets/css/vcard7.css') }}">

    {{-- font awesome --}}
    <link href="{{ asset('backend/css/all.min.css') }}" rel="stylesheet">

    {{-- slick slider --}}
    <link rel="stylesheet" href="{{ asset('backend/css/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/slick/slick-theme.css') }}">

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
    <div class="container main-section">
        <div class="row d-flex justify-content-center">
            <div class="main-bg p-0">
                <div class="d-flex justify-content-end">
                    <div class="language pt-3 me-2">
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
                                        <img src="{{ asset('assets/img/vcard1/spain.png') }}" width="25px"
                                            height="20px" class="me-3"><a href="#">Spanish</a>
                                    </li>
                                    <li>
                                        <img src="{{ asset('assets/img/vcard1/france.png') }}" width="25px"
                                            height="20px" class="me-3"><a href="#">Franch</a>
                                    </li>
                                    <li>
                                        <img src="{{ asset('assets/img/vcard1/arabic.svg') }}" width="25px"
                                            height="20px" class="me-3"><a href="#">Arabic</a>
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
                <div>
                    <img src="{{ asset('assets/img/vcard7/bannerimg.png') }}" class="banner-img" />
                </div>
                <div class="container">
                    <div class="main-profile">
                        <div class="profile-img py-3">
                            <div class="mb-4">
                                <div class="d-flex align-items-center mb-4">
                                    <div class="vcard_eight">
                                        @php
                                            $profilePic = isset($getUserData->profile_pic) ? asset('admin/uploads/users/' . $getUserData->profile_pic) : asset('img/No_image_available.svg');
                                        @endphp
                                        <img src="{{ $profilePic }}" alt="profile-img" class="rounded-circle" />

                                        <div class="vcard-eight_block">
                                            <div class="d-flex flex-column">
                                                <span
                                                    class="vcard-eight-heading fw-bold text-white text-sm-start text-center">{{ isset($getuser->name) ? $getuser->name : 'NA' }}</span>
                                                <span
                                                    class="avatar-designation text-white text-sm-start text-center">{{ isset($getuser->designation) ? $getuser->designation : 'NA' }}</span>
                                            </div>
                                        </div>
                                        <a href="{{ isset($getUserData->email) ? url('vcard-login/' . $getUserData->id) : url('vcard-register/' . $getUserData->nfc_id) }}"
                                            class="edit_profile_cus btn btn-primary" style="text-decoration: auto;"> <i
                                                class="fas fa-pencil"></i> <span><b>Edit</b></span> </a>
                                    </div>
                                    <div class="ms-3">
                                        <h3 class="big-title">
                                            {{ isset($getUserData->name) ? $getUserData->name : 'NA' }}</h3>
                                        <p class="small-title mb-0">
                                            {{ isset($getUserData->designation) ? $getUserData->designation : 'NA' }}
                                        </p>

                                    </div>
                                </div>

                                <div class="social-section mb-4">
                                    <div class="container px-md-5">
                                        <div class="social-icon d-flex justify-content-center">
                                            <div class="pro-icon me-md-3">
                                                <a href="{{ isset($getUserData->websiteURL) ? 'https://' . $getUserData->websiteURL : 'https://www.google.com' }}"
                                                    target="_blank">
                                                    <i class="fas fa-globe icon fa-2x" title="Website"></i></a>
                                            </div>
                                            <div class="pro-icon mx-md-3">
                                                <a href="{{ isset($getUserData->instagramURL) ? 'https://' . $getUserData->instagramURL : 'https://www.instagram.com' }}"
                                                    target="_blank">
                                                    <i class="fab fa-instagram instagram-icon icon fa-2x"
                                                        title="Instagram"></i></a>
                                            </div>
                                            <div class="pro-icon mx-md-3">
                                                <a href="{{ isset($getUserData->youtubeURL) ? 'https://' . $getUserData->youtubeURL : 'https://www.youtube.com' }}"
                                                    target="_blank">
                                                    <i class="fab fa-youtube youtube-icon icon fa-2x"
                                                        title="Youtube"></i>
                                                </a>
                                            </div>
                                            <div class="pro-icon mx-md-3">
                                                <a href="{{ isset($getUserData->linkedinURL) ? 'https://' . $getUserData->linkedinURL : 'https://www.linkedin.com' }}"
                                                    target="_blank">
                                                    <i class="fab fa-linkedin linkedin-icon icon fa-2x"
                                                        title="Linkedin"></i>
                                                </a>
                                            </div>
                                            <div class="pro-icon ms-md-3">
                                                <a href="{{ isset($getUserData->whatsappURL) ? 'https://' . $getUserData->whatsappURL : 'https://www.whatsapp.com' }}"
                                                    target="_blank">
                                                    <i class="fab fa-whatsapp whatsapp-icon icon fa-2x"
                                                        title="Whatsapp"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 mb-4">
                                    <div class="card border-0 bg-transparent">
                                        <div class="event-icon text-center">
                                            <div>
                                                <img src="{{ asset('assets/img/vcard7/email.png') }}"
                                                    class="img-fluid mb-2" />
                                            </div>
                                            <span class="event-title">E-mail Address</span>
                                            <p class="mb-0 event-text">
                                                {{ isset($getUserData->email) ? $getUserData->email : 'NA' }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 mb-4">
                                    <div class="card border-0 bg-transparent">
                                        <div class="event-icon text-center">
                                            <div>
                                                <img src="{{ asset('assets/img/vcard7/phone.png') }}"
                                                    class="img-fluid mb-2" />
                                            </div>
                                            <span class="event-title">Mobile Number</span>
                                            <p class="mb-0 event-text">
                                                {{ isset($getUserData->phone_number) ? $getUserData->phone_number : 'NA' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 mb-4">
                                    <div class="card border-0 bg-transparent">
                                        <div class="event-icon text-center">
                                            <div>
                                                <img src="{{ asset('assets/img/vcard7/cake.png') }}"
                                                    class="img-fluid mb-2" />
                                            </div>
                                            <span class="event-title">Date of Birth</span>
                                            <p class="mb-0 event-text">
                                                {{ isset($getUserData->DOB) ? $getUserData->DOB : 'NA' }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 mb-4">
                                    <div class="card border-0 bg-transparent">
                                        <div class="event-icon text-center">
                                            <div>
                                                <img src="{{ asset('assets/img/vcard7/location.png') }}"
                                                    class="img-fluid mb-2" />
                                            </div>
                                            <span class="event-title">Location</span>
                                            <p class="mb-0 event-text">
                                                {{ isset($getUserData->location) ? $getUserData->location : 'NA' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Appointment --}}
                {{-- <div class="container py-3 mb-4">
                    <h2 class="appointment-heading mb-4 position-relative text-center">Make an Appointment</h2>
                    <div class="appointment">
                        <div class="row d-flex align-items-center justify-content-center mb-3">
                            <div class="col-md-2">
                                <label for="date" class="me-4 appoint-date mb-2">Date</label>
                            </div>
                            <div class="col-md-10">
                                <input id="myID" type="text" class="appoint-input"
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

                        <button type="button" class="appoint-btn mt-4 d-block mx-auto btn btn-lg">Make an Appointment
                        </button>
                    </div>
                </div> --}}

                {{-- our services --}}
                <div class="vcard-nine__service py-4 px-3 position-relative px-sm-3">
                    <h4 class="heading-left heading-line position-relative text-center">OUR SERVICES</h4>
                    <div class="container mt-5">
                        <div class="row service-row g-4">
                            <div class="col-12">
                                <div
                                    class="card service-card h-100 w-100 p-3 border-0 d-flex align-items-center flex-sm-row">
                                    <div
                                        class="service-image rounded-circle d-flex justify-content-center align-items-center justify-content-center">
                                        <img src="{{ isset($getUserData->icon1) ? asset('our_services/' . $getUserData->icon1) : asset('img/No_image_available.svg') }}"
                                            alt="service" />
                                    </div>
                                    <div class="service-details ms-sm-3 mt-sm-0 mt-3">
                                        <h4 class="service-title text-sm-start text-center">
                                            {{ isset($getUserData->title1) ? $getUserData->title1 : 'NA' }}</h4>
                                        <p class="service-paragraph mb-0 text-sm-start text-center">
                                            {{ isset($getUserData->description1) ? $getUserData->description1 : 'NA' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div
                                    class="card service-card h-100 w-100 p-3 border-0 d-flex align-items-center flex-sm-row">
                                    <div
                                        class="service-image rounded-circle d-flex justify-content-center align-items-center justify-content-center">
                                        <img src="{{ isset($getUserData->icon2) ? asset('our_services/' . $getUserData->icon2) : asset('img/No_image_available.svg') }}"
                                            alt="service" />
                                    </div>
                                    <div class="service-details ms-sm-3 mt-sm-0 mt-3">
                                        <h4 class="service-title text-sm-start text-center">
                                            {{ isset($getUserData->title2) ? $getUserData->title2 : 'NA' }}</h4>
                                        <p class="service-paragraph mb-0 text-sm-start text-center">
                                            {{ isset($getUserData->description2) ? $getUserData->description2 : 'NA' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- gallery --}}
                <div class="vcard-nine__gallery py-4 px-3 position-relative px-sm-3">
                    <h4 class="heading-right heading-line position-relative text-center">GALLERY</h4>
                    <div class="container">
                        <div class="row g-3 gallery-slider mt-4">
                            <div class="col-6">
                                <div class="card gallery-card p-3 border-0 w-100">
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
                            <div class="col-6">
                                <div class="card gallery-card p-3 border-0 w-100">
                                    <div class="gallery-profile">
                                        <img src="{{ isset($getUserData->galleryImage) ? asset('Gallery/' . $getUserData->galleryImage) : asset('img/No_image_available.svg') }}"
                                            alt="icon1" class="w-100" />
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

                {{-- product --}}

                <div class="vcard-nine__product py-4 px-3 position-relative px-sm-3">
                    <h4 class="heading-left heading-line position-relative text-center">PRODUCTS</h4>
                    <div class="container">
                        <div class="row g-3 product-slider mt-4">
                            <div class="col-6">
                                <div class="card product-card p-3 border-0 w-100">
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
                                            class="text-black">${{ isset($getUserData->productprice1) ? $getUserData->productprice1 : 'NA' }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card product-card p-3 border-0 w-100">
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
                                        <span
                                            class="text-black">${{ isset($getUserData->productprice2) ? $getUserData->productprice2 : 'NA' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- testimonial --}}
                <div class="vcard-nine__testimonial py-4 px-3 position-relative px-sm-3">
                    <h4 class="heading-right heading-line position-relative text-center">TESTIMONIAL</h4>
                    <div class="container">
                        <div class="row g-3 testimonial-slider mt-4">
                            <div class="col-12">
                                <div class="card testimonial-card p-3 border-0 w-100">
                                    <div
                                        class="testimonial-user d-flex flex-sm-row flex-column align-items-center justify-content-sm-start justify-content-center">
                                        <img src="{{ isset($getUserData->testmonial1) ? asset('testmonial/' . $getUserData->testmonial1) : '' }}"
                                            alt="profile" class="rounded-circle" />
                                        <div class="user-details d-flex flex-column ms-sm-3 mt-sm-0 mt-2">
                                            <span
                                                class="user-name text-sm-start text-center">{{ isset($getUserData->testimonial_title1) ? $getUserData->testimonial_title1 : 'NA' }}</span>
                                            <span
                                                class="user-designation text-sm-start text-center">{{ isset($getUserData->subtitle1) ? $getUserData->subtitle1 : 'NA' }}</span>
                                        </div>

                                    </div>
                                    <p class="review-message mb-2 text-sm-start text-center mt-2">
                                        {{ isset($getUserData->testimonialDescription1) ? $getUserData->testimonialDescription1 : 'NA' }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="card testimonial-card p-3 border-0 w-100">
                                    <div
                                        class="testimonial-user d-flex flex-sm-row flex-column align-items-center justify-content-sm-start justify-content-center">
                                        <img src="{{ isset($getUserData->testmonial2) ? asset('testmonial/' . $getUserData->testmonial2) : '' }}"
                                            alt="profile" class="rounded-circle" />
                                        <div class="user-details d-flex flex-column ms-sm-3 mt-sm-0 mt-2">
                                            <span
                                                class="user-name text-sm-start text-center">{{ isset($getUserData->testimonial_title2) ? $getUserData->testimonial_title2 : 'NA' }}</span>
                                            <span
                                                class="user-designation text-sm-start text-center">{{ isset($getUserData->subtitle2) ? $getUserData->subtitle2 : 'NA' }}</span>
                                        </div>

                                    </div>
                                    <p class="review-message mb-2 text-sm-start text-center mt-2">
                                        {{ isset($getUserData->testimonialDescription2) ? $getUserData->testimonialDescription2 : 'NA' }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="card testimonial-card p-3 border-0 w-100">
                                    <div
                                        class="testimonial-user d-flex flex-sm-row flex-column align-items-center justify-content-sm-start justify-content-center">
                                        <img src="{{ isset($getUserData->testmonial3) ? asset('productGallery/' . $getUserData->testmonial3) : '' }}"
                                            alt="profile" class="rounded-circle" />
                                        <div class="user-details d-flex flex-column ms-sm-3 mt-sm-0 mt-2">
                                            <span
                                                class="user-name text-sm-start text-center">{{ isset($getUserData->testimonial_title3) ? $getUserData->testimonial_title3 : 'NA' }}</span>
                                            <span
                                                class="user-designation text-sm-start text-center">{{ isset($getUserData->subtitle3) ? $getUserData->subtitle3 : 'NA' }}</span>
                                        </div>

                                    </div>
                                    <p class="review-message mb-2 text-sm-start text-center mt-2">
                                        {{ isset($getUserData->testimonialDescription3) ? $getUserData->testimonialDescription3 : 'NA' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Qrcode --}}
                {{-- <div class="container mt-4 mb-5">
                    <div class="main-Qr-section mb-5">
                        <div class="qr-header-title">
                            <h3 class="mb-4 text-center">QR Code</h3>
                        </div>
                        <div class="row d-flex align-items-center">
                            <div class="col-lg-6">
                                <div class="text-center mb-4">
                                    <img id="qrCodeImage"
                                        src="{{ asset('qr_codes/' . (isset($qrcode) ? $qrcode : 'NA')) }}"
                                        alt="qr code" />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="text-center">
                                    <div class="qr-section">
                                        <img id="qrCodeImage"
                                            src="{{ asset('qr_codes/' . (isset($qrcode) ? $qrcode : 'NA')) }}"
                                            alt="qr code" />
                                    </div>
                                    <div class="mt-4">
                                        <button type="button" class="qr-code-btn text-white mt-4 d-block mx-auto"
                                            onclick="downloadQRCode()">Download My QR Code</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

                {{-- business hour --}}

                {{-- <div class="container">
                    <div class="business-main-section">
                        <h3 class="text-center mb-4">Business Hour</h3>
                        <div class="row d-flex justify-content-center">
                            <div class="col-sm-8">
                                <div class="hour-info text-center">
                                    <div class="business-day mb-3">
                                        <p class="mb-0">Sunday : 08:10 - 20:00</p>
                                    </div>
                                    <div class="business-day mb-3">
                                        <p class="mb-0">Monday : 08:10 - 20:00</p>
                                    </div>
                                    <div class="business-day mb-3">
                                        <p class="mb-0">Tuesday : 08:10 - 20:00</p>
                                    </div>
                                    <div class="business-day mb-3">
                                        <p class="mb-0">Wednesday : 08:10 - 20:00</p>
                                    </div>
                                    <div class="business-day mb-3">
                                        <p class="mb-0">Thursday : 08:10 - 20:00</p>
                                    </div>
                                    <div class="business-day mb-3">
                                        <p class="mb-0">Friday : 08:10 - 20:00</p>
                                    </div>
                                    <div class="business-day mb-3">
                                        <p class="mb-0">Saturday : Closed</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                {{-- <form id="addVcard1" data-get-email="{{ $getUserDataData->email }}">
                    @csrf

                    <div class="container mt-3 mb-3">
                        <div class="contactus-section position-relative">
                            <h3 class="text-center mb-4">Contact Us</h3>

                            <h6 id="Edit_message"></h6>
                            <h6 id="Edit_message_five"></h6>
                            <h6 id="Edit_message_notffound"></h6>

                            <div class="main-contact">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <label for="basic-url" class="form-label mb-0">Your Name</label>
                                            <span id="namemessage"></span>
                                            <div class="col-12 mb-3 input-group">
                                                <span class="input-group-text contact-icon bg-transparent border-end-0"
                                                    id="basic-addon1"><i class="far fa-user"></i></span>
                                                <input type="text" class="form-control border-start-0"
                                                    placeholder="Full Name" id="vcard1name">
                                            </div>

                                            <label for="basic-url" class="form-label mb-0">E-mail</label>
                                            <span id="emailmessage"></span>
                                            <div class="col-12 mb-3 input-group">
                                                <span class="input-group-text contact-icon border-end-0 bg-transparent"
                                                    id="basic-addon1"><i class="far fa-envelope"></i></span>
                                                <input type="email" class="form-control border-start-0"
                                                    placeholder="E-mail Address" id="vcard1email">
                                            </div>

                                            <label for="inputAddress" class="form-label mb-0">Phone</label>
                                            <span id="phonemessage"></span>
                                            <div class="col-12 mb-3 input-group">
                                                <span class="input-group-text contact-icon border-end-0 bg-transparent"
                                                    id="basic-addon1"><i class="fas fa-phone"></i></span>
                                                <input type="number" placeholder="Mobile Number"
                                                    class="form-control border-start-0" id="vcard1phone">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="row">
                                            <div class="col-12 mb-3">
                                                <label for="exampleFormControlTextarea1" class="form-label mb-0">Your
                                                    Message</label>
                                                    <span id="publicmessage"></span>
                                                    <textarea class="form-control" placeholder="Type a message here..." id="message" rows="5"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-center mt-3">
                                        <button type="submit" class="btn contact-btn px-4">Send Message</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </form> --}}

                <div class="d-sm-flex justify-content-center mt-5">
                    <button type="submit" class="vcard-one-btn text-black d-block mb-sm-0 mb-3"
                        onclick="downloadQRCode()">
                        <i class="fas fa-download me-2"></i>Qr code
                    </button>
                    <button type="submit" class="vcard-one-btn text-black d-block mb-sm-0 mb-3" id="addToContact">
                        <i class="fas fa-download me-2"></i> Download Vcard
                    </button>
                    {{-- share btn --}}
                    <button type="button" class="share-btn d-block btn mt-4 ms-sm-3" data-toggle="modal"
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
                                                    <i class="fab fa-youtube youtube-icon icon fa-2x"
                                                        title="Youtube"></i>
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
                                                <button onclick="myFunction()"><i
                                                        class="fa-solid fa-copy"></i></button>
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
        $('.testimonial-vcard').slick({
            dots: true,
            infinite: true,
            speed: 300,
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            autoplay: true,
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
        $('.product-vcard').slick({
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
        $('.gallery-vcard').slick({
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


</body>

</html>
