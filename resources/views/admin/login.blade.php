<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>V-card</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<style>
    #LoginMesage {
        color: rgb(51, 255, 0);
    }

    #passwordMessage {
        color: red;
    }

    #messageEmail,
    #error404 {
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

                                <h2 class="mb-2 text-center">V-CARD</h2>

                                <div id="LoginMesage"></div>
                                <div id="error404"></div>
                                @php
                                    if (isset($_COOKIE['rememberedEmail']) && isset($_COOKIE['rememberedPassword'])) {
                                        $login_email = $_COOKIE['rememberedEmail'];
                                        $login_pass = $_COOKIE['rememberedPassword'];
                                        $is_remember = "checked='checked'";
                                    } else {
                                        $login_email = '';
                                        $login_pass = '';
                                        $is_remember = '';
                                    }
                                @endphp
                                <form id="loginsubmit">
                                    @csrf <!-- add csrf field on your form -->
                                    <div class="form-group mb-3">
                                        <input type="email" placeholder="Email" id="email" name="email"
                                            value="{{ $login_email }}" class="form-control">
                                        <span id="messageEmail"></span>
                                    </div>

                                    <div class="form-group mb-3">
                                        <input type="password" placeholder="Password" id="password" name="password"
                                            value="{{ $login_pass }}" class="form-control">
                                        <span id="passwordMessage"></span>
                                    </div>

                                    <div class="form-group mb-3">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" id="rememberme" name="rememberme"
                                                    {{ $is_remember }}>
                                                Remember me
                                            </label>
                                        </div>
                                    </div>

                                    <div class="d-grid mx-auto">
                                        <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                                    </div>
                                </form>
                                <div>
                                    {{-- <a href="{{ route('v-card_register') }}">Create Account!!</a> --}}
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
        document.getElementById('loginsubmit').addEventListener('submit', function(e) {
            e.preventDefault();
            LoginForm();
        });

        function getCSRFToken() {
            return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        }

        function setCookie(name, value, days) {
            const expires = new Date(Date.now() + days * 24 * 60 * 60 * 1000).toUTCString();
            document.cookie = `${name}=${encodeURIComponent(value)}; expires=${expires}; path=/`;
        }

        function LoginForm() {
            let email = document.getElementById('email').value;
            let password = document.getElementById('password').value;
            let rememberme = document.getElementById('rememberme').value; // Corrected here

            if (rememberme) {
                setCookie("rememberedEmail", email, 30);
                setCookie("rememberedPassword", password, 30);
            } else {
                document.cookie = "rememberedEmail=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                document.cookie = "rememberedPassword=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            }

            let csrfToken = getCSRFToken();

            $.ajax({
                method: 'POST',
                url: '{{ route('login.post') }}',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: JSON.stringify({
                    email: email,
                    password: password,
                    rememberme: rememberme
                }),
                success: function(data) {
                    if (data.status === 200) {
                        document.getElementById('LoginMesage').innerHTML =
                            '<div class="alert alert-success">' + data.message + '</b></div>';
                        setTimeout(() => {
                            document.getElementById('LoginMesage').innerHTML = "";
                        }, 3000);
                        window.location.href = data.redirect; // Redirect to the dashboard page
                    } else if (data.status === 404) {

                        document.getElementById('error404').innerHTML =
                            '<div class="alert alert-danger">' + data.message + '</b></div>';
                        setTimeout(() => {
                            document.getElementById('error404').innerHTML = "";
                        }, 3000);

                    } else if (data.message === 'your password is incorrect') {
                        document.getElementById('passwordMessage').innerHTML = "Password is incorrect";
                        setTimeout(() => {
                            document.getElementById('passwordMessage').innerHTML = "";
                        }, 3000);
                    } else if (data.message === 'Please enter your password') {
                        document.getElementById('passwordMessage').innerHTML = "Enter your password";
                        setTimeout(() => {
                            document.getElementById('passwordMessage').innerHTML = "";
                        }, 3000);
                    } else if (data.message === 'password must be at least 6 characters') {
                        document.getElementById('passwordMessage').innerHTML =
                            "Password must be at least 6 characters";
                        setTimeout(() => {
                            document.getElementById('passwordMessage').innerHTML = "";
                        }, 3000);
                    } else if (data.message === 'Please enter your email address') {
                        document.getElementById('messageEmail').innerHTML = "Please enter your email address";
                        setTimeout(() => {
                            document.getElementById('messageEmail').innerHTML = "";
                        }, 3000);
                    } else {
                        document.getElementById('LoginMesage').innerHTML = data.message;
                        setTimeout(() => {
                            document.getElementById('LoginMesage').innerHTML = "";
                        }, 3000);
                    }
                }
            });
        }
    </script>


</body>

</html>
