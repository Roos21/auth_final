<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DASHMIN - Bootstrap Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sign In Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="index.html" class="">
                                <h3 class="text-primary">Gescol</h3>
                            </a>
                            <h3>Sign In</h3>
                        </div>
                        <form action="{{ route('login') }}" method="post">
                            @if (Session::has('AUTHSAAD'))
                                <div class="alert alert-success">
                                    {{ Session::get('AUTHSAAD') }}
                                </div>
                            @endif

                            @if (Session::has('AUTHPAAD'))
                                <div class="alert alert-danger">
                                    {{ Session::get('AUTHPAAD') }}
                                </div>
                            @endif
                            @if (Session::has('AUTHUAAD'))
                                <div class="alert alert-danger">
                                    {{ Session::get('AUTHUAAD') }}
                                </div>
                            @endif
                            @if (Session::has('AUTHOAAD'))
                                <div class="alert alert-success">
                                    {{ Session::get('AUTHOAAD') }}
                                </div>
                            @endif
                            @if (Session::has('AUTHCAAD'))
                                <div class="alert alert-danger">
                                    {{ Session::get('AUTHCAAD') }}
                                </div>
                            @endif
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="text" name="login" class="form-control" id="floatingInput"
                                    placeholder="name@example.com">
                                <label for="floatingInput">Login</label>
                            </div>
                            <div class="input-group mb-3" style="height:60px">
                                <input class="form-control password" id="password" class="block mt-1 w-full"
                                    type="password" name="password" required placeholder="Password"/>
                                <span class="input-group-text">
                                    <i class="far fa-eye-slash" id="togglePassword" style="cursor: pointer"></i>
                                </span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <a href="{{ route('forgotpassword') }}">Mot de passe oublié?</a>
                            </div>
                            <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Sign In</button>
                            <p class="text-center mb-0">Vous n'avez pas un compte? <a
                                    href="{{ route('create-admin', ['level'=>1]) }}">Sign Up</a></p>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sign In End -->
    </div>



    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('lib/chart/chart.min.js') }}"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('js/main.js') }}"></script>
    <script>
        $("#togglePassword").click(function(e) {
            e.preventDefault();
            var type = $(this).parent().parent().find(".password").attr("type");
            console.log(type);
            if (type == "password") {
                $(this).removeClass("fa-eye-slash");
                $(this).addClass("fa-eye");
                $(this).parent().parent().find(".password").attr("type", "text");
            } else if (type == "text") {
                $(this).removeClass("fa-eye");
                $(this).addClass("fa-eye-slash");
                $(this).parent().parent().find(".password").attr("type", "password");
            }
        });

    </script>
</body>

</html>
