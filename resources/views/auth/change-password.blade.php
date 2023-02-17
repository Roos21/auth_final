<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profil</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Template Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <style>
        body {
            margin-top: 20px;
            color: #1a202c;
            text-align: left;
            background-color: #e2e8f0;
        }

        .main-body {
            padding: 15px;
        }

        .card {
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid rgba(0, 0, 0, .125);
            border-radius: .25rem;
        }

        .card-body {
            flex: 1 1 auto;
            min-height: 1px;
            padding: 1rem;
        }

        .gutters-sm {
            margin-right: -8px;
            margin-left: -8px;
        }

        .gutters-sm>.col,
        .gutters-sm>[class*=col-] {
            padding-right: 8px;
            padding-left: 8px;
        }

        .mb-3,
        .my-3 {
            margin-bottom: 1rem !important;
        }

        .bg-gray-300 {
            background-color: #e2e8f0;
        }

        .h-100 {
            height: 100% !important;
        }

        .shadow-none {
            box-shadow: none !important;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="main-body">

            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="main-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashbord">Accueil</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">utilisateur</a></li>
                    <li class="breadcrumb-item active" aria-current="page">profil</li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="https://cdn0.iconfinder.com/data/icons/man-user-human-profile-avatar-person-business/100/10-1User_14-512.png"
                                    alt="Admin" class="rounded-circle" width="150">
                                <div class="mt-3">
                                    <h4>{{ $user->nom_user }}</h4>
                                    <p class="text-secondary mb-1">

                                        @foreach ($user->roles as $role)
                                            <span class="badge bg-secondary">{{ $role->nom_role }}</span>
                                        @endforeach
                                    </p>
                                    <p class="text-muted font-size-sm">crée le : {{ $user->created_at }}</p>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">
                            <form action="/user/change-password" method="post">
                                @if (Session::has('AUTHFEPASU'))
                                    <div class="alert alert-danger">
                                        {{ Session::get('AUTHFEPASU') }}
                                    </div>
                                @endif
                                @csrf
                                <div class="row">
                                    <div class="col-sm-4">
                                        <h6 class="mb-0">Ancien mot de passe</h6>
                                    </div>
                                    <div class="col-sm-8 text-secondary">
                                        <div class="input-group mb-3">
                                            <input class="form-control password" id="password" class="block mt-1 w-full"
                                                type="password" name="old_password" required />
                                            <span class="input-group-text">
                                                <i class="far fa-eye-slash" id="togglePassword" style="cursor: pointer"></i>
                                            </span>
                                        </div>
                                    </div>


                                </div>
                                @error('old_password')
                                    <p class="text text-danger">
                                        {{ $message }}
                                    </p>
                                @enderror
                                <hr>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <h6 class="mb-0">Nouveau mot de passe</h6>
                                    </div>
                                    <div class="col-sm-8 text-secondary">
                                        <div class="input-group mb-3">
                                            <input class="form-control password" id="password" class="block mt-1 w-full"
                                                type="password" name="new_password" required />
                                            <span class="input-group-text">
                                                <i class="far fa-eye-slash" id="togglePassword1" style="cursor: pointer"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                @error('new_password')
                                    <p class="text text-danger">
                                        {{ $message }}
                                    </p>
                                @enderror
                                <hr>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <button class="btn btn-primary " type="submit"><i class="bi bi-check-lg"></i>
                                            Enregistrer</button>

                                        <a class="btn btn-danger " href="/user/profil"><i
                                                class="bi bi-arrow-left-circle-fill"></i> Abandonner</a>
                                    </div>

                                </div>
                            </form>
                        </div>

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

        $("#togglePassword1").click(function(e) {
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
