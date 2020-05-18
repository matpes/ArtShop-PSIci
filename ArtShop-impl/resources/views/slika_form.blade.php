@extends('.layouts.app')
@section('header_form')

    <a href="/korpa">
        <img src="/images/design/cart.png" alt="" class="img-fluid float-right">
    </a>
@endsection

@section('content')

    <div class="row">
        <div class="col-1">

        </div>
        <div class="col-10">
            <form action="/slika" method="post" class="form-group">
                <div class="row">


                    <div class="col-sm-5 col-xs-12 padding_form_picture">
                        <img src="@if(isset($picture->path)){{$picture->path}} @endif" id="uploaded_image" width="100%">
                        <div class="bottom">
                            <input id="path" type="text" name="path" class="form-control form_input_text" style="width: 100%" value="@if(isset($picture->path)){{$picture->path}} @endif"/>
                            <small>@if(isset($error['path'])){{$error['path']}} @endif</small>
                            <button type="button" class="load_file" onclick="document.getElementById('uploaded_image').setAttribute('src', document.getElementById('path').value);">Ucitaj sliku</button>

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
                                    <option value="klasicizam" @if(isset($picture->stil_id) && $picture->stil_id == 1) selected = "selected" @endif>Klasicizam</option>
                                    <option value="romantizam" @if(isset($picture->stil_id) && $picture->stil_id == 2) selected = "selected" @endif>Romantizam</option>
                                    <option value="kubizam" @if(isset($picture->stil_id) && $picture->stil_id == 3) selected = "selected" @endif>Kubizam</option>
                                    <option value="barok" @if(isset($picture->stil_id) && $picture->stil_id == 4) selected = "selected" @endif>Barok</option>
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
                                <input type="hidden" name="user_id" value="1">
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
