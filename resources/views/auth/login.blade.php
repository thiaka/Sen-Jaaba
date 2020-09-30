<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Sen Jaaba </title>
        <meta name="description" content="Solution d’Analyse et de Traitement de stock">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('assets/images/jaaba.png')}}">

        <!-- App css -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Merriweather:300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900,900i" rel="stylesheet">
        <link href="{{asset('assets/css/login.css')}}" rel="stylesheet" type="text/css" id="app-stylesheet" />

</head>

<body>
    <div class="container-fluid">
        <div class="row no-gutter">
            <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
                <div class="col-md-8 col-lg-6">
                    <div class="login d-flex align-items-center py-5">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-9 mb-4 col-lg-8 mx-auto">
                                    <img src="{{asset('assets/images/jaaba-l.png')}}" class="img-fluid"/>
                                    <form class="mt-4" method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-label-group">
                                            <input type="email" id="inputEmail" name="email" :value="old('email')" class="form-control" placeholder="Email address" required autofocus>
                                            <label for="inputEmail">Adresse email</label>
                                        </div>

                                        <div class="form-label-group">
                                            <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
                                            <label for="inputPassword">Mot de passe</label>
                                        </div>

                                        <div class="custom-control custom-checkbox mb-3">
                                            <input type="checkbox" class="form-checkbox" name="remember">
                                            <label class="custom-control-label" for="customCheck1">Rester connecté</label>
                                        </div>

                                        <button class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" type="submit">Connexion</button>
                                        <div class="text-center">
                                            @if (Route::has('password.request'))
                                                <a class="medium" href="{{ route('password.request') }}">Mot de passe oublié ?</a>
                                            @endif
                                        </div>
                                    </form>

                                    <div class="col-md-9 mb-4 col-lg-8 mx-auto fixed-bottom">
                                        <div class="text-right">
                                            2020 © Sen Jaaba by <a href="#">ADJA M. SY & AWA DIOP</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js "></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.js "></script>
</body>

</html>
