<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ArtShop</title>
    <!-- Favicon -->
    <link rel="icon" href="{{asset('images/logo.png')}}" type="image/gif" sizes="16x16">

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
$user
    <div class="row">
        <div class="col-md-12 float-md-right">
            $path = null;
            @if(is_null($user->profilna_slika))
                $path = '/images/avatar.png';
            @else
                $path = '/images/users/'.$user->picture_path;
            @endif
            <img class = "img-fluid img-rounded" src= $path style="width:100%" alt="profilna">
        </div>
    </div>
    <hr>
    <div class="container-fluid spaceFromHeader">
        <div class="row justify-content-center">
            <div class="col-md-4 mb-0">
                {{--   profilna     --}}
                <div class="row justify-content-center">
                    <label for="profilna" class="col-md-4 col-form-label text-md-right">
                        {{ __('Profilna slika: ') }}</label>
                    <div class="col-md-8 offset-md-4">
                        <img id='profilna' class = "img-fluid" src= $path style="width:100%" alt="profilna">
                    </div>
                    <div class="col-md-4 text-md-right">E-mail: </div>
                    <div class="col-md-8 offset-md-4">{{$user->email}}</div>
                    <div class="col-md-4 text-md-right">Korisničko ime: </div>
                    <div class="col-md-8 offset-md-4">{{$user->username}}</div>
                    <div class="col-md-4 text-md-right">Lozinka: </div>
                    <div class="col-md-8 offset-md-4">{{$user->username}}</div>
                    <div class="col-md-4 text-md-right">Tip naloga: </div>
                    <div class="col-md-8 offset-md-4">

                        @if ($user->isSlikar && !$user->isAdmin){
                                echo "slikar";
                            }
                        @else @if(!$user->isSlikar && !$user->isAdmin)
                            echo "kupac";
                            @endif
                        @endif
                    </div>

                </div>

                <div class="row justify-content-center">
                    <div class="col-md-8 offset-md-4">

                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-0">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-0">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                    </div>
                </div>
            </div>
        </div>
    </div>>
    <footer>
        <img src="/images/logo.png" alt="ArtShopLogo" class="float-right img-fluid">
    </footer>
</body>
</html>
