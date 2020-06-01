@extends('.layouts.app')


@section('head')

    <link rel="stylesheet" type="text/css" href="/css/Sanja.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
    <script>
        var b = false;

        window.onbeforeunload = function (){
            if(b) {
                var path_el = document.getElementById("path").value;
                if (path_el != null) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: 'POST',
                        url: '/slika/unsave',
                        async:false,
                        processData: false,
                        contentType: false,
                        data: {path: path_el},
                        success: function (data) {
                            $("#err").html(data.naziv);
                            $("#err").attr("style",'display:block;');
                        },
                        error: function (data) {
                        }
                    });
                }
            }
        }
        window.onload = function() {
            b = false;
        }

        function go() {

            var file = $('#file_path')[0].files[0];
            var fd = new FormData();
            fd.append('file_path', file);
            var path_el = document.getElementById("path").value;
            if(path_el == "")
                path_el = 'a';
            fd.append('path', path_el);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type:'POST',
                url:'/slika/save',
                processData: false,
                contentType: false,
                data: fd,
                success: function (data) {
                    if(data.path == "error"){
                        $("#err").html(data.naziv);
                        $("#err").attr("style",'display:block;');
                    } else {
                        $("#uploaded_image").attr("src", data.path);
                        $("#uploaded_image").attr("alt", data.naziv);
                        $("#path").attr("value", data.path);
                        b = true;
                        $("#err").attr("style",'display:none;')
                    }
                    //success code
                },
                error: function (data) {
                    $("#err").html(data);
                    $("#err").attr("style",'display:block;');
                    //error code
                }
            });
        }
    </script>
@endsection

