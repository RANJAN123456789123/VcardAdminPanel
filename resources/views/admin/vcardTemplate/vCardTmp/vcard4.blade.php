<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link href="{{ asset('front/css/bootstrap.min.css') }}" rel="stylesheet">

    <title>Vcard4</title>

    {{-- css link --}}
    <link rel="stylesheet" href="{{ asset('assets/css/vcard4.css') }}">

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
        <div class="main-content vcard w-100 mx-auto">
            <div class="d-flex justify-content-end mt-4">
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
            <div class="vcard__banner w-100">
                <img src="{{ asset('assets/img/vcard3/vcard3-banner.png') }}" alt="banner" />
            </div>
            {{-- profile details --}}
            <div class="vcard__profile d-flex align-items-center px-4 flex-sm-row flex-column">
                <div class="vcard__avatar">
                    @php
                        $profilePic = isset($getuser->profile_pic) ? asset('admin/uploads/users/' . $getuser->profile_pic) : asset('img/No_image_available.svg');
                    @endphp
                    <img src="{{ $profilePic }}" alt="profile-img" class="rounded-circle" />
                </div>
                <div class="vcard__position d-flex flex-column mx-4 mt-sm-5 mt-2">
                    <div class="d-flex flex-column">
                        <span
                            class="avatar-name fw-bold text-sm-start text-center">{{ isset($getuser->name) ? $getuser->name : 'NA' }}</span>
                        <span
                            class="avatar-designation text-sm-start text-center">{{ isset($getuser->designation) ? $getuser->designation : 'NA' }}</span>
                    </div>

                    <div class="vcard__social d-flex mt-3">
                        <span class="icons rounded-circle d-flex justify-content-center align-items-center my-2 me-2">
                            <a href="https://www.facebook.com"><i class="fab fa-facebook facebook-icon icon"></i></a>
                        </span>
                        <span class="icons rounded-circle d-flex justify-content-center align-items-center m-2">
                            <a href="https://www.instagram.com"><i
                                    class="fab fa-instagram instagram-icon icon "></i></a>
                        </span>
                        <span class="icons rounded-circle d-flex justify-content-center align-items-center m-2">
                            <a href="https://www.linkedin.com"><i
                                    class="fab fa-linkedin-in linkedin-icon icon "></i></a>
                        </span>
                        <span class="icons rounded-circle d-flex justify-content-center align-items-center my-2 ms-2">
                            <a href="https://www.whatsapp.com"><i class="fab fa-whatsapp whatsapp-icon icon "></i></a>
                        </span>
                        <span class="icons rounded-circle d-flex justify-content-center align-items-center my-2 ms-2">
                            <a href="https://www.twitter.com"><i class="fab fa-twitter twitter-icon icon"></i></a>
                        </span>
                    </div>
                </div>
            </div>
            {{-- details --}}
            <div class="px-4 my-3">
                <div class="vcard__event">
                    <div class="row py-4 g-3">
                        <div class="col-sm-6 col-12">
                            <div
                                class="card vcard__event-card d-flex flex-column justify-content-center align-items-center border-0 p-3 h-100">
                                <span class="event-icon">
                                    <img src="{{ asset('assets/img/vcard4/email.png') }}" class="img-fluid">
                                </span>
                                <span
                                    class="event-name pt-2">{{ isset($getuser->email) ? $getuser->email : 'NA' }}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div
                                class="card vcard__event-card d-flex flex-column justify-content-center align-items-center border-0 p-3 h-100">
                                <span class="event-icon">
                                    <img src="{{ asset('assets/img/vcard4/birthday.png') }}" class="img-fluid">
                                </span>
                                <span class="event-name pt-2">{{ isset($getuser->DOB) ? $getuser->DOB : 'NA' }}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div
                                class="card vcard__event-card d-flex flex-column justify-content-center align-items-center border-0 p-3 h-100">
                                <span class="event-icon">
                                    <img src="{{ asset('assets/img/vcard4/mobile.png') }}" class="img-fluid">
                                </span>
                                <span
                                    class="event-name pt-2">{{ isset($getuser->phone_number) ? $getuser->phone_number : 'NA' }}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div
                                class="card vcard__event-card d-flex flex-column justify-content-center align-items-center border-0 p-3 h-100">
                                <span class="event-icon">
                                    <img src="{{ asset('assets/img/vcard4/location.png') }}" class="img-fluid">
                                </span>
                                <span
                                    class="event-name pt-2">{{ isset($getuser->location) ? $getuser->location : 'NA' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Appointment --}}
            {{-- <div class="vcard__appointment py-3">
                <h4 class="vcard__heading heading-line text-center pb-4 position-relative">Make an Appointment</h4>
                <div class="container">
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
                        <button type="button" class="appoint-btn text-white mt-4 d-block mx-auto">Make an
                            Appointment
                        </button>
                    </div>
                </div>
            </div> --}}

            {{-- our services --}}
            <div class="my-4 px-4 pb-2 position-relative overflow-hidden">
                <div class="line-shape position-absolute">
                    <span class="inner-circle position-absolute rounded-circle"></span>
                </div>
                <div class="vcard__service">
                    <h4 class="vcard__heading text-center pb-3">OUR SERVICES</h4>
                    <div class="container mt-4">
                        <div class="row g-4 justify-content-center">
                            <div class="col-sm-6 service-container">
                                <div class="card service-card h-100 border-0">
                                    <div
                                        class="service-image rounded-circle d-flex justify-content-center align-items-center mx-auto">
                                        <img
                                            src="{{ isset($getuser->icon1) ? asset('our_services/' . $getuser->icon1) : asset('img/No_image_available.svg') }}" />
                                    </div>
                                    <div class="service-details d-flex flex-column">
                                        <h4 class="mt-3 text-center">
                                            {{ isset($getuser->title1) ? $getuser->title1 : 'NA' }}</h4>
                                        <p class="mb-0 text-center">
                                            {{ isset($getuser->description1) ? $getuser->description1 : 'NA' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 service-container">
                                <div class="card service-card h-100 border-0">
                                    <div
                                        class="service-image rounded-circle d-flex justify-content-center align-items-center mx-auto">
                                        <img
                                            src="{{ isset($getuser->icon2) ? asset('our_services/' . $getuser->icon2) : asset('img/No_image_available.svg') }}" />
                                    </div>
                                    <div class="service-details d-flex flex-column">
                                        <h4 class="mt-3 text-center">
                                            {{ isset($getuser->title2) ? $getuser->title2 : 'NA' }}</h4>
                                        <p class="mb-0 text-center">
                                            {{ isset($getuser->description2) ? $getuser->description2 : 'NA' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- gallery --}}
            <div class="pt-4 px-4">
                <div class="vcard__gallery">
                    <h4 class="vcard__heading text-center pb-2">Gallery</h4>
                    <div class="container mt-4 py-3">
                        <div class="row g-4 justify-content-center gallery-slider">
                            <div class="col-6">
                                <div class="card gallery-card h-100 border-0 w-100">
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
                                <div class="card gallery-card h-100 border-0 w-100">
                                    <div class="gallery-profile">
                                        <img src="{{ isset($getuser->galleryImage) ? asset('Gallery/' . $getuser->galleryImage) : asset('img/No_image_available.svg') }}"
                                            alt="icon1" class="w-100" />
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

            {{-- Product --}}
            <div class="pt-4 px-4">
                <div class="vcard__product">
                    <h4 class="vcard__heading text-center pb-2">PRODUCTS</h4>
                    <div class="container mt-4 py-3">
                        <div class="row g-4 justify-content-center product-slider">
                            <div class="col-6">
                                <div class="card product-card h-100 border-0 w-100">
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
                                <div class="card product-card h-100 border-0 w-100">
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
            </div>

            {{-- Testimonial --}}
            <div class="pt-4 px-4">
                <div class="vcard__testimonial">
                    <h4 class="vcard__heading text-center pb-2">TESTIMONIAL</h4>
                    <div class="container mt-4 py-3">
                        <div class="row g-4 justify-content-center testimonial-slider">
                            <div class="col-6">
                                <div class="card testimonial-card h-100 border-0 w-100">
                                    <img src="{{ isset($getuser->testmonial1) ? asset('productGallery/' . $getuser->testmonial1) : '' }}"
                                        class="testimonial-image d-block mx-auto" />
                                    <div class="testimonial-details d-flex flex-column">
                                        <p class="mb-0 text-center pt-3">
                                            {{ isset($getuser->testimonialDescription1) ? $getuser->testimonialDescription1 : 'NA' }}
                                        </p>
                                    </div>

                                    <div
                                        class="testimonial-user d-flex justify-content-center flex-column align-center mt-3">
                                        <h5 class="user-name text-center position-relative mt-2">
                                            {{ isset($getuser->testimonial_title1) ? $getuser->testimonial_title1 : 'NA' }}
                                        </h5>
                                        <span
                                            class="user-designation text-center">{{ isset($getuser->subtitle1) ? $getuser->subtitle1 : 'NA' }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card testimonial-card h-100 border-0 w-100">
                                    <img src="{{ isset($getuser->testmonial2) ? asset('productGallery/' . $getuser->testmonial2) : '' }}"
                                        class="testimonial-image d-block mx-auto" />
                                    <div class="testimonial-details d-flex flex-column">
                                        <p class="mb-0 text-center pt-3">
                                            {{ isset($getuser->testimonialDescription2) ? $getuser->testimonialDescription2 : 'NA' }}
                                        </p>
                                    </div>

                                    <div
                                        class="testimonial-user d-flex justify-content-center flex-column align-center mt-3">
                                        <h5 class="user-name text-center position-relative mt-2">
                                            {{ isset($getuser->testimonial_title2) ? $getuser->testimonial_title2 : 'NA' }}
                                        </h5>
                                        <span
                                            class="user-designation text-center">{{ isset($getuser->subtitle2) ? $getuser->subtitle2 : 'NA' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- QR code --}}
            <div class="vcard__qr-code">
                <div class="px-4 pt-5 pb-4">
                    <h4 class="vcard__heading text-center pb-5">QR CODE</h4>
                    <div class="qr-code d-block mx-auto position-relative px-5 pt-5 pb-3">
                        <img id="qrCodeImage" src="{{ asset('qr_codes/' . (isset($qrcode) ? $qrcode : 'NA')) }}"
                            alt="qr code" />

                        <div class="qr-code-image d-flex justify-content-center">
                            <img id="qrCodeImage" src="{{ asset('qr_codes/' . (isset($qrcode) ? $qrcode : 'NA')) }}"
                                alt="qr code" />
                        </div>
                    </div>
                    <button type="button" class="qr-code-btn text-white mt-4 d-block mx-auto"
                        onclick="downloadQRCode()">Download My QR Code</button>
                </div>
            </div>

            {{-- Business hour --}}
            {{-- <div class="vcard__timing pt-5 pb-4">
                <div class="px-4">
                    <h4 class="vcard__heading text-center pb-4">BUSINESS HOURS</h4>
                    <div class="row">
                        <div class="col-sm-6 col-12 week-time mb-2">
                            <span>Sunday :</span>
                            <span>08:10 - 20:00</span>
                        </div>
                        <div class="col-sm-6 col-12 week-time mb-2">
                            <span>Monday :</span>
                            <span>08:10 - 20:00</span>
                        </div>
                        <div class="col-sm-6 col-12 week-time mb-2">
                            <span>Tuesday :</span>
                            <span>08:10 - 20:00</span>
                        </div>
                        <div class="col-sm-6 col-12 week-time mb-2">
                            <span>Wednesday :</span>
                            <span>08:10 - 20:00</span>
                        </div>
                        <div class="col-sm-6 col-12 week-time mb-2">
                            <span>Thursday :</span>
                            <span>08:10 - 20:00</span>
                        </div>
                        <div class="col-sm-6 col-12 week-time mb-2">
                            <span>Friday :</span>
                            <span>08:10 - 20:00</span>
                        </div>
                        <div class="col-sm-6 col-12 week-time">
                            <span>Saturday :</span>
                            <span>close</span>
                        </div>
                    </div>
                </div>
            </div> --}}
            {{-- contact us --}}
            {{-- <form id="addVcard1" data-get-email="{{ $getuser->email }}">
                @csrf
                <div class="vcard__contact-us pb-5 pt-4">
                    <div class="px-4">
                        <h4 class="vcard__heading text-center pb-4">CONTACT US</h4>

                        <h6 id="Edit_message"></h6>
                        <h6 id="Edit_message_five"></h6>
                        <h6 id="Edit_message_notffound"></h6>

                        <div class="contact-form px-sm-5">
                            <div class="mb-3">
                                <span id="namemessage"></span>
                                <input type="text" class="form-control border-start-0" placeholder="Full Name"
                                    id="vcard1name">
                            </div>
                            <div class="mb-3">
                                <span id="emailmessage"></span>
                                <input type="email" class="form-control border-start-0"
                                placeholder="E-mail Address" id="vcard1email">
                            </div>
                            <div class="mb-3">
                                <span id="phonemessage"></span>
                                <input type="number" placeholder="Mobile Number" class="form-control border-start-0"
                                    id="vcard1phone">
                            </div>
                            <div class="mb-3">
                                <span id="publicmessage"></span>
                                <textarea class="form-control" placeholder="Type a message here..." id="message" rows="5"></textarea>
                            </div>
                            <button type="submit" class="contact-btn text-white mt-4 d-block mx-auto">Send
                                Message</button>
                        </div>
                    </div>
                    <div class="d-sm-flex justify-content-center mt-5">
                        <button type="submit" class="vcard-four-btn text-white mt-4 d-block" id="addToContact">
                            <i class="fas fa-download me-2"></i> Download Vcard
                        </button>

                        <button type="button" class="share-btn text-white d-block btn mt-4 ms-sm-4">
                            <a href="#" class="text-white text-decoration-none">
                                <i class="fas fa-share-alt me-2"></i> Share</a>
                        </button>
                    </div>
                </div>
            </form> --}}
            <div class="d-sm-flex justify-content-center mt-5">
                <button type="submit" class="vcard-four-btn text-white mt-4 d-block" id="addToContact">
                    <i class="fas fa-download me-2"></i> Download Vcard
                </button>
                {{-- share btn --}}
                <button type="button" class="share-btn text-white d-block btn mt-4 ms-sm-4">
                    <a href="#" class="text-white text-decoration-none">
                        <i class="fas fa-share-alt me-2"></i> Share</a>
                </button>
            </div>
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
            speed: 300,
            arrows: false,
            slidesToShow: 2,
            slidesToScroll: 1,
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
