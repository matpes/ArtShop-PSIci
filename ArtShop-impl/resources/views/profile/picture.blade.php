{{-- forma za promenu profilne slike --}}
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
    <script>

        function go() {
            var file = $('#path')[0].files[0];
            var path = URL.createObjectURL(file);
            $("#uploaded_image").attr("src", path);
            console.log(path);
            $("#uploaded_image").attr("alt", file.name);
        }

    </script>
</head>
<body class="body">
<div>
    <img src="/images/logo.png" alt="ArtShopLogo" class="float-right img-fluid">
    <br><br><br>
    <hr>
</div>
<div class="container">
    <div class="form-group row mt-0">
        <div class="col-md-2 ml-0 float-md-left" style="left: -50px;">
            <a class="btn btn-link-btn" href="{{ route('home') }}">
                <button type="button" class="btn btn-warning">
                    {{ __('Povratak na početnu') }}
                </button>
            </a>
        </div>
    </div>
    <form method="POST" action="{{ route('profile.picture', ['id'=>Auth::id()]) }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group row justify-content-center">
            <div class="col-md-6 mt-0 offset-md-2">
                <img alt="profilna_slika" style="" width="300px" height="300px" src="\images\design\images-empty.png"
                     id="uploaded_image" alt="empty_image">
            </div>
        </div>
        <div class="form-group row justify-content-center">
            <div class="col-md-6 justify-content-center">
                <label for="path" class="load_file btn btn-warning @error('path') is-invalid @enderror">
                    {{ __('Učitaj sliku') }}
                </label>
                <input id="path" class="form-control form_input_text  @error('path') is-invalid @enderror"
                       type="file" name="path"  style="width: 100%" onchange="go()"/>

                @error('path')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="col-md-6 justify-content-center">
                <button type="submit" class="load_file btn btn-warning" onclick="go()">
                    {{ __('Promeni profilnu sliku') }}
                </button>
            </div>
        </div>
    </form>

</div>
</body>
</html>
