<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>V-card</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>

    <style>
        #LoginMesage {
            color: rgb(51, 255, 0);
        }

        #passwordMessage,
        #messagetapid {
            color: red;
        }

        #messageEmail,
        #error404 {
            color: red;
        }


        .btn-primary {
            color: #fff;
            background-color: #000000;
            border-color: #292929;
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
                                    <h2 class="mb-2 text-center">CREATE NEW TAP</h2>
                                    <div id="LoginMesage"></div>
                                    <div id="error404"></div>

                                    <form id="createtapsubmit">
                                        @csrf <!-- add csrf field on your form -->
                                        <div class="form-group mb-3">
                                            <span id="messagetapid"></span>
                                            <input type="text" placeholder="Enter tap Id" id="tapid"
                                                class="form-control">

                                        </div>
                                        <div class="form-group mb-3">

                                            <span id="messageinstuct"></span>
                                            <img src="" alt="Vcard image" width="300px" height="250px"
                                                class="mr-2 qr-code-image">
                                        </div>
                                        <div class="d-grid mx-auto">
                                            <button type="submit" class="btn btn-primary btn-block">create</button>
                                        </div>
                                    </form>
                                    <div>
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
        <script>
            document.getElementById("createtapsubmit").addEventListener("submit", function(e) {
                e.preventDefault();

                let tapid = document.getElementById("tapid").value;
                console.log(tapid);

                if (tapid === '') {
                    document.getElementById("messagetapid").innerHTML =
                        '<div class="alert alert-danger" role="alert"><b> Enter tap id</b></div>';
                    setTimeout(() => {
                        document.getElementById("messagetapid").innerHTML = "";
                    }, 3000);
                }

                $.ajax({
                    method: 'POST',
                    url: '{{ route('createQrcodeTapCard.post') }}',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: JSON.stringify({
                        nfc_id: tapid,
                    }),
                    success: function(data) {
                        // console.log("Already QR Code URL:", data.data.qr_code);
                        if (data.status === 200 && data.message === 'Already qr generated') {
                            var imageUrl = '{{ asset('qrcodeprimary/') }}' + '/' + data.data.qr_code;
                            $('.qr-code-image').attr('src', imageUrl);
                            console.log(data);
                            // Update the content of the element with id 'messageinstuct'
                            document.getElementById('messageinstuct').innerHTML = "<div><b>" + data
                                .message + "</b></div>";
                        }
                        if (data.status === 200 && data.message === 'New Qr Code generated successfully') {
                            window.location.href = data.redirect;
                            // window.open(data.redirect, '_blank');
                            // var imageUrl = '{{ asset('qrcodeprimary/') }}' + '/' + data.redirect;
                            // $('.qr-code-image').attr('src', imageUrl);
                            console.log(data);
                        }
                    }

                });
                document.getElementById("tapid").addEventListener('input', function() {
                    document.getElementById('messagetapid').innerHTML = '';
                });

            });
        </script>

    </body>

</html>
