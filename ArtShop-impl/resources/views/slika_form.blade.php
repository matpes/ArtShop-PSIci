@extends('.layouts.app')


{{--@section('header_form')--}}

{{--    <a href="/profile/info/{{Auth::id()}}" >--}}
{{--        <img src="{{$path}}" alt="AAAA" class="img-fluid float-right" style="padding-left: 20px">--}}
{{--    </a>--}}

{{--@endsection--}}

@section('content')

    <div class="row">
        <div class="col-1">

        </div>
        <div class="col-10">
            <form action="/slika" method="post" class="form-group">
                <div class="row">


                    <div class="col-sm-5 col-xs-12 padding_form_picture">
                        <img src="@if(isset($picture->path)){{$picture->path}} @else {{'\images\design\images-empty.png'}} @endif" id="uploaded_image" width="100%">
                        <div class="bottom">
                            <label for="file_path" class="load_file">
                                Ucitaj sliku
                            </label>
                            @php($user = \App\User::find(Auth::id()))
                            <input type="hidden" id="path" name="path" value="@if(isset($picture->path)){{$picture->path}} @endif">
                            <input id="file_path" type="file" name="file_path" class="form-control form_input_text" style="width: 100%" oninput="document.getElementById('uploaded_image').setAttribute('src','\\images\\{{$user->username}}' + value.substr(value.lastIndexOf('\\'))); document.getElementById('path').value='\\images\\{{$user->username}}' + value.substr(value.lastIndexOf('\\'));"/>
                            <small>@if(isset($error['path'])){{$error['path']}} @endif</small>
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
                                <button type="button" class="btn-success form-control form_gray_button">
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
