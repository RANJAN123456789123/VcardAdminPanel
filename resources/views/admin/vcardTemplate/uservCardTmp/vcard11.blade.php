{{-- {{dd($getUserData)}} --}}

{{-- @php
    $sessiongetid = Session::get('userId');
@endphp --}}


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="description" content="NFC RFID BLUETOOTH TECHNOLOGY">
    <meta name="keywords" content="ACES INVENSYS TECHNOLOGIES">
    <meta property="og:image" content="https://tagtoconnect.com/assets/images/default_cover_image.jpg" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>vcard 11</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    {{-- css link --}}


    <link rel="stylesheet" href="{{ asset('assets/css/vcard11.css') }}">


    <link href="https://tagtoconnect.com/front/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('assets/css/tttvcard8.css') }}">
    <link rel="stylesheet" href="https://tagtoconnect.com/assets/css/slider/css/slick.css">
    <link rel="stylesheet" href="https://tagtoconnect.com/assets/css/slider/css/slick-theme.min.css">
    <link rel="stylesheet" type="text/css" href="https://tagtoconnect.com/assets/css/third-party.css">
    <link rel="stylesheet" type="text/css" href="https://tagtoconnect.com/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="https://tagtoconnect.com/css/plugins.css">
    <link rel="stylesheet" href="https://tagtoconnect.com/assets/css/custom-vcard.css">
    <link rel="stylesheet" href="https://tagtoconnect.com/assets/css/lightbox.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&family=Roboto&display=swap" rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" href="http://tagtoconnect.com/uploads/settings/3/T16x16.png" type="image/png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link href="{{ asset('front/css/bootstrap.min.css') }}" rel="stylesheet">

    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@500&family=PT+Sans:wght@700&family=Poppins:wght@600&family=Roboto&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    {{-- <style>
        body {
            font-family: Roboto;
        }

        .content-blur {
            filter: unset !important;
        }

        .col-sm-12.col-12.cust2 {
            border-radius: 12px;
            padding: 16px 0px;
            background: #2196F3;
        }

        .event-details.custom {
            text-align: center;
        }

        .custom h5 {
            color: #fff;
            font-size: 16px;
        }

        .profile_image {
            position: relative;
        }
    </style> --}}

