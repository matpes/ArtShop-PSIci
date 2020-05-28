@extends('layouts.app')

@section('head')
    <script src="http://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>



    <link rel="stylesheet" href="/css/Ana.css">
    <!--<link rel="stylesheet" type="text/css" href="/css/style.css">-->
    <script type="text/javascript">

        //var myJavascriptVar
      /*  $(document).ready(function() {
            $('#submit-button').on('submit', function(e){
                $('#myModal').modal('show');
                e.preventDefault();
            });
        });*/

    /*  function newF(){


      }


        var btn = document.getElementById("btnDelete");
        btn.onclick = function () {


             myJavascriptVar = document.getElementById("k").val();
            document.cookie = "myJavascriptVar=" + myJavascriptVar

              newF();

        }*/

        function simulirajKlik() {

            document.getElementById('btnDelete').click();

            //simulateClick(document.getElementById('btnDelete'));

        }
    </script>



@endsection



@section('content')

    <h1> Komentari, guys:::</h1>

    <?php


    if(isset($_GET['submit']))
    {
        $komentarToDelete_id = $_GET['name'];
    }



    //dodati pored komentara i ime autora


    $autori->toArray();
    $i=-1;
    echo '<div class="light-grey-background">';
    foreach($sviKomentari as $komentar){
        $i++;

        //$komentarToDelete_id=$komentar->id;
        $autor=$autori[$i];

        echo '<h6 class="user_name">'.$autor->username.'</h6>';
        echo '<h6><div class="komentar-box">'.$komentar->tekst.'</div></h6><form method="get" action="'. $_SERVER['PHP_SELF'].'">

                                          <!--<input type="hidden" name="picture_id" value="'.$picture_id.'">
                                              <input type="hidden" name="komentar_id" value="'.$komentar->id.'">-->
                                              <input type="hidden" name="name" value="'.$komentar->id.'">
                                              <input type="submit" name="submit" id="submitDugme" onclick="simulirajKlik()" value="Obrisi">


                                              <button type="button" id ="btnDelete" name="isSubmit" data-toggle="modal" data-target="#myModal">OBRISI</button>
                                           </form>

                                           <form method="get" action="/prijave">

                                              <input type="hidden" name="picture_id" value="'.$picture_id.'">
                                              <input type="hidden" name="komentar_id" value="'.$komentar->id.'">
                                              <input type="submit" name="submit" value="Prijavi">
                                           </form>';

    }

    echo '</div>';
//data-toggle="modal" data-target="#myModal"
        //TO DO Nazvati formu pa dohvatati preko forme kao sto smo radili na vdu najobicnije
        //TO DO Pozvati posebnu funkciju komtrolera koja ce prodledjivati odgovarajuci id ovom vjuu i onda ponovo ucitavati stranicu
    ?>





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
                            <button type="submit" id="potvrdiBrisanjeKomentara" class="btn btn-warning">Potvrdi</button>
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Odustani</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- end Sanjin modal-->



    <h1>Please type your comment:</h1>

    <form method="get" action="/postComment">
        <textarea name="tekst" placeholder="Enter your comment..."></textarea>
        {{ csrf_field() }}

        <input type="hidden" name="picture_id" value="{{$picture_id}}">
        <input type="submit" name="submit"  value="Objavi komentar" onclick="return confirm('Sure?')">
    </form>

    <!--Povratak na stranicu sa slikama-->

    <form method="get" action="/picture/{{$picture_id}}">


        <input type="hidden" name="picture_id" value="{{$picture_id}}">

        <input type="submit" name="submit" value="Nazad na sliku" onclick="return confirm('Sure?')">
    </form>

@endsection
