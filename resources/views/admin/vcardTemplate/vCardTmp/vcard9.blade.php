<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link href="{{ asset('front/css/bootstrap.min.css') }}" rel="stylesheet">

    {{-- css link --}}
    <link rel="stylesheet" href="{{ asset('assets/css/vcard9.css') }}">

    {{-- font awesome --}}
    <link href="{{ asset('backend/css/all.min.css') }}" rel="stylesheet">

    {{-- slick slider --}}
    <link rel="stylesheet" href="{{ asset('backend/css/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/slick/slick-theme.css') }}">

    {{-- google Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&family=Roboto&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <title>Vcard</title>
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
    $profilePic = isset($getuser->profile_pic) ? 'admin/uploads/users/' . $getuser->profile_pic : 'img/No_image_available.svg';

    $profilePic = asset($profilePic);

    // Create an array with user data
    $userData = [
        'name' => isset($getuser->name) ? htmlspecialchars($getuser->name, ENT_QUOTES) : 'N/A',
        'email' => isset($getuser->email) ? htmlspecialchars($getuser->email, ENT_QUOTES) : 'N/A',
        'designation' => isset($getuser->designation) ? htmlspecialchars($getuser->designation, ENT_QUOTES) : 'N/A',
        'phone_number' => isset($getuser->phone_number) ? htmlspecialchars($getuser->phone_number, ENT_QUOTES) : 'N/A',
        'DOB' => isset($getuser->DOB) ? htmlspecialchars($getuser->DOB, ENT_QUOTES) : 'N/A',
        'profile_pic' => $profilePic, // Default photo path or handle missing profile photo
    ];

    $person = $userData;
    ?>
    <div class="container">
        <div class="vcard-nine main-content w-100 mx-auto overflow-hidden">
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
            <div class="vcard-nine__banner w-100 position-relative">
                <img src="{{ asset('assets/img/vcard9/vcard9-banner.png') }}" class="img-fluid banner-image"
                    alt="banner" />
            </div>
            {{-- profile --}}
            <div class="vcard-nine__profile position-relative">
                <div class="avatar position-absolute top-0 start-50 translate-middle">
                    @php
                        $profilePic = isset($getuser->profile_pic) ? asset('admin/uploads/users/' . $getuser->profile_pic) : asset('img/No_image_available.svg');
                    @endphp
                    <img src="{{ $profilePic }}" alt="profile-img" class="rounded-circle" />
                </div>
            </div>
            {{-- profile details --}}
            <div class="vcard-nine__profile-details py-3 px-3">
                <h4 class="profile-name text-center mb-1">{{ isset($getuser->name) ? $getuser->name : 'NA' }}</h4>
                <span
                    class="profile-designation text-center d-block">{{ isset($getuser->designation) ? $getuser->designation : 'NA' }}</span>
                <div class="social-icons d-flex justify-content-center pt-sm-5 pt-4">
                    <span class="rounded-circle d-flex justify-content-center align-items-center me-sm-3 me-1">
                        <a href="https://www.facebook.com"><i class="fab fa-facebook facebook-icon icon"></i></a>
                    </span>
                    <span class="rounded-circle d-flex justify-content-center align-items-center mx-sm-3 mx-1">
                        <a href="https://www.instagram.com"><i class="fab fa-instagram instagram-icon icon"></i></a>
                    </span>
                    <span class="rounded-circle d-flex justify-content-center align-items-center mx-sm-3 mx-1">
                        <a href="https://www.linkedin.com"><i class="fab fa-linkedin-in linkedin-icon icon"></i></a>
                    </span>
                    <span class="rounded-circle d-flex justify-content-center align-items-center mx-sm-3 mx-1">
                        <a href="https://www.whatsapp.com"><i class="fab fa-whatsapp whatsapp-icon icon"></i></a>
                    </span>
                    <span class="rounded-circle d-flex justify-content-center align-items-center ms-sm-3 ms-1">
                        <a href="https://www.twitter.com"><i class="fab fa-twitter twitter-icon icon"></i></a>
                    </span>
                </div>
            </div>
            {{-- event --}}
            <div class="vcard-nine__event py-3 px-3 mt-2 position-relative">
                <div class="container">
                    <div class="row g-3">
                        <div class="col-sm-6 col-12">
                            <div
                                class="card event-card px-3 py-4 h-100 border-0 flex-sm-row flex-column align-items-center">
                                <span class="event-icon d-flex justify-content-center align-items-center">
                                    <img src="{{ asset('assets/img/vcard9/vcard9-email.png') }}" alt="email" />
                                </span>
                                <div class="event-detail ms-sm-3 mt-sm-0 mt-4">
                                    <h6 class="text-sm-start text-center">E-mail address</h6>
                                    <h5 class="event-name text-sm-start text-center mb-0">
                                        {{ isset($getuser->email) ? $getuser->email : 'NA' }}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div
                                class="card event-card px-3 py-4 h-100 border-0 flex-sm-row flex-column align-items-center">
                                <span class="event-icon d-flex justify-content-center align-items-center">
                                    <img src="{{ asset('assets/img/vcard9/vcard9-phone.png') }}" alt="phone" />
                                </span>
                                <div class="event-detail ms-sm-3 mt-sm-0 mt-4">
                                    <h6 class="text-sm-start text-center">Mobile Number</h6>
                                    <h5 class="event-name text-center mb-0">
                                        {{ isset($getuser->phone_number) ? $getuser->phone_number : 'NA' }}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div
                                class="card event-card px-3 py-4 h-100 border-0 flex-sm-row flex-column align-items-center">
                                <span class="event-icon d-flex justify-content-center align-items-center">
                                    <img src="{{ asset('assets/img/vcard9/vcard9-birthday.png') }}" alt="birthday" />
                                </span>
                                <div class="event-detail ms-sm-3 mt-sm-0 mt-4">
                                    <h6 class="text-sm-start text-center">Date of Birth</h6>
                                    <h5 class="event-name text-center mb-0">
                                        {{ isset($getuser->DOB) ? $getuser->DOB : 'NA' }}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div
                                class="card event-card px-3 py-4 h-100 border-0 flex-sm-row flex-column align-items-center">
                                <span class="event-icon d-flex justify-content-center align-items-center">
                                    <img src="{{ asset('assets/img/vcard9/vcard9-location.png') }}" alt="location" />
                                </span>
                                <div class="event-detail ms-sm-3 mt-sm-0 mt-4">
                                    <h6 class="text-sm-start text-center">Location</h6>
                                    <h5 class="event-name text-center mb-0">
                                        {{ isset($getuser->location) ? $getuser->location : 'NA' }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Appointment --}}
            {{-- <div class="vcard-nine__appointment py-3 px-sm-4 px-3 mt-2 position-relative">
                <h4 class="heading-left heading-line position-relative text-center mb-5">Make an Appointment</h4>
                <div class="container">
                    <div class="appointment-card p-3">
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

                        <button type="button" class="appoint-btn text-white mt-4 d-block mx-auto ">Make an
                            Appointment
                        </button>
                    </div>
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
                                    <img src="{{ isset($getuser->icon1) ? asset('our_services/' . $getuser->icon1) : asset('img/No_image_available.svg') }}"
                                        alt="service" />
                                </div>
                                <div class="service-details ms-sm-3 mt-sm-0 mt-3">
                                    <h4 class="service-title text-sm-start text-center">
                                        {{ isset($getuser->title1) ? $getuser->title1 : 'NA' }}</h4>
                                    <p class="service-paragraph mb-0 text-sm-start text-center">
                                        {{ isset($getuser->description1) ? $getuser->description1 : 'NA' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div
                                class="card service-card h-100 w-100 p-3 border-0 d-flex align-items-center flex-sm-row">
                                <div
                                    class="service-image rounded-circle d-flex justify-content-center align-items-center justify-content-center">
                                    <img src="{{ isset($getuser->icon2) ? asset('our_services/' . $getuser->icon2) : asset('img/No_image_available.svg') }}"
                                        alt="service" />
                                </div>
                                <div class="service-details ms-sm-3 mt-sm-0 mt-3">
                                    <h4 class="service-title text-sm-start text-center">
                                        {{ isset($getuser->title2) ? $getuser->title2 : 'NA' }}</h4>
                                    <p class="service-paragraph mb-0 text-sm-start text-center">
                                        {{ isset($getuser->description2) ? $getuser->description2 : 'NA' }}
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
                                                    src="{{ isset($getuser->videoFile) ? asset('videoGallery/' . $getuser->videoFile) : '' }}"
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
                                    <img src="{{ isset($getuser->galleryImage) ? asset('Gallery/' . $getuser->galleryImage) : asset('img/No_image_available.svg') }}"
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
                                    <img src="{{ isset($getuser->productimage1) ? asset('productGallery/' . $getuser->productimage1) : asset('img/No_image_available.svg') }}"
                                        alt="profile" class="w-100" />
                                </div>
                                <div class="product-details mt-3">
                                    <h4>{{ isset($getuser->producttitle1) ? $getuser->producttitle1 : 'NA' }}</h4>
                                    <p class="mb-2">
                                        {{ isset($getuser->productdescription1) ? $getuser->productdescription1 : 'NA' }}
                                    </p>
                                    <span
                                        class="text-black">${{ isset($getuser->productprice1) ? $getuser->productprice1 : 'NA' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card product-card p-3 border-0 w-100">
                                <div class="product-profile">
                                    <img src="{{ isset($getuser->productimage2) ? asset('productGallery/' . $getuser->productimage2) : asset('img/No_image_available.svg') }}"
                                        alt="profile" class="w-100" />
                                </div>
                                <div class="product-details mt-3">
                                    <h4>{{ isset($getuser->producttitle2) ? $getuser->producttitle2 : 'NA' }}</h4>
                                    <p class="mb-2">
                                        {{ isset($getuser->productdescription2) ? $getuser->productdescription2 : 'NA' }}
                                    </p>
                                    <span
                                        class="text-black">${{ isset($getuser->productprice2) ? $getuser->productprice2 : 'NA' }}</span>
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
                                    <img src="{{ isset($getuser->testmonial1) ? asset('productGallery/' . $getuser->testmonial1) : '' }}"
                                        alt="profile" class="rounded-circle" />
                                    <div class="user-details d-flex flex-column ms-sm-3 mt-sm-0 mt-2">
                                        <span
                                            class="user-name text-sm-start text-center">{{ isset($getuser->testimonial_title1) ? $getuser->testimonial_title1 : 'NA' }}</span>
                                        <span
                                            class="user-designation text-sm-start text-center">{{ isset($getuser->subtitle1) ? $getuser->subtitle1 : 'NA' }}</span>
                                    </div>

                                </div>
                                <p class="review-message mb-2 text-sm-start text-center mt-2">
                                    {{ isset($getuser->testimonialDescription1) ? $getuser->testimonialDescription1 : 'NA' }}
                                </p>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card testimonial-card p-3 border-0 w-100">
                                <div
                                    class="testimonial-user d-flex flex-sm-row flex-column align-items-center justify-content-sm-start justify-content-center">
                                    <img src="{{ isset($getuser->testmonial2) ? asset('productGallery/' . $getuser->testmonial2) : '' }}"
                                        alt="profile" class="rounded-circle" />
                                    <div class="user-details d-flex flex-column ms-sm-3 mt-sm-0 mt-2">
                                        <span
                                            class="user-name text-sm-start text-center">{{ isset($getuser->testimonial_title2) ? $getuser->testimonial_title2 : 'NA' }}</span>
                                        <span
                                            class="user-designation text-sm-start text-center">{{ isset($getuser->subtitle2) ? $getuser->subtitle2 : 'NA' }}</span>
                                    </div>

                                </div>
                                <p class="review-message mb-2 text-sm-start text-center mt-2">
                                    {{ isset($getuser->testimonialDescription2) ? $getuser->testimonialDescription2 : 'NA' }}
                                </p>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card testimonial-card p-3 border-0 w-100">
                                <div
                                    class="testimonial-user d-flex flex-sm-row flex-column align-items-center justify-content-sm-start justify-content-center">
                                    <img src="{{ isset($getuser->testmonial3) ? asset('productGallery/' . $getuser->testmonial3) : '' }}"
                                        alt="profile" class="rounded-circle" />
                                    <div class="user-details d-flex flex-column ms-sm-3 mt-sm-0 mt-2">
                                        <span
                                            class="user-name text-sm-start text-center">{{ isset($getuser->testimonial_title3) ? $getuser->testimonial_title3 : 'NA' }}</span>
                                        <span
                                            class="user-designation text-sm-start text-center">{{ isset($getuser->subtitle3) ? $getuser->subtitle3 : 'NA' }}</span>
                                    </div>

                                </div>
                                <p class="review-message mb-2 text-sm-start text-center mt-2">
                                    {{ isset($getuser->testimonialDescription3) ? $getuser->testimonialDescription3 : 'NA' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- qr code --}}
            <div class="vcard-eight__qr-code py-4 position-relative px-sm-4 px-3">
                <h4 class="vcard-eight-heading heading-line position-relative text-center d-block mx-auto pb-3">Qr Code
                </h4>
                <div
                    class="card qr-code-card justify-content-center align-items-center px-sm-3 px-4 pt-5 pb-4 position-relative w-100 mx-auto">
                    <div class="qr-profile mb-3 d-flex justify-content-center position-absolute top-0">
                        <img src="{{ $profilePic }}" alt="qr profile" class="rounded-circle" />
                    </div>
                    <div class="mt-3 qr-code-scanner mx-md-4 mx-2 p-2 bg-white">
                        <img id="qrCodeImage" src="{{ asset('qr_codes/' . (isset($qrcode) ? $qrcode : 'NA')) }}"
                            alt="qr code" />
                    </div>
                    <div class="mx-2">
                        <button type="button" class="qr-code-btn text-dark mt-4 d-block mx-auto"
                            onclick="downloadQRCode()">Download My QR Code</button>
                    </div>
                </div>
            </div>

            {{-- business hour --}}
            {{-- <div class="vcard-nine__timing py-4 px-3 position-relative px-sm-3">
                <h4 class="heading-right position-relative text-center">BUSINESS HOURS</h4>
                <div class="container">
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-8 col-12 time-section p-sm-3 p-2">
                            <div class="d-flex justify-content-center time-zone">
                                <span class="me-2">Sun :</span>
                                <span>08:10 - 20:00</span>
                            </div>
                            <div class="d-flex justify-content-center time-zone">
                                <span class="me-2">Mon :</span>
                                <span>08:10 - 20:00</span>
                            </div>
                            <div class="d-flex justify-content-center time-zone">
                                <span class="me-2">Tue :</span>
                                <span>08:10 - 20:00</span>
                            </div>
                            <div class="d-flex justify-content-center time-zone">
                                <span class="me-2">Wed :</span>
                                <span>08:10 - 20:00</span>
                            </div>
                            <div class="d-flex justify-content-center time-zone">
                                <span class="me-2">Thu :</span>
                                <span>08:10 - 20:00</span>
                            </div>
                            <div class="d-flex justify-content-center time-zone">
                                <span class="me-2">Fri :</span>
                                <span>08:10 - 20:00</span>
                            </div>
                            <div class="d-flex justify-content-center time-zone">
                                <span class="me-2">Sat :</span>
                                <span>08:10 - 20:00</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            {{-- contact us --}}
            {{-- <form id="addVcard1" data-get-email="{{ $getuser->email }}">
                @csrf
                <div class="vcard-nine__contact py-4 px-3 position-relative px-sm-3">
                    <h4 class="heading-left position-relative text-center">CONTACT US</h4>

                    <h6 id="Edit_message"></h6>
                    <h6 id="Edit_message_five"></h6>
                    <h6 id="Edit_message_notffound"></h6>

                    <div class="container mt-5">
                        <div class="row mt-4">
                            <div class="col-12 px-0">
                                <div class="contact-form px-sm-2">
                                    <div class="mb-3">
                                        <span id="namemessage"></span>
                                        <input type="text" class="form-control border-start-0"
                                            placeholder="Full Name" id="vcard1name">
                                    </div>
                                    <div class="mb-3">
                                        <span id="emailmessage"></span>
                                        <input type="email" class="form-control border-start-0"
                                            placeholder="E-mail Address" id="vcard1email">
                                    </div>
                                    <div class="mb-3">
                                        <span id="phonemessage"></span>
                                        <input type="number" placeholder="Mobile Number"
                                            class="form-control border-start-0" id="vcard1phone">
                                    </div>
                                    <div class="mb-3">
                                        <span id="publicmessage"></span>
                                        <textarea class="form-control" placeholder="Type a message here..." id="message" rows="5"></textarea>
                                    </div>
                                    <button type="submit" class="contact-btn text-white mt-4 d-block mx-auto">Send
                                        Message
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-sm-flex justify-content-center mt-5">
                        <button type="submit" class="vcard-nine-btn mt-4 d-block btn text-white" id="addToContact">
                            <i class="fas fa-download me-2"></i> Download Vcard
                        </button>

                        <button type="button" class="share-btn d-block btn mt-4">
                            <a href="#" class="text-decoration-none text-white">
                                <i class="fas fa-share-alt me-2"></i>Share</a>
                        </button>
                    </div>
                </div>
            </form> --}}
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('backend/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('front/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/js/slick.min.js') }}" type="text/javascript"></script>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        $('.testimonial-slider').slick({
            dots: true,
            infinite: true,
            arrows: false,
            autoplay: true,
            speed: 300,
            slidesToShow: 1,
            slidesToScroll: 1
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
        $("#myID").flatpickr();
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
            // Get the QR code image element
            var qrCodeImg = document.getElementById('qrCodeImage');

            // Create an "a" element
            var downloadLink = document.createElement('a');

            // Set the download link attributes
            downloadLink.href = qrCodeImg.src;
            downloadLink.download = '{{ isset($getuser->name) ? $getuser->name : 'NA' }}_qr_code.png';

            // Append the link to the body (for Firefox compatibility)
            document.body.appendChild(downloadLink);

            // Simulate a click on the download link
            downloadLink.click();

            // Remove the link from the body
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
    </script>
</body>

</html>
