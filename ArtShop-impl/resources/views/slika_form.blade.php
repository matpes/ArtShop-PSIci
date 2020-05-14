@extends('.layouts.app')

@section('content')

    <div class="row">
        <div class="col-1">

        </div>
        <div class="col-10">
            <div class="row">

                <div class="col-sm-5 col-xs-12 padding_form_picture">
                    <img src="{{$picture->path}}" width="100%">
                    <div class="bottom">
                        <table class="table table-borderless">
                            <tr>
                                <td>
                                    <label for="cena" class="form_label_text">
                                        Cena:
                                    </label>
                                </td>
                                <td>
                                    <input type="text" name="cena" id="cena" class="form-control form_input_text">
                                    {{csrf_field()}}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-7 paddingTopAndBot text-center">
                    <form action="slika_forma" method="post" class="form-group">
                        <div class="row padding-top">
                            <div class="col-sm-5 text-right">
                                <label for="naziv" class="form_label_text">
                                    Naziv:
                                </label>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" name="naziv" id="naziv" class="form-control form_input_text">
                                {{csrf_field()}}
                            </div>
                        </div>
                        <div class="row padding-top">
                            <div class="col-sm-5 text-right">
                                <label for="autor" class="form_label_text">
                                    Autor:
                                </label>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" name="autor" id="autor" class="form-control form_input_text">
                                {{csrf_field()}}
                            </div>
                        </div>
                        <div class="row padding-top">
                            <div class="col-sm-5 text-right">
                                <label for="stil" class="form_label_text">
                                    Stil:
                                </label>
                            </div>
                            <div class="col-sm-7">
                                <select name="stil" id="stil" class="form-control form_input_text">
                                    <option value="klasicizam">Klasicizam</option>
                                    <option value="romantizam">Romantizam</option>
                                    <option value="kubizam">Kubizam</option>
                                    <option value="barok">Barok</option>
                                </select>
                            </div>
                        </div>
                        <div class="row padding-top">
                            <div class="col-sm-5 text-right">
                                <label for="opis" class="form_label_text">
                                    Opis:
                                </label>
                            </div>
                            <div class="col-sm-7">
                                <textarea name="opis" id="opis" class="form-control form_input_text"> </textarea>
                                {{csrf_field()}}
                            </div>
                        </div>
                        <div class="row padding-top">
                            <div class="col-sm-5 text-right">
                                <label for="smer" class="form_label_text">
                                    Smer:
                                </label>
                            </div>
                            <div class="col-sm-7">
                                <select name="smer" id="smer" class="form-control form_input_text">
                                    <option value="horizontalno">Horizontalno</option>
                                    <option value="vertikalno">Vertikalno</option>
                                </select>
                            </div>
                        </div>
                        <div class="row padding-top">
                            <div class="col-sm-5">
                                <input type="checkbox" name="aukcijaFlag" id="aukcijaFlag" class="form_checkbox">
                                {{csrf_field()}}
                            </div>
                            <div class="col-sm-7 text-left">
                                <label for="danIstekaAukcije" class="form_label_text">
                                    Aukcija
                                </label>
                            </div>
                        </div>
                        <div class="row padding-top">
                            <div class="col-sm-5 text-right">
                                <label for="danIstekaAukcije" class="form_label_text">
                                    Dan isteka aukcije:
                                </label>
                            </div>
                            <div class="col-sm-7">
                                <input type="date" name="danIstekaAukcije" id="danIstekaAukcije" class="form-control form_input_text">
                                {{csrf_field()}}
                            </div>
                        </div>
                        <div class="row padding-top">
                            <div class="col-sm-6">
                                <input type="hidden" name="korisnik_id" value="1">
                                <button type="submit" name="potvrdi" class="btn-success form-control form_gray_button">
                                    Potvrdi
                                </button>
                            </div>
                            <div class="col-sm-6">
                                <button type="button" class="btn-success form-control form_gray_button">
                                    Odustani
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
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
