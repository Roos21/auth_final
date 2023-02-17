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
                  <h5>Mot de passe oublié?</h5>
                  <p class="mb-2">Fournissez votre identifiant
                  </p>
                </div>
                <form method="post" action="{{ route('reset')}}">
                    @csrf
                    @if (Session::has('AUTHRPEI'))
                    <div class="alert alert-danger">
                      {{ Session::get('AUTHRPEI') }}
                    </div>
                    @endif
                    @if (Session::has('option') && Session::get('option') == 2)
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" class="form-control" name="email" placeholder="Entrer votre adresse Email"
                          required="">
                      </div>
                    @endif
                    @if (Session::has('option') && Session::get('option') == 3)
                    <div class="mb-3">
                        <label for="telephone" class="form-label">Numéro de téléphone</label>
                        <input type="tel" id="telephone" class="form-control" name="phrase_secrete" placeholder="Entrer votre numéro de téléphone"
                          required="">
                      </div>
                    @endif
                    @if (Session::has('option') && Session::get('option') == 1)
                    <div class="mb-3">
                        <label for="phrase_secrete" class="form-label">Phrase secrete</label>
                        <input type="text" id="phrase_secrete" class="form-control" name="phrase_secrete" placeholder="Entrer votre phrase secrète"
                          required="">
                      </div>
                    @endif
                  <div class="mb-3 d-grid">
                    <button type="submit" class="btn btn-primary">
                      Réinitialiser le mot de passe
                    </button>
                  </div>
                  <span>Vous vous êtes déjà souvenu? <a href="{{ route('login-form') }}" class="text-danger">S'identifier</a></span>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
</body>
</html>
