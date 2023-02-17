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
                            <form action="/user/profil/store-edition" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Nom ustilisateur</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="nom_user" class="form-control"
                                            value="{{ $user->nom_user }}">
                                    </div>

                                </div>
                                @error('nom_user')
                                    <p class="text text-danger">
                                        {{ $message }}
                                    </p>
                                @enderror
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Email</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <div class="col-sm-12 text-secondary">
                                            <input type="text" name="email" class="form-control"
                                                value="{{ $user->email }}">
                                        </div>
                                    </div>
                                </div>
                                @error('email')
                                    <p class="text text-danger">
                                        {{ $message }}
                                    </p>
                                @enderror
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Téléphone</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <div class="col-sm-12 text-secondary">
                                            <input type="text" name="telephone" class="form-control"
                                                value="{{ $user->telephone }}">
                                        </div>
                                    </div>
                                </div>
                                @error('telephone')
                                    <p class="text text-danger">
                                        {{ $message }}
                                    </p>
                                @enderror
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Phrase secrète</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <div class="col-sm-12 text-secondary">
                                            <input type="text" name="phrase_secrete" class="form-control"
                                                value="{{ $user->phrase_secrete }}">
                                        </div>

                                    </div>
                                </div>
                                @error('phrase_secrete')
                                    <p class="text text-danger">
                                        {{ $message }}
                                    </p>
                                @enderror
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Login</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="login" class="form-control"
                                            value="{{ $user->login }}">

                                    </div>
                                </div>
                                @error('login')
                                    <p class="text text-danger">
                                        {{ $message }}
                                    </p>
                                @enderror
                                <hr>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <button class="btn btn-primary " type="submit"><i
                                                class="bi bi-check-lg"></i> Enregistrer</button>

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
</body>

</html>
