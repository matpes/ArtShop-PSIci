@extends('.welcome')


@section('content')


    <div class="row">
        <div class="col-1">

        </div>
        <div class="col-10">
            <div class="row dark_background">


                <div class="col-sm-4 col-xs-12 padding_form_picture">



                        <img src="{{$slika}}" alt="Lele" class="img-fluid" width="100%" id="slika">



                    <div class="keep_it_low">
                        <table class="table table-borderless">
                            <tr>
                                <td>
                                    <label for="cena" class="form_label_text">
                                        Ukupna cena:
                                    </label>
                                </td>
                                <td>
                                    <label for="cena" class="form_label_text">
                                        14 000.0$
                                    </label>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 paddingTopAndBot text-center">
                    <form action="" class="form-group">
                        <table class="table table-borderless">
                            <tr>
                                <td class="text-right">
                                    <label for="ime" class="form_label_text">
                                        Ime:
                                    </label>
                                </td>
                                <td><input type="text" name="" id="ime" class="form-control form_input_text"></td>
                            </tr>
                            <tr>
                                <td class="text-right">
                                    <label for="prezime" class="form_label_text">
                                        Prezime:
                                    </label>
                                </td>
                                <td><input type="text" name="" id="prezime" class="form-control form_input_text"></td>
                            </tr>
                            <tr>
                                <td class="text-right">
                                    <label for="ulica" class="form_label_text">
                                        Ulica:
                                    </label>
                                </td>
                                <td><input type="text" name="" id="ulica" class="form-control form_input_text"></td>
                            </tr>
                            <tr>
                                <td class="text-right">
                                    <label for="grad" class="form_label_text">
                                        Grad:
                                    </label>
                                </td>
                                <td><input type="text" name="" id="grad" class="form-control form_input_text"></td>
                            </tr>
                            <tr>
                                <td class="text-right">
                                    <label for="brUlice" class="form_label_text">
                                        Broj ulice:
                                    </label>
                                </td>
                                <td><input type="text" name="" id="brUlice" class="form-control form_input_text"
                                           maxlength="4"></td>
                            </tr>
                            <tr>
                                <td class="text-right">
                                    <label for="zip" class="form_label_text">
                                        ZIP code:
                                    </label>
                                </td>
                                <td><input type="text" name="" id="zip" class="form-control form_input_text" size="5">
                                </td>
                            </tr>
                            <tr>
                                <td class="text-right">
                                    <label for="brTelefona" class="form_label_text">
                                        Broj telefona:
                                    </label>
                                </td>
                                <td><input type="text" name="" id="brTelefona" class="form-control form_input_text">
                                </td>
                            </tr>
                            <tr>
                                <td class="text-right">
                                    <label for="metodNaplate" class="form_label_text">
                                        Metod naplate:
                                    </label>
                                </td>
                                <td>
                                    <select name="" id="metodNaplate" class="form-control form_input_text">
                                        <option value="pou">POU (plaćanje pouzećem)</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <button type="submit" class="btn-success form-control form_gray_button">
                                        Potvrdi
                                    </button>
                                </td>
                                <td>
                                    <button type="button" class="btn-success form-control form_gray_button">
                                        Odustani
                                    </button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
            <br><br><br>
        </div>
        <div class="col-1">

        </div>
    </div>
@endsection
