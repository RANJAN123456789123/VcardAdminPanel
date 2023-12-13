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
        color: rgb(2, 216, 145);
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

                                <h2 class="mb-2 text-center">Register</h2>

                                <div id="RegisterMesage"></div>
                                <h6 id="validationmessage"></h6>
                                <h6 id="validationmessage404"></h6>
                                <h6 id="validationmessage500"></h6>

                                <form id="registersubmit">
                                    @csrf <!-- add csrf field on your form -->
                                    <label for="permissionStatus">NAME</label>
                                    <div class="form-group mb-3">
                                        <input type="text" placeholder="Name" name="name" id="name"
                                            class="form-control">
                                        <span id="namemessage"></span>
                                    </div>

                                    <label for="permissionStatus">EMAIL</label>
                                    <div class="form-group mb-3">
                                        <input type="email" placeholder="Email" name="email" id="email"
                                            class="form-control">
                                        <span id="messageEmail"></span>
                                    </div>
                                    {{-- <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="plain">Company Name</label>
                                                <select name="company_name_id" id="company_name_id"
                                                    class="form-control js-example-basic-single">
                                                    <option>--Company Name--</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                </select>
                                            </div>
                                            <span id="companynamemessage"></span>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="plain">Plain</label>
                                                <select name="plain_id" id="plain_id"
                                                    class="form-control js-example-basic-single">
                                                    <option>--Plain--</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                </select>
                                            </div>
                                            <span id="plainmessage"></span>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="refer_company">Refer Company Name</label>
                                                <select name="refer_company_id" id="refer_company_id"
                                                    class="form-control js-example-basic-single">
                                                    <option>--Refer Company Name--</option>
                                                    <option value="1">1</option>
                                                </select>
                                            </div>
                                            <span id="refercmpmessage"></span>
                                        </div>
                                    </div> --}}

                                    {{-- <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="theme">Theme</label>
                                                <select name="themeimage_id" id="themeimage_id"
                                                    class="form-control js-example-basic-single">
                                                    <option>--Theme--</option>
                                                    <option value="1">1</option>
                                                </select>
                                            </div>
                                            <span id="thememessage"></span>
                                        </div>
                                    </div> --}}


                                    <div class="form-group mb-3">

                                        <label for="permissionStatus">PASSWORD</label>
                                        <div class="input-group">
                                            <input type="password" id="password" placeholder="Enter password"
                                                class="form-control">
                                            <span class="input-group-text" id="togglePassword">
                                                <i class="bi bi-eye-slash" id="toggleIcon"></i>
                                            </span>
                                        </div>
                                        <span id="passwordmessage"></span>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="permissionStatus">CONFIRM PASSWORD</label>
                                        <div class="input-group">
                                            <input type="password" id="c_password"
                                                placeholder="Confirm password" class="form-control">
                                            <span class="input-group-text" id="toggleConfirmPassword">
                                                <i class="bi bi-eye-slash" id="toggleConfirmIcon"></i>
                                            </span>
                                        </div>
                                        <span id="confirmpasswordmessage"></span>
                                    </div>

                                    <div class="d-grid mx-auto">
                                        <button type="submit" class="btn btn-primary btn-block">Register</button>
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

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        })
    </script>
    <script>
        document.getElementById('registersubmit').addEventListener('submit', function(e) {
            e.preventDefault();
            formRegister();
        });





        function formRegister() {
            let name = document.getElementById('name').value;
            console.log(name);
            let email = document.getElementById('email').value;
            console.log(email);

            let password = document.getElementById('password').value;
            let c_password = document.getElementById('c_password').value;

            $.ajax({
                method: 'POST',
                url: '{{ route('register.post') }}',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: JSON.stringify({
                    name: name,
                    email: email,
                    password: password,
                    c_password: c_password,
                    icon1:'Na',

                }),
                success: function(data) {
                    if (data.status === 200) {
                        document.getElementById('RegisterMesage').innerHTML = "Register successful";
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

            document.getElementById('name').addEventListener('input', function() {
            let namemessage = document.getElementById('namemessage');
            namemessage.innerHTML = "";
             });

             document.getElementById('email').addEventListener('input', function() {
            let namemessage = document.getElementById('messageEmail');
            namemessage.innerHTML = "";
             });

             document.getElementById('password').addEventListener('input', function() {
            let namemessage = document.getElementById('passwordmessage');
            namemessage.innerHTML = "";
             });
             document.getElementById('c_password').addEventListener('input', function() {
            let namemessage = document.getElementById('confirmpasswordmessage');
            namemessage.innerHTML = "";
             });


        }
    </script>
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
</body>

</html>
