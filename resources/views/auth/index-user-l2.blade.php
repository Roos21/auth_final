<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Gescol - Utilisateur</title>
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


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary">Gescol</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <i class="bi bi-person-circle" style="width: 40px; height: 40px;"></i>
                        <div
                            class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                        </div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">
                            @if (Session::has('user'))
                                {{ Session::get('user')->nom_user }}
                            @endif
                        </h6>
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="{{ route('auth.index') }}" class="nav-item nav-link"><i
                            class="fa fa-tachometer-alt me-2"></i>Tableau de bord</a>
                    <a href="" class="nav-item nav-link active"><i class="bi bi-people-fill"></i> Utilisateur</a>
                </div>
        </div>
        </nav>
    </div>
    <!-- Sidebar End -->


    <!-- Content Start -->
    <div class="content">
        <!-- Navbar Start -->
        <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
            <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
            </a>
            <a href="#" class="sidebar-toggler flex-shrink-0">
                <i class="fa fa-bars"></i>
            </a>
            <form class="d-none d-md-flex ms-4">
                <input class="form-control border-0" type="search" placeholder="Search">
            </form>
            <div class="navbar-nav align-items-center ms-auto">
                <!--
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="fa fa-bell me-lg-2"></i>
                        <span class="d-none d-lg-inline-flex">Notificatin</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                        <a href="#" class="dropdown-item">
                            <h6 class="fw-normal mb-0">Profile updated</h6>
                            <small>15 minutes ago</small>
                        </a>
                        <hr class="dropdown-divider">
                        <a href="#" class="dropdown-item">
                            <h6 class="fw-normal mb-0">New user added</h6>
                            <small>15 minutes ago</small>
                        </a>
                        <hr class="dropdown-divider">
                        <a href="#" class="dropdown-item">
                            <h6 class="fw-normal mb-0">Password changed</h6>
                            <small>15 minutes ago</small>
                        </a>
                        <hr class="dropdown-divider">
                        <a href="#" class="dropdown-item text-center">See all notifications</a>
                    </div>
                </div>
                -->
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle"></i>
                        <span class="d-none d-lg-inline-flex">
                            @if (Session::has('user'))
                                {{ Session::get('user')->nom_user }}
                            @endif
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                        <a href="#" class="dropdown-item">Mon profil</a>
                        <a href="/auth/logout" class="dropdown-item">D??connexion</a>
                    </div>
                </div>
            </div>
        </nav>
        <!-- Navbar End -->



        <!-- Recent Sales Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="bg-light text-center rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Liste des utilisateurs</h6>
                    <div class="col-md-4">
                        <form action="" method="post">
                            <select class="form-select form-select mb-3" aria-label=".form-select-sm example">
                                <option selected="">-------------------------------</option>
                                <option value="1">Supprimer</option>
                            </select>
                        </form>
                    </div>
                    <a href="{{ route('user.create', ['level' => 2]) }}" class="btn btn-primary"><i
                            class="bi bi-person-plus-fill"></i> nouvel
                        utilisateur</a>
                </div>
                <div class="row col-lg-12 col-md-12">
                    @if (Session::has('AUTHSDL2U'))
                        <div class="alert alert-success">
                            {{ Session::get('AUTHSDL2U') }}
                        </div>
                    @endif
                </div>
                @if (Session::has('AUTHSUL2U'))
                    <div class="alert alert-success">
                        {{ Session::get('AUTHSUL2U') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr class="text-dark">
                                <th scope="col"><input class="form-check-input" type="checkbox"></th>
                                <th scope="col">Action</th>
                                <th scope="col">Nom utilisateur</th>
                                <th scope="col">email</th>
                                <th scope="col">Statut</th>

                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($users as $user)
                                <tr>

                                    <td><input class="form-check-input" type="checkbox"></td>
                                    <td>
                                        <a class="" href="{{ route('user.edit', ['user' => $user]) }}">
                                            <i class="bi bi-pencil-fill text-warning"></i>
                                        </a>
                                        <a class="sweet-confirm" href="" id="a-{{ $user->id }}"
                                            onclick="del('{{ $user->id }}','{{ $user->nom_user }}','/user/delete/{{ $user->id }}')">
                                            <i class="bi bi-trash-fill text-danger"></i>
                                        </a>
                                        <a class="" href="/user/detail/{{ $user->id }}">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        <!-- <a class="" href="">
                                            @if ($user->statut == 0)
<i class="bi bi-toggle2-off" style="color:gray"></i>
@endif
                                            <i class="bi bi-toggle2-on"></i>
                                        </a>
                                        -->
                                    </td>
                                    <td>{{ $user->nom_user }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if ($user->statut == 1)
                                            <i class="bi bi-check-circle-fill text-success"></i>
                                        @endif
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Recent Sales End -->
    </div>
    <!-- Content End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('lib/chart/chart.min.js') }}"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Template Javascript -->
    <script src="{{ asset('js/main.js') }}"></script>
    <script>
        function del(id, nom_user, lien) {
            var rep = window.confirm('Faut-il vraiment supprimer ' + nom_user + ' ?');
            if (rep == true) {
                document.getElementById('a-' + id).href = lien;

            }
        }
    </script>
</body>

</html>
