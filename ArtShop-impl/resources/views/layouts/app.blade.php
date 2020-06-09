{{-- heder sa pretragom i prikazom login/register linkova ili profilne itd. --}}
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
@yield('head')
</head>
<body class="body">
<section>
<div class="container-fluid noPadding">
    <div class="myHeader">
        <div class="row-fluid">
            <div class="col-sm-12">
                <div class="form-group noMargin">
                    <form method="get" action="/pretraga">
                        <input type="text" name="autor" id="1" class="form-control header_input_text"
                               placeholder="Slikar">
                        <input type="text" name="tema" id="2" class="form-control header_input_text"
                               placeholder="Tematika">
                        <select name="stil" id="3" class="form-control header_input_text">
                            <option value="stil">Stil</option>
                            <option value="renesansa">Renesansa</option>
                            <option value="barok">Barok</option>
                            <option value="klasicizam">Klasicizam</option>
                            <option value="neoklasicizam">Neoklasicizam</option>
                            <option value="romantizam">Romantizam</option>
                            <option value="impresionizam">Impresionizam</option>
                            <option value="simbolizam">Simbolizam</option>
                            <option value="ekspresionizam">Ekspresionizam</option>
                            <option value="kubizam">Kubizam</option>
                            <option value="futurizam">Futurizam</option>
                            <option value="dadaizam">Dadaizam</option>
                            <option value="nadrealizam">Nadrealizam</option>
                            <option value="popart">Pop art</option>
                            <option value="postmodernizam">Postmodernizam</option>
                            <option value="savremenaUmetnost">Savremena umetnost</option>
                            <option value="realizam">Realizam</option>
                        </select>
                        <button type="submit" class="btn-dark gray_button" name="submit"> Pretraži</button>

                        @yield('header_form_2')
                        @if(Auth::check())
                            @if(!Auth::user()->isAdmin)
                                @if(Auth::user()->isSlikar)
                                {{--objavi sliku za slikare--}}
                                    <a class="btn btn-link-btn" href="/slika">
                                        <!-- {{ __('Objavi sliku') }}
                                    <a class="btn btn-link-btn" href="{{ route('login') }} class="float-md-right"> -->
                                        <button type="button" class="mr-0 btn-dark gray_button" style="width: fit-content;">{{ __('Objavi sliku') }}</button>
                                    </a>

                                @else

                                    {{--korpa za korisnike --}}
                                    <a href="/korpa" class="float-md-right mr-4">
                                        <img src="/images/design/cart.png" alt="korpa" class="img-fluid mt-1" href="/korpa" height="56px">
                                    </a>
                                @endif
                            @endif

                                {{--profilna slika --}}
                                <a href="/profile/info/{{Auth::id()}}" >
                            <img  class = "img-fluid rounded float-md-right mr-4 mt-1"  alt="profilna_slika" style=""
                                  width="60px" height="60px"
                                  src=<?php if(is_null(Auth::user()->picture_path)){ echo'/images/avatar.png';}
                            else {$path = '/images/users/'.Auth::user()->picture_path; echo $path; } ?>>
                                </a>
                        @else
                            <a class="btn btn-link" href="{{ route('login') }}">
                                {{ __('Uloguj se') }}
                            </a>
                            <a class="btn btn-link" href="{{ route('register') }}">
                                {{ __('Registruj se') }}
                            </a>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
    <hr>
</div>
<div class="spaceFromHeader">
    @yield('content')
</div>

    <footer>
        <a href="/">
            <img src="/images/logo.png" alt="ArtShopLogo" class="float-right img-fluid">
        </a>
    </footer>
</section>
{{--    @yield('footer')--}}

</body>
</html>