</head>

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
    <div class="container p-0">
        <div id="passwordModal" class="modal fade" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Enter Password</h5>
                    </div>
                    <form method="POST" action="https://tagtoconnect.com/046052B2826781" accept-charset="UTF-8"
                        id="passwordForm"><input name="_token" type="hidden"
                            value="WLih1zftECMhzfufkytr0s1dqD8c6HY4bC0qPd6u">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-12">

                                    <div class="alert alert-danger d-none" id="passwordError">
                                    </div>
                                    <input class="form-control input-box" required autocomplete="off" id="password"
                                        placeholder="Password" name="password" type="password" value="">
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary submit-btn">Ok</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="vcard-eight main-content w-100 mx-auto overflow-hidden content-blur collapse show allSection">
            <div class="vcard-eight__banner w-100 position-relative">

                <img src="https://tagtoconnect.com/assets/images/default_cover_image.jpg"
                    class="img-fluid banner-image position-relative" alt="banner" />
                <a href="{{ isset($getUserData->email) ? url('vcard-login/' . $getUserData->id) : url('vcard-register/' . $getUserData->nfc_id) }}"
                    class="edit_profile" style=""><i class="fas fa-pencil"></i><span><b>Edit</b></span> </a>
            </div>

            <div>
                <div
                    class="vcard-eight__profile d-flex align-items-center px-4 flex-sm-row flex-column position-relative">
                    <div class="vcard-eight__avatar profile_image">
                        <img src="{{ isset($getUserData->profile_pic) ? asset('admin/uploads/users' . '/' . $getUserData->profile_pic) : 'https://tagtoconnect.com/web/media/avatars/150-26.jpg' }}"
                            class="rounded-circle" />

                    </div>
                    <div class="vcard-eight__position d-flex flex-column mx-4 position-relative">
                        <div class="d-flex flex-column">
                            <h4 class="vcard-eight-heading fw-bold text-sm-start text-center">
                                {{ isset($getUserData->name) ? $getUserData->name : 'Ankit' }}</h4>
                            <span
                                class="avatar-designation text-white text-sm-start text-center p-1">{{ isset($getUserData->designation) ? $getUserData->designation : 'RMS MONITORING' }}</span>

                            <span class="avatar-company d-block text-white text-sm-start text-center ms-1">
                                {{ isset($getUserData->company_name) ? $getUserData->company_name : ' INVENSYS TECHNOLOGIES LLP' }}</span>
                        </div>
                    </div>
                </div>
                <!--  <div class="d-flex align-items-center mb-5 ms-3">
                    <span class="pt-5 profile-description fs-6"> <p> Please Login to www.tagtoconnect.com to edit your NFC Business Card <br><br>Username is 046052B2826781@tagtoconnect.com <br>Password is 046052B2826781 </p></span>
                </div> -->
            </div>
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
                            <i class="fab fa-instagram instagram-icon icon fa-2x" title="Instagram"></i>
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
                            <i class="fab fa-linkedin linkedin-icon icon fa-2x" title="Linkedin"></i>
                        </a>
                    </span>
                    <span
                        class="social-back rounded-circle d-flex justify-content-center align-items-center m-sm-2 m-1">
                        <a href="{{ isset($getUserData->whatsappURL) ? 'https://' . $getUserData->whatsappURL : 'https://www.whatsapp.com' }}"
                            target="_blank" class="share-button whatsapp">
                            <i class="fab fa-whatsapp whatsapp-icon icon fa-2x" title="Whatsapp"></i>
                        </a>
                    </span>
                </div>
            </div>
            <div class="vcard-eight__event py-3 px-sm-4 px-3 mt-2 position-relative">
                <div class="row">
                    <div class="col-12">
                        <div class="card event-card p-4">
                            <div class="row g-4">
                                <div class="col-sm-6 col-12">
                                    <div
                                        class="event-icon rounded-circle d-flex justify-content-center align-items-center mx-auto mb-2">
                                        <img src="https://tagtoconnect.com/assets/img/vcard8/vcard8-email.png"
                                            alt="email" />
                                    </div>
                                    <div class="event-details">
                                        <span class="text-white text-center d-block mb-1">E-mail address</span>
                                        <h5 class="text-center mb-0 text-white"><a
                                                href="{{ isset($getUserData->email) ? 'mailto:' . $getUserData->email : '#' }}"
                                                class="text-white text-decoration-none">{{ isset($getUserData->email) ? $getUserData->email : 'Company-abc@yahoo.com' }}</a>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <div
                                        class="event-icon rounded-circle d-flex justify-content-center align-items-center mx-auto mb-2">
                                        <img src="https://tagtoconnect.com/assets/img/vcard8/vcard8-phone.png"
                                            alt="mobile" />
                                    </div>
                                    <div class="event-details">
                                        <span class="text-white text-center d-block mb-1">Mobile Number</span>
                                        <h5 class="text-center mb-0 text-white"><a
                                                href=" {{ isset($getUserData->phone_number) ? 'tel:' . $getUserData->phone_number : '+918756277623' }}"
                                                class="text-white text-decoration-none">+91
                                                {{ isset($getUserData->phone_number) ? $getUserData->phone_number : '+918756277623' }}</a>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <div
                                        class="event-icon rounded-circle d-flex justify-content-center align-items-center mx-auto mb-2">
                                        <i class="fa-solid fa-book" style="color:#fff;font-size:20px;"></i>
                                    </div>
                                    <div class="event-details">
                                        <span class="text-white text-center d-block mb-1">GST</span>
                                        <h5 class="text-center mb-0 text-white"><a href="#"
                                                class="text-white text-decoration-none">
                                                {{ isset($getUserData->gstNumber) ? $getUserData->gstNumber : '09AAACH7409R1ZZ' }}</a>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <div
                                        class="event-icon rounded-circle d-flex justify-content-center align-items-center mx-auto mb-2">
                                        <i class="fa-solid fa-bank" style="color:#fff;font-size:20px;"></i>
                                    </div>
                                    <div class="event-details custom">
                                        <span class="text-white text-center d-block mb-1">Bank Details</span>
                                        <h5>
                                            Person Name:
                                            {{ isset($getUserData->name) ? $getUserData->name : 'Hardik Vasani' }}
                                        </h5>
                                        <h5>
                                            Bank name :
                                            {{ isset($getUserData->bankname) ? $getUserData->bankname : 'Kotak Mahindra' }}
                                        </h5>
                                        <h5>
                                            Accont No:
                                            {{ isset($getUserData->accountnumber) ? $getUserData->accountnumber : '000000004545' }}
                                        </h5>
                                        <h5> Branch :
                                            {{ isset($getUserData->branch) ? $getUserData->branch : 'Fort Mumbai' }}
                                        </h5>
                                        <h5>IFSC:
                                            {{ isset($getUserData->ifsccode) ? $getUserData->ifsccode : 'KKBK0245' }}
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <p>{{ $getsession ? $getsession : 'NA' }}</p> --}}

            {{-- our services --}}
            {{-- <div class="vcard-two__service my-3 py-3 position-relative">

                <img src="{{ asset('assets/img/vcard2/shape2.png') }}"
                    class="banner-shape-two position-absolute end-0" alt="shape" />
                <img src="{{ asset('assets/img/vcard2/shape3.png') }}"
                    class="banner-shape-three position-absolute start-0" alt="shape" />
                <h4 class="vcard-two-heading text-center pb-4">Our Services</h4>
                <div class="container">
                    <div class="row g-3">
                        <div class="col-sm-6 col-12">
                            <div class="card service-card d-flex align-items-center p-2 h-100 border-0">
                                <div class="service-image d-flex justify-content-center align-items-center">
                                    <img src="{{ isset($getUserData->icon1) ? asset('our_services/' . $getUserData->icon1) : asset('img/No_image_available.svg') }}"
                                        alt="icon1" />
                                </div>
                                <div class="service-details mt-3">
                                    <h4 class="service-title text-center">
                                        {{ isset($getUserData->title1) ? $getUserData->title1 : 'NA' }}</h4>
                                    <p class="service-paragraph mb-0 text-center">
                                        {{ isset($getUserData->description1) ? $getUserData->description1 : 'NA' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="card service-card d-flex align-items-center p-2 h-100 border-0">
                                <div class="service-image d-flex justify-content-center align-items-center">
                                    <img src="{{ isset($getUserData->icon2) ? asset('our_services/' . $getUserData->icon2) : asset('img/No_image_available.svg') }}"
                                        alt="icon1" />
                                </div>
                                <div class="service-details mt-3">
                                    <h4 class="service-title text-center">
                                        {{ isset($getUserData->title2) ? $getUserData->title2 : 'NA' }}</h4>
                                    <p class="service-paragraph mb-0 text-center">
                                        {{ isset($getUserData->description2) ? $getUserData->description2 : 'NA' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="card service-card d-flex align-items-center p-2 h-100 border-0">
                                <div class="service-image d-flex justify-content-center align-items-center">
                                    <img src="{{ isset($getUserData->icon3) ? asset('our_services/' . $getUserData->icon3) : asset('img/No_image_available.svg') }}"
                                        alt="icon1" />
                                </div>
                                <div class="service-details mt-3">
                                    <h4 class="service-title text-center">
                                        {{ isset($getUserData->title3) ? $getUserData->title3 : 'NA' }}</h4>
                                    <p class="service-paragraph mb-0 text-center">
                                        {{ isset($getUserData->description3) ? $getUserData->description3 : 'NA' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="card service-card d-flex align-items-center p-2 h-100 border-0">
                                <div class="service-image d-flex justify-content-center align-items-center">
                                    <img src="{{ isset($getUserData->icon4) ? asset('our_services/' . $getUserData->icon4) : asset('img/No_image_available.svg') }}"
                                        alt="icon1" />
                                </div>
                                <div class="service-details mt-3">
                                    <h4 class="service-title text-center">
                                        {{ isset($getUserData->title4) ? $getUserData->title4 : 'NA' }}</h4>
                                    <p class="service-paragraph mb-0 text-center">
                                        {{ isset($getUserData->description4) ? $getUserData->description4 : 'NA' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

            {{-- gallary --}}

            {{-- <div class="vcard-nine__gallery py-4 px-3 position-relative px-sm-3">
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
            </div> --}}

            {{-- product --}}

            {{-- <div class="vcard-nine__product py-4 px-3 position-relative px-sm-3">
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
                                    <h4>{{ isset($getUserData->producttitle1) ? $getUserData->producttitle1 : 'NA' }}</h4>
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
                                    <h4>{{ isset($getUserData->producttitle2) ? $getUserData->producttitle2 : 'NA' }}</h4>
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
            </div> --}}

            {{-- testimonial --}}
            {{-- <div class="vcard-nine__testimonial py-4 px-3 position-relative px-sm-3">
                <h4 class="heading-right heading-line position-relative text-center">TESTIMONIAL</h4>
                <div class="container">
                    <div class="row g-3 testimonial-slider mt-4">
                        <div class="col-12">
                            <div class="card testimonial-card p-3 border-0 w-100">
                                <div
                                    class="testimonial-user d-flex flex-sm-row flex-column align-items-center justify-content-sm-start justify-content-center">
                                    <img src="{{ isset($getUserData->testmonial1) ? asset('productGallery/' . $getUserData->testmonial1) : '' }}"
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
                                    <img src="{{ isset($getUserData->testmonial2) ? asset('productGallery/' . $getUserData->testmonial2) : '' }}"
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
            </div> --}}

            {{-- @if ($sessiongetid)
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <img id="qrCodeImage" src="{{ asset('qr_codes/' . (isset($qrcode) ? $qrcode : 'NA')) }}"
                                alt="qr code" />
                            <div class="mt-4">
                                <button type="button" class="qr-code-btn text-white mt-4 d-block mx-auto"
                                    onclick="downloadQRCode()">Download My
                                    QR Code</button>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <span></span>
            @endif --}}
            <div class="vcard-eight__contact pt-4 position-relative px-sm-4 px-3 ">

                {{-- <div class="w-100 d-flex justify-content-center  position-fixed"
                    style="top:50%; left:0; z-index: 9999;">
                    <div class="vcard-bars-btn position-relative">
                        <a href="javascript:void(0)"
                            class="vcard8-sticky-btn border-0 bars-btn d-flex justify-content-center text-white me-5 align-items-center rounded-0 mb-3 text-decoration-none py-1 rounded-pill justify-content-center">
                            <img src="https://tagtoconnect.com/assets/img/vcard8/sticky.png" />
                        </a>
                        <div class="sub-btn d-none">
                            <div class="sub-btn-div">
                                <div class="stickyIcon">
                                    <button type="button"
                                        class="vcard8-share vcard8-sticky-btn mb-3 vcard8-btn-group bg-white px-2 py-1"><i
                                            class="fas fa-share-alt fs-1"></i></button>
                                    <a type="button"
                                        class=" vcard8-btn-group vcard8-sticky-btn d-flex justify-content-center bg-white text-decoration-none align-items-center px-2 mb-3 py-2"
                                        id="qr-code-btn" download="qr_code.png"><i
                                            class="fa-solid fa-qrcode fs-1"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="w-100 d-flex justify-content-center sticky-vcard-div">
                        </div>
                        <div id="vcard8-shareModal" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Share My VCard</h5>
                                        <button type="button" class="share-btn text-white d-block btn"
                                            data-toggle="modal" data-target="#shareModal">
                                            <span class="svg-icon svg-icon-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                                    viewBox="0 0 24 24" version="1.1">
                                                    <g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)"
                                                        fill="#000000">
                                                        <rect fill="#000000" x="0" y="7" width="16"
                                                            height="2" rx="1" />
                                                        <rect fill="#000000" opacity="0.5"
                                                            transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000)"
                                                            x="0" y="7" width="16" height="2"
                                                            rx="1" />
                                                    </g>
                                                </svg>
                                            </span>
                                        </button>
                                    </div>
                                    <div id="vcard8-shareModel" class="modal fade" role="dialog">
                                        <div class="row">
                                            <div class="col-sm-12 justify-content-between social-link-modal">
                                                <a href="http://www.facebook.com/sharer.php?u=https://tagtoconnect.com/046052B2826781"
                                                    target="_blank" class="mx-2 share8" title="Facebook">
                                                    <i class="fab fa-facebook fa-2x" style="color: #1B95E0"></i>
                                                </a>
                                                <a href="http://twitter.com/share?url=https://tagtoconnect.com/046052B2826781&text=Ankit Prasad&hashtags=sharebuttons"
                                                    target="_blank" class="mx-2 share8" title="Twitter">
                                                    <i class="fab fa-twitter fa-2x" style="color: #1DA1F3"></i>
                                                </a>
                                                <a href="http://www.linkedin.com/shareArticle?mini=true&url=https://tagtoconnect.com/046052B2826781"
                                                    target="_blank" class="mx-2 share8" title="Linkedin">
                                                    <i class="fab fa-linkedin fa-2x" style="color: #1B95E0"></i>
                                                </a>
                                                <a href="mailto:?Subject=&Body=https://tagtoconnect.com/046052B2826781"
                                                    target="_blank" class="mx-2 share8" title="Email">
                                                    <i class="fas fa-envelope fa-2x" style="color: #191a19  "></i>
                                                </a>
                                                <a href="http://pinterest.com/pin/create/link/?url=https://tagtoconnect.com/046052B2826781"
                                                    target="_blank" class="mx-2 share8">
                                                    <i class="fab fa-pinterest fa-2x" style="color: #bd081c"
                                                        title="Pinterest"></i>
                                                </a>
                                                <a href="http://reddit.com/submit?url=https://tagtoconnect.com/046052B2826781&title=Ankit Prasad"
                                                    target="_blank" class="mx-2 share8" title="Reddit">
                                                    <i class="fab fa-reddit fa-2x" style="color: #ff4500"></i>
                                                </a>
                                                <a href="https://wa.me/?text=https://tagtoconnect.com/046052B2826781"
                                                    target="_blank" class="mx-2 share8" title="Whatsapp">
                                                    <i class="fab fa-whatsapp fa-2x" style="color: limegreen"></i>
                                                </a>
                                                <span id="vcardUrlCopy69" class="d-none" target="_blank">
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div>

                </div>
                <div class="d-sm-flex flex-column justify-content-center mt-12 text-center">

                    <button type="submit" class="vcard-one-btn text-white d-block mb-sm-0 mb-3"
                        onclick="downloadQRCode()">
                        <i class="fas fa-download me-2"></i>Qr code
                    </button>
                    <button type="submit" class="vcard-one-btn text-white d-block mb-sm-0 mb-3" id="addToContact">
                        <i class="fas fa-download me-2"></i> Download Vcard
                    </button>

                    <button type="button" class="share-btn text-white d-block btn" data-toggle="modal"
                        data-target="#shareButtonall">
                        <i class="fas fa-share-alt me-2"></i> Share
                    </button>

                    <div class="modal fade" id="shareButtonall" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
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

                                            <span>
                                                <button onclick="myFunction()"><i class="fa-solid fa-copy"></i> Copy
                                                    Link</button>
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

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

{{-- qr code dounload --}}
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
    let shareUrl = "{!! addslashes($shareurl) !!}";

    let shareText = "default share text";
    let titletext = shareUrl;
    document.getElementById('shareButton').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default link behavior

        var shareU = shareUrl;
        if (navigator.share) {
            navigator.share({
                title:titletext,
                text: shareText,
                url: shareU,
            })
            .then(() => console.log('Successful share'))
            .catch((error) => console.log('Error sharing:', error));
        } else {
            window.open('https://www.facebook.com/sharer/sharer.php?u=' + shareU);
            window.open('https://twitter.com/intent/tweet?url=' + encodeURIComponent(shareU) + '&text=' +
                encodeURIComponent(shareText));
            window.open('https://www.instagram.com/share?url=' + encodeURIComponent(shareU));
            window.open('whatsapp://send?text=' + encodeURIComponent(shareText + ' ' + shareU));
        }
    });
</script> --}}
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
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
    function downloadQRCode() {
        // Get the QR code image element
        var qrCodeImg = document.getElementById('qrCodeImage');

        // Create an "a" element
        var downloadLink = document.createElement('a');

        // Set the download link attributes
        downloadLink.href = qrCodeImg.src;
        downloadLink.download = `{{ isset($getUserData->name) ? $getUserData->name : 'NA' }}_qr_code.png`;

        // Append the link to the body (for Firefox compatibility)
        document.body.appendChild(downloadLink);

        // Simulate a click on the download link
        downloadLink.click();

        // Remove the link from the body
        document.body.removeChild(downloadLink);
    }
</script> --}}

</html>
