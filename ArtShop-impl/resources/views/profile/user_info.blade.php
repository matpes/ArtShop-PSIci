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
    <div class="row">
        <div class="col-md-12 float-md-right">
            <img   class = "img-fluid img-rounded offset-md-10"  alt="profilna_slika" style=""  width="75px" height="75px"
                   src=<?php if(is_null($user->picture_path)){ echo'images/avatar.png';}
                   else {$path = 'images/users/'.$user->picture_path; echo $path; } ?>>
        </div>
    </div>
    <hr>
    <div class="container-fluid spaceFromHeader">
        <div class="row justify-content-center">
            {{-- 1. kolona--}}
            <div class="col-md-6 mb-0">
                {{--     profilna     --}}
                <label for="profilna" class="col-md-3 col-form-label text-md-right">
                    {{ __('Profilna slika: ') }}</label>
                <div class="col-md-8 offset-md-3 align-text-top">
                    <img id='profilna' class = "img-fluid " style="" width="80px" height="80px" alt="profilna_slika"
                         src= <?php if(is_null($user->picture_path)){ echo'images/avatar.png';}
                         else {$path = 'images/users/'.$user->picture_path; echo $path; } ?>>
                </div>
                <br>
                {{--     email     --}}
                <div class="col-md-3 text-md-right">E-mail: </div>
                <div class="col-md-8 offset-md-3">{{__($user->email)}}</div>
                <br>
                {{--     username     --}}
                <div class="col-md-3 text-md-right">Korisničko ime: </div>
                <div class="col-md-8 offset-md-3">{{__($user->username)}}</div>
                <br>
                {{--     password     --}}
                <div class="col-md-3 text-md-right">Lozinka: </div>
                <div class="col-md-8 offset-md-3">
                    <button type="submit" class="btn btn-warning">
                        {{ __('Promeni lozinku') }}
                    </button>
                </div>
                <br>
                {{--     tip naloga     --}}
                <div class="col-md-3 text-md-right">Tip naloga: </div>
                    @if(Auth::check())
                        @if($user->isSlikar)
                        <div class="col-md-8 offset-md-3">slikar </div>
                            <br>
                            {{--     prosečna ocena     --}}
                            <div class="col-md-3 text-md-right">Prosečna ocena: </div>
                            <div class="col-md-8 offset-md-3">
                                <?php if(is_null($slikar)){
                                        $ocena = "Nemate još nijednu ocenu/sliku";
                                    } else{
                                        $ocena = $slikar->sumaOcena / $slikar->brOcenjenihSlika;
                                    }
                                    echo $ocena; ?>
                            </div>
                            <br>
                            {{--     broj ocena     --}}
                            <div class="col-md-3 text-md-right">Broj ocena: </div>
                            <div class="col-md-8 offset-md-3">
                                <?php echo $brOcena; ?>
                            </div>
                        @elseif($user->isAdmin)
                        <div class="col-md-8 offset-md-3"> admin </div>
                        @else
                        <div class="col-md-8 offset-md-3"> kupac </div>
                        @endif
                    @endif
                <br>
            </div>
            {{-- 2. kolona--}}
            <div class="col-md-2 mb-0">
                <br> <br>
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <form method="POST" action="{{ route('password.reset', ['token'=>csrf_token()]) }}">
                            <button type="submit" class="btn-warning">
                                {{ __('Promeni lozinku') }}
                            </button>
                        </form>
                    </div>
                </div>
                <br> <br> <br> <br>
                <div class="row justify-content-center">
                    <div class="col-md-12 float-md-right">
{{-- UGASI NALOG--}}
                    {{--
                        <div class="col-md-8 offset-md-4">
                            <a class="btn btn-link" href="{{ route('????????') }}">
                                {{ __('Ugasi nalog') }}
                            </a>
                        </div>--}}
                    </div>
                </div>
            </div>
            {{-- 3. kolona--}}
            <div class="col-md-4 mb-0">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        @if(Auth::check())
                            @if($user->isSlikar)
                                {{--     profil slikara     --}}
                                    <form method="GET" action="{{ route('profile.user', ['user'=>$user]) }}">
                                        <button type="submit" class="btn btn-warning" >
                                            {{ __('Moj profil lozinku') }}
                                        </button>
                                    </form>
                                <br>
                                {{--     objavi sliku     --}}
                                {{--<div class="col-md-8 offset-md-4">
                                    <a class="btn btn-link" href="{{ route('?????????') }}">
                                        {{ __('Objavi sliku') }}
                                    </a>
                                </div>--}}
                                <br>
                                {{--     objavi izložbu     --}}
                                {{--<div class="col-md-8 offset-md-4">
                                    <a class="btn btn-link" href="{{ route('?????????') }}">
                                        {{ __('Objavi izložbu') }}
                                    </a>
                                </div>--}}
                                {{--     povratak na početnu     --}}
                                <div class="col-md-8 offset-md-4">
                                    <a class="btn btn-link" href="{{ route('home') }}">
                                        <button type="button" class="btn btn-warning" >
                                            {{ __('Povratak na početnu') }}
                                        </button>
                                    </a>
                                </div>
                                <br>
                            @elseif($user->isAdmin)
                                <div class="col-md-8 offset-md-4"> admin </div>
                            @else
                                {{--     povratak na početnu     --}}
                                <div class="col-md-8 offset-md-4">
                                    <a class="btn btn-link" href="{{ route('home') }}">
                                        <button type="button" class="btn btn-warning" >
                                            {{ __('Povratak na početnu') }}
                                        </button>
                                    </a>
                                </div>
                                <br>
                            @endif
                            {{--     odjavi se     --}}
                            <div class="col-md-8 offset-md-4">
                                <form method="POST" action="{{ route('logout') }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    @csrf
                                    <button type="submit" class="btn-warning">
                                        {{ __('Izloguj se') }}
                                    </button>
                                </form>
                            </div>
                            <br>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    <footer>
        <img src="/images/logo.png" alt="ArtShopLogo" class="float-right img-fluid">
    </footer>
</body>
</html>
