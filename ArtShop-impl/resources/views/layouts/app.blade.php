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
                                <option value="klasicizam">Klasicizam</option>
                                <option value="romantizam">Romantizam</option>
                                <option value="kubizam">Kubizam</option>
                                <option value="barok">Barok</option>
                            </select>
                            <button type="submit" class="btn-dark gray_button" name="submit"> Pretraži</button>

                    </form>
                    </div>{{--
                    @if(!is_null($user ?? ''))
                        @if($user ?? '' ?? ''->picture_path!=null)
                            <img style="width:100%" src="{{ asset('images/users/'.$user ?? '' ?? ''->picture_path) }}">
                        @else
                            <img style="width:100%" src="{{ asset('images/avatar.png') }}">
                        @endif
                    @endif--}}
                            @yield('header_form')
                        </form>
                    </div>


                </div>
            </div>
            <hr>
        </div>
        <div class="spaceFromHeader">
            @yield('content')
        </div>
        <div class="spaceFromHeader">
            @yield('footer')
        </div>
    </div>

</body>
</html>

