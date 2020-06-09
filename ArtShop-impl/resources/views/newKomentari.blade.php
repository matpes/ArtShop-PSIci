//START
@extends('layouts.app')

@section('head')
    <script src="http://code.jquery.com/jquery-3.4.0.min.js"
            integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>


    <link rel="stylesheet" href="/css/Ana.css">
    <link rel="stylesheet" href="/css/Matija.css">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <script type="text/javascript">

        function simulirajKlik() {

            document.getElementById('btnDelete').click();

            //simulateClick(document.getElementById('btnDelete'));

        }

    </script>



@endsection



@section('content')

    <div class="row">
        <div class="offset-sm-2">

        </div>
        <div class="col-sm-5">


            <h1> Komentari:</h1>

            <?php


            if (isset($_GET['submit'])) {
                $komentarToDelete_id = $_GET['name'];
            }

            $autori->toArray();
            $i = -1;
            ?>




            @foreach($sviKomentari as $komentar)
                <?php $i++;
                $autor = $autori[$i]?>

                <div class="row ">

                    <div class="offset-sm-1 col-sm-6">
                        <!--Ime autora-->
                        <div class="user_name">
                            {{$autor->username}}
                        </div>


                        <!--Komentar-->
                        <div>
                            <div class="tekst_komentara">
                                {{$komentar->tekst}}
                            </div>
                            <div>


                                @if($autor->id==$user->id)
                                    <button type="button" class="dugme" data-toggle="modal"
                                            data-target="#obrisiKomentar{{$komentar->id}}">OBRISI
                                    </button>

                                    <!--Sanjin modal-->
                                    <div class="container-fluid">
                                        <div class="modal" id="obrisiKomentar{{$komentar->id}}"
                                             style="margin-top:15%;color:black;">
                                            <div class="modal-dialog">
                                                <div class="modal-content"
                                                     style="background-color:rgb(64,64,64);color:#7FF000">
                                                    <div class="modal-header">
                                                        <h5 style="font-size:20px; color: #84deb4">Brisanje komentara</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p style="color: #84deb4">Da li ste sigurni da želite da obrisete ovaj komentar?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form method="get" action="/comment/delete">
                                                            <input type="hidden" name="_token" value="{{csrf_token()}}">

                                                            <input type="hidden" name="picture_id"
                                                                   value="{{$picture_id}}">
                                                            <input type="hidden" name="komentar_id"
                                                                   value="{{$komentar->id}}">
                                                            <button type="submit" id="potvrdiBrisanjeKomentara"
                                                                    class="btn btn-warning">Potvrdi
                                                            </button>
                                                            <button type="button" class="btn btn-warning"
                                                                    data-dismiss="modal">Odustani
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end Sanjin modal-->


                                @else
                                    <form method="get" action="/prijave">

                                        <input type="hidden" name="picture_id" value="{{$picture_id}}">
                                        <input type="hidden" name="komentar_id" value="{{$komentar->id}}">
                                        <input type="submit" class="dugme" name="submit" value="Prijavi">
                                    </form>



                                @endif
                            </div>
                        </div>
                        <br>
                    </div>
                </div>

            @endforeach




            <!--Sanjin modal-->
            <div class="container-fluid">
                <div class="modal" id="myModal" style="margin-top:15%;color:black;">
                    <div class="modal-dialog">
                        <div class="modal-content" style="background-color:rgb(64,64,64);color:#7FF000">
                            <div class="modal-header">
                                <h5 style="font-size:20px">Brisanje komentara</h5>
                            </div>
                            <div class="modal-body">
                                <p>Da li ste sigurni da želite da obrisete ovaj komentar?</p>
                            </div>
                            <div class="modal-footer">
                                <form method="get" action="/comment/delete">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    @csrf
                                    <input type="hidden" name="picture_id" value="{{$picture_id}}">
                                    <input type="hidden" name="komentar_id" value="{{$komentarToDelete_id}}">
                                    <button type="submit" id="potvrdiBrisanjeKomentara" class="btn btn-warning">
                                        Potvrdi
                                    </button>
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">Odustani</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end Sanjin modal-->


        <!--<form method="get" action="/postComment">
    <textarea name="tekst" placeholder="Enter your comment..."></textarea>
    {{ csrf_field() }}

            <input type="hidden" name="picture_id" value="{{$picture_id}}">
    <input type="submit" name="submit"  value="Objavi komentar" onclick="return confirm('Sure?')">
</form>-->


            <!--modal za unos komentara-->

            <button type="button" class="dugme" id="btnUnosKomentara" name="isSubmit" data-toggle="modal"
                    data-target="#unosKomentara">Napisi komentar
            </button>

            <!--Povratak na stranicu sa slikama-->

            <form method="get" action="/picture/{{$picture_id}}" style="display: inline; margin-left: 60px">


                <input type="hidden" name="picture_id" value="{{$picture_id}}">

                <input type="submit" class="dugme" name="submit" value="Nazad na sliku">
            </form>
            <!--Sanjin modal-->
            <div class="container-fluid">
                <div class="modal" id="unosKomentara" style="margin-top:15%;color:black;">
                    <div class="modal-dialog">
                        <div class="modal-content" style="background-color:rgb(64,64,64);color:#7FF000">
                            <div class="modal-header">
                                <h5 style="font-size:20px; color: #84deb4">Unos komentara</h5>
                            </div>
                            <div class="modal-body">
                                <p style="color: #84deb4">Unesite komentar</p>
                            </div>
                            <div class="modal-footer">
                                <form method="get" action="/postComment">
                                    <textarea rows="4" cols="35" name="tekst"
                                              placeholder="Enter your comment..."></textarea>
                                    <input type="hidden" name="_token" value="'. csrf_token() .'">
                                    <input type="hidden" name="picture_id" value="{{$picture_id}}">
                                    <button type="submit" id="potvrdiBrisanjeKomentara" class="btn btn-warning">
                                        Potvrdi
                                    </button>
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">Odustani</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>
        <div class="col-sm-4 ">
            <img src="{{\App\Picture::find($picture_id)->path}}" class="img-fluid" alt="">
        </div>
    </div>

@endsection
