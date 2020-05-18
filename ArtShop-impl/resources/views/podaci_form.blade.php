@extends('.layouts.app')

@section('head')

    <link rel="stylesheet" href="/css/Matija.css">
    <script src="/js/Matija.js"></script>
@endsection

@section('content')


    <div class="row">
        <div class="col-1">

        </div>
        <div class="col-10">
            <div class="row dark_background">


                <div class="col-sm-4 col-xs-12 padding_form_picture">


                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

                        <ol class="carousel-indicators noMargin">
                            @for($i = 0; $i< count($slike); $i++)
                                @if($i == 0)
                                    <li class="active" data-target="#carouselExampleIndicators" data-slide-to={{$i}}
                                        ></li>
                                @else
                                    <li data-target="#carouselExampleIndicators" data-slide-to={{$i}}></li>
                                @endif
                            @endfor
                        </ol>

                        <div class="carousel-inner">
                            @for($i = 0; $i< count($slike); $i++)


                                @if($i == 0)
                                    <div class="carousel-item active">
                                        <img class="img-fluid active" src='{{$slike[$i]}}'
                                             alt="..." class="img-fluid" width="100%">
                                @else
                                            <div class="carousel-item">
                                        <img class="img-fluid" src='{{$slike[$i]}}'
                                             alt="..." class="img-fluid" width="100%">
                                @endif

                                </div>
                            @endfor
{{--                            @foreach ($slike as $slika)--}}
{{--                                <div class="carousel-item">--}}
{{--                                    <img class="img-fluid" src='{{$slika}}'--}}
{{--                                         alt="..." class="img-fluid">--}}
{{--                                </div>--}}
{{--                            @endforeach--}}
                        </div>


                        <a class="carousel-control-prev" href="#carouselExampleIndicators" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" data-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </a>
                    </div>

{{--                <img src="{{$slika}}" alt="Lele" class="img-fluid" width="100%" id="slika">--}}


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
                                    {{$cena}}$
                                </label>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

                    <!--                    FORMAAAAAAA-->
                    <!--                    FORMAAAAAAA-->
                    <!--                    FORMAAAAAAA-->
                    <!--                    FORMAAAAAAA-->


            <div class="col-xs-12 col-sm-6 paddingTopAndBot text-center">
                <form action="kupac_forma" method="post" class="form-group">
                    <table class="table table-borderless">
                        <tr>
                            <td class="text-right noDownPadding">
                                <label for="ime" class="form_label_text">
                                    Ime:
                                </label>
                            </td>
                            <td class="noDownPadding">
                                <input type="text" name="ime" id="ime" class="form-control form_input_text">
                                <label class="warning_text" id="imeNapomena" ></label>
                                {{csrf_field()}}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right noTDPadding">
                                <label for="prezime" class="form_label_text">
                                    Prezime:
                                </label>
                            </td>
                            <td class="noTDPadding">
                                <input type="text" name="prezime" id="prezime" class="form-control form_input_text">
                                <label class="warning_text" id="prezimeNapomena" ></label>

                            </td>
                        </tr>
                        <tr>
                            <td class="text-right noTDPadding">
                                <label for="grad" class="form_label_text">
                                    Grad:
                                </label>
                            </td>
                            <td class="noTDPadding">
                                <input type="text" name="grad" id="grad" class="form-control form_input_text">
                                <label class="warning_text" id="gradNapomena" ></label>

                            </td>
                        </tr>
                        <tr>
                            <td class="text-right noTDPadding">
                                <label for="adresa" class="form_label_text">
                                    Ulica:
                                </label>
                            </td>
                            <td  class="noTDPadding">
                                <input type="text" name="adresa" id="adresa" class="form-control form_input_text">
                                <label class="warning_text" id="adresaNapomena" ></label>

                            </td>
                        </tr>
                        <tr>
                            <td class="text-right noTDPadding">
                                <label for="brUlice" class="form_label_text">
                                    Broj ulice:
                                </label>
                            </td>
                            <td class="noTDPadding">
                                <input type="text" name="brUlice" id="brUlice" class="form-control form_input_text"
                                       maxlength="4">
                                <label class="warning_text" id="brUliceNapomena" ></label>

                            </td>
                        </tr>
                        <tr>
                            <td class="text-right noTDPadding">
                                <label for="zip" class="form_label_text">
                                    Poštanski broj:
                                </label>
                            </td>
                            <td class="noTDPadding">
                                <input type="text" name="ZIPCode" id="zip" class="form-control form_input_text" size="5">
                                <label class="warning_text" id="zipNapomena" ></label>

                            </td>
                        </tr>
                        <tr>
                            <td class="text-right noTDPadding">
                                <label for="brTelefona" class="form_label_text">
                                    Broj telefona:
                                </label>
                            </td>
                            <td class="noTDPadding">
                                <input type="text" name="brTelefona" id="brTelefona" class="form-control form_input_text">
                                <label class="warning_text" id="telefonNapomena" ></label>

                            </td>
                        </tr>
                        <tr>
                            <td class="text-right noUpPadding">
                                <label for="metodNaplate" class="form_label_text">
                                    Metod naplate:
                                </label>
                            </td>
                            <td class="noUpPadding">
                                <select name="metodNaplate" id="metodNaplate" class="form-control form_input_text">
                                    <option value="placanje po preuzimanju">POU (plaćanje pouzećem)</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="hidden" name="korisnik_id" value="1">
                                <button type="button" name="potvrdi" class="btn-success form-control form_gray_button" onclick="proveri()">
                                    Potvrdi
                                </button>
                            </td>
                            <td>
                                <button type="button" class="btn-success form-control form_gray_button" onclick="prikazi('odustani')">
                                    Odustani
                                </button>
                            </td>
                        </tr>
                    </table>
                    <div id="potvrdi" class="modalWindow text-center">
                        <div>
                            <h2>Upozorenje</h2>
                            <h5>Da li sigurno zelite da potvrdite kupovinu svih slika</h5>
                            <br><br><br>
                                <table class="table">
                                    <tr>
                                        <td>
                                            <input type="submit" value="Potvrdi" name="potvrdi" class="btn-dark gray_button_100">
                                            {{csrf_field()}}
                                        </td>
                                        <td>

                                            <input type="button" value="Odustani" class="btn-dark gray_button_100"
                                                   onclick="sakrij('potvrdi')">

                                        </td>
                                    </tr>
                                </table>
                        </div>
                    </div>


                    <div id="odustani" class="modalWindow text-center">
                        <div>
                            <h2>Upozorenje</h2>
                            <h5>Da li sigurno zelite da odustanete od kupovine svih slika</h5>
                            <br><br><br>
                                <table class="table">
                                    <tr>
                                        <td>
                                            <input type="submit" value="Potvrdi" name="potvrdi" class="btn-dark gray_button_100">
                                            {{csrf_field()}}
                                        </td>
                                        <td>

                                            <input type="button" value="Odustani" class="btn-dark gray_button_100"
                                                   onclick="sakrij('odustani')">

                                        </td>
                                    </tr>
                                </table>
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
