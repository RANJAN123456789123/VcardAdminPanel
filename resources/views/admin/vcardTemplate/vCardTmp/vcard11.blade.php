
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="description" content="NFC RFID BLUETOOTH TECHNOLOGY">
    <meta name="keywords" content="ACES INVENSYS TECHNOLOGIES">
    <meta property="og:image" content="https://tagtoconnect.com/assets/images/default_cover_image.jpg" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>vcard11</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    {{-- css link --}}


    <link rel="stylesheet" href="{{ asset('assets/css/vcard11.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/vcard8.css') }}">

    <link href="https://tagtoconnect.com/front/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://tagtoconnect.com/assets/css/vcard8.css">
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


            </div>

            <div>
                <div
                    class="vcard-eight__profile d-flex align-items-center px-4 flex-sm-row flex-column position-relative">
                    <div class="vcard-eight__avatar profile_image">
                        <img src="{{ isset($getuser->profile_pic) ? asset('admin/uploads/users' . '/' . $getuser->profile_pic) : 'https://tagtoconnect.com/web/media/avatars/150-26.jpg' }}"
                            class="rounded-circle" />

                        {{-- <a href="{{ isset($getuser) ? url('vcard-login/' . $getuser->id) : url('vcard-register') }}"
                            class="edit_profile" style=""><i class="fas fa-pencil"></i></a> --}}

                    </div>
                    <div class="vcard-eight__position d-flex flex-column mx-4 position-relative">
                        <div class="d-flex flex-column">
                            <h4 class="vcard-eight-heading fw-bold text-sm-start text-center">
                                {{ isset($getuser->name) ? $getuser->name : 'Ankit' }}</h4>
                            <span
                                class="avatar-designation text-white text-sm-start text-center p-1">{{ isset($getuser->designation) ? $getuser->designation : 'RMS MONITORING' }}</span>

                            <span class="avatar-company d-block text-white text-sm-start text-center ms-1">
                                {{ isset($getuser->company_name) ? $getuser->company_name : ' INVENSYS TECHNOLOGIES LLP' }}</span>
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
                        <a href="{{ isset($getuser->websiteURL) ? 'https://' . $getuser->websiteURL : 'https://www.google.com' }}"
                            target="_blank">
                            <i class="fas fa-globe icon fa-2x" title="Website"></i>
                        </a>
                    </span>
                    <span
                        class="social-back rounded-circle d-flex justify-content-center align-items-center m-sm-2 m-1">
                        <a href="{{ isset($getuser->instagramURL) ? 'https://' . $getuser->instagramURL : 'https://www.instagram.com' }}"
                            target="_blank">
                            <i class="fab fa-instagram instagram-icon icon fa-2x" title="Instagram"></i>
                        </a>
                    </span>
                    <span
                        class="social-back rounded-circle d-flex justify-content-center align-items-center m-sm-2 m-1">
                        <a href="{{ isset($getuser->youtubeURL) ? 'https://' . $getuser->youtubeURL : 'https://www.youtube.com' }}"
                            target="_blank">
                            <i class="fab fa-youtube youtube-icon icon fa-2x" title="Youtube"></i>
                        </a>
                    </span>
                    <span
                        class="social-back rounded-circle d-flex justify-content-center align-items-center m-sm-2 m-1">
                        <a href="{{ isset($getuser->linkedinURL) ? 'https://' . $getuser->linkedinURL : 'https://www.linkedin.com' }}"
                            target="_blank">
                            <i class="fab fa-linkedin linkedin-icon icon fa-2x" title="Linkedin"></i>
                        </a>
                    </span>
                    <span
                        class="social-back rounded-circle d-flex justify-content-center align-items-center m-sm-2 m-1">
                        <a href="{{ isset($getuser->whatsappURL) ? 'https://' . $getuser->whatsappURL : 'https://www.whatsapp.com' }}"
                            target="_blank">
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
                                                href="{{ isset($getuser->email) ? 'mailto:' . $getuser->email : '#' }}"
                                                class="text-white text-decoration-none">{{ isset($getuser->email) ? $getuser->email : 'Company-abc@yahoo.com' }}</a>
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
                                                href=" {{ isset($getuser->phone_number) ? 'tel:' . $getuser->phone_number : '+918756277623' }}"
                                                class="text-white text-decoration-none">+91
                                                {{ isset($getuser->phone_number) ? $getuser->phone_number : '+918756277623' }}</a>
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
                                                {{ isset($getuser->gstNumber) ? $getuser->gstNumber : '09AAACH7409R1ZZ' }}</a>
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
                                            {{ isset($getuser->name) ? $getuser->name : 'Hardik Vasani' }} </h5>
                                        <h5>
                                            Bank name :
                                            {{ isset($getuser->bankname) ? $getuser->bankname : 'Kotak Mahindra' }}
                                        </h5>
                                        <h5>
                                            Accont No:
                                            {{ isset($getuser->accountnumber) ? $getuser->accountnumber : '000000004545' }}
                                        </h5>
                                        <h5> Branch :
                                            {{ isset($getuser->branch) ? $getuser->branch : 'Fort Mumbai' }}
                                        </h5>
                                        <h5>IFSC:
                                            {{ isset($getuser->ifsccode) ? $getuser->ifsccode : 'KKBK0245' }}
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <p>{{ $getsession ? $getsession : 'NA' }}</p> --}}


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

            <div class="vcard-eight__contact pt-4 position-relative px-sm-4 px-3 ">

                {{-- <div class="w-100 d-flex justify-content-center  position-fixed"
                    style="top:50%; left:0; z-index: 9999;">
                    <div class="vcard-bars-btn position-relative">
                        <a href="javascript:void(0)"
                            class="vcard8-sticky-btn border-0 bars-btn d-flex justify-content-center text-white me-5 align-items-center rounded-0 px-5 mb-3 text-decoration-none py-1 rounded-pill justify-content-center">
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
                        <div id="vcard8-shareModel" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Share My VCard</h5>
                                        <button type="button" aria-label="Close"
                                            class="btn btn-sm btn-icon btn-active-color-danger"
                                            data-bs-dismiss="modal">
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
                                    <div class="modal-body">
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

                <div class="d-sm-flex justify-content-center mt-5">

                    <button type="submit" class="vcard-ten-btn text-white mt-4 d-block btn" id="addToContact">
                        <i class="fas fa-download me-2"></i>Add Contact
                    </button>

                    <button type="button" class="share-btn text-white d-block btn">
                        <a href="#" class="text-white text-decoration-none">
                            <i class="fas fa-share-alt me-2"></i> Share</a>
                    </button>
                </div>
            </div>
        </div>
    </div>


</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    function downloadQRCode() {
        // alert("Downloading");
        var qrCodeImg = document.getElementById('qrCodeImage');
        var downloadLink = document.createElement('a');
        downloadLink.href = qrCodeImg.src;
        downloadLink.download = '{{ isset($getuser->name) ? $getuser->name : 'NA' }}_qr_code.png';
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

</html>
