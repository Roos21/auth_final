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
                  <h5>Choississez une option de réinitialisation</h5>
                </div>
                <form method="post" action="{{ route('check') }}">
                    @csrf
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="option" id="flexRadioDefault1" checked value="1">
                        <label class="form-check-label" for="flexRadioDefault1">
                          Phrase secrète
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="option" id="flexRadioDefault2"  value="2">
                        <label class="form-check-label" for="flexRadioDefault2">
                          Email
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="option" id="flexRadioDisabled" value="3" disabled>
                        <label class="form-check-label" for="flexRadioDisabled">
                          Téléphone
                        </label>
                      </div>
                      <br>
                      <div class="mb-3 d-flex">
                        <button type="submit" class="btn btn-primary">
                          Continuer   &nbsp;&nbsp;&nbsp;<i class="bi bi-arrow-right"></i>
                        </button>
                      </div>
                  <span>Vous vous êtes déjà souvenu? <a href="{{ route('login-form') }}">S'identifier</a></span>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
</body>
</html>
