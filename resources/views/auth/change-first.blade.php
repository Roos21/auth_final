<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profil</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <!-- Template Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <style>
        .btn-color {
            background-color: #0e1c36;
            color: #fff;

        }

        .profile-image-pic {
            height: 200px;
            width: 200px;
            object-fit: cover;
        }



        .cardbody-color {
            background-color: #ebf2fa;
        }

        a {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-5 offset-md-3">
                <h2 class="text-center text-dark mt-5">Bienvenue</h2>
                <div class="alert alert-warning mb-5 text-dark">
                    <strong>{{ $user->nom_user }}</strong> ce formulaire vous est présenté pour changer vos identifiants
                    de connexion crées par votre administrateur
                    &nbsp;&nbsp;&nbsp;<a class="btn btn-primary" href="/remember/{{ $user->id }}">Me rappeler
                        plutart</a>
                </div>
                <div class="card my-5">

                    <form class="card-body cardbody-color p-lg-5" method="post" action="/auth/change-first-user"
                        onsubmit="return verifyPassword()">
                        @csrf
                        @if ($erreur)
                            <div class="alert alert-danger">
                                {{ $erreur }}
                            </div>
                        @endif
                        @if (Session::has('AUTHSEPASP'))
                            <div class="alert alert-danger">
                                {{ Session::get('AUTHSEPASP') }}
                            </div>
                        @endif
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <div class="mb-3">
                            <input type="text" value="{{ $user->login }}" name="login" class="form-control"
                                id="Username" placeholder="Nom d'utilisateur" required>
                        </div>
                        <div class="mb-3">
                            <input id="pswd" type="password" name="password" class="form-control" id="password"
                                placeholder="Mot de passe " size="8" required>
                            <span id="message" style="color:red"> Choisir un mot de passe d'au moins 8 caractères
                            </span> <br><br>
                        </div>
                        <div class="text-center"><button type="submit"
                                class="btn btn-color px-5 mb-5 w-100">Enregistrer</button></div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    </div>

    <script>
        function verifyPassword() {
            var pw = document.getElementById("pswd").value;
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
