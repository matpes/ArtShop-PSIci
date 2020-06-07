@extends('.layouts.app')

@section('head')
    <link rel="stylesheet" href="/css/Matija.css">
    <script src="/js/Matija.js"></script>
@endsection


@section('header_form_2')
    @if(count($slike_u_korpi)>0)

        <a href="kupac_forma">
            <button type="button" class="btn-dark gray_button"> Kupi slike</button>
        </a>
    @else
        <button disabled type="button" class="btn disabledButton gray_button"> Kupi slike</button>
    @endif

@endsection

@section('content')


    <div class="row">
        <div class="col-1">

        </div>
        <div class="col-10">
            <div class="row">
                @if(count($slike_u_korpi)>0)
                    @for($i = 0; $i < count($slike_u_korpi); $i++)
                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-3 marginTop">
                            <div>
                                <a href="#" id="pictureModalWindow{{$i}}" onclick="prikazi('modalWindow{{$i}}')">
                                    <img src="{{$slike_u_korpi[$i]->path}}" alt="slika {{$i}}" class="image_cart">
                                </a>
                            </div>

                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-3 marginTop">
                            <table class="table table-borderless">
                                <tr>
                                    <td rowspan="4" colspan="2" class="dark_background korpa_kratak_opis">
                                        Slika:
                                        <br>
                                        &emsp;
                                        {{$slike_u_korpi[$i]->naziv}}
                                        <br>
                                        Slikar:
                                        <br>
                                        &emsp;
                                        {{$slikari[$i]->username}}
                                        <div align="right">
                                            <a href="#" id="pictureDeleteModalWindow{{$i}}"
                                               onclick="prikazi('deleteModalWindow{{$i}}')">
                                                <img src="/images/design/trash.png" alt="">
                                            </a>
                                        </div>

                                    </td>
                                </tr>
                                <tr></tr>
                                <tr></tr>
                                <tr></tr>

                                <tr>
                                    <td>
                                        <input type="text" value="{{$slike_u_korpi[$i]->cena}}$" disabled
                                               class="form_input_text cenaPadding" style="background-color: white">
                                    </td>
                                    <td> &nbsp;</td>
                                </tr>
                            </table>
                        </div>
                    @endfor



                @else
                    <div class="offset-3 col-6">
                        <br><br><br>
                        <div class="emptyCart" style="padding: 50px">

                            Vasa korpa je prazna

                        </div>
                    </div>

                @endif
            </div>
            <br><br><br>
        </div>
        <div class="col-1">

        </div>
    </div>


    @for($i = 0; $i < count($slike_u_korpi); $i++)

        <div id="modalWindow{{$i}}" class="modalWindow">

            <div class="row">


                <div class="col-6">
                    <img src="{{$slike_u_korpi[$i]->path}}" alt="slika{{$i}}" width="100%">
                </div>
                <div class="col-6">
                    <table class="table table-borderless">
                        <tr>
                            <td>
                                Slikar:
                            </td>
                            <td>
                                {{$slikari[$i]->username}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Stil:
                            </td>
                            <td>
                                {{$stilovi[$i]->naziv}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Tema:
                            </td>
                            <td>
                                OVDE IDE TEMA
                            </td>
                        </tr>

                    </table>
                    <div style="overflow: auto">
                        {{$slike_u_korpi[$i]->opis}}
                    </div>

                </div>
                <div class="close" id="modalClose{{$i}}" onclick="sakrij('modalWindow{{$i}}')">+</div>
            </div>
        </div>

        <div id="deleteModalWindow{{$i}}" class="modalWindow text-center">
            <div>
                <h2>Upozorenje</h2>
                <h5>Da li sigurno zelite da izbacite sliku iz korpe</h5>
                <br><br><br>
                <form method="post" action="/korpa/{{$slike_u_korpi[$i]->id}}">
                    <input type="hidden" name="_method" value="DELETE">
                    <table class="table">
                        <tr>
                            <td>
                                <input type="submit" value="Potvrdi" name="potvrdi" class="btn-dark gray_button_100">
                                {{csrf_field()}}
                            </td>
                            <td>

                                <input type="button" value="Odustani" class="btn-dark gray_button_100"
                                       id="modalDeleteClose{{$i}}" onclick="sakrij('deleteModalWindow{{$i}}')">

                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    @endfor

@endsection