@section('content')

    <div class="row">
        <div class="col-1">

        </div>
        <div class="col-10">
            <form action="/slika" method="post" class="form-group">
                <div class="row">


                    <div class="col-sm-5 col-xs-12 padding_form_picture">
                        <img src="\images\design\images-empty.png" id="uploaded_image" width="100%" alt="empty_image">
                        <div class="bottom-obajvi-sliku">
                            <label for="file_path" class="load_file">
                                Učitaj sliku
                            </label>
                            @php($user = Auth::user())
                            <input type="hidden" id="path" name="path" value="">
                            @error('path')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <div class="invalid-feedback" style="display:none;" id="err" role="alert"></div>

                            <input id="file_path"class="form-control form_input_text  @error('username') is-invalid @enderror"
                                   type="file" name="file_path"  style="width: 100%" onchange="go()"/>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-7 paddingTopAndBot text-center">
                        <div class="row padding-top">
                            <div class="col-sm-5 text-right">
                                <label for="naziv" class="form_label_text">
                                    Naziv:
                                </label>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" name="naziv" id="naziv" class="form-control form_input_text" value="@if(isset($picture->naziv)){{$picture->naziv}} @endif">
                                <small>@if(isset($error['naziv'])){{$error['naziv']}} @endif</small>
                                {{csrf_field()}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5 text-right">
                                <label for="autor" class="form_label_text">
                                    Autor:
                                </label>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" name="autor" id="autor" class="form-control form_input_text" value="@if(isset($picture->autor)){{$picture->autor}} @endif">
                                <small>@if(isset($error['autor'])){{$error['autor']}} @endif</small>
                                {{csrf_field()}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5 text-right">
                                <label for="stil" class="form_label_text">
                                    Stil:
                                </label>
                            </div>
                            <div class="col-sm-7">
                                <select name="stil_id" id="stil" class="form-control form_input_text">
                                    <option value="renesansa" @if(isset($picture->stil_id) && $picture->stil_id == 1) selected = "selected" @endif>Renesansa</option>
                                    <option value="barok" @if(isset($picture->stil_id) && $picture->stil_id == 2) selected = "selected" @endif>Barok</option>
                                    <option value="klasicizam" @if(isset($picture->stil_id) && $picture->stil_id == 3) selected = "selected" @endif>Klasicizam</option>
                                    <option value="neoklasicizam" @if(isset($picture->stil_id) && $picture->stil_id == 4) selected = "selected" @endif>Neoklasicizam</option>
                                    <option value="romantizam" @if(isset($picture->stil_id) && $picture->stil_id == 5) selected = "selected" @endif>Romantizam</option>
                                    <option value="impresionizam" @if(isset($picture->stil_id) && $picture->stil_id == 6) selected = "selected" @endif>Impresionizam</option>
                                    <option value="simbolizam" @if(isset($picture->stil_id) && $picture->stil_id == 7) selected = "selected" @endif>Simbolizam</option>
                                    <option value="ekspresionizam" @if(isset($picture->stil_id) && $picture->stil_id == 8) selected = "selected" @endif>Ekspresionizam</option>
                                    <option value="kubizam" @if(isset($picture->stil_id) && $picture->stil_id == 9) selected = "selected" @endif>Kubizam</option>
                                    <option value="futurizam" @if(isset($picture->stil_id) && $picture->stil_id == 10) selected = "selected" @endif>Futurizam</option>
                                    <option value="dadaizam" @if(isset($picture->stil_id) && $picture->stil_id == 11) selected = "selected" @endif>Dadaizam</option>
                                    <option value="nadrealizam" @if(isset($picture->stil_id) && $picture->stil_id == 12) selected = "selected" @endif>Nadrealizam</option>
                                    <option value="popart" @if(isset($picture->stil_id) && $picture->stil_id == 13) selected = "selected" @endif>Pop art</option>
                                    <option value="postmodernizam" @if(isset($picture->stil_id) && $picture->stil_id == 14) selected = "selected" @endif>Postmodernizam</option>
                                    <option value="savremenaUmetnost" @if(isset($picture->stil_id) && $picture->stil_id == 15) selected = "selected" @endif>Savremena umetnost</option>
                                </select>
                                <small></small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5 text-right">
                                <label for="teme" class="form_label_text">
                                    Teme:
                                </label>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" name="teme" id="teme" class="form-control form_input_text" value="@if(isset($teme)){{$teme}} @endif" placeholder="npr. priroda, portret, ...">
                                <small></small>
                                {{csrf_field()}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5 text-right">
                                <label for="opis" class="form_label_text">
                                    Opis:
                                </label>
                            </div>
                            <div class="col-sm-7">
                                <textarea name="opis" id="opis" class="form-control form_input_text"> @if(isset($picture->opis)){{$picture->opis}} @endif </textarea>
                                <small>@if(isset($error['opis'])){{$error['opis']}} @endif</small>
                                {{csrf_field()}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5 text-right">
                                <label for="smer" class="form_label_text">
                                    Smer:
                                </label>
                            </div>
                            <div class="col-sm-7">
                                <select name="smer" id="smer" class="form-control form_input_text">
                                    <option value="horizontalno"@if(isset($picture->smer) && $picture->smer == 'horizontalno') selected = "selected" @endif>Horizontalno</option>
                                    <option value="vertikalno" @if(isset($picture->smer) && $picture->smer == 'vertikalno') selected = "selected" @endif>Vertikalno</option>
                                </select>
                                <small></small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="radio" name="aukcijaFlag" id="javnaAukcija" value="javnaAukcija" class="form_checkbox" @if(isset($picture->aukcijaFlag) && $picture->aukcijaFlag == 1) checked @endif>
                                {{csrf_field()}}
                            </div>
                            <div class="col-sm-6 text-left">
                                <label for="javnaAukcija" class="form_label_text">
                                    Javna aukcija
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="radio" name="aukcijaFlag" id="tajnaAukcija" value="tajnaAukcija" class="form_checkbox" @if(isset($picture->aukcijaFlag) && $picture->aukcijaFlag == 2) checked @endif>
                                {{csrf_field()}}
                            </div>
                            <div class="col-sm-6 text-left">
                                <label for="tajnaAukcija" class="form_label_text">
                                    Tajna aukcija
                                </label>
                            </div>
                        </div>
                        <div class="row padding-top">
                            <div class="col-sm-5 text-right">
                                <label for="danIstekaAukcije" class="form_label_text">
                                    Traje do:
                                </label>
                            </div>
                            <div class="col-sm-7">
                                <input type="date" name="danIstekaAukcije" id="danIstekaAukcije" class="form-control form_input_text" value=@if(isset($picture->danIstekaAukcije)) {{date($picture->danIstekaAukcije->format('Y-m-d'))}} @endif>
                                @if(isset($picture->danIstekaAukcije)) {{date($picture->danIstekaAukcije->format('Y-m-d'))}} @endif
                                <small>@if(isset($error['danIstekaAukcije'])){{$error['danIstekaAukcije']}} @endif</small>
                                {{csrf_field()}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5 text-right">
                                <label for="cena" class="form_label_text">
                                    Cena:
                                </label>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" name="cena" id="cena" class="form-control form_input_text" value="@if(isset($picture->cena)){{$picture->cena}} @endif">
                                <small>@if(isset($error['cena'])){{$error['cena']}} @endif</small>
                                {{csrf_field()}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="hidden" name="user_id" value="{{$user->id}}">
                                <button type="submit" name="potvrdi" class="btn-success form-control form_gray_button">
                                    Potvrdi
                                </button>
                                <input type="hidden" value="{{csrf_token()}}">
                            </div>
                            <div class="col-sm-6">
                                <button type="button" class="btn-success form-control form_gray_button" onclick="giveUp()">
                                    Odustani
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <br><br><br>
        </div>
        <div class="col-1">

        </div>
    </div>

@endsection



@section('footer')

    <footer>
        <img src="/images/logo.png" alt="ArtShopLogo" class="float-right img-fluid">
    </footer>

@endsection
