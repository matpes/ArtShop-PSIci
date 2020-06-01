{{-- prikaz informacija o korisniku sa mogućnošću promene određenih informacija --}}
{{--    !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!     --}}
{{--!!!!DODATI: 1)IZGLED INFORMACIJA ZA ADMINA  !!!!--}}
{{--!!!!        2)LINK ZA OBJAVI SLIKU          !!!!--}}
{{--!!!!        3)LINK ZA OBJAVI IZLOŽBU        !!!!--}}
{{--    !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! !!!!--}}
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
    <script type="javascript">
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on the button, open the modal
        btn.onclick = function () {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function () {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</head>
<body class="body">
<div class="container-fluid">
    <div class="row justify-content-center noPadding">
        {{-- 1. kolona--}}
        <div class="col-md-4 mb-0 ml-0 text-md-left noPadding">
            {{--     profilna     --}}
            <div class="col-md-12 text-md-left mt-3">Profilna slika: &emsp;
                <img id='profilna' class = "img-fluid " style="" width="140px" height="140px" alt="profilna_slika"
                     src= <?php if(is_null($user->picture_path)){ echo'\images/avatar.png';}
                else {$path = '\images\users\\'.$user->picture_path; echo $path; } ?>>
            </div>
            <br>
            {{--     email     --}}
            <div class="col-md-12 text-md-left">E-mail: &emsp; {{__($user->email)}}</div>
            <br>
            {{--     username     --}}
            <div class="col-md-12 text-md-left">Korisničko ime: &emsp; {{__($user->username)}}</div>
            <br>
            {{--     password     --}}
            <form method="GET" action="{{ route('password.reset', ['token'=>csrf_token()]) }}">
                <button type="submit" class="btn-warning">
                    {{ __('Promeni lozinku') }}
                </button>
            </form>
            <br>
            {{--     tip naloga     --}}
            <div class="col-md-12 text-md-left">Tip naloga: &emsp;
                <?php if($user->isSlikar){ echo'SLIKAR';}
                else if($user->isAdmin){echo 'ADMIN';}
                else {echo 'KUPAC';}?>
            </div>
            @if($user->isSlikar)
                {{--     prosečna ocena     --}}
                <div class="text-md-left">Prosečna ocena: &emsp;
                    <?php if($slikar->sumaOcena == 0){
                        $ocena = "Nemate još nijednu ocenu/sliku";
                    } else{
                        $ocena = $slikar->sumaOcena / $slikar->brOcenjenihSlika;
                    }
                    echo $ocena; ?>
                </div>
                <br>
                {{--     broj ocena     --}}
                <div class="text-md-left">Broj ocena: &emsp;
                    <?php echo $slikar->brOcenjenihSlika; ?>
                </div>
            @endif
            <br>
        </div>
        {{-- 2. kolona--}}
        <div class="col-md-3 mb-0" style="vertical-align: middle;">
            <br>
            @if(session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
                <br>
                {{--     password     --}}
                <div class="col-md-12 text-md-left">Lozinka: &nbsp;
                    <form method="GET" action="/password/reset/">
                        <input type="hidden" name="token" value="{{csrf_token()}}">
                    </form>
                </div>
            @else
                <br> <br>
            @endif
            <form method="GET" action="{{ route('profile.picture', ['id'=> Auth::user()->id])}}">
                <button type="submit" class="btn btn-warning">
                    {{ __('Promeni profilnu sliku') }}
                </button>
            </form>
            <br> <br> <br> <br> <br>
            @if($user->isSlikar)
            <div class="row justify-content-center">
                <div class="col-md-12">
                    {{--     odjavi se     --}}
                    <form method="POST" action="{{ route('logout') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @csrf
                        <button type="submit" class="btn-warning">
                            {{ __('Izloguj se') }}
                        </button>
                    </form>
                </div>
                <br>

            </div>


            <br> <br> <br>
            @else
                <br> <br> <br>
            @endif
            <div class="row justify-content-center">
                <div class="col-md-12 float-md-left">
                    {{-- UGASI NALOG--}}
                    <button type="button" id="myBtn" class="btn btn-warning" data-toggle="modal" data-target="#myModal">
                        Ugasi nalog</button>
                </div>
            </div>
        </div>
        {{-- 3. kolona--}}
        <div class="col-md-3 mb-0">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <br> <br> <br>
                    @if(Auth::check())
                        @if($user->isSlikar)
                            {{--     profil slikara     --}}
                            <form method="GET" action="{{ route('profile.user_slikar', ['id'=>$user->id]) }}">
                                <button type="submit" class="btn btn-warning" >
                                    {{ __('Moj profil') }}
                                </button>
                            </form>
                            <br> <br>
                            {{--     objavi sliku   !!!!PROMENITI RUTU!!!!  --}}
                            <form method="GET" action="/slika">
                                <button type="submit" class="btn btn-warning" >
                                    {{ __('Objavi sliku') }}
                                </button>
                            </form>
                            <br> <br>
                            {{--     objavi izložbu   !!!!PROMENITI RUTU!!!!  --}}{{--
                            <form method="GET" action="{{ route('profile.user', ['id'=>$user->id]) }}">
                                <button type="submit" class="btn btn-warning" >
                                    {{ __('Objavi izložbu') }}
                                </button>
                            </form>--}}
                            <br> <br>
                            {{--     povratak na početnu     --}}
                            <form method="GET" action="{{ route('profile.user_new', ['id'=>$user->id]) }}">
                                <button type="submit" class="btn btn-warning" >
                                    {{ __('Povratak na početnu') }}
                                </button>
                            </form>
                            <br> <br>
                        @elseif($user->isAdmin)
                            <div class="col-md-8 offset-md-4"> admin </div>
{{--!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!NEMAM POJMA ŠTA RADI ADMIN BEM LI GA...--}}
                        @else
                            <br>
                            {{--     povratak na početnu     --}}
                            <form method="GET" action="{{ route('profile.user_new', ['id'=>$user->id]) }}">
                                <button type="submit" class="btn btn-warning" >
                                    {{ __('Povratak na početnu') }}
                                </button>
                            </form>
                            <br>
                            <form method="GET" action="/zaOcenu">
                                <button type="submit" class="btn btn-warning" >
                                    {{ __('Oceni slike') }}
                                </button>
                            </form>
                            <br>
                            {{--     odjavi se     --}}
                            <form method="POST" action="{{ route('logout') }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                @csrf
                                <button type="submit" class="btn-warning">
                                    {{ __('Izloguj se') }}
                                </button>
                            </form>
                            <br>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<div class="container-fluid">
    <div class="modal" id="myModal" style="margin-top:15%;color:black;">
        <div class="modal-dialog">
            <div class="modal-content" style="background-color:rgb(64,64,64);color:#7FF000">
                <div class="modal-header">
                    <h5 style="font-size:20px">Uklanjanje naloga</h5>
                </div>
                <div class="modal-body">
                    <p>Da li ste sigurni da želite da uklonite svoj nalog?</p>
                </div>
                <div class="modal-footer">
                    <form method="POST" action="{{ route('removeAccount',['id'=>Auth::user()->id]) }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @csrf
                        <button type="submit" class="btn btn-warning">Potvrdi</button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Odustani</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
