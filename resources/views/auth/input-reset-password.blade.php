<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gescol | Récupération du compte</title>
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
    <div class="container d-flex flex-column">
        <div class="row align-items-center justify-content-center
            min-vh-100 g-0">
            <div class="col-12 col-md-8 col-lg-4 border-top border-3 border-primary">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="mb-4">
                            <h5>Nouveau mot de passe</h5>
                        </div>
                        <form method="post" action="{{ route('reset-change') }}" onsubmit="return verifyPassword()">
                            @csrf
                            @if (Session::has('AUTHRSPD'))
                            <div class="alert alert-danger">
                              {{ Session::get('AUTHRSPD') }}
                            </div>
                            @endif
                            <div class="mb-3">
                                <label class="form-label">Entre votre nouveau mot de passe</label>
                                <div class="input-group mb-3">
                                    <input class="form-control password" id="password" class="block mt-1 w-full"
                                        type="password" name="password" required />
                                    <span class="input-group-text">
                                        <i class="far fa-eye-slash" id="togglePassword" style="cursor: pointer"></i>
                                    </span>
                                </div>
                                <span id = "message" style="color:red"> Choisir un mot de passe d'au moins 8 caractères </span> <br><br>
                            </div>
                            <div class="mb-3 d-grid">
                                <button type="submit" class="btn btn-primary">
                                    Changer le mot de passe
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
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


        function verifyPassword() {
                var pw = document.getElementById("password").value;
                //check empty password field
                if (pw == "") {
                    document.getElementById("message").innerHTML = "Veillez choisir un mot de passe svp!";
                    return false;
                }
    
                //minimum password length validation
                if (pw.length < 8) {
                    document.getElementById("message").innerHTML = "Le mot de password comporte moins de 8 caractères.";
                    return false;
                }
    
    
    
            }
    </script>

    
</body>

</html>
