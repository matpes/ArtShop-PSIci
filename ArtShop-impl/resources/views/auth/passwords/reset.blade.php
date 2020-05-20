{{-- forma za promenu lozinke kada je korisnik ulogovan --}}
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ArtShop</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
            integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
            crossorigin="anonymous"></script>

    <link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body class="body">
<div class="row justify-content-end">
    <div class="col-md-4 offset-md-8 float-md-right">
        <img   class = "img-fluid img-rounded offset-md-10"  alt="profilna_slika" style=""  width="60px" height="60px"
               src=<?php if(is_null(Auth::user()->picture_path)){ echo'images/avatar.png';}
        else {$path = 'images/users/'.Auth::user()->picture_path; echo $path; } ?>>
    </div>
</div>
<hr>
<div class="container spaceFromHeader">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="{{ route('password.reset', ['token'=>csrf_token()]) }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @csrf
                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">
                        {{ __('Stara lozinka: ') }}</label>
                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                               name="password" required autocomplete="password"
                               placeholder="unesite staru lozinku">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="new_password" class="col-md-4 col-form-label text-md-right">
                        {{ __('Nova lozinka: ') }}</label>
                    <div class="col-md-6">
                        <input id="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror"
                               name="new_password" required autocomplete="new_password"
                               placeholder="unesite novu lozinku">

                        @error('new_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password_confirm" class="col-md-4 col-form-label text-md-right">
                        {{ __('Ponovljena lozinka: ') }}</label>
                    <div class="col-md-6">
                        <input id="password_confirm" type="password" class="form-control @error('password_confirm') is-invalid @enderror"
                               name="password_confirm" required autocomplete="password_confirm"
                                placeholder="unesite novu lozinku ponovo">

                        @error('password_confirm')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-warning">
                            {{ __('Promeni lozinku') }}
                        </button>
                    </div>
                </div>
            </form>
            <br> <br>
            <div class="form-group row mb-0">
                <div class="col-md-2 offset-md-10 float-md-left">
                    <a class="btn btn-link-btn" href="{{ route('home') }}">
                        <button type="button" class="btn btn-warning">
                            {{ __('Povratak na početnu') }}
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<footer>
    <img src="/images/logo.png" alt="ArtShopLogo" class="float-right img-fluid">
</footer>
</body>
</html>

